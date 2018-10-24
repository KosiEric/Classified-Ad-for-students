<?php

if(!class_exists("Configurations")){

    $document_root = $_SERVER['DOCUMENT_ROOT'];
    require_once ($document_root.'/security/config.php');
    require_once ($document_root.'/security/database.php');



}
$page_action = "";
if(isset($_GET['action'])) {
    $page_action = (strtolower($_GET['action'])) ?? "nothing";
    $page_actions = Array("login", "signup");

    if (!in_array($page_action, $page_actions)) {
        $page_action = null;
    }

}

$cookie_username = "";
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


}

require_once ('req/other.php');
$home_page_site_name = ucfirst($home_page_site_name);
$site_features = "Electronics , Phones , Tablets , Home , Furniture and More";
$page_title = "Account Login / Sign up • {$home_page_site_name}  ";
$page_description = "Welcome to {$home_page_site_name}.com ";
$page_keywords = "E-commerce,Phones,Tablets,Fashion,Clothes,Laptops,Computers,Beauty,Care,";
$selected_state = "Rivers";
$include_bootstrap = true;
$include_custom_check_box = true;

?>

    <!DOCTYPE html <?php echo $other_doctype_attribute; ?>>
    <html lang="en-us"  xmlns = "http://www.w3.org/1999/xhtml" dir="ltr">
    <head>
        <?php /*
        <script src="js/jquery-3.2.1.min.js" type="text/javascript"></script>
        <script src="styles/bootstrap4/popper.js" type="text/javascript"></script>
        <script src="styles/bootstrap4/bootstrap.min.js" type="text/javascript"></script>
        <script src="plugins/Isotope/isotope.pkgd.min.js" type="text/javascript"></script>
        <script src="plugins/OwlCarousel2-2.2.1/owl.carousel.js" type="text/javascript"></script>
        <script src="plugins/easing/easing.js" type="text/javascript"></script>
        <script src="js/custom.js" type="text/javascript"></script>
 */ ?>



        <?php require_once SITE_CONFIGURATIONS['HTML_FOLDER'].'meta.php'; ?>
         <link rel="stylesheet" type="text/css" href="styles/main_styles.css">

        <link rel="stylesheet" type="text/css" href="styles/cairo.css" />
        <script type="text/javascript" src = "<?php  echo SITE_CONFIGURATIONS['JS_FOLDER'].'home.js'; ?>" language = "JavaScript"></script>
        <?php  if ($page_action == "signup") { ?>
        <script type="text/javascript">

$(document).ready(function () {


    $('#loginbox').hide();
    $('#signupbox').show();

});



        </script>
        <?php } ?>

<?php
if(isset($_COOKIE["unverified_account"]) and !empty($_COOKIE["unverified_account"])) {
    $unverified_profile = json_decode($_COOKIE["unverified_account"] , true);
    $unverified_firstname = $unverified_profile['firstname'];
    $unverified_lastname = $unverified_profile['lastname'];
    $unverified_email = $unverified_profile['email'];
}


?>
        <style type = "text/css">
            body , span , input , form ,*{
                font-family : Cairo;
            }
        </style>
    </head>
<body class="container-body">


<div class="container" id = "login-container">
    <div class="alert alert-success alerts" id = "success-alert">
        <!--<strong>Success!</strong> Indicates a successful or positive action. -->
    </div>


    <div class="alert alert-warning alerts" id = "failure-alert">
        <!--<strong id ="main-error-cause">Warning!</strong> Indicates a warning that might need attention. -->
    </div>

    <div id="loginbox" style="margin-top:50px;" class="mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">
        <div class="panel panel-info" >
            <div class="panel-heading">
                <div class="panel-title">Sign In</div>
                <div style="float:right; font-size: 80%; position: relative; top:-10px"><a href="/resetPassword">Forgot password?</a></div>
            </div>

            <div style="padding-top:30px" class="panel-body" >

                <div style="display:none" id="login-alert" class="alert alert-danger col-sm-12"></div>
