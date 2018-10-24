<?php

header('Content-Type: application/json');
function isValidRequest()
{
    $request_method = $_SERVER['REQUEST_METHOD'];
    $expected_request_method = 'POST';
    if ($request_method != $expected_request_method) {
        return false;

    }


exit("Request failed");

}




require_once '../security/config.php';
require_once '../security/database.php'; // Required for Necessary Database Connections.
require '../phpmailer/PHPMailerAutoload.php';

global $countries , $selected_country , $selected_state , $home_page_site_url , $home_page_site_name , $image_folder;

    class sendVerificationEmail extends DatabaseConnection {


 /* TODO: Declaring all the class variables */

 private  $firstname , $data , $error , $success ,  $lastname , $email , $password , $verification_code , $verification_timestamp , $verification_date ,
    $email_address_exists_error = "email address already exists " , $email_send_error = "failed to send email verification link, try again" ,
        $success_message = "email verification link sent to ";





        function __construct()
        {

 /* TODO : Parent::__construct() Establishes a database connection i.e DatabaseConnection Class in Security/database */



                parent::__construct();

        }



     public function processor()  {
         if($this->isReady()) {

             $this->setDetails();
             if($this->is_existing_email_address()) {

                 $this->error = Array("success" => 0 , "error" => $this->email_address_exists_error."<strong>{$this->email}</strong>");
                 $this->error = json_encode($this->error);
                 return $this->error;


             }

             else {

                 $this->setDetails();

                 $profile = Array("firstname" => ucfirst($this->firstname) , "lastname" => ucfirst($this->lastname) , "email" => ucfirst($this->email));
                 $profile = json_encode($profile);
                 $time = time();
                 $thirty_days_from_now = (86400 * 30) + $time;

                 if($this->is_unverified_email_address()) {

                     $this->reset_verification_code();
                     $this->update_existing_emails();




                     if($this->send_verification_email()) {

                         $this->error = Array("success" => 1 , "error" => $this->success_message."<strong>".$this->email."</strong>");
                         $this->error = json_encode($this->error);
                         ob_start();
                         setcookie("unverified_account" , $profile , $thirty_days_from_now , "/");
                         ob_end_flush();
                         return $this->error;
                     }

                     else {
                         $this->error = Array("success" => 0 , "error" => $this->email_send_error);
                         $this->error = json_encode($this->error);
                         return $this->error;

                     }


                 }

                 else {

                     $this->insert_into_unverified_emails();
                     if($this->send_verification_email()) {

                         $this->error = Array("success" => 1 , "error" => $this->success_message."<strong>".$this->email."</strong>");
                         $this->error = json_encode($this->error);

                         ob_start();
                         setcookie("unverified_account" , $profile , $thirty_days_from_now , "/");
                         ob_end_flush();
                         return $this->error;
                     }

                     else {
                         $this->error = Array("success" => 0 , "error" => $this->email_send_error);
                         $this->error = json_encode($this->error);
                         return $this->error;

                     }


                 }
             }

         }

         else {


             $this->error = Array("success" => 0 , "error" => $this->email_address_exists_error);
             $this->error = json_encode($this->error);
             return $this->error;
         }

     }





    private  function isReady () : bool {

        $data = ($_POST['data']) ?? null;
        if ($data == null)
            return false;
        return true;


    }


    private function setDetails () {
            global $email_verification_code_length;
        $time = time();
        $this->data = json_decode($_POST['data'] , true);
        $data = $this->data;
        $this->firstname = $data['firstname'];
        $this->lastname = $data['lastname'];
        $this->email = $data['email'];
        $this->password = $data['password'];
        $this->verification_code = bin2hex(openssl_random_pseudo_bytes($email_verification_code_length));
        if($this->is_existing_verification_code()){
            $this->setDetails();
        }

        $this->verification_timestamp = $time;
        $this->verification_date = date('d-m-Y' , $time);

          }

    function __destruct()
    {
        // TODO: Parent::__destruct() ends the  the  database connection i.e DatabaseConnection Class in Security/database

        parent::__destruct();

    }


   private function  is_unverified_email_address() : bool {
          $unverified_emails_table_name = $this->unverified_emails_table_name;
          $email_address = strtolower($this->email);
          $sql = "SELECT email_address FROM {$unverified_emails_table_name} WHERE email_address = '{$email_address}'";
          $result = $this->conn->prepare($sql);
          $result->execute();
          $num_rows = $result->rowCount();

          if($num_rows > 0) {
              return true;
          }


              return false;

    }


    private function  update_existing_emails() {
        $email_address = strtolower($this->email);
        $unverified_emails_table_name = $this->unverified_emails_table_name;

        $password = md5($this->password);
        $sql = "UPDATE {$unverified_emails_table_name} SET first_name = '{$this->firstname}' , last_name = '{$this->lastname}' , password = '{$password}' ,
 verification_date='{$this->verification_date}' , verification_timestamp = '{$this->verification_timestamp}' WHERE email_address = '{$email_address}'";
        $result = $this->conn->prepare($sql);
        $result->execute();
        return true;
    }


    private  function insert_into_unverified_emails () : bool{
        $unverified_emails_table_name = $this->unverified_emails_table_name;

        $email = $this->email;
        $firstname = ucfirst($this->firstname);
        $lastname = ucfirst($this->lastname);
        $password = md5($this->password);
        $time = time();
        $date = date("d-m-Y" , $time);
        $verification_code = $this->verification_code;
        $sql = "INSERT INTO {$unverified_emails_table_name}
 (id , first_name , last_name , email_address , password , verification_code , verification_date , verification_timestamp) VALUES 
( null , '$firstname' , '$lastname' , '$email' , '$password' , '$verification_code' , '$date' , '$time')";



        try {


            $this->conn->exec($sql);
            return true;
        }

        catch (PDOException $exception) {

            echo $exception->getMessage();
            return false;
        }

    }





    /*


    The function below checks if the email address already exists in users table.

    */

        private function  is_existing_email_address() : bool {
            $users_table_name = $this->users_table_name;

            $email_address = strtolower($this->email);
            $sql = "SELECT email_address FROM {$users_table_name} WHERE email_address = '{$email_address}'";
            $result = $this->conn->prepare($sql);
            $result->execute();
            $num_rows = $result->rowCount();

            if($num_rows > 0) {
                return true;
            }


                return false;

        }




        /*

        The function below checks  if the random verification code already exists
        to avoid two email addresses having the same verification code
        the probability of this happening is almost equal to 0 , but needless to say it still needs to be checked


        #nothingIsImpossible
*/

        private function  is_existing_verification_code() : bool {
            $unverified_emails_table_name = $this->unverified_emails_table_name;

            $verification_code = $this->verification_code;
            $sql = "SELECT verification_code FROM {$unverified_emails_table_name} WHERE verification_code = '{$verification_code}'";
            $result = $this->conn->prepare($sql);
            $result->execute();
            $num_rows = $result->rowCount();

            if($num_rows > 0) {
                return true;
            }



                return false;

        }



        /*


        the function below returns the verification code sent  previously to the same email address ,
        if the email address had previously been signed up without been verified.




        */


private  function reset_verification_code () : bool {
        $email_address = $this->email;
    $unverified_emails_table_name = $this->unverified_emails_table_name;

    $sql = "SELECT verification_code FROM $unverified_emails_table_name WHERE email_address = '{$email_address}'";
        $query = $this->conn->prepare($sql);
        $query->execute();
        $result = $query->setFetchMode(PDO::FETCH_NUM);
        $verification_code = $query->fetch()[0];
        $this->verification_code = $verification_code;
        return true;
    }




        private function  send_verification_email  ()   {

            $mail = new PHPMailer;


            //TODO: fetching some necessary variables from security/config.php file


            global $countries , $selected_country  , $home_page_site_url , $home_page_site_name , $image_folder ;
             $site_name = strtolower($home_page_site_url);
            $address = $countries[$selected_country]['head_office'];


//$mail->SMTPDebug = 3;
            $email = strtolower($this->email);
            $firstname = ucfirst($this->firstname);
            $lastname = ucfirst($this->lastname);
            $fullname = "$firstname $lastname";
            $email_address = $email;
            $home_page_site_name = ucfirst($home_page_site_name);
            $logo_image = $image_folder."fav.png";

            $verification_code = $this->verification_code;
            $time = time();
            $date = date('d-m-Y' , $time);


            // include  '../emails/basic_emails/verification_email.php';
            // include  '../emails/html_emails/verification_email.php';
            $time_string = date('h:i:s a' , $time);


            $html_email_body = <<<HTML_EMAIL_BODY

<!DOCTYPE html>
<html lang = 'en-us'>
<head>
<style type='text/css'>
#mail-logo-image {
width : 16px;
height : 16px;
position:relative;
left : 93%;

}

#email-text , #not-user-message{
font-family: 'Helvetica Neue Light',Helvetica,Arial,sans-serif;
font-size: 16px;
padding: 0px;
margin: 0px;
font-weight: normal;
line-height: 22px;
color : #222;
margin-top : 20px;
}


