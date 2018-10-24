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
$config = new Configurations();



$cookie_username = "";


require_once ('req/other.php');
$home_page_site_name = ucfirst($home_page_site_name);
$site_features = "Electronics , Phones , Tablets , Home , Furniture and More";
$page_title = "Free Classified For Students  • {$home_page_site_name} ";
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
        <link rel="stylesheet" href="<?php echo SITE_CONFIGURATIONS['CSS_FOLDER']?>animate.css" />
        <link rel="stylesheet" href="<?php echo SITE_CONFIGURATIONS['CSS_FOLDER']?>owl.carousel.css">
        <link rel="stylesheet" href="<?php echo SITE_CONFIGURATIONS['CSS_FOLDER']?>main.css" />
        <link rel="stylesheet" href="<?php echo SITE_CONFIGURATIONS['CSS_FOLDER']?>responsive.css" />
        <link rel="stylesheet" href="<?php echo SITE_CONFIGURATIONS['CSS_FOLDER']?>percentage.css" />

        <link rel="stylesheet" href="<?php echo SITE_CONFIGURATIONS['CSS_FOLDER']?>home.css" />


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

            body {
                background-repeat: repeat-x;
                background-size: cover ,contain;
                background-color: #f8f8f8;
                background-position: center;
            }
        </style>

    </head>
    <body>
<?php require_once SITE_CONFIGURATIONS["HTML_FOLDER"].'default-header.php'; ?>

    <?php require_once SITE_CONFIGURATIONS["HTML_FOLDER"].'home-slider.php'; ?>

    <?php require_once SITE_CONFIGURATIONS["HTML_FOLDER"].'search.php'; ?>
        


        <div class="container">

<div class="ad-list-text container"><h3>Trending Ads in <?php echo $selected_country; ?></h3> </div>
<div class="container bg">

    <div class="row" id = "main-ads-container">
    </div>
</div>

    <p class = "load-more-icon" id = "user-ads-load-more" ><span id = "load-more-action"  data-max-ad = "<?php echo $config->number_of_home_ads_to_load;?>" <?php  if($functions->getTotalNumberOfAds() == 0){ echo "style='display:none;' data-load-more = '0'" ; } else {echo "data-load-more = '1' data-total-ads='0'";}?>> <span class = "load-more-plus-text">+</span><span class="load-more-text">load more</span></span>
    </p>

<div class="container loading-image-container" id = "ads-loading-image-container"><img class="img-responsive" src="<?php echo SITE_CONFIGURATIONS['IMG_FOLDER'].'spin.gif';?>" id = "loading-more-ads-image"/></div>

<?php require_once SITE_CONFIGURATIONS["HTML_FOLDER"].'default-footer.php'; ?>


<!-- JS -->
    </div>

      </body>
</html>
