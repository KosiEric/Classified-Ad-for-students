<?php
$home_page_site_url = strtolower($home_page_site_url);
$my_name = 'Kosi Eric';
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
<a href ="https://$home_page_site_url/completeRegistration?code=$verification_code" title = 'Complete registration'>https://$home_page_site_url/completeRegistration?code=$verification_code</a>

<br /><br />

This email was automatically sent to you by Cicinda.com.Please do not reply to this email.
If you have any question, do not hesistate to <a href="https://$home_page_site_url/contact">contact us</a>.
Thank you.<br /><br />

The $site_name Team

</body>
</html>

BASIC_EMAIL_BODY;

?>