<?php

if(!class_exists("Configurations")){

    $document_root = $_SERVER['DOCUMENT_ROOT'];
    require_once ($document_root.'/security/config.php');
    require_once ($document_root.'/security/database.php');
    require_once ($document_root.'/security/functions.php');


}
$configurations = new Configurations();
if(!isset($_GET["id"]) or mb_strlen($_GET["id"]) < $configurations->length_of_ad_id){
    header('Location: /error');
}

$functions = new Functions();
$database_connection = new DatabaseConnection();

if($database_connection->record_exists_in_table($database_connection->ads_table_name , 'ad_id' , $functions->escape_string($_GET['id']))){
    $ad = $functions->getAdDetails($_GET["id"]);
    if(!$functions->postedByCurrentUser($_GET['id'])){
        header('Location: /error/'.$_GET['id']);
    }
}

else {
    header('Location: /'.$_GET['id']);
}

require_once ('req/other.php');
$home_page_site_name = ucfirst($home_page_site_name);
$site_features = "Electronics , Phones , Tablets , Home , Furniture and More";
$page_title = "Edit ad • {$ad['title']} | $home_page_site_name.";
$page_description = "Track your posted ads, here on   {$home_page_site_name}.com ";
$page_keywords = "E-commerce,Phones,Tablets,Fashion,Clothes,Laptops,Computers,Beauty,Care,students";
$selected_state = "Rivers";
$include_bootstrap = true;
$include_custom_check_box = false;
$include_bootstrap_js = true;


$ad_id = $ad["ad_id"];

$amount_format;

$poster_school = $functions->getAdPosterDetails($ad_id)["school"];
$poster_country = $functions->getAdPosterDetails($ad_id)["country"];
$poster_currency;

if (is_numeric($ad["amount"])){
    $amount_format = number_format($ad["amount"]);
    $poster_currency = $countries[$poster_country]["currency_sign"];

}
else {
    $amount_format = $ad["amount"];
    $poster_currency = "";
}

$time_posted = $ad["post_time"];
$condition = $ad["product_condition"];
$views = number_format($ad["views"]);
$number_of_favorites  = $functions->getNumAdFavorites($ad_id);
$favorite_count = ($number_of_favorites > 0) ? $number_of_favorites : "";
$views = number_format($ad["views"]) + 1;
$ad_closed = $ad["closed"];
$database_connection = new DatabaseConnection();
#$database_connection->update_record($database_connection->ads_table_name , 'views' , "{$views}" , "ad_id" , "{$ad_id}");

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
    <link rel="stylesheet" href="<?php echo SITE_CONFIGURATIONS['CSS_FOLDER']?>post-ad.css" />

    <link rel="stylesheet" href="<?php echo SITE_CONFIGURATIONS['CSS_FOLDER']?>form-steps.css" />
    <link rel="stylesheet" href="<?php echo SITE_CONFIGURATIONS['CSS_FOLDER']?>sell.css" />
    <script src="<?php echo SITE_CONFIGURATIONS['JS_FOLDER']?>ad-product-detail.js"></script>

    <!-- font -->
    <!-- favicon icon -->

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>

    <![endif]-->
<style>
    .drop-down-arrow-background {
        background-size: 12px 12px;

        background-position-x: 98%;

        background-position-y: 15px;

        background-repeat: no-repeat;
        background-image : url("<?php echo SITE_CONFIGURATIONS["IMG_FOLDER"].'drop-down.png';?>") !important;

    }
    .hideable-forms.form-step-3{
        position: relative;
        top : -60px;
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

                <?php require_once SITE_CONFIGURATIONS["HTML_FOLDER"].'edit-ad.php'; ?>
            </div>
        </div>
    </div>
    <?php require_once SITE_CONFIGURATIONS["HTML_FOLDER"].'default-footer.php'; ?>
</div>

</body>
</html>