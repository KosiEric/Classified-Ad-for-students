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

if($functions->userCookieExists()){

    $cookie_userID = $_COOKIE["current_active_user"];

    class GetUserDetails extends DatabaseConnection
    {
        function get_user_profile(): array

        {
            global $cookie_userID;
            $sql = "SELECT * FROM users WHERE user_id = '{$cookie_userID}'";
            $result = $this->conn->prepare($sql);
            $result->execute();
            $set_type_record = $result->setFetchMode(PDO::FETCH_ASSOC);
            $record = $result->fetchAll();
            return $record;
        }


    }
    $user_details = new GetUserDetails();

    $profile = $user_details->get_user_profile()[0];


}


require_once ('req/other.php');
$home_page_site_name = ucfirst($home_page_site_name);
$site_features = "Electronics , Phones , Tablets , Home , Furniture and More";
$page_title = "Free account signup  • {$home_page_site_name} ";
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

    <link rel="stylesheet" href="<?php echo SITE_CONFIGURATIONS['CSS_FOLDER']?>form-steps.css" />

    <link rel="stylesheet" href="<?php echo SITE_CONFIGURATIONS['CSS_FOLDER']?>post-ad.css" />
    <link rel="stylesheet" href="<?php echo SITE_CONFIGURATIONS['CSS_FOLDER']?>sell.css" />
    <script src="<?php echo SITE_CONFIGURATIONS['JS_FOLDER']?>ad-product-detail.js"></script>
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

    <style type="text/css">

        .hideable-forms {
            display: none;
        }

        #contact-fullname {
            background-image : url("<?php echo SITE_CONFIGURATIONS["IMG_FOLDER"].'user1.png';?>") !important;

        }
        #contact-primary-phone{

            background-image : url("<?php echo SITE_CONFIGURATIONS["IMG_FOLDER"].'caller.png';?>") !important;


        }
        .drop-down-arrow-background {
            background-size: 12px 12px;

            background-position-x: 98%;

            background-position-y: 15px;

            background-repeat: no-repeat;
            background-image : url("<?php echo SITE_CONFIGURATIONS["IMG_FOLDER"].'drop-down.png';?>") !important;

        }
        #contact-secondary-phone{
            background-image : url("<?php echo SITE_CONFIGURATIONS["IMG_FOLDER"].'fone.png';?>") !important;

        }

        #contact-email{
            background-image : url("<?php echo SITE_CONFIGURATIONS["IMG_FOLDER"].'email.png';?>") !important;
            -webkit-background-size: 15px;
            background-size: 15px;
        }
        #contact-select-state  , #contact-select-school , #post-ad-category , #post-ad-subcategory{
            background-image : url("<?php echo SITE_CONFIGURATIONS["IMG_FOLDER"].'drop-down.png';?>") !important;

        }

        #seller-information{
            display: block;
        }
    </style>

</head>
<body>
<?php require_once SITE_CONFIGURATIONS["HTML_FOLDER"].'default-header.php'; ?>

<div class="page">

    <div id="breadcrumb-section" class="section" <?php ?>>
        <div class="container">
            <div class="page-title text-center">
                <h1 id = "ad-post-header">Post an ad on <?php echo  $home_page_site_name; ?>.</h1>
                <!--
                 <ol class="breadcrumb">
                     <li><a href="#">Home</a></li>
                     <li class="active">Post Ad</li>
                 </ol> -->
            </div>

        </div>
    </div><!-- breadcrumb-section -->

    <div class="avt-post-wrapper section">

        <div class="container">

            <div class="avt-post" >

                <div class="alert alert-success alerts" id = "success-alert">
                    <!--<strong>Success!</strong> Indicates a successful or positive action. -->
                </div>


                <div class="alert alert-warning alerts" id = "failure-alert">
                    <!--<strong id ="main-error-cause">Warning!</strong> Indicates a warning that might need attention. -->
                </div>

                <?php require_once SITE_CONFIGURATIONS["HTML_FOLDER"].'seller-information-container.php'; ?>
            </div>
        </div>
    </div>
    <?php require_once SITE_CONFIGURATIONS["HTML_FOLDER"].'default-footer.php'; ?>
</div>
</body>
</html>