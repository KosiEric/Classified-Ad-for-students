<?php

if(!class_exists("Configurations")){

    $document_root = $_SERVER['DOCUMENT_ROOT'];
    require_once ($document_root.'/security/config.php');
    require_once ($document_root.'/security/database.php');
    require_once ($document_root.'/security/functions.php');


}
// Instanciating the  functions class

$functions = new Functions();
$cookie_username = "";
$config = new Configurations();
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
$page_title = "Track your ads • {$home_page_site_name} ";
$page_description = "Track your posted ads, here on   {$home_page_site_name}.com ";
$page_keywords = "E-commerce,Phones,Tablets,Fashion,Clothes,Laptops,Computers,Beauty,Care,students";
$selected_state = "Rivers";
$include_bootstrap = true;
$include_custom_check_box = false;
$include_bootstrap_js = true;
?>
<!DOCTYPE html <?php echo $other_doctype_attribute; ?>>
<html lang="en-us"  xmlns = "http://www.w3.org/1999/xhtml" dir="ltr">
<head>

    <?php require_once SITE_CONFIGURATIONS['HTML_FOLDER'].'meta.php'; ?>
    <?php
    if(!$functions->isLoggedInUser()){ ?>
        <link rel="stylesheet" href="<?php echo SITE_CONFIGURATIONS['CSS_FOLDER']?>default-login.css" />

    <?php } ?>

    <link rel="stylesheet" href="<?php echo SITE_CONFIGURATIONS['CSS_FOLDER']?>bootstrap.min.css"/>
    <link rel="stylesheet" href="<?php echo SITE_CONFIGURATIONS['CSS_FOLDER']?>animate.css">
    <link rel="stylesheet" href="<?php echo SITE_CONFIGURATIONS['CSS_FOLDER']?>owl.carousel.css">
    <link rel="stylesheet" href="<?php echo SITE_CONFIGURATIONS['CSS_FOLDER']?>main.css" />
    <link rel="stylesheet" href="<?php echo SITE_CONFIGURATIONS['CSS_FOLDER']?>responsive.css" />
    <script src="<?php echo SITE_CONFIGURATIONS['JS_FOLDER']?>moment.js"></script>

    <script src="<?php echo SITE_CONFIGURATIONS['JS_FOLDER']?>livestamp.js"></script>



</head>
<body><?php require_once SITE_CONFIGURATIONS["HTML_FOLDER"].'default-header.php'; ?>
<?php require_once SITE_CONFIGURATIONS["HTML_FOLDER"].'search.php'; ?>

    <?php if($functions->isLoggedInUser()){ ?>
    
    
    <?php 
    $user_status = $functions->getActiveUserDetails()['active'];
    $actions_text = Array("Disable your account" , "Activate your account");
    $user_status_text = ($user_status == 1)? "Disable your account" : "Activate your account";
    $user_status_title = ($user_status == 1)? "Disable account" : "Activate account";
    $status_button_class = ($user_status == 1)? "btn-info" : "btn-danger";
    $status_action = ($user_status == 1) ? 0 : 1;
    
    ?>
    
<div  class = "container" id = "change-user-account-status-container"><span class="num-user-ads-container">Your ads : <span class="num-user-ads-counter"><?php echo count($functions->getAdsByUser($functions->getActiveUserID()));?></span> </span> <button data-action-0-text = "<?php echo $actions_text[0];?>" data-action-1-text = "<?php echo $actions_text[1];?>" data-action = "<?php echo $status_action; ?>" data-user-id ="<?php echo $functions->getActiveUserID();?>"  title="<?php echo $user_status_title; ?>" id = "change-user-account-status-button" class = "btn <?php echo $status_button_class; ?>"><?php echo $user_status_text; ?></button></div>
       
    <?php }?>

