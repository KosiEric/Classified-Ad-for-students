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
}

else {
    header('Location: /'.$_GET['id']);
}

require_once ('req/other.php');
$home_page_site_name = ucfirst($home_page_site_name);
$site_features = "Electronics , Phones , Tablets , Home , Furniture and More";
$page_title = "{$ad['title']} • {$home_page_site_name} ";
$page_description = "View ads posted on  {$home_page_site_name}.com ";
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
$database_connection->update_record($database_connection->ads_table_name , 'views' , "{$views}" , "ad_id" , "{$ad_id}");

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

<style type="text/css">
#item-image-container {

     //background-image : url("<?php echo SITE_CONFIGURATIONS['IMG_FOLDER'].'post-ad-bg.png';?>");
     background-repeat : repeat-x repeat-y;
     background-size : 100%;


}

</style>

</head>
<body>
<!-- Modal -->
<div class="modal fade" id="report-ad-form-modal" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header" id = "ad-report-modal-header-container">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title" id = "report-item-header">Report Item</h4>
            </div>
            <div class="modal-body">
                <fieldset id = "report-ad-fieldset">
                <form autocomplete="off" action="#" name = "report-ad-form"  id = "report-ad-form" method="post" enctype="application/x-www-form-urlencoded" accept-charset="utf-8">
<div class="report-ad-radio-and-label-container">
                <input checked="checked" value="Fraud" type="radio" name = "report-ad-reason" class="report-ad-reason-radiobutton" id = "fraud-reason" />
                <label for="fraud-reason" id = "fraud-label" class="report-ad-labels">Fraud</label>
</div>
                <div class="report-ad-radio-and-label-container">
                <input type="radio" value="Duplicate ad" name = "report-ad-reason" class="report-ad-reason-radiobutton" id = "duplicate-reason" />
                <label for="duplicate-reason" id = "duplicate-label" class="report-ad-labels">Duplicate ad</label>

                </div>
                <div class="report-ad-radio-and-label-container">
                <input value = "inappropriate item" type="radio" name = "report-ad-reason" class="report-ad-reason-radiobutton" id = "inappropriate-reason" />
                <label for="inappropriate-reason" id = "inappropriate-label" class="report-ad-labels">inappropriate item</label>
                </div>
                <div class="report-ad-radio-and-label-container">
                <input value="Other" type="radio" name = "report-ad-reason" class="report-ad-reason-radiobutton" id = "other-reason" />
                <label for="other-reason" id = "other-label" class="report-ad-labels">Other</label>
                </div>
                <span id = "report-ad-comment-text">Comment</span>
                <textarea required="required" id = "report-ad-comment-box" data-ad-id = "<?php echo  $ad_id; ?>"></textarea>
                <div id = "comment-number-of-text-typed-div"><span id = "comment-num-typed">0</span><span>/<span id = "max-ad-report-comment-length"></span></span></div>
                <div id = "ad-report-error">Please add a comment to help us understand what's wrong with this item.</div>
                <button type="submit" class="btn btn-primary" id="report-ad-submit">Send Complaint</button>
                </form>
                </fieldset>
            </div>

            <?php /* ?>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
 */ ?>
        </div>

    </div>
</div>


<div class="page">



    <!-- Trigger the Modal -->

    <!-- The Modal -->
    <div id="enlarge-image-modal" class="enlarge-image-modal">

        <!-- The Close Button -->
        <span id="close-zoom-image">&times;</span>

        <!-- Modal Content (The Image) -->
        <img class="modal-content" id="img01" alt="" />
<!--<div id = "ad-image-zoom-forward-backward-container"-->
        <span id = "ad-image-zoom-left-container" class="ad-image-zoom-foward-backward"><i class="fa fa-chevron-left"></i></span>
        <span id = "ad-image-zoom-right-container" class="ad-image-zoom-foward-backward"><i class="fa fa-chevron-right"></i></span>
<!--/div-->
        <!-- Modal Caption (Image Text) -->
        <div id="zoomed-image-caption"><span id = "current-zoomed-image-number" data-current-image = "" data-max-ad-images = "<?php echo $configurations->number_of_ads_images; ?>"></span>&nbsp;/&nbsp;<?php echo $configurations->number_of_ads_images; ?></div>

    </div>
    <?php require_once SITE_CONFIGURATIONS["HTML_FOLDER"].'default-header.php'; ?>
<?php require_once SITE_CONFIGURATIONS["HTML_FOLDER"].'search.php'; ?>

