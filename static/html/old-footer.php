<footer class="footer" id="site-footer">
   <?php /*
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <div class="footer_nav_container d-flex flex-sm-row flex-column align-items-center justify-content-lg-start justify-content-center text-center">
                    <ul class="footer_nav">

                        <?php
                        $pages = "";
                        foreach ($default_site_pages as $page => $url){
                            $page = ucfirst($page);
                            $pages.= "<li><a href='/{$url}'>$page</a></li>";



                        }

                        echo $pages;

                        ?>
                    </ul>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="footer_social d-flex flex-row align-items-center justify-content-lg-end justify-content-center">
                    <ul>
                        <li><a href="https://facebook.com/<?php echo $facebook_page; ?>" target="_blank"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
                        <li><a href="https://twitter.com/<?php echo $twitter_page; ?>" target="_blank"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
                        <li><a href="https://instagram.com/<?php echo $instagram_page; ?>" target="_blank"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>


                    </ul>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="footer_nav_container">


                    <img src="<?php echo SITE_CONFIGURATIONS['IMG_FOLDER']."payments.png"?>" width = "300px" id = "footer-payment-image" />

                    <div class="cr" id="footer-copyright">Copyright &copy; 2010 - <?php echo date("Y"). " {$home_page_site_name} Inc. "; ?> All Rights Reserverd.
                       <!--
                        Powered by  <i class="fa fa-heart" aria-hidden="true"></i>  <?php echo  $home_page_site_name. " Business Services"; ?>
-->
                    </div>
            </div>
        </div>
    </div>
 */

   ?>

   <footer id = "site-footer" class ="container-fluid">

<span class = "site-footer-spans" id = "site-footer-copyright">
<?php echo $home_page_site_name.' '. date('Y')." "; ?>&copy;
    </span>
    <span class = "site-footer-spans" id = "site-footer-socials"><?php echo " "; ?>
        <a href = "https://fb.com/<?php echo $facebook_page; ?>" target="_blank" class = "footer-socials" id = "footer-social-facebook">
  <i class="fa fa-facebook-official"></i>
</a>

<a href = "https://twitter.com/<?php echo $twitter_page; ?>" target="_blank" class = "footer-socials" id = "footer-social-twitter">
  <i class="fa fa-twitter"></i>
</a>

<a href = "https://instagram.com/<?php echo $instagram_page; ?>" target="_blank" class = "footer-socials" id = "footer-social-instagram"><i class="fa fa-instagram"></i></a>
</span>

    <!--<font class = "dashes"> - </font>--><span class = "site-footer-spans" id = "site-footer-home"><a href = "/"  class = "footer-links" id = "footer-link-privacy">Home</a></span>
    <font class = "dashes"> - </font><span class = "site-footer-spans" id = "site-footer-privacy"><a href = "/privacy"  class = "footer-links" id = "footer-link-privacy">Privacy</a></span>
    <font class = "dashes"> - </font><span class = "site-footer-spans" id = "site-footer-terms"><a href = "/terms"  class = "footer-links" id =
        "footer-link-terms">Terms</a></span><font class = "dashes"> - </font><span class = "site-footer-spans" id = "site-footer-about"><a href = "/about"  class = "footer-links" id =
        "footer-link-about">About</a></span><font class = "dashes"> - </font>
    <span class = "site-footer-spans" id = "site-footer-contact"><a href = "/contact"  class = "footer-links" id =
        "footer-link-contact">Contact us</a></span>


</footer>
</footer>