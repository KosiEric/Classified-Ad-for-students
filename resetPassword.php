<?php
if(!class_exists("Configurations")){

    $document_root = $_SERVER['DOCUMENT_ROOT'];
    require_once ($document_root.'/security/config.php');
    require_once ($document_root.'/security/database.php');



}

$page_action = "";

$cookie_email = "";
if(isset($_COOKIE["current_active_user"])){

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
    $cookie_username = $profile["username"];
    $cookie_email = $profile["email_address"];

}

require_once ('req/other.php');
$home_page_site_name = ucfirst($home_page_site_name);
$site_features = "Electronics , Phones , Tablets , Home , Furniture and More";
$page_title = "Recover password • {$home_page_site_name}  ";
$page_description = "Recover your lost {$home_page_site_name}.com account";
$page_keywords = "Recover password , Reset password , E-commerce,Phones,Tablets,Fashion,Clothes,Laptops,Computers,Beauty,Care,";
$selected_state = "Rivers";
$include_bootstrap = true;
$include_custom_check_box = true;


$get_code  = ($_GET["code"]) ?? null;

$code = ($_GET["code"]) ?? null;



if ($code == null) { ?>








    <!DOCTYPE html <?php echo $other_doctype_attribute; ?>>
<html lang="en-us"  xmlns = "http://www.w3.org/1999/xhtml" dir="ltr">
<head>



    <link rel="stylesheet" type="text/css" href="styles/bootstrap4/bootstrap.min.css">
    <link rel = "stylesheet" type = "text/css" href = "<?php  echo SITE_CONFIGURATIONS["CSS_FOLDER"].'account.css'?>" />
    <script type="text/javascript" language="JavaScript">
        var resetPasswordForUser = false;
    </script>
    <?php require_once SITE_CONFIGURATIONS['HTML_FOLDER'].'meta.php'; ?>

    <link rel = "stylesheet" type = "text/css" href = "<?php  echo SITE_CONFIGURATIONS["CSS_FOLDER"].getCurrentPHPFileName().'.css'?>" />
</head>

<!------ Include the above in your HEAD tag ---------->
<body>
<div class="container">
    <div class="alert alert-success alerts" id = "success-alert">
        <!--<strong>Success!</strong> Indicates a successful or positive action. -->
    </div>


    <div class="alert alert-warning alerts" id = "failure-alert">
        <!--<strong id ="main-error-cause">Warning!</strong> Indicates a warning that might need attention. -->
    </div>
</div>
<div class="container" id = "password-recovery-container">
    <div class="alert alert-success alerts" id = "success-alert">
        <!--<strong>Success!</strong> Indicates a successful or positive action. -->
    </div>


    <div class="alert alert-warning alerts" id = "failure-alert">
        <!--<strong id ="main-error-cause">Warning!</strong> Indicates a warning that might need attention. -->
    </div>
    <div id="passwordreset" style="margin-top:50px" class="mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">
        <div class="panel panel-info">
            <div class="panel-heading">
                <div class="panel-title">Password Reset</div>
                <div style="float:right; font-size: 85%; position: relative; top:-10px"><a id="signinlink" href="/account">Sign In</a></div>
            </div>
            <div class="panel-body" >
                <fieldset id="recover-fieldset">
                <form id="account-recovery-form" class="form-horizontal" role="form">
                    <div class="form-group">
                        <label for="email" class="col-md-3 control-label" id ="registered-email-label">Registered Email</label>
                        <div class="col-md-9">
                            <input id = "email" value="<?php echo $cookie_email; ?>" type="email" class="form-control" name="email" placeholder="Enter your account email address" />
                            <span id = "email-error" class = "signup-errors"></span>

                        </div>
                         </div>

                    <div class="form-group">
                        <!-- Button -->
                        <div class="col-md-offset-3 col-md-9">
                            <button id="btn-signup" type="submit" class="btn btn-info"><i class="icon-hand-right"></i><span id = "signup-button-text">&nbsp Send</span><i class = "fa fa-spinner fa-spin" id = "recover-loading-icon"></i> </button>

                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-12 control">
                            <div style="border-top: 1px solid#888; padding-top:15px; font-size:85%" >
                                We'll send you an email with a link to reset your password.
                            </div>
                        </div>
                    </div>

                </form>
                </fieldset>
            </div>
        </div>

    </div>    </div>



<?php require_once SITE_CONFIGURATIONS['HTML_FOLDER'].'old-footer.php'; ?>
</body>
</html>



    <?php }






