body {

background-color: #f5f8fa;
margin: 0;
padding: 0;

}
#final-step {

color : #222;
font-family:'Helvetica Neue',Helvetica,Arial,sans-serif;
font-size:24px;
padding:0px;
margin:0px;
font-weight:bold;
line-height:32px;
}

#date {

  display : none;
}


@media only screen and (max-width: 600px) {

#main-mail-container-div {

width : 80%;
}


}

#container{
background-color : #e1e8ed;
}

#main-mail-container-div {

margin-left : auto;
margin-right: auto;
background-color : #fff;
width : 420px;
padding : 15px;
}
#confirmation-link{

font-size: 16px;
font-family: 'HelveticaNeue','Helvetica Neue',Helvetica,Arial,sans-serif;
color: #ffffff;
text-decoration: none;
border-radius: 4px;
padding: 11px 30px;
border: 1px solid #1da1f2;
display: inline-block;
font-weight: bold;
background-color: rgb(29, 161, 242);
margin-top : 20px;
}

#not-user-message {

font-size: 12px;


}

#site-address {
color: #8899a6;

font-family: 'Helvetica Neue Light',Helvetica,Arial,sans-serif;

font-size: 12px;

font-weight: normal;

line-height: 16px;

text-align: center;
width : 180px;
margin : auto;
}

