
<div id = "desktop-modal-popup-for-state">


    <!-- Modal content-->
    <div class="modal-content container-fluid" id = "desktop-modal-content-for-state">

        <div class="" id = "desktop-modal-header-for-state">
            <button type="button" class="close modal-closers" data-dismiss="modal" id = "desktop-modal-header-cancel-times">&times;</button>
            <h4 class="modal-title" id = "desktop-modal-header-for-state-title">View contents posted from

<p id = "modal-country-icon-container"><img src="<?php $selected_country_upper = ucfirst($selected_country); echo SITE_CONFIGURATIONS['IMG_FOLDER']."countries/{$selected_country_upper}.png";?>" width="14px" /><span id = "country-icon-text"> <?php echo $selected_country_upper; ?></span></p>
            </h4>
        </div>

        <div class="modal-body">
            <form class="navbar-form navbar-left" id = "change-state-form" action="#" method="post" enctype="application/x-www-form-urlencoded" accept-charset="utf-8">
                <div class="form-group">
                     <select  id = "modal-select-state" style="background-image: url(<?php echo SITE_CONFIGURATIONS['IMG_FOLDER'].'drop-down.png'?>)">
                        <option value="<?php echo $selected_state;?>"><?php echo  $selected_state; ?></option>
                        <?php

                        for($i = 0; $i < count($states[$selected_country]); $i++){

                            $state = $states[$selected_country][$i];
                            if($state == $selected_state){
                                continue;
                            }

                            echo "<option value = '{$state}'>{$state}</option>";
                        }
                        ?>
                    </select>


                </div>
                <button type="submit" class="btn btn-default" id="modal-submit-button">Submit</button>
            </form>

        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-default modal-closers" data-dismiss="modal" id = "modal-state-close-button">Close</button>
        </div>
    </div>

</div>

<!-- Header -->

<header class="header trans_300">

    <!-- Top Navigation -->

    <div class="top_nav">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <div class="top_nav_left">The best ideas come as jokes</div>
                </div>
                <div class="col-md-6 text-right">
                    <div class="top_nav_right">
                        <ul class="top_nav_menu">

                            <!-- Currency / Language / My Account -->

                            <li class="currency">
                                <a href="#">
                                    Naira
                                    <i class="fa fa-angle-down"></i>
                                </a>
                                <ul class="currency_selection">
                                    <li><a href="#">Naira</a></li>
                                    <!--<li><a href="#">aud</a></li>
                                    <li><a href="#">eur</a></li>
                                    <li><a href="#">gbp</a></li> -->
                                </ul>
                            </li>
                            <li class="language">
                                <a href="#" id = "desktop-selected-state-link" class="selected-state-links">
                                    <?php echo $selected_state; ?>
                                    <i class="fa fa-angle-down"></i>
                                </a>
                                <ul class="language_selection">

                                    <?php /*for($i = 0; $i < count($states_in_nigeria); $i++){
                                            $state = $states_in_nigeria[$i];
                                            echo "<li><a href='/reset?state=$state'>$state</a></li>";

                                        }  */ ?>
                                </ul>
                            </li>
                            <li class="account">
                                <a href="#">
                                    My Account
                                    <i class="fa fa-angle-down"></i>
                                </a>
                                <ul class="account_selection">
                                    <li><a href="/account?action=login"><i class="fa fa-sign-in" aria-hidden="true"></i>Sign In</a></li>
                                    <li><a href="/account?action=signup"><i class="fa fa-user-plus" aria-hidden="true"></i>Register</a></li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Navigation -->

    <div class="main_nav_container">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-right">
                    <div class="logo_container">
                        <a href="#">Mov<span>ybe</span></a>
                    </div>
                    <nav class="navbar">
                        <ul class="navbar_menu navbar_menu_Desktop" id = "navbar_menu">

                            <?php
                            $pages = "";
                            foreach ($default_site_pages as $page => $url){
                                $pages.= "<li><a href='{$url}'>$page</a></li>";



                            }

                            echo $pages;

                            ?>
                        </ul>
                        <ul class="navbar_user navbar-user-desktop" id = "header-navbar-user">
                            <li><a href="/#search-field" <?php  if(strpos($_SERVER['PHP_SELF'] , 'index.php') == true){



                                ?> onclick="$('#header-search-text').focus();" <?php  }?>> <i class="fa fa-search" aria-hidden="true"></i></a></li>
                            <li><a href="#"><i class="fa fa-user" aria-hidden="true"></i></a></li>
                            <li class="checkout">
                                <a href="#">
                                    <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                                    <span id="checkout_items" class="checkout_items">2</span>
                                </a>
                            </li>
                        </ul>
                        <div class="hamburger_container">
                            <i class="fa fa-bars" id = "mobile-bar-icon" aria-hidden="true"></i>
                        </div>
                    </nav>
                </div>
            </div>
        </div>
    </div>

</header>

<div class="fs_menu_overlay"></div>
<div class="hamburger_menu">
    <div class="hamburger_close"><i class="fa fa-times" aria-hidden="true"></i></div>
    <div class="hamburger_menu_content text-right">
        <ul class="menu_top_nav">
            <li class="menu_item has-children">
                <a href="#">
                    Naira
                    <i class="fa fa-angle-down"></i>
                </a>
                <ul class="menu_selection">
                    <li><a href="#">Naira</a></li>
                    <?php /* <li><a href="#">aud</a></li>
                        <li><a href="#">eur</a></li>
                        <li><a href="#">gbp</a></li>
 */ ?>
                </ul>
            </li>
            <li class="menu_item has-children">
                <a href="#" id = "mobile-selected-state-link" class="selected-state-links">
                    <?php echo $selected_state;
                    ?>
                    <i class="fa fa-angle-down"></i>
                </a>
                <?php /*
                    <ul class="menu_selection">
                        <li><a href="#">FUTO</a></li>
                        <li><a href="#">UNIPORT</a></li>
                        <li><a href="#">AVAN</a></li>
                        <li><a href="#">NDU</a></li>
                    </ul>
 */ ?>
            </li>
            <li class="menu_item has-children">
                <a href="#">
                    My Account
                    <i class="fa fa-angle-down"></i>
                </a>
                <ul class="menu_selection">
                    <li><a href="/account?action=login"><i class="fa fa-sign-in" aria-hidden="true"></i>Sign In</a></li>
                    <li><a href="/account?action=signup"><i class="fa fa-user-plus" aria-hidden="true"></i>Register</a></li>
                </ul>
            </li>


            <?php
            $pages = "";
            foreach ($default_site_pages as $page => $url){
                $pages.= "<li class='menu_item'><a href='/$url'>$page</a></li>";



            }

            echo $pages;

            ?>
        </ul>
    </div>
</div>
