<?php

header('Content-Type: application/json');
//session_start();
function isValidRequest()
{
    $request_method = $_SERVER['REQUEST_METHOD'];
    $expected_request_method = 'POST';
    if ($request_method != $expected_request_method) {
        return false;

    }


    exit("Request failed");

}



require_once '../security/functions.php';
require_once '../security/config.php';
require_once '../security/database.php'; // Required for Necessary Database Connections.
require '../phpmailer/PHPMailerAutoload.php';

global $countries , $selected_country , $selected_state , $home_page_site_url , $home_page_site_name , $image_folder;

class createUpdateProfile extends DatabaseConnection
{


    /* TODO: Declaring all the class variables */

    private  $data, $name, $email, $primary_contact , $secondary_contact , $state , $school ,  $username, $profile , $action ,  $error, $success,  $verification_code, $verification_timestamp, $verification_date,
        $email_address_exists_error = "email address already registered",   $userID = "" ,$email_send_error = "failed to send email verification link, try again",
        $success_message = "Account created successfully! , email verification link sent to " , $functions , $image_error , $primary_contact_exists_error = "Sorry , primary contact belongs to another profile" , $secondary_contact_exists_error = "secondary contact belongs to another profile" , $network_error = "seems we are having issues with your connection!" ,
        $password_reset_code , $email_verification_code , $image_upload_error = "failed to upload image, please try again sometime" , $user_profile_image;




    function __construct()
    {

        /* TODO : Parent::__construct() Establishes a database connection i.e DatabaseConnection Class in Security/database */


        parent::__construct();
        $this->functions = new Functions();
    }
    function __destruct()
    {
        // TODO: Parent::__destruct() ends the  the  database connection i.e DatabaseConnection Class in Security/database

        parent::__destruct();

    }
private function  setIDs () {
        global $email_verification_code_length , $password_recovery_code_length , $user_id_length; // Gotten from config.php;
        $functions = $this->functions;
        $this->password_reset_code = $functions->generateID($password_recovery_code_length);
        $this->email_verification_code = $functions->generateID($email_verification_code_length);
        $this->userID = $functions->generateID($user_id_length);
        if($this->record_exists_in_table($this->users_table_name , "user_id" , $this->userID) or
            $this->record_exists_in_table($this->users_table_name , "password_reset_code" , $this->password_reset_code) or
            $this->record_exists_in_table($this->users_table_name , "email_verification_code" , $this->email_verification_code)
        ){
            $this->setIDs();
        }
        else {
            return true;
        }
}

    private  final   function isReady () : bool
    {

        if($_SERVER["REQUEST_METHOD"] == "POST") {

           $this->data = ($_POST) ?? null;
           if($this->data != null)
               return true;
           return false;

        }

    }


    private final function setDetails () : bool  {
        $time = time();
        $this->name = ucwords($_POST["name"]);
        $this->email = $_POST["email"];
        $this->primary_contact = $_POST["primary"];
        $this->secondary_contact = $_POST["secondary"];
        $this->state = $_POST["state"];
        $this->school = $_POST["school"];
        $this->username = $_POST["username"];
        $this->profile = $_FILES["profile"];
        $this->setIDs();
        $this->verification_timestamp = $time;
        $this->verification_date = date('d-m-Y' , $time);
         return true;

    }

    private final function  username_exists()  : bool {


        if($this->record_exists_in_table($this->users_table_name , "username" , $this->username ))   {
                         return true;
        }

               else {

                                  return false;
               }
    }

    private final  function  email_exists () : bool  {
        if($this->record_exists_in_table($this->users_table_name , "email_address" , $this->email))
            return true;
        return false;
    }


    private final function primary_contact_doesnt_exists () : bool {

        if(!$this->record_exists_in_table($this->users_table_name , "primary_phone" , $this->primary_contact) &&
            !$this->record_exists_in_table($this->users_table_name , "secondary_phone" , $this->primary_contact)){
            return true;
        }
       return false;
    }



    private final function secondary_contact_doesnt_exists () : bool {

        if(!$this->record_exists_in_table($this->users_table_name , "primary_phone" , $this->secondary_contact) &&
            !$this->record_exists_in_table($this->users_table_name , "secondary_phone" , $this->secondary_contact)){
            return true;
        }
        return false;
    }
private function  isValidImage () :  bool
 {
global $max_user_profile_image_size;

        $profile = $_FILES['profile'];


        $file_name = $profile['name'];
        $file_size = $profile['size'];
        $file_type = $profile['type'];
        $file_error = $profile['error'];
        $tmp_name = $profile['tmp_name'];


        $functions = $this->functions;
        $is_image = $functions->isImage($tmp_name);
        $is_file_type = $functions->isFileType($file_name , 'image' , $functions->profile_upload_directory);
        $is_file_size = $functions->isFileSize($file_size , $max_user_profile_image_size);

        if($is_image){
            if($is_file_type) {
                if($is_file_size) {
                    return true;
                }
                else {
                    $max_image_size_mb = round($max_user_profile_image_size / 1000000);
                    $this->image_error = "Max image size allowed : $max_image_size_mb";
                    return false;
                }
            }
            else {

                $this->image_error = "Only .png , .jpg  and .jpeg images are allowed";
                return false;
            }
        }
        else {
            $this->image_error = "Only .png , .jpg  and .jpeg images are allowed";
            return false;
        }




 }



