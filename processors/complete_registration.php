<?php

header('Content-Type: application/json');
session_start();
function isValidRequest()
{
    $request_method = $_SERVER['REQUEST_METHOD'];
    $expected_request_method = 'POST';
    if ($request_method != $expected_request_method) {
        return false;

    }


    exit("Request failed");

}


$existing_user_details = json_decode($_SESSION["existing_user_details"] , true);




require_once '../security/config.php';
require_once '../security/database.php'; // Required for Necessary Database Connections.
require '../phpmailer/PHPMailerAutoload.php';


class completeRegistration extends DatabaseConnection {

    private  $username , $data , $error , $success ,  $country , $email , $password , $verification_code ,
        $primary_phone_number , $secondary_phone_number ,  $verification_timestamp , $verification_date ,
        $registration_date , $registration_timestamp , $username_exists_error = "username already exists, "
        , $email_send_error = "failed to send email verification link, try again" , $success_message = "Registration complete"
        ,  $firstname , $lastname , $signup_password , $password_match_error = "password does not match signup password",  $user_id ,
        $primary_phone_exists_error = "Primary phone already exists." , $secondary_phone_exists_error = "Secondary phone already exists" ,
        $connection_error;






    function __construct()
    {

        parent::__construct();

    }



    public function processor()  {

        if($this->isReady()) {

            $this->setDetails();
            if(!$this->record_exists_in_table("users" , "username" , $this->username)) {

                $this->setDetails();

                $time = time();
                $thirty_days_from_now = (86400 * 30) + $time;
                if($this->is_previous_password()) {

                    if(!$this->record_exists_in_table("users" , "primary_phone" , $this->primary_phone_number) and !$this->record_exists_in_table("users" , "secondary_phone" , $this->primary_phone_number) ){

                        if((!empty($this->secondary_phone_number) and $this->record_exists_in_table("users" , "secondary_phone" , $this->secondary_phone_number)) or (!empty($this->secondary_phone_number) and $this->record_exists_in_table("users" , "primary_phone" , $this->secondary_phone_number))){

                            $this->error = Array("success" => 0 , "error" => $this->secondary_phone_exists_error." <strong>{$this->secondary_phone_number}</strong>");
                            $this->error = json_encode($this->error);
                            return $this->error;
                        }


                        if($this->insert_into_users()) {
                            //$this->deleteRecord();
                            $this->error = Array("success" => 1 , "error" => $this->success_message);
                            $this->error = json_encode($this->error);
                            ob_start();
                            setcookie("current_active_user" , $this->user_id , $thirty_days_from_now , "/");
                            setcookie("unverified_account" , $this->user_id, $time - 300 , "/");
                            $_SESSION["current_active_user"] = $this->user_id;
                            unset($_SESSION["existing_user_details"]);
                            
                            ob_end_flush();
                            return $this->error;
                        }

                        else {
                            $this->error = Array("success" => 0 , "error" => $this->connection_error);
                            $this->error = json_encode($this->error);
                            return $this->error;

                        }

                    }

                    else {
                        $this->error = Array("success" => 0 , "error" => $this->primary_phone_exists_error." <strong>{$this->primary_phone_number}</strong>");
                        $this->error = json_encode($this->error);
                        return $this->error;


                    }




                }

                else {



                    $this->error = Array("success" => 0 , "error" => $this->password_match_error);
                    $this->error = json_encode($this->error);
                    return $this->error;





                }


            }

            else {
                $this->error = Array("success" => 0 , "error" => $this->username_exists_error."<strong>".$this->username."</strong>");
                $this->error = json_encode($this->error);
                return $this->error;


                }

        }

        else {


            $this->error = Array("success" => 0 , "error" => $this->connection_error);
            $this->error = json_encode($this->error);
            return $this->error;
        }

    }