<?php
if(!$functions->isLoggedInUser()){
require_once SITE_CONFIGURATIONS["HTML_FOLDER"].'default-login.php';

}
?>

<div class="all-categories section">
    <div class="container">
        <div class="ad-details">
            <span id = "ad-page-category-links-container">
   
                <a href = "/" class="ad-page-category-links">Home&nbsp;/</a>
                <a class="ad-page-category-links" href='/search?category=<?php echo strtolower(str_replace("&", ".", $ad['category'])); ?>'><?php echo ucwords(str_replace("&" , " " , $ad['category'])); ?>&nbsp;/</a>
                <a class="ad-page-category-links" id="ad-page-subcategory-link" href='/search?category=<?php echo strtolower(str_replace("&" , "." , $ad['category'])); ?>&sub=<?php echo urlencode($ad['sub_category']);?>'><?php echo $ad['sub_category']; ?></a>
                <?php if($functions->postedByCurrentUser($ad_id)){ ?>
               <span id="ad-poster-action-buttons-container">
                    <a class = "ad-poster-actions product-condition" href="/edit-ad/<?php echo $ad_id;?>" class = "product-condition">Edit ad</a>
            <a class = "ad-poster-actions product-condition" href="#" data-ad-id = "<?php echo $ad_id;
            ?>" id="change-ad-status" data-action = "<?php if($ad_closed == 1){echo '0';}else{echo '1';} ?>"><?php if($ad_closed == 1){echo 'Open ad';}else{echo 'Close ad';} ?></a>

               </span>

                <?php } ?>
            </span>
            <div class="row">
                <div class="col-md-8 col-sm-7">

                    <div class="item">

                        <div class="detail-item-image item-image carousel slide" id = "item-image-container" data-ride="carousel">
                           <div id="ad-image-zoom-icon-container"> <span id="ad-zoomin-icon"><i class="fa fa-search-plus" id = "ad-image-zoom-in"></i> </span></div>
                            <?php if($ad_closed == 1 ){ ?>
                            <img alt = "Ad closed by seller" src='<?php echo SITE_CONFIGURATIONS["IMG_FOLDER"]."closed.png"?>' id="ad-closed-image" alt="featured ad image" />
<?php } ?>



                            <div class="carousel-inner" id = "carousel-inner">
                                <div class="item active ad-images-slider-containers" data-image = "1" title="<?php echo $ad['title'];?>">
                                    <span class="current-image-slide">1&nbsp;/&nbsp;<span class="number-of-ad-images"><?php echo $configurations->number_of_ads_images; ?></span></span>
                                    <img title="<?php echo $ad['title'];?>" alt="<?php echo $ad['title'];?> , featured image" src="<?php echo "{$functions->getAdImages($ad_id)[0]}"; ?>" id = "ad-image-1" alt="" class="img-responsive ad-images-sliders" data-image = "1" />

                                </div>
                                <div class="item ad-images-slider-containers" data-image = "2" title="<?php echo $ad['title'];?>">
                                    <span class="current-image-slide">2&nbsp;/&nbsp;<span class="number-of-ad-images"><?php echo $configurations->number_of_ads_images; ?></span></span>

                                    <img title="<?php echo $ad['title'];?>" src="<?php echo "{$functions->getAdImages($ad_id)[1]}"; ?>" id = "ad-image-2" alt="<?php echo $ad['title'];?>,  second image" class="img-responsive ad-images-sliders" alt="third ad image" data-image = "2" />

                                </div>
                                <div class="item ad-images-slider-containers" data-image = "3" title="<?php echo $ad['title'];?>">
                                    <span class="current-image-slide">3&nbsp;/&nbsp;<span class="number-of-ad-images"><?php echo $configurations->number_of_ads_images; ?></span></span>

                                    <img title="<?php echo $ad['title'];?>" src="<?php echo "{$functions->getAdImages($ad_id)[2]}"; ?>"  alt="<?php echo $ad['title'];?> , third image" id = "ad-image-3" class="img-responsive ad-images-sliders" data-image = "3" />

                                     </div>
                            </div>
                            <a class="left-control ad-images-arrows"  href=".detail-item-image" id = "prvious-image-icon" role="button" data-slide="prev">
                                <i class="fa fa-angle-left" aria-hidden="true"></i>
                                <span class="sr-only">Previous</span>
                            </a>
                            <a class="right-control ad-images-arrows" id = "next-image-icon" href=".detail-item-image" role="button" data-slide="next">
                                <i class="fa fa-angle-right" aria-hidden="true"></i>
                                <span class="sr-only">Next</span>
                            </a>
                            <div class="item-price">
                                <span><?php echo  $poster_currency.$amount_format; ?></span>
                            </div>
                        </div>
                        <div class="details-description" id = "ad-full-details">
                            <div class="item-info item-meta">
                                <div class="item-post-date">
                                    <span><i class="fa fa-clock-o"></i> <span data-livestamp='<?php echo "{$time_posted}"; ?>'></span></span>
                                </div>
                                <div class="ad-title">
                                    <h3><?php echo $ad["title"]; ?></h3>
                                </div>
                                <ul class="list-inline product-social">

                                    <?php if($functions->postedByCurrentUser($ad_id)){ ?>
                                        <span id = "ad-updated-status">Updated!</span>
                                       <li><a title="Refresh this Ad" id="ad-refresh-link" data-disabled = "0" href="javascript:void(0);" data-ad-id = "<?php echo $ad_id?>"><i id = "ad-refresh-icon" class="fa fa-refresh" aria-hidden="true"></i></a></li>
<?php } ?>
                                     <li><a <?php echo $functions->favoriteAdToggle($ad_id); ?>><i class='<?php echo $functions->favoritedAdIconToggle($ad_id); ?> ad-list-icons ad-fav-icon' aria-hidden="true" id = '<?php echo $ad_id; ?>-heart-icon'></i><span id = '<?php echo $ad_id;?>-favs-count' class = "ad-list-num-views favorites-count <?php echo $ad_id; ?>"><?php echo $favorite_count; ?></span></a></li>
                                    </span></a></li>
                                    <li><a href="#"><i class="fa fa-eye ad-list-eye ad-list-icons" aria-hidden="true"></i><span class = "ad-list-num-views"><?php echo $views; ?></span></a></li>
                                    <?php /*<li><a href="#"><i class="fa fa-share-alt" aria-hidden="true"></i></a></li> */ ?>
                                </ul>

                            </div><!-- item-info -->
                            <div class="item-info">
                                <h4>Description</h4>
                              <p>
                                  <?php echo str_replace('\n' , '<br />' , $ad["description"]); ?>
                              </p>
                                <h3>Condition</h3>
                                <p>           <a  href="javascript:void(0);" class = "product-condition"><?php echo $ad["product_condition"]; ?></a>
                                </p>
