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
$page_title = "Recover your account • {$home_page_site_name} ";
$page_description = "Welcome to {$home_page_site_name}.com ";
$page_keywords = "E-commerce,Phones,Tablets,Fashion,Clothes,Laptops,Computers,Beauty,Care,";
$selected_state = "Rivers";
$include_bootstrap = true;
$include_custom_check_box = false;
$include_bootstrap_js = false;
?>
<!DOCTYPE html <?php echo $other_doctype_attribute; ?>>
<html lang="en-us"  xmlns = "http://www.w3.org/1999/xhtml" dir="ltr">
<head>

    <?php require_once SITE_CONFIGURATIONS['HTML_FOLDER'].'meta.php'; ?>
    <link rel="stylesheet" href="<?php echo SITE_CONFIGURATIONS['CSS_FOLDER']?>bootstrap.min.css"/>
    <link rel="stylesheet" href="<?php echo SITE_CONFIGURATIONS['CSS_FOLDER']?>animate.css">
    <link rel="stylesheet" href="<?php echo SITE_CONFIGURATIONS['CSS_FOLDER']?>owl.carousel.css">
    <link rel="stylesheet" href="<?php echo SITE_CONFIGURATIONS['CSS_FOLDER']?>main.css" />
    <link rel="stylesheet" href="<?php echo SITE_CONFIGURATIONS['CSS_FOLDER']?>responsive.css" />


</head>
<body>
<div class="alert alert-info alerts fade in" id = "email-send-error">
    <!--<strong id ="main-error-cause">Warning!</strong> Indicates a warning that might need attention. -->

</div>
<div class="form-gap" id = "forgot-account-form"></div>
<div class="container">
    <div class="row">
        <div class="col-md-4 col-md-offset-4">
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="text-center">
                        <h3><i class="fa fa-user fa-4x"></i></h3>
                        <h2 class="text-center">Forgot logins?</h2>
                        <p>Your login details will be sent to your email.</p>
                        <div class="panel-body">
<fieldset id = "forgot-account-fieldset">
                            <form id="user-forgot-account-form" name = "forgot-account-form" accept-charset="utf-8" role="form" autocomplete="on" class="form" method="post" enctype="application/x-www-form-urlencoded">

                                <div class="form-group">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="glyphicon glyphicon-envelope color-blue"></i></span>
                                        <input id="account-recovery-email" name="email" placeholder="email address" class="form-control"  type="email">

                                    </div>
                                    <span class="contact-errors signup-errors" id = "forgot-accont-email-error"></span>
                                </div>

                                <div class="form-group">
                                    <button name="recover-submit" class="btn btn-lg btn-primary btn-block"  type="submit"><span id = "button-text">Recover account</span><i class = "fa fa-spinner fa-spin" id = "forgot-account-loading-icon"></i></button>
                                </div>


                            </form>
</fieldset>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php require_once SITE_CONFIGURATIONS["HTML_FOLDER"].'default-footer.php'; ?>
</div>
</body>
</html>