</style>
</head>

<body>
<div id ='container'>
<div id = 'main-mail-container-div'>

<!--<a href = "http://$home_page_site_url" title='$home_page_site_name'><img src="/{$logo_image}" alt='' id = 'mail-logo-image' /></a>-->
<p id = 'final-step'>Final step...</p>
<p id = 'email-text'>

Confirm your email address to complete your $home_page_site_name account <strong>$email_address</strong>. It's easy — just click the button below. 

</p>

<a href = "https://$home_page_site_url/completeRegistration/{$verification_code}" title='Complete registration' id = 'confirmation-link'>Confirm now</a>

<p id = 'not-user-message'>

This email was automatically sent to you by $site_name.Please do not reply to this email. If you have any question, do not hesistate to <a href="https://$site_name/contact">contact us.</a>  Thank you.
</p>
<p id = 'site-address'>
$home_page_site_name International ﻿Company.
$address
</p>
<br />
<span id = "date">$time_string</span>;

</div>


</div>

</body>

</html> 



HTML_EMAIL_BODY;
            $home_page_site_url = strtolower($home_page_site_url);
            $basic_email_body = <<<BASIC_EMAIL_BODY

<!DOCTYPE html>
<html lang='en-us' dir='ltr'>
<body>

Dear $firstname $lastname,<br /><br />

Thank you for registering on <a href="https://$home_page_site_url">$site_name</a>. Click on the link below
to activate your account.
<br />
<br/>
<strong>Activation Link</strong><br>
<a href ="https://$home_page_site_url/completeRegistration/{$verification_code}" title = 'Complete registration'>https://$home_page_site_url/completeRegistration/$verification_code</a>

<br /><br />

This email was automatically sent to you by $home_page_site_name.Please do not reply to this email.
If you have any question, do not hesistate to <a href="https://$home_page_site_url/contact">contact us</a>.
Thank you.<br /><br />



The $site_name Team <br /> <br />
<span style="display: none;">$time_string</span> 
</body>
</html>

BASIC_EMAIL_BODY;


            $mail->isSMTP();                                      // Set mailer to use SMTP
            $mail->Host = SITE_CONFIGURATIONS["PRIMARY_EMAIL_SERVER"];  // Specify main and backup SMTP servers
            $mail->SMTPAuth = true;
//$mail->SMTPDebug = 3;                              // Enable SMTP authentication
            $mail->Username = SITE_CONFIGURATIONS["PRIMARY_EMAIL"];                 // SMTP username
            $mail->Password = SITE_CONFIGURATIONS["PRIMARY_EMAIL_PASSWORD"];                           // SMTP password
            $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
            $mail->Port = 587;                                    // TCP port to connect to
            $site_author = SITE_CONFIGURATIONS['SITE_AUTHOR'];
            $primary_email = SITE_CONFIGURATIONS['PRIMARY_EMAIL'];
            $primary_email_server = SITE_CONFIGURATIONS['PRIMARY_EMAIL_SERVER'];
            $primary_email_password = SITE_CONFIGURATIONS['PRIMARY_EMAIL_PASSWORD'];

            try {
                $mail->setFrom($primary_email_server, "{$site_author} From {$site_name}");
            } catch (phpmailerException $e) {
              //  echo $e->getMessage();
                return false;
            }

            $mail->addAddress($email, $fullname);     // Add a recipient
//$mail->addAddress('ellen@example.com');               // Name is optional
            $mail->addReplyTo($primary_email, $site_name);

// $mail->addCC('cc@example.com');
//$mail->addBCC('bcc@example.com');

//$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
//$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
            $mail->isHTML(true);                                  // Set email format to HTML
            $mail->Subject = "Confirm your $site_name account, $fullname";
            $mail->Body = $html_email_body;
            $mail->AltBody = $basic_email_body;
            if(!$mail->send()) {
              //  echo 'Mailer Error: ' . $mail->ErrorInfo;
                return false;
            } else {
                return  true;
            }

        }




    }

$send_verification_email = new sendVerificationEmail();
echo $send_verification_email->processor();

?>