<fieldset id = "login-fieldset">
                <form id="loginform" class="form-horizontal" role="form" name = "login-form" enctype="application/x-www-form-urlencoded" method="post" accept-charset="utf-8" autocomplete="on">

                    <div style="margin-bottom: 25px" class="input-group">
                        <span class="input-group-addon"><i class="fa fa-user"></i></span>
                        <input id="login-username" value = "<?php echo  $cookie_username; ?>"
                        type="text" class="form-control" name="username"  placeholder="username or email">

                    </div>
                    <span class = "signup-errors" id = "login-username-error"></span>
                    <div style="margin-bottom: 25px" class="input-group">
                        <span class="input-group-addon"><i class="fa fa-key"></i></span>
                        <input id="login-password" type="password" class="form-control" name="password" placeholder="password">
                    </div>
                    <span class = "signup-errors" id = "login-password-error"></span>



                    <div class="input-group">
                        <!--<div class="checkbox">
                            <label>
                                <input id="login-remember" type="checkbox" name="remember" value="1"> Remember me
                            </label>
                        </div> -->
                        <div class="form-check">
                            <label>
                                <input type="checkbox" name="check" checked id = "remember-me"> <span class="label-text">Remember me</span>
                            </label>
                        </div>

                    </div>


                    <div style="margin-top:10px" class="form-group">
                        <!-- Button -->

                        <div class="col-sm-12 controls">
                            <button id="btn-login" href="#" class="btn btn-success" type="submit">Login  </button>
                            <a id="btn-fblogin" href="/resetPassword" class="btn btn-primary">Recover password</a>

                        </div>
                    </div>


                    <div class="form-group">
                        <div class="col-md-12 control">
                            <div style="border-top: 1px solid#888; padding-top:15px; font-size:85%" >
                                Don't have an account!
                                <a href="#" onClick="$('#loginbox').hide(); $('#signupbox').show()">
                                    Sign Up Here
                                </a>
                            </div>
                        </div>
                    </div>
                </form>
</fieldset>


            </div>
        </div>
    </div>
    <div id="signupbox" style="display:none; margin-top:50px" class="mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">
        <div class="panel panel-info">
            <div class="panel-heading">
                <div class="panel-title">Sign Up</div>
                <div style="float:right; font-size: 85%; position: relative; top:-10px"><a id="signinlink" href="#" onclick="$('#signupbox').hide(); $('#loginbox').show()">Sign In</a></div>
            </div>
            <div class="panel-body" >
                <fieldset id = "signup-form-fieldset">
                <form id="signupform" class="form-horizontal"  autocomplete="on" name="signup-form" method="post" enctype="application/x-www-form-urlencoded" accept-charset="utf-8">

                    <div id="signupalert" style="display:none" class="alert alert-danger">
                        <p>Error:</p>
                        <span></span>
                    </div>



                    <div class="form-group">
                        <label for="signup-email" class="col-md-3 control-label">Email</label>
                        <div class="col-md-9">
                            <input type="text" class="form-control" name="email" id="signup-email" placeholder="Email Address" value="
<?php
                            echo $email = ($unverified_email) ?? "";
                            ?>
" />
                            <span class = "signup-errors" id = "signup-email-error"></span>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="signup-first-name" class="col-md-3 control-label">First Name</label>
                        <div class="col-md-9">
                            <input type="text" class="form-control" name="firstname" id="signup-first-name" placeholder="First Name"
                                   value="<?php
                                   echo $firstname = ($unverified_firstname) ?? "";
                                   ?>
"/>
                            <span class = "signup-errors" id = "signup-first-name-error"></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="signup-last-name" class="col-md-3 control-label">Last Name</label>
                        <div class="col-md-9">
                            <input type="text" class="form-control" id="signup-last-name" name="lastname" value="<?php
                            echo $lastname = ($unverified_lastname) ?? "";
                            ?>
" placeholder="Last Name" />
                            <span class = "signup-errors" id = "signup-last-name-error"></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="signup-password" class="col-md-3 control-label">Password</label>
                        <div class="col-md-9">
                            <input type="password" class="form-control" id="signup-password" name="passwd" placeholder="Password  (e.g myPass123)" />
                            <span class = "signup-errors" id = "signup-password-error"></span>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="icode" class="col-md-3 control-label"></label>
                        <div class="col-md-9">
                             <input type="password" class="form-control" id="signup-password-again" name="icode" placeholder="password again" />
                            <span class = "signup-errors" id = "signup-password-again-error"></span>
                        </div>
                    </div>

                    <div class="form-group">
                    <div class="form-check" id ="signup-accept-terms-div">
                        <label>
                            <input type="checkbox" name="check" id ="signup-acceptance-checkbox"> <span class="label-text" id = "terms-acceptance-text">By signing up, you agree to our <a href="/terms" class="signup-acceptance-links" target="_blank" id = "signup-terms-link">Terms</a> & <a href="/privacy" class="signup-acceptance-links" target="_blank" id = "signup-privacy-link">Privacy Policy</a>  </span>
                        </label>

                        <span class="signup-errors" id = "signup-acceptance-error">



                        </span>
                    </div>
                    </div>

                    <div class="form-group">
                        <!-- Button -->
                        <div class="col-md-offset-3 col-md-9">
                            <button id="btn-signup" type="submit" class="btn btn-info"><i class="icon-hand-right"></i><span id = "signup-button-text">&nbsp Sign Up</span><i class = "fa fa-spinner fa-spin" id = "signup-loading-icon"></i> </button>
                            <span style="margin-left:8px;">or</span>
                        </div>
                    </div>

                    <div style="border-top: 1px solid #999; padding-top:20px"  class="form-group">

                        <div class="col-md-offset-3 col-md-9">
                            <button id="btn-fbsignup" type="button" class="btn btn-primary" onclick="$('#signupbox').hide(); $('#loginbox').show();">Login your account</button>
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
