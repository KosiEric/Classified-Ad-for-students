<?php
/*$home_page_site_url = "http://google.com";
$home_page_site_url = strtolower($home_page_site_url);
$home_page_site_name = "Movybe";
$logo_image = "iiujd.png";
$address = "Block no 9";
$email_address = "ejjshsss";
$site_name = "jhsh;ls";
$verification_code = "njsdhdhhd";
*/
/** @var TYPE_NAME $html_email_body */
$html_email_body = <<<HTML_MAIL_BODY

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


@media only screen and (max-width: 600px) {

#main-mail-container-div {

width : 80%;
}


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
<div id = 'main-mail-container-div'>

<a href = "http://$home_page_site_url" title='$home_page_site_name'><img src="/{$logo_image}" alt='' id = 'mail-logo-image' /></a>
<p id = 'final-step'>Final step...</p>
<p id = 'email-text'>

Confirm your email address to complete your $home_page_site_name account <strong>$email_address</strong>. It's easy — just click the button below. 

</p>

<a href = "https://$home_page_site_url/completeRegistration?code=$verification_code" title='Complete registration' id = 'confirmation-link'>Confirm now</a>

<p id = 'not-user-message'>

This email was automatically sent to you by $site_name.Please do not reply to this email. If you have any question, do not hesistate to <a href="https://$site_name/contact">contact us.</a>  Thank you.

</p>

<p id = 'site-address'>
$home_page_site_name International ﻿Company.
$address
</p>
</div>


</body>

</html> 
HTML_MAIL_BODY;

?>
