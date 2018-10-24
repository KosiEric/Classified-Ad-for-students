<div class="home-page">
    <div id="home-section" class="parallax-section carousel slide" data-ride="carousel">
        <div class="carousel-inner">
            <div class="item active home-sliders" style="background-image:url(<?php echo SITE_CONFIGURATIONS['IMG_FOLDER'].'slider_1.jpg';?>)">
                <div class="container">
                    <div class="row">
                        <div class="col-md-9">
                            <div class="slider-content">
                                <h1 data-animation="animated lightSpeedIn">Classified For Students</h1>
                                <h3 data-animation="animated lightSpeedIn">Buy/Sell To Students in <?php echo $selected_country?> Campuses<br />
                                    Find Hostels around your Campus. For Free on <?php echo $home_page_site_name; ?>
                                    <br />
                                </h3>
                                <h4 data-animation="animated lightSpeedIn">
                                    Over <?php echo number_format($functions->getTotalNumberOfAds());?> Ads by <?php echo $selected_country;?> Students
                                </h4>

                                <div class="ad-btn">
                                    <a href="#" class="btn btn-primary" data-animation="animated lightSpeedIn">View Ads</a>
                                </div>
                            </div>
                        </div>
                    </div><!-- row -->
                </div><!-- contaioner -->
            </div><!-- item -->
<?php /*
            <div class="item" style="background-image:url(<?php echo SITE_CONFIGURATIONS['IMG_FOLDER'].'slider_1.jpg';?>)">
                <div class="container">
                    <div class="row">
                        <div class="col-md-9">
                            <div class="slider-content">
                                <h1 data-animation="animated lightSpeedIn">Say Hello</h1>
                                <h2 data-animation="animated lightSpeedIn">To Advert Template</h2>
                                <p data-animation="animated lightSpeedIn">Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat.</p>
                                <div class="ad-btn">
                                    <a href="#" class="btn btn-primary" data-animation="animated lightSpeedIn">View Ads</a>
                                </div>
                            </div>
                        </div>
                    </div><!-- row -->
                </div><!-- contaioner -->
            </div><!-- item -->
            <div class="item" style="background-image:url(<?php echo SITE_CONFIGURATIONS['IMG_FOLDER'].'slider_1.jpg';?>)">
                <div class="container">
                    <div class="row">
                        <div class="col-md-9">
                            <div class="slider-content">
                                <h1 data-animation="animated lightSpeedIn">Modern Design</h1>
                                <h2 data-animation="animated lightSpeedIn">Maximum Posibilities</h2>
                                <p data-animation="animated lightSpeedIn">Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat.</p>
                                <div class="ad-btn" >
                                    <a href="#" class="btn btn-primary" data-animation="animated lightSpeedIn">View Ads</a>
                                </div>
                            </div>
                        </div>
                    </div><!-- row -->
                </div><!-- contaioner -->
            </div><!-- item -->
 */ ?>
        </div>
        <?php /*
        <a class="left carousel-control" href="#home-section" role="button" data-slide="prev">
            <i class="fa fa-chevron-left home-slider-arrows" aria-hidden="true"></i>
            <span class="sr-only">Previous</span>
        </a>
        <a class="right carousel-control" href="#home-section" role="button" data-slide="next">
            <i class="fa fa-chevron-right home-slider-arrows" aria-hidden="true"></i>
            <span class="sr-only">Next</span>
        </a>
 */ ?>
    </div><!-- #home-section -->
</div>