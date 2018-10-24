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

<div class="container" id = "faq-container">
    <div class="row">
        <div class="col-md-12">
            <div class="section-title text-center wow zoomIn">
                <h1>Frequently Asked Questions</h1>
                <span></span>
                <p>Our Frequently Asked Questions here.</p>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                <div class="panel panel-default">
                    <div class="panel-heading" role="tab" id="headingOne">
                        <h4 class="panel-title">
                            <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                            How do i post my ad?
                            </a>
                        </h4>
                    </div>
                    <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
                        <div class="panel-body">
                            <p class="faq-answers">Posting an ad is quick and very easy, please <a href="/post-ad">Click here</a> . to get Started  </p>
                        </div>
                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading" role="tab" id="headingTwo">
                        <h4 class="panel-title">
                            <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                Why was my ad text edited?
                            </a>
                        </h4>
                    </div>
                    <div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
                        <div class="panel-body">
                            <p class="faq-answers">The quality of ads posted on our platform matter a lot to us. As a result, we are focused on ensuring that ads posted have really good all-round quality in terms of image, title and description. A badly, punctuated ad, with wrong spelling can really work against an ad and sometimes, even change its meaning. We are here to help! We have edited the ad and corrected the typographical errors on your behalf. </p>
                        </div>
                    </div>
                </div>




                <div class="panel panel-default">
                    <div class="panel-heading" role="tab" id="headingThree">
                        <h4 class="panel-title">
                            <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                Why is my Ad not yet live?
                            </a>
                        </h4>
                    </div>
                    <div id="collapseThree" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree">
                        <div class="panel-body">
                            <p class="faq-answers">You ad might have been deleted for a number of reasons, Please read our <a href ="/posting-rules">Posting Rules</a> and <a href = "/disallowed-items">Items not allowed</a>. </p>
                        </div>
                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading" role="tab" id="headingFour">
                        <h4 class="panel-title">
                            <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                                Why was my ad deleted (Bad Price)?
                            </a>
                        </h4>
                    </div>
                    <div id="collapseFour" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingFour">
                        <div class="panel-body">
                            <p class="faq-answers">Your ad may have been deleted because the price quoted is below or above its current market value. Please ensure that the price for your item is reflective of its market value. One more thing- Input only numbers in the space provided for price. Do not format the price with spaces, punctuation marks or other special characters. For instance, an ad priced at Forty Five Thousand Naira, should state "45000" in the price box. Not "45", "45k", "45,000.00".</p>
                        </div>
                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading" role="tab" id="headingFive">
                        <h4 class="panel-title">
                            <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
                                How long will my ads appear on <?php echo $home_page_site_name;?>
                            </a>
                        </h4>
                    </div>
                    <div id="collapseFive" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingFive">
                        <div class="panel-body">
                            <p class="faq-answers">Your ads will remain on <?php echo  $home_page_site_name ?> without been deleted, unless it fails any of our <a href ="/posting-rules">Posting Rules</a>.
                            Ads that have been closed by sellers will only be visible to users who have bookmarked such ad.</p>
                        </div>
                    </div>
                </div>

                <div class="panel panel-default">
                    <div class="panel-heading" role="tab" id="headingSix">
                        <h4 class="panel-title">
                            <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseSix" aria-expanded="false" aria-controls="collapseSix">
                                Will i be notified if my ad gets deleted by <?php echo $home_page_site_name?>?
                            </a>
                        </h4>
                    </div>
                    <div id="collapseSix" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
                        <div class="panel-body">
                            <p class="faq-answers">
Nope! , <?php echo $home_page_site_name; ?> will not notify you , if any of your ads gets deleted , or even if your account gets deleted

                            </p>
                        </div>
                    </div>
                </div>


                <div class="panel panel-default">
                    <div class="panel-heading" role="tab" id="headingSeven">
                        <h4 class="panel-title">
                            <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseSeven" aria-expanded="false" aria-controls="collapseSeven">
                                Why can't i find my ads posted on <?php echo $home_page_site_name?>?
                            </a>
                        </h4>
                    </div>
                    <div id="collapseSeven" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingSeven">
                        <div class="panel-body">
                            <p class="faq-answers">
                                This will only happen if your ad violates any of our <a href ="/posting-rules">Posting Rules</a>, or as a result of your ad been "too old" <?php echo $home_page_site_name; ?> will not notify you , if any of your ads gets deleted , or even if your account gets deleted

                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div><!--- END COL -->
    </div><!--- END ROW -->
</div><?php require_once SITE_CONFIGURATIONS["HTML_FOLDER"].'default-footer.php'; ?>

</body>
</html>