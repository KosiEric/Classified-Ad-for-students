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
$page_title = "Privacy policy  • {$home_page_site_name} ";
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
<div class="page container">

<div id = "privacy-policy-container">

    <span id = "privacy-header">Privacy Policy</span>

    <span class = "privacy-texts">We understand your fears and concerns regarding the privacy of your data on the internet. We have prepared this policy to help you understand the nature of the data we collect from your when visiting <?php echo $home_page_site_name; ?> and how we use this personal data.</span>

    <span class = "privacy-headers">Navigation</span>
    <span class = "privacy-texts">
We didn't design this website to collect your personal data from your computer while browsing this site. But will only use the data you provided with you being aware and your personal desire.
</span>
    <span class = "privacy-headers">IP</span>
    <span class = "privacy-texts">
At any time you visit any website on the internet including this website, the hosting server will record your internet protocol (IP) and the date and time of your visit and the type of the browser that you use and the URL of any website which referred you to this site on the web and the website may record it for different purposes.</span>
    <span class = "privacy-headers">Network Surveys</span>

    <span class = "privacy-texts">The surveys that we conduct on our network allows us to collect specific data like the data collected from you regarding your view and feeling about our website. Your responses are of great concern and an area of appreciation as it helps us to improve our site and you have the full freedom and choice to provide data related to your name and other data.</span>
    <span class = "privacy-headers">Links to External Sites</span>
    <span class = "privacy-texts">
Our website may contain links to other sites in the internet or advertisements from other sites like Google AdSense and we are not considered responsible for the data collection methods of these websites. You can find the confidentiality policies and the content of these websites that can be accessed through any link on this site. We may be assisted by third party advertising companies for the reason of displaying ads when you visit our website. These companies have the right to use information about your visit to this website and other websites (excluding the name, address or email or phone). This is to provide ads about products or services that you care about.</span>
    <span class = "privacy-headers">Disclosure of Information</span>
    <span class = "privacy-texts">
We will always maintain your privacy and the confidentiality of your personal data that we get. We will never disclose the this information unless there is a law requirement or with good intention if we feel that this procedure is required or wanted to meet legal requirements. Or to defend or protect the ownership rights of this website or other parties benefiting from this site.</span>
    <span class = "privacy-headers">Required Data to do the necessary procedures from your side</span>
    <span class = "privacy-texts">
When we need any data from you. We will ask you for your consent. As this data will help us contact you and satisfy your orders whenever possible. We will never sell the data you provide to any third party as part of personal marketing without your prior and written consent unless t was a part of bulk data used for statistics and research and it won't contain any data to identify you.</span>
    <span class = "privacy-headers">When Contacting Us</span>
    <span class = "privacy-texts">
We will consider all data provided by you confidential. The forms on our network require data that can help us improve our site. We will use data provided by you to answer all of your questions, observations, or orders through this site or other sites belonging to this site.</span>
    Disclosure of Information to Third Parties
    <span class = "privacy-texts">
We will not sell, trade, rent or disclose any information to any third party out of this website or sites out of our network and we will only disclose information when ordered by a legal or organizational entity.</span>
    <span class = "privacy-headers">Modification of Data Confidentiality and Privacy Policy</span>
    <span class = "privacy-texts">
We have the right to modify the items and conditions of data confidentiality and privacy policy if needed and when adequate</span>
    <span class = "privacy-headers">Contacting Us</span>
    <span class = "privacy-texts">
        You can contact us using the methods described in the <a href="/contact">"Contact Us"</a> page</span>
    <span class = "privacy-headers">Finally</span>

    <span class = "privacy-texts">Your concerns and fears regarding data confidentiality and privacy is a highly valuable thing to us. We hope that we will address these concerns by this policy.</span>

</div>
</div>

<?php require_once SITE_CONFIGURATIONS["HTML_FOLDER"].'default-footer.php'; ?>

</body>
</html>