    private  function  deleteRecord() : bool {
        
        $email_address = $this->email;
        $sql = "DELETE FROM unverified_emails WHERE email_address = '{$email_address}'";
        if ($this->conn->exec($sql)) {
            return true;
        }
        
        return false;
        
    }


    public function isReady () : bool {

        $data = ($_POST['data']) ?? null;
        if ($data == null) {

            return false;

        }

        return true;

    }


    public function setDetails () {
        global $existing_user_details;
        $time = time();
        $this->data = json_decode($_POST['data'] , true);
        $data = $this->data;
        $this->username = $data['username'];
        $this->primary_phone_number = $data['primaryPhoneNumber'];
        $this->secondary_phone_number = $data['secondaryPhoneNumber'];
        $this->email = $data['email'];
        $this->password = $data['password'];

        $this->firstname = $existing_user_details["first_name"];
        $this->lastname = $existing_user_details["last_name"];
        $this->user_id = uniqid(null);

        $this->registration_timestamp = $existing_user_details["verification_timestamp"];
        $this->registration_date = $existing_user_details["verification_date"];
        $this->verification_date = date('d-m-Y' , $time);
        $this->signup_password = $existing_user_details["password"];


    }

    private function is_previous_password () : bool {

        if (md5($this->password) == $this->signup_password){
            return true;
        }

        return false;

    }

    function __destruct()
    {
        parent::__destruct(); // TODO: Change the autogenerated stub
    }





     public function get_user_id() : string {

         $this->user_id = uniqid(null);

         if($this->record_exists_in_table("users" , "user_id" , $this->user_id)){
             $this->get_user_id();
         }

         return $this->user_id;

             }

    private  function insert_into_users() : bool{
        global $selected_country;
        $username = $this->username;
        $user_id = $this->get_user_id();
        $email = $this->email;
        $primary_phone = $this->primary_phone_number;
        $secondary_phone = (empty($this->secondary_phone_number)) ? "null" : $this->secondary_phone_number;
        $password = md5($this->password);
        $profile = "user.png";
        $firstname = ucfirst($this->firstname);
        $lastname = ucfirst($this->lastname);
        $school = "null";
        $state = "null";
        $country = $selected_country;
        $registration_date = $this->registration_date;
        $registration_timestamp = $this->registration_timestamp;
        $email_verified = 1;
        $last_seen = time();
        $active = 1;
        $sql = "INSERT INTO users
 (id , username , user_id , email_address , primary_phone , secondary_phone , password , profile , first_name , last_name , business_type , state , country , registration_date , registration_timestamp , email_verified , last_seen , active) 
 VALUES 
(null , '{$username}' , '{$user_id}' , '{$email}' , '{$primary_phone}' , '{$secondary_phone}' , '{$password}' , '{$profile}' , '{$firstname}' , '{$lastname}' , '{$school}' , '{$state}' , '{$selected_country}' , '{$registration_date}' , '{$registration_timestamp}' , '{$email_verified}' , '{$last_seen}' , '{$active}')";



        try {


            $this->conn->exec($sql);
            return true;
        }

        catch (PDOException $exception) {

            echo $exception->getMessage();
            return false;
        }

    }



    public function  send_welcome_email  ()   {

        $mail = new PHPMailer;
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
<p id = 'final-step'>Registration complete.</p>
<p id = 'email-text'>

Thanks for creating a  $home_page_site_name account. It's easy — just click the button below. 

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
<a href ="https://$home_page_site_url/completeRegistration/{$verification_code}" title = 'Complete registration'>https://$home_page_site_url/completeRegistration?code=$verification_code</a>

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
        $mail->Subject = "Welcome to $site_name , $fullname";
        $mail->Body = $html_email_body;
        $mail->AltBody = $basic_email_body;
        if(!$mail->send()) {
           // echo 'Mailer Error: ' . $mail->ErrorInfo;
            return false;
        } else {
            return  true;
        }

    }




}

$complete_registration = new completeRegistration();
echo $complete_registration->processor();

?>