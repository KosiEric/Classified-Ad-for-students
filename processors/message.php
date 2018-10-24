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


class sendMessage extends DatabaseConnection
{
    private $name, $email, $ad_poster_details, $subject, $body, $msg_id, $sent_to, $database_error_message = "please check your network connection", $time, $ad_id, $functions, $configurations, $email_subject = "", $error, $success_msg = "Message sent successfully!", $email_error_message = "couldn't send message to user, check back later";

    public function __construct()
    {
        // TODO: Implement __destruct() method.
        parent::__construct();
        $this->functions = new Functions();
        $this->configurations = new Configurations();
    }

    public function __destruct()
    {
        // TODO: Implement __destruct() method.
        parent::__destruct();
    }

    private final function setDetails(): bool
    {

        $this->data = json_decode($_POST['data'], true);

        $this->name = ucwords($this->data["name"]);
        $this->email = strtolower($this->data['email']);
        $this->subject = $this->functions->escape_string(ucfirst($this->data["subject"]));
        $this->body = $this->functions->escape_string($this->data["body"]);
        $this->msg_id = $this->functions->generateID($this->configurations->length_of_msg_id);
        $this->sent_to = $this->data["sentTo"];
        $this->time = time();
        $this->ad_id = $this->data["ad_id"];

        $this->ad_poster_details = $this->functions->getAdPosterDetails($this->ad_id);
        if ($this->record_exists_in_table($this->messages_table_name, 'message_id', $this->msg_id))
            $this->setDetails();
        return true;

    }

    private final function isReady(): bool
    {
        if (isset($_POST['data']) and !empty($_POST['data']))
            return true;
        return false;

    }

    private final function insert_to_database()
    {
        $sql = "INSERT INTO {$this->messages_table_name} (name , subject , body , message_id , sent_to , time_sent , ad_id , message_read)  
                VALUES ('{$this->name}' , '{$this->subject}' , '{$this->body}' , '{$this->msg_id}' , '{$this->sent_to}' , '{$this->time}' , '{$this->ad_id}' , '0')";
        if ($this->conn->exec($sql)) {
            return true;
        } else {

            //echo $exception->getMessage();
            return false;
        }


    }

    private final function send_message(): bool
    {

        $mail = new PHPMailer;


        //TODO: fetching some necessary variables from security/config.php file


        global $countries, $selected_country, $home_page_site_url, $home_page_site_name, $image_folder;
        $site_name = strtolower($home_page_site_url);
        $address = $countries[$selected_country]['head_office'];


//$mail->SMTPDebug = 3;
        $email = strtolower($this->email);


        $email_address = $email;
        $home_page_site_name = ucfirst($home_page_site_name);
        $logo_image = $image_folder . "fav.png";


        $time = time();
        $date = date('d-m-Y', $time);


        // include  '../emails/basic_emails/verification_email.php';
        // include  '../emails/html_emails/verification_email.php';
        $time_string = date('h:i:s a', $time);


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
<p id = 'final-step'>Message From {$this->name}</p>
<p id = 'email-text'>
Dear {$this->ad_poster_details['full_name']} , 
</p>
<p>A message was sent to you by {$this->name} ({$this->email})</p>

<strong>Subject : </strong><br />

<p>
 {$this->subject}

</p>


<strong> Message : </strong><br/ >

 <p>

{$this->body}  

</p>



<p id = 'not-user-message'>

This email was automatically sent to you by $site_name. If you have any question, do not hesistate to <a href="https://$site_name/contact">contact us.</a>  Thank you.
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
<div id ='container'>
<div id = 'main-mail-container-div'>

<!--<a href = "http://$home_page_site_url" title='$home_page_site_name'><img src="/{$logo_image}" alt='' id = 'mail-logo-image' /></a>-->
<p id = 'final-step'>Message From {$this->name}</p>
<p id = 'email-text'>
Dear {$this->ad_poster_details['full_name']} , 
</p>
<p>A message was sent to you by {$this->name}({$this->email})</p>

<strong>Subject : </strong> <br />

<p>
 {$this->subject}

</p>


<strong> Message : </strong> </br />

 <p>

{$this->body}  

</p>



<p id = 'not-user-message'>

This email was automatically sent to you by $site_name. If you have any question, do not hesistate to <a href="https://$site_name/contact">contact us.</a>  Thank you.
</p>
<p id = 'site-address'>
$home_page_site_name International ﻿Company.
$address
</p>
<br />
<span id = "date">$time_string</span>;

</div>


</div></body>
</html>

BASIC_EMAIL_BODY;


        $mail->isSMTP();                                      // Set mailer to use SMTP
        $mail->Host = SITE_CONFIGURATIONS["PRIMARY_EMAIL_SERVER"];  // Specify main and backup SMTP servers
        $mail->SMTPAuth = true;
//$mail->SMTPDebug = 3;                              // Enable SMTP authentication
        $mail->Username = SITE_CONFIGURATIONS["MESSAGE_EMAIL"];                 // SMTP username
        $mail->Password = SITE_CONFIGURATIONS["MESSAGE_EMAIL_PASSWORD"];                           // SMTP password
        $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
        $mail->Port = 587;                                    // TCP port to connect to
        $site_author = SITE_CONFIGURATIONS['SITE_AUTHOR'];
        $message_email = SITE_CONFIGURATIONS['PRIMARY_EMAIL'];
        $primary_email_server = SITE_CONFIGURATIONS['PRIMARY_EMAIL_SERVER'];
        $primary_email_password = SITE_CONFIGURATIONS['PRIMARY_EMAIL_PASSWORD'];

        try {
            $mail->setFrom($this->email, "{$this->name} From {$site_name}");
        } catch (phpmailerException $e) {
            //  echo $e->getMessage();
            return false;
        }

        $mail->addAddress($this->ad_poster_details["email_address"], $this->name);     // Add a recipient
//$mail->addAddress('ellen@example.com');               // Name is optional
        $mail->addReplyTo($this->ad_poster_details["email_address"], $this->name);

// $mail->addCC('cc@example.com');
//$mail->addBCC('bcc@example.com');

//$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
//$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
        $mail->isHTML(true);                                  // Set email format to HTML
        $mail->Subject = "{$this->functions->getAdDetails($this->ad_id)['title']} | $home_page_site_name";
        $mail->Body = $html_email_body;
        $mail->AltBody = $basic_email_body;
        if (!$mail->send()) {
            //  echo 'Mailer Error: ' . $mail->ErrorInfo;
            return false;
        } else {
            return true;
        }

    }


    public final function Processor()
    {
        if ($this->isReady()) {
            if ($this->setDetails()) {
                if ($this->send_message()) {

                    if (!$this->insert_to_database()) {
                        $this->error = Array("success" => "0", "error" => $this->database_error_message);
                        $this->error = json_encode($this->error);
                        return $this->error;
                    }

                                       $this->error = Array("success" => "1" , "error" => $this->success_msg);
                                       $this->error = json_encode($this->error);
                                       return $this->error;

                }

                else {

                    $this->error = Array("success" => "0", "error" => $this->email_error_message);
                    $this->error = json_encode($this->error);
                    return $this->error;
                }
            }
        }
    }

}

$send_message = new sendMessage();
echo $send_message->Processor();

?>