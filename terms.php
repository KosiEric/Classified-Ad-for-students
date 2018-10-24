<?php

if(!class_exists("Configurations")){

    $document_root = $_SERVER['DOCUMENT_ROOT'];
    require_once ($document_root.'/security/config.php');
    require_once ($document_root.'/security/database.php');
    require_once ($document_root.'/security/functions.php');


}
$page_action = "";
if(isset($_GET['action'])) {
    $page_action = (strtolower($_GET['action'])) ?? "nothing";
    $page_actions = Array("login", "signup");

    if (!in_array($page_action, $page_actions)) {
        $page_action = null;
    }

}
// Instanciating the  functions class

$functions = new Functions();
$cookie_username = "";


require_once ('req/other.php');
$home_page_site_name = ucfirst($home_page_site_name);
$site_features = "Electronics , Phones , Tablets , Home , Furniture and More";
$page_title = "Frequently asked Questions  • {$home_page_site_name} ";
$page_description = "Welcome to {$home_page_site_name}.com ";
$page_keywords = "E-commerce,Phones,Tablets,Fashion,Clothes,Laptops,Computers,Beauty,Care,";
$include_bootstrap = true;
$include_custom_check_box = false;
$include_bootstrap_js = false;
?>
<!DOCTYPE html <?php echo $other_doctype_attribute; ?>>
<html lang="en-us"  xmlns = "http://www.w3.org/1999/xhtml" dir="ltr">
<head>
    <script src="<?php echo SITE_CONFIGURATIONS['JS_FOLDER']?>universities.js"></script>

    <?php require_once SITE_CONFIGURATIONS['HTML_FOLDER'].'meta.php'; ?>
    <link rel="stylesheet" href="<?php echo SITE_CONFIGURATIONS['CSS_FOLDER']?>bootstrap.min.css"/>
    <link rel="stylesheet" href="<?php echo SITE_CONFIGURATIONS['CSS_FOLDER']?>animate.css">
    <link rel="stylesheet" href="<?php echo SITE_CONFIGURATIONS['CSS_FOLDER']?>owl.carousel.css">
    <link rel="stylesheet" href="<?php echo SITE_CONFIGURATIONS['CSS_FOLDER']?>main.css" />
    <link rel="stylesheet" href="<?php echo SITE_CONFIGURATIONS['CSS_FOLDER']?>responsive.css" />
    <link rel="stylesheet" href="<?php echo SITE_CONFIGURATIONS['CSS_FOLDER']?>percentage.css" />

    <script src="<?php echo SITE_CONFIGURATIONS['JS_FOLDER']?>post-ad.js"></script>

    <!-- font -->
    <!-- favicon icon -->

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>

    <![endif]-->
    <style type="text/css">
        #breadcrumb-section{

            -webkit-background-size: cover;
            background-size: cover !important;
            background-repeat: no-repeat !important;
        }


        #breadcrumb-section {
            background-image: url("<?php echo SITE_CONFIGURATIONS['IMG_FOLDER']?>items-sold.jpg") !important;

            display:none !important;

        }


    </style>



    <style>
        @media only screen and (min-width:620px) {
            #breadcrumb-section {
                background-image: url("<?php echo SITE_CONFIGURATIONS['IMG_FOLDER']?>breadcrumb-bg.jpg") !important;

                echo "display:none";

            }

            #ad-post-header{
                color : #fff;
                opacity: .6;
            }
        }
    </style>


</head>
<body>
<?php require_once SITE_CONFIGURATIONS["HTML_FOLDER"].'default-header.php'; ?>
<div class="page container" id = "">


    <div id = "terms-policy-container">

        <span id = "terms-header">Terms of usage</span>

        <span class = "terms-texts">All users must comply with the terms and conditions on this page </span>

        <span class = "terms-headers">Public Use</span>
        <span class = "terms-texts">
All users should commit to ethics and values and should refrain from insult and abuse of the site. </span>
        <span class = "terms-headers">Privacy Policy</span>
        <span class = "terms-texts">
All users have to read the privacy policy linked to in the footer and their use of the website implicates agreement to the policy. </span>
        <span class = "terms-headers">Denial of Access</span>

        <span class = "terms-texts"><?php echo $home_page_site_name; ?> has the right to block any user from accessing the website or using it's services in general. </span>
        <span class = "terms-headers">Impersonation</span>
        <span class = "terms-texts">
Impersonation by name or subdomain is not allowed and <?php echo $home_page_site_name; ?> has the right to take adequate actions. </span>
        <span class = "terms-headers">Inactive Accounts</span>
        <span class = "terms-texts">
<?php echo $home_page_site_name; ?> has the right to remove inactive accounts under the duration that <?php echo $home_page_site_name; ?> sees adequate. </span>
        <span class = "terms-headers">Removal of Ads and Accounts</span>
        <span class = "terms-texts">
<?php echo $home_page_site_name; ?> has the right to remove any message or account with the justification that the website management sees adequate. </span>
        <span class = "terms-headers">Information</span>
        <span class = "terms-texts">
<?php echo $home_page_site_name; ?> has the right to use the information input by users with agreement to the privacy policies.

<span class = "terms-headers">E-mail</span>
<span class = "terms-texts">
<?php echo $home_page_site_name; ?> has the right to e-mail users with what <?php echo $home_page_site_name; ?> sees adequate with the option to unsubscribe from notification e-mails
<span class = "terms-headers">Modifications of Terms and Conditions</span>
<span class = "terms-texts">
We have the right to modify terms and conditions if needed and whenever adequate </span>
<span class = "terms-headers">Limits of Responsibility</span>

<span class = "terms-texts">All communicated content on the website is the responsibility of their owners and <?php echo $home_page_site_name; ?> is not responsible for its content or any damage that could result from this content or the use of any of the site's services. </span>
<span class = "terms-headers">Contact us</span>

    <span class = "terms-texts">You can contact us using the <a href = "/contact">"Contact Us"</a> page.  </span>

    </div>

</div>
<?php require_once SITE_CONFIGURATIONS["HTML_FOLDER"].'default-footer.php'; ?>

</body>
</html>