 private  final function  upload_image ()
 {
     $functions = $this->functions;

     $filename = $this->profile["name"];
     $tmp_name = $this->profile["tmp_name"];
     $new_name = $functions->changeFileName($filename, $this->userID);

     $target_dir = $functions->profile_upload_directory;
     $new_filename = $target_dir . $new_name;
     if (move_uploaded_file($tmp_name, $new_filename)) {
         $this->user_profile_image = $new_name;
         return true;
     } else {
         $this->image_error = $this->image_upload_error;
         return false;
     }
 }
    private final  function insert_into_users() : bool{
        global $selected_country;
        $username = $this->username;
        $user_id = $this->userID;
        $email = $this->email;
        $primary_phone = $this->primary_contact;
        $secondary_phone = (empty($this->secondary_contact)) ? "null" : $this->secondary_contact;
        $profile = $this->user_profile_image;
        $fullname = $this->name;

        $school = $this->school;
        $state = $this->state;
        $country = $selected_country;
        $registration_date = $this->verification_date;
        $registration_timestamp = $this->verification_timestamp;
        $email_verified = 0;
        $last_seen = $registration_date;
        $active = 1;
        $password_reset_code = $this->password_reset_code;
        $email_verification_code = $this->email_verification_code;
        $users_table_name = $this->users_table_name;
        $sql = "INSERT INTO $users_table_name
 (id , username , user_id , email_address , primary_phone , secondary_phone , profile , full_name ,  state , school , country , registration_date , registration_timestamp , email_verified , last_seen , active , password_reset_code , email_verification_code) 
 VALUES 
(null , '{$username}' , '{$user_id}' , '{$email}' , '{$primary_phone}' , '{$secondary_phone}' , '{$profile}' , '{$fullname}' , '{$state}' , '{$school}' , '{$country}' , '{$registration_date}' , '{$registration_timestamp}' , '{$email_verified}' , '{$last_seen}' , '{$active}' , '{$password_reset_code}' , '{$email_verification_code}')";



        if( $this->conn->exec($sql)){

            return true;
        }

        else   {

           //echo $exception->getMessage();
            return false;
        }

    }

    private final function  send_verification_email  ()   {

        $mail = new PHPMailer;


        //TODO: fetching some necessary variables from security/config.php file


        global $countries , $selected_country  , $home_page_site_url , $home_page_site_name , $image_folder ;
        $site_name = strtolower($home_page_site_url);
        $address = $countries[$selected_country]['head_office'];


//$mail->SMTPDebug = 3;
        $email = strtolower($this->email);

        $fullname = $this->name;
        $email_address = $email;
        $home_page_site_name = ucfirst($home_page_site_name);
        $logo_image = $image_folder."fav.png";

        $verification_code = $this->email_verification_code;
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
Dear $fullname , <br /> <br />
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

Dear $fullname ,<br /><br />

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



  public function processor () {


        if($this->isReady()){
            if($this->setDetails()){
                if($this->primary_contact_doesnt_exists()) {
if($this->secondary_contact_doesnt_exists()){
    if(!$this->email_exists()){
        if($this->isValidImage()){
           if($this->upload_image()){
              if(!$this->insert_into_users()){
                  $this->error = Array("success" => 0 , "error" =>  $this->network_error);
                  $this->error = json_encode($this->error);
                  return $this->error;
              }

               $this->error = Array("success" => 1 , "error" => $this->success_message."<strong>".$this->email."</strong>"  , "user_id" => $this->userID);
               $this->error = json_encode($this->error);
               $time = time();


               $thirty_days_from_now = (86400 * 30) + $time;

               setcookie("current_active_user" , $this->userID , $thirty_days_from_now , "/");

               try {

               $this->send_verification_email();
               }
               catch (Exception $exception){

               }

               return $this->error;
           }
           else {
               $this->error = Array("success" => 0 , "error" => $this->image_error);
               $this->error = json_encode($this->error);
               return $this->error;

           }
        }
        else {
            $this->error = Array("success" => 0 , "error" => $this->image_error);
            $this->error = json_encode($this->error);
            return $this->error;
        }
    }
    else {
        $this->error = Array("success" => 0 , "error" => $this->email_address_exists_error);
        $this->error = json_encode($this->error);
        return $this->error;
    }


}

else {

    $this->error = Array("success" => 0 , "error" => $this->secondary_contact_exists_error);
    $this->error = json_encode($this->error);
    return $this->error;
}
                }

                else {
                    $this->error = Array("success" => 0 , "error" => $this->primary_contact_exists_error);
                    $this->error = json_encode($this->error);
                    return $this->error;

                }
            }
        }
  }


}

$create_update_profile = new createUpdateProfile();
//$create_update_profile->isReady();

echo $create_update_profile->processor();
?>


