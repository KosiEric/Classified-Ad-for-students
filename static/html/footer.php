
<!-- Footer -->
<footer class="bg3 p-t-75 p-b-32">
    <div class="container">
        <div class="row">
            <div class="col-sm-6 col-lg-3 p-b-50">
                <h4 class="stext-301 cl0 p-b-30">
                    Categories
                </h4>

                <ul>

                    <?php foreach($super_categories as $super_catgory){
                        $super = $super_catgory;
                        $category = str_replace("_" , " & " , $super_catgory);
                        $super_catgory = ucwords($category);
                        echo "<li class='p-b-10'>
                        <a href='/sup/{$super}' class='stext-107 cl7 hov-cl1 trans-04'>
               {$super_catgory}
                        </a>
                    </li>
                    ";

                    }
                    ?>
                </ul>
            </div>

            <div class="col-sm-6 col-lg-3 p-b-50">
                <h4 class="stext-301 cl0 p-b-30">
                    Help
                </h4>

                <ul>
                    <li class="p-b-10">
                        <a href="/trackOrder" class="stext-107 cl7 hov-cl1 trans-04">
                            Track Order
                        </a>
                    </li>

                    <li class="p-b-10">
                        <a href="/returnsPolicy" class="stext-107 cl7 hov-cl1 trans-04">
                            Returns Policy
                        </a>
                    </li>

                    <li class="p-b-10">
                        <a href="/deliveryPolicy" class="stext-107 cl7 hov-cl1 trans-04">
                            Delivery Policy
                        </a>
                    </li>

                    <li class="p-b-10">
                        <a href="/faq" class="stext-107 cl7 hov-cl1 trans-04">
                            FAQ's
                        </a>
                    </li>
                </ul>
            </div>

            <div class="col-sm-6 col-lg-3 p-b-50">
                <h4 class="stext-301 cl0 p-b-30">
                    GET IN TOUCH
                </h4>

                <p class="stext-107 cl7 size-201">
                    Any questions? Let us know. our head office is at <?php echo $countries[$selected_country]['head_office']; ?> or call us on : <br /><?php echo $countries[$selected_country]['helpline']; ?>
                </p>

                <div class="p-t-27">
                    <a href="https://facebook.com/<?php echo $facebook_page; ?>" target="_blank" class="fs-18 cl7 hov-cl1 trans-04 m-r-16">
                        <i class="fa fa-facebook"></i>
                    </a>

                    <a href="https://twitter.com/<?php echo $twitter_page; ?>" target="_blank" class="fs-18 cl7 hov-cl1 trans-04 m-r-16">
                        <i class="fa fa-twitter"></i>
                    </a>

                    <a href="https://instagram.com/<?php echo $instagram_page; ?>" target="_blank" class="fs-18 cl7 hov-cl1 trans-04 m-r-16">
                        <i class="fa fa-instagram"></i>
                    </a>
                </div>
            </div>

            <div class="col-sm-6 col-lg-3 p-b-50">
                <h4 class="stext-301 cl0 p-b-30">
                    Newsletter
                </h4>

                <form>
                    <div class="wrap-input1 w-full p-b-4">
                        <input class="input1 bg-none plh1 stext-107 cl7" type="text" name="email" placeholder="email@example.com">
                        <div class="focus-input1 trans-04"></div>
                    </div>

                    <div class="p-t-18">
                        <button class="flex-c-m stext-101 cl0 size-103 bg1 bor1 hov-btn2 p-lr-15 trans-04">
                            Subscribe
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <div class="p-t-40">
            <div class="flex-c-m flex-w p-b-18">
                <span id = "footer-icon-container">
                        <i class="fa fa-cc-mastercard footer-payment-icons"  id = "mastercard-icon" aria-hidden="true"></i>
                        <i class="fa fa-cc-visa footer-payment-icons" id = "visa-icon" aria-hidden="true"></i>
                        <i class="fa fa-cc-verve footer-payment-icons" id = "visa-icon" aria-hidden="true"></i>
                        <span id = "verve-word-container">

                            <i id = "letter-v-in-verve">V</i>erve

                        </span>

                    </span>
            </div>

            <p class="stext-107 cl6 txt-center">
                <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                Copyright &copy; <?php echo date("Y")." ".$home_page_site_name; ?> All rights reserved
                <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->

            </p>
        </div>
    </div>
</footer>
