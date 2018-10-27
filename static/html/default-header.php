<?php

if(!class_exists('DatabaseConnection')){
    require_once '../../security/database.php';
}

if(!class_exists('Functions')){
    require_once '../../security/functions.php';

}


class updateLastSeen extends  DatabaseConnection {

    private $functions;
    function __construct()
    {
        $this->functions = new Functions();
    parent::__construct();
    }

    function __destruct()
    {
     parent::__destruct();
        // TODO: Implement __destruct() method.
    }


    public  final function updateLastSeen () : bool {
        if($this->functions->isLoggedInUser()){
            $time = time();
            $this->update_record($this->users_table_name , "last_seen" ,  "{$time}" , "user_id" , "{$this->functions->getActiveUserID()}");
            return true;
        }
        else {
            return false;
        }
    }

    }

    $update_last_seen = new updateLastSeen();
    $update_last_seen-> updateLastSeen();

?>

<div class="alert alert-info alerts fade in" id = "connection-lost-alert">
    <!--<strong id ="main-error-cause">Warning!</strong> Indicates a warning that might need attention. -->
   Internet connect lost. reconnecting...
</div>
<?php
if(isset($profile) and !empty($profile) and $profile["email_verified"] == "0") { ?>
    <div class="alert alert-info fade in" id = "email-not-verified-warning-container">
        Your email address <strong id = "unverified-email-address"><?php echo  strtolower($profile["email_address"]); ?> </strong>has not been verified yet.
        <a href="#" class="alert-link" id="resend-verification-link">Click here to send verification link</a>.

        <a href="#" class="close" data-dismiss="alert" aria-label="close" id = "">&times;</a>
  </div>
<?php }?>
<header id="header" class="clearfix">
    <nav class="navbar navbar-default">
        <div class="topbar">
            <div class="container">
                <div class="row">
                    <div class="col-sm-6">
                        <ul class="list-inline">
                            <li><span class="cairo-family"><i class="fa fa-envelope-o"></i></span> <a href="/contact" class="cairo-family"> <?php echo SITE_CONFIGURATIONS["site_contact_email"]; ?></a></li>
                            <li><span><i class="fa fa-phone"></i></span> <?php echo $countries[$selected_country]["helpline"]; ?> </li>
                            <li><ul class="list-inline top-social">
                                    <li><a class="facebook" title = "facebook page" href="https://facebook.com/<?php echo $facebook_page;?>"><i class="fa fa-facebook"></i></a></li>
                                    <li><a class="twitter" title = "Twitter handle"  href="https://twitter.com/<?php echo $twitter_page;?>"><i class="fa fa-twitter"></i></a></li>

                                    <li><a class="instagram" title = "Instagram page" href="https://instagram.com/<?php echo $instagram_page;?>"><i class="fa fa-instagram"></i></a></li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                    <div class="col-sm-6">
                        <div class="user-section">
                            <ul class="list-line">
                                <li><a href="#" id = "country-text"> <img alt = "<?php echo $selected_country; ?> flag" width="19" height="17" src="<?php echo  SITE_CONFIGURATIONS['COUNTRY_FLAGS_FOLDER'].ucfirst($selected_country).'.png'?>" /><span id = "country-text-container"> <?php echo $selected_country; ?></span></a></li>
                                <li><a href="/track-ads"><i class="fa fa-user" aria-hidden="true"></i> Track your ads</a></li>
                            </ul>
                            <a href="<?php if(getCurrentPHPFileName() != 'post-ad') {

                                echo '/post-ad';
                            } else {

                                echo "javascript:void(0)";
                            }?>" class="btn btn-primary cairo-family" id="post-ad-link" ><i class="fa fa-camera"></i> <span id = "header-link-sell-text">Sell</span></a>
                        </div><!-- user-section -->
                    </div>
                </div>
            </div>
        </div><!-- topbar -->

        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="/"><img class="img-responsive" src="<?php echo SITE_CONFIGURATIONS['IMG_FOLDER'].'main-logo.png'; ?>" width = "150" height="150" alt="<?php echo $home_page_site_name; ?> Logo" id="logo-image"/></a>
            </div><!-- /navbar-header -->

            <div class="navbar-right">
                <div class="collapse navbar-collapse" id="navbar-collapse">
                    <ul class="nav navbar-nav">
                        <li><a href="/">Home</a></li>
                        <li class="dropdown"><a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown"><?php
                                $category = str_replace("&" , " & " , $ad_categories[0]);
                                echo  $category." "; ?><span class="caret"></span></a>
                            <ul class="dropdown-menu">

                                <?php

                                $category_icons = Array("home" , "television" , "tablet" , "desktop" , "shopping-bag" , "bed" , "book");
                                $counter = 0;
                                foreach ($ad_categories as $category) {

                                    $category_text = str_replace("&" , " & " , $category);
                                    $category_text_upper = ucwords($category_text);
                                    $current_icon = $category_icons[$counter];
                                    $search_category_text = str_replace("&", ".", $category);

                                    echo     "<li class='dropdown-submenu'>
 <a href='/search?category=$search_category_text' tabindex='-1'><span class='header-category-icon-containers'><i class='fa fa-$current_icon category-icons'></i> </span><span class = 'header-category-link-text'>$category_text_upper</span></a>

 
 </li>";
                                    $counter++;
                                }
                                ?>
                            </ul>
                        </li>
                        <li class="active dropdown"><a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown"><?php echo $site_pages['/faq']; ?> <span class="caret"></span></a>
                            <ul class="dropdown-menu">
                                <?php
                                $counter = 0;
                                foreach ($site_pages as $page => $page_text) {
                                    $counter++;
                                    if ($counter == 1) {
                                        echo "<li class='active'><a href='/$page'>$page_text</a></li>";
                                    }
                                    else {
                                        echo "<li><a href='$page'>$page_text</a></li>";
                                        $counter++;

                                    }



                                }

                                ?>

                            </ul>
                        </li>
                        <li class="dropdown"><a href="<?php echo  $site_blog_page;?>" class="dropdown-toggle" data-toggle="dropdown">Blog <span class="caret"></span></a>
                            <ul class="dropdown-menu">
                                <li><a href="<?php echo  $site_blog_page;?>">Visit Our Blog</a></li>
                            </ul>
                        </li>
                        <li><a href="/contact">Contact Us</a></li>
                    </ul>
                </div>
            </div>
        </div><!-- container -->
    </nav><!-- navbar -->
</header><!-- header -->