<div class="container" id = "user-ads-list">

    <ul class="nav nav-tabs">
        <li class="active"><a data-toggle="tab" href="#menu1" class="ad-type-toggle active-ad-type" id = "user-ads-toggle" data-initial-background-color = "">Your Ads</a></li>
        <li ><a data-toggle="tab" href="#menu2" class="ad-type-toggle inactive-ad-type" id = "favorite-ads-toggle">Favorite Ads</a></li>
            </ul>
    
   <div id = "user-ads-container">
    <?php if(!$functions->isLoggedInUser()) { ?>
    <div class="row" id = "account-not-found">
        <h1>Not found <span>:(</span></h1>
        <p>Sorry, but there seems to be no account linked to this browser.</p>
        <p>You can either do the following:</p>

            <a href="#myModal" class="btn btn-default btn-track-ad" data-toggle="modal">Login your account</a>
            <a href="/create" class="btn btn-success btn-track-ad">Create an account</a>

    </div>
    
        <?php require_once SITE_CONFIGURATIONS["HTML_FOLDER"].'default-login.php'; ?>

        <?php }



        else if (empty($functions->getAdsByUser($functions->getActiveUserID()))){ ?>
            <div class="row" id = "account-not-found">
        <h1>Not found <span>:(</span></h1>
        <p>You've not posted any ads yet on your account.</p>

            <a href="/post-ad" class="btn btn-success">Post Ad</a>

    </div>

        <?php }  else { ?>





<?php


            $ads_by_active_user= $functions->getAdsByUser($functions->getActiveUserID());
            $number_of_user_ads = count($ads_by_active_user);


            echo '<div class="container bg">

<div class="row" id = "main-ads-container">
';

            echo            '</div></div>';
            ?>


        <?php }?>
</div>


<div id="favorite-ads-container">
    <?php if(!$functions->isLoggedInUser()) { ?>
    
    
        <div class="row" id = "account-not-found">
            <h1>Not found <span>:(</span></h1>
            <p>Sorry, but there seems to be no account linked to this browser.</p>
            <p>You can either do the following:</p>

            <a href="#myModal" class="btn btn-default btn-track-ad" data-toggle="modal">Login your account</a>
            <a href="/create" class="btn btn-success btn-track-ad">Create an account</a>

        </div>
        <?php require_once SITE_CONFIGURATIONS["HTML_FOLDER"].'default-login.php'; ?>

    <?php }



    else if (empty($functions->getFavoriteAdsByUser($functions->getActiveUserID()))){ ?>
        <div class="row" id = "account-not-found">
            <h1>Not found <span>:(</span></h1>
            <p>You've not favorited any ads yet.</p>

            <a href="/post-ad" class="btn btn-success">Post Ad</a>

        </div>

    <?php }  else { ?>





        <?php


        $favorite_ads_by_user = $functions->getFavoriteAdsByUser($functions->getActiveUserID());
        $number_of_favorite_ads_by_user = count($favorite_ads_by_user);
        echo '<div class="container bg">

<div class="row" id = "main-favorites-container">';

        echo      '</div>
</div>';
        ?>


    <?php }?>

</div>


</div>

<p class = "load-more-icon <?php
if(!$functions->isLoggedInUser() or empty($functions->getAdsByUser($functions->getActiveUserID()))){
    echo 'hidden';
}
?>" id = "user-ads-load-more" ><span id = "load-more-action" data-user-id = "<?php echo $functions->getActiveUserID(); ?>" data-max-ad = "<?php echo $config->number_of_user_ads_to_load;?>" <?php  if($number_of_user_ads == 0){ echo "style='display:none;' data-load-more = '0'" ; } else {echo "data-load-more = '1' data-total-ads='0'";}?>> <span class = "load-more-plus-text">+</span><span class="load-more-text">load more</span></span>
</p>
<p class = "load-more-icon <?php
if(!$functions->isLoggedInUser() or empty($functions->getFavoriteAdsByUser($functions->getActiveUserID()))){
    echo 'hidden';
}
?>" id = "favorite-ads-load-more"><span id = "more-favorites-action" data-user-id = "<?php echo $functions->getActiveUserID(); ?>" data-max-ad = "<?php echo $config->number_of_favorites_ads_to_load;?>" <?php  if($number_of_favorite_ads_by_user == 0){ echo "style='display:none;' data-load-more = '0'" ; } else {echo "data-load-more = '1' data-total-ads='0'";}?>><span class = "load-more-plus-text">+</span><span class="load-more-text">load more</span></span>

</p>

<div class="container loading-image-container" id = "ads-loading-image-container"><img class="img-responsive" src="<?php echo SITE_CONFIGURATIONS['IMG_FOLDER'].'spin.gif';?>" id = "loading-more-ads-image"/></div>
<?php require_once SITE_CONFIGURATIONS["HTML_FOLDER"].'default-footer.php'; ?>

</body>


</html>