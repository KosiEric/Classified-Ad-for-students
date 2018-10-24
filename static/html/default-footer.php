
<!-- footer -->
<div class="navbar navbar-default navbar-fixed-bottom" id = "simple-site-footer">
    <div class="container">
        <p class="navbar-text pull-left" id="simple-footer-text-paragraph"> Free Classifieds for <span id = "footer-students-text">Students</span> © <?php echo date('Y');?> <?php echo $home_page_site_name; ?>&nbsp; -&nbsp;<a href="/faq" id ="simple-footer-help-link">Help</a> </p>
    </div>
</div>
<?php /*<footer id="footer">
    <div class="footer-top section">
        <div class="container">
            <div class="row">
                <div class="col-sm-4">
                    <div class="footer-widget about-widget">
                        <h3>About <?php echo $home_page_site_name; ?></h3>
                        <p><?php  echo  $home_page_site_name; ?>.com is Nigeria's fastest growing Classified ad site for Universities & Tertiary institutions.</p>
                        <br> <p> We provide a simple hassle-free solution to sell and buy almost anything on Campus.</p><br />


                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="footer-widget link-widget">
                        <h3>Useful Links</h3>
                        <ul>

                            <?php

                            foreach ($site_pages as $page => $page_text ){
                                echo "<li><a href='$page'> <i class='fa fa-angle-double-right'></i> $page_text</a></li>";
                            }

                            ?>
                        </ul>
                    </div>
                </div>

                <div class="col-sm-4">
                    <div class="footer-widget contact-widget">
                        <h3>Contact Us</h3>
                        <ul>
                            <li><span><i class="fa fa-map-marker"></i> Address :</span><span id ="footer-site-head-office" class="footer-site-details"><?php echo $countries[$selected_country]["head_office"]; ?></span></li>
                            <li><span><i class="fa fa-phone"></i> Phone number :</span> <span id ="footer-site-help-line" class="footer-site-details"><?php echo $countries[$selected_country]["helpline"]; ?></span></li>
                            <li><span><i class="fa fa-envelope"></i> E-mail :</span> <a href="mailto:<?php echo SITE_CONFIGURATIONS["site_contact_email"]; ?>"><span id ="footer-site-contact-email" class="footer-site-details"><?php echo SITE_CONFIGURATIONS["site_contact_email"]; ?></span></a></li>
                            <li>
                                <ul class="list-inline social">
                                    <li><a class="facebook" href="<?php echo "https://facebook.com/$facebook_page"; ?>"><i class="fa fa-facebook-square"></i></a></li>
                                    <li><a class="twitter" href="<?php echo "https://twitter.com/$twitter_page"; ?>"><i class="fa fa-twitter-square"></i></a></li>
                                    <li><a class="instagram" href="<?php echo "https://instagram.com/$instagram_page"; ?>"><i class="fa fa-instagram"></i></a></li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div><!-- container -->
    </div><!-- footer-top -->


    <div class="footer-bottom clearfix">
        <div class="container">
            <div class="row">
                <div class="col-sm-6">
                    <p>&copy; <?php echo  date("Y")." {$home_page_site_name}"; ?>. Property of  <a href="<?php echo $site_author_url; ?>"> <?php echo  SITE_CONFIGURATIONS["SITE_AUTHOR"];?></a></p>

                </div>
                <div class="col-sm-6">
                    <div class="payment-opt-icons">
                        <span>Payments </span>
                        <ul>
                            <li><img src="<?php echo SITE_CONFIGURATIONS['IMG_FOLDER'];?>paypal.png" alt="" class="img-responsive"></li>
                            <li><img src="<?php echo SITE_CONFIGURATIONS['IMG_FOLDER'];?>visa.png" alt="" class="img-responsive"></li>
                            <li><img src="<?php echo SITE_CONFIGURATIONS['IMG_FOLDER'];?>mastercard.png" alt="" class="img-responsive"></li>

                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div><!-- footer-bottom -->
</footer> */?><!-- footer -->

<script src="<?php echo SITE_CONFIGURATIONS['JS_FOLDER']?>modernizr.min.js"></script>
<script src="<?php echo SITE_CONFIGURATIONS['JS_FOLDER']?>bootstrap.min.js"></script>
<!--<script src="https://maps.google.com/maps/api/js?sensor=true"></script> -->
<!--<script src="js/gmaps.min.js"></script> -->
<script src="<?php echo SITE_CONFIGURATIONS['JS_FOLDER']?>owl.carousel.min.js"></script>
<script src="<?php echo SITE_CONFIGURATIONS['JS_FOLDER']?>custom.js"></script>