<?php if($ad['negotiable'] == 1){ ?>
                                <h3>Negotiable</h3>
                                <p>           <a  href="javascript:void(0);" class = "product-condition">Yes</a>
                                </p>
<?php } ?>
                            </div><!-- item-info -->
                        </div>
                    </div><!-- item -->

                    <div class="location-map">
                        <h4>Seller Location</h4>
                        <div id="gmap">

                            <!--<iframe class = "ad-poster-location-map"  id="gmap_canvas" src="https://maps.google.com/maps?q=<?php echo $poster_school;?>&t=&z=9&ie=UTF8&iwloc=&output=embed" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"></iframe>-->

                        </div>

                    </div><!-- location-map -->
                </div>


                <div class="col-sm-5 col-md-4">
                    <div class="side-bar">
                        <div class="item-author widget">
                            <h4><?php if (!$functions->postedByCurrentUser($ad_id)){ ?>
                                Seller
                                <?php } else { ?>
                                Your
                                <?php } ?> Info
                            </h4>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="seller-image">
                                        <div class="img-responsive" id = "seller-profile-image" title="<?php echo $functions->getAdPosterDetails($ad_id)['full_name'];?> profile image" style="background-image:url(<?php echo $functions->getAdPosterProfileImage($ad_id) ?>)"></div>
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <div class="seller-info">
                                        <p><span>Name:</span> <a href="javascript:void(0);"><?php echo $functions->getAdPosterDetails($ad_id)['full_name'];?></a></p>
                                        <address>
                                            <span>School:</span> <?php echo $functions->getAdPosterDetails($ad_id)['school'];?>
                                        </address>

                                        <p><span>Contact :</span> <a href = "#" id="hidden-seller-contact"><?php echo $functions->getAdPosterDetails($ad_id)["primary_phone"];
                                        if (strtolower($functions->getAdPosterDetails($ad_id) != 'null')){
                                            echo  ", {$functions->getAdPosterDetails($ad_id)['secondary_phone']}";
                                        }
                                        ?></a> <a href="#" id ="show-hidden-contact">Show contact</a> </p>
                                        <p><span>Joined : </span> <a href="javascript:void(0);" id = "ad-poster-registration-timestamp"><span id = "ad-poster-join-timestamp" data-livestamp='<?php $date_joined_to_time = strtotime($functions->getAdPosterDetails($ad_id)['registration_date']); echo $date_joined_to_time; ?>'></span></a> </p>
                                        <?php if(!$functions->postedByCurrentUser($ad_id)) { ?>
                                        <p><a href="/profile/<?php echo  $functions->getAdPosterDetails($ad_id)['user_id']; ?>" id = "view_more_user_ads">View other items of this seller</a></p>
                                   <?php } ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="contact-seller widget">

                            <button type="submit"  id = "contact-seller-action-dropdown" class="btn btn-primary"
                                <?php if($functions->postedByCurrentUser($ad_id) or $ad_closed == 1 or $functions->getAdPosterDetails($ad_id)["email_verified"] == "0"){
                                echo "disabled='disabled'";
                            } ?>><i class="fa fa-envelope" id = "message-seller-envelope"></i>Contact Seller</button>

                            <?php
                            $reported_ads = ($_COOKIE['reported_ads']) ?? null;
                            $ad_in_reported_ads_cookie = null;
                            if($reported_ads != null){
                                $ad_in_reported_ads_cookie = in_array($ad_id , json_decode($reported_ads , true));
                            }

                            if (!$functions->postedByCurrentUser($ad_id) and !$ad_in_reported_ads_cookie != null){ ?>
                            <a href="#" id="report-ad-modal-link"  data-toggle="modal" data-target="#report-ad-form-modal">REPORT THIS AD</a>
<?php }?>
                        </div>

                        <div class="contact-seller widget" id="contact-seller-form">
                            <?php
                            $fullname = ""; $email ="";
                             if($functions->isLoggedInUser()){
                                 $active_user_details = $functions->getActiveUserDetails();
                                 $fullname = $active_user_details["full_name"];
                                 $email =$active_user_details["email_address"];

                            }?>
                            <h4>Contact Seller</h4>
                            <fieldset id = "contact-form-fieldset">
                            <form data-sent-to = "<?php echo $functions->getAdPosterDetails($ad_id)['user_id'];?>" id="contact-form" class="contact-form" accept-charset="utf-8" name="contact-form" method="post" action="#" enctype="application/x-www-form-urlencoded" data-ad-id = "<?php echo  $ad_id; ?>">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <input type="text" class="form-control" required="required" placeholder="Name" id = "message-name" value="<?php echo $fullname; ?>">
                                            <span class="contact-errors" id = "message-name-error"></span>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <input type="email" value="<?php echo $email; ?>" class="form-control" required="required" id = "message-email" placeholder="Email address"/>
                                            <span class="contact-errors" id = "message-email-error"></span>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <input type="text" id="message-subject" class="form-control" required="required" placeholder="Subject">
                                            <span class="contact-errors" id = "message-subject-error"></span>
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <textarea name="message" id="message-body" required="required" class="form-control" rows="7" placeholder="We advice you include your contact information, to enable the seller reach you."></textarea>
                                            <span class="contact-errors" id = "message-body-error"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <span id = "contact-seller-error"></span>
                                    <button type="submit" class="btn btn-primary">Submit Message</button>
                                </div>

                            </form>
                            </fieldset>
                        </div>
                        <div class="widget item-tag">
                            <h4>Item Tags</h4>
                            <ul class="list-inline">

                                <?php

                                $ad_category_lower = strtolower($ad["category"]);
                                $subcategories = $ad_sub_categories[$ad_category_lower];
                                foreach ($subcategories as $subcategory){
                                    $subcategory_text = ucwords(str_replace('&' , ' ' , $subcategory));
                                    $subcategory_link_text = urlencode($subcategory);
                                    $category_link_text = str_replace("&", ".", $ad_category_lower);
                                    echo "<li><a href='/search?category={$category_link_text}&sub=$subcategory_link_text'>{$subcategory_text}</a></li>";

                                }

                                ?>

                                                            </ul>
                        </div>
                    </div><!-- side-bar -->
                </div>
            </div>
        </div>
    </div>
</div> <!-- all-categories -->
</div> <!-- page -->

<?php require_once SITE_CONFIGURATIONS["HTML_FOLDER"].'default-footer.php'; ?>

	<!-- page -->

</body>
</html>