else {

$code_length = mb_strlen($code);

if ($code_length != $password_recovery_code_length) {

    header('Location: /error');

} else {

    class CheckAccountResetCode extends DatabaseConnection
    {


        function __construct()
        {

            parent::__construct();
        }

        function __destruct()
        {
            parent::__destruct(); // TODO: Change the autogenerated stub
        }

        public function get_code_profile(): array
        {
            global $code;
            $sql = "SELECT * FROM password_recovery WHERE token = '{$code}'";
            $result = $this->conn->prepare($sql);
            $result->execute();
            $set_type_record = $result->setFetchMode(PDO::FETCH_ASSOC);
            $record = $result->fetchAll();
            return $record;
        }


    }

    $validate_code = new CheckAccountResetCode();
    $profile = $validate_code->get_code_profile();

    if (empty($profile)) {

       header("location: /$code");
    }

    else {
        $profile = $profile[0];
        $user_id = $profile["user_id"];
        $account_recovery_email_address = $profile["email_address"];
        $page_title = "Recover password • ({$account_recovery_email_address})";


        ?>
        <!DOCTYPE html <?php echo $other_doctype_attribute; ?>>
        <html lang="en-us"  xmlns = "http://www.w3.org/1999/xhtml" dir="ltr">
        <head>



            <link rel="stylesheet" type="text/css" href="styles/bootstrap4/bootstrap.min.css">
            <link rel = "stylesheet" type = "text/css" href = "<?php  echo SITE_CONFIGURATIONS["CSS_FOLDER"].'account.css'?>" />
            <script type="text/javascript" language="JavaScript">
                var resetPasswordForUser = true;
            </script>

            <?php require_once SITE_CONFIGURATIONS['HTML_FOLDER'].'meta.php'; ?>

            <link rel = "stylesheet" type = "text/css" href = "<?php  echo SITE_CONFIGURATIONS["CSS_FOLDER"].getCurrentPHPFileName().'.css'?>" />
                  </head>

        <!------ Include the above in your HEAD tag ---------->
        <body>
        <div class="container">
            <div class="alert alert-success alerts" id = "success-alert">
                <!--<strong>Success!</strong> Indicates a successful or positive action. -->
            </div>


            <div class="alert alert-warning alerts" id = "failure-alert">
                <!--<strong id ="main-error-cause">Warning!</strong> Indicates a warning that might need attention. -->
            </div>
        </div>
        <div class="container" id = "password-recovery-container">
            <div class="alert alert-success alerts" id = "success-alert">
                <!--<strong>Success!</strong> Indicates a successful or positive action. -->
            </div>


            <div class="alert alert-warning alerts" id = "failure-alert">
                <!--<strong id ="main-error-cause">Warning!</strong> Indicates a warning that might need attention. -->
            </div>
            <div id="passwordreset" style="margin-top:50px" class="mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">
                <div class="panel panel-info">
                    <div class="panel-heading">
                        <div class="panel-title">Password Reset</div>
                        <div style="float:right; font-size: 85%; position: relative; top:-10px"><a id="signinlink" href="/account">Sign In</a></div>
                    </div>
                    <div class="panel-body" >
                        <fieldset id="reset-fieldset">
                            <form id="password-reset-form" class="form-horizontal" role="form">
                                <div class="form-group">
                                    <label for="email" class="col-md-3 control-label" id ="registered-email-label">Registered Email</label>
                                    <div class="col-md-9">
                                        <input id = "email" disabled = "disabled" data-user-id = "<?php echo  $user_id; ?>" value="<?php echo $account_recovery_email_address; ?>" type="email" class="form-control" name="email" placeholder="Enter your account email address" />
                                    </div>
                                    <span id = "email-erorr" class = "signup-errors"></span>
                                </div>
                                <div class="form-group">
                                    <label for="password" class="col-md-3 control-label" id ="password-label">Password</label>
                                    <div class="col-md-9">
                                        <input id = "password" placeholder ="********" type="password" class="form-control" name="password" />
                                        <span id = "password-error" class = "signup-errors users-reset-password-error"></span>
                                    </div>

                                </div>
                                <div class="form-group">
                                    <label for="password-again" class="col-md-3 control-label" id ="password-again-label">Password again</label>
                                    <div class="col-md-9">
                                        <input id = "password-again" placeholder = "re-enter password" type="password" class="form-control" name="password-again"/>
                                        <span id = "password-again-error" class = "signup-errors users-reset-password-error"></span>
                                    </div>

                                </div>
                                <div class="form-group">
                                    <!-- Button -->
                                    <div class="col-md-offset-3 col-md-9">
                                        <button id="reset-password-button" type="submit" class="btn btn-info"><i class="icon-hand-right"></i><span id = "reset-button-text">&nbsp Send</span><i class = "fa fa-spinner fa-spin" class = "loading-icons"  id = "reset-loading-icon"></i> </button>

                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-md-12 control">
                                        <div style="border-top: 1px solid#888; padding-top:15px; font-size:85%" >
                                            reset your account password for <strong><?php echo  $account_recovery_email_address; ?></strong>
                                        </div>
                                    </div>
                                </div>

                            </form>
                        </fieldset>
                    </div>
                </div>
            </div>
            </div>



        <?php require_once SITE_CONFIGURATIONS['HTML_FOLDER'].'old-footer.php'; ?>
        </body>
        </html>





    <?php }

}

}
?>
