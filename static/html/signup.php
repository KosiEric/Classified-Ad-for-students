
<div class="seller-section avtpost-fields hideable-forms form-steps form-step-2" id = "seller-information">
    <fieldset id = "seller-information-fieldset">
        <form action="#" enctype="multipart/form-data" id = "seller-information-form" method="post" name="account-information" autocomplete="on" accept-charset="utf-8">

            <div class="row">
                <div class="col-xs-12">
                    <h3>Account Information</h3>
                </div>
                <div class="col-md-6">
                    <div class="post-inner">
                        <div class="row form-group">
                            <label class="col-md-4" for="contact-fullname">Contact Name: </label>
                            <div class="col-md-8">
                                <input type="text" required="required" name="name" class="form-control contact-inputs" id="contact-fullname" placeholder="full name" />
                                <span class = "contact-errors" id = "contact-fullname-error"></span>

                            </div>

                        </div>

                    </div><!-- post-inner -->

                </div>

                <div class="col-md-6">
                    <div class="post-inner">
                        <div class="row form-group">
                            <label class="col-md-4" for="contact-email">Contact Email: </label>
                            <div class="col-md-8">
                                <input type="email" name="email" required="required" class="form-control contact-inputs" id="contact-email"  placeholder="name@domain.com" />
                                <span class = "contact-errors" id = "contact-email-error"></span>
                            </div>
                        </div>
                    </div><!-- post-inner -->
                </div>
                <div class="col-md-6">
                    <div class="post-inner">
                        <div class="row form-group">
                            <label class="col-md-4" for ="contact-primary-phone">primary contact: </label>
                            <div class="col-md-8">
                                <input type="tel" name="primary" required="required" class="form-control contact-inputs" id="contact-primary-phone" placeholder="Primary phone number" />
                                <span class = "contact-errors" id = "primary-contact-error"></span>
                            </div>
                        </div>
                    </div><!-- post-inner -->
                </div>
                <div class="col-md-6">
                    <div class="post-inner">
                        <div class="row form-group">
                            <label class="col-md-4" for = "contact-secondary-phone">Secondary contact (if any) : </label>

                            <div class="col-md-8">
                                <input type="tel" name="secondary" class="form-control contact-inputs" id="contact-secondary-phone" placeholder="Secondary phone number" />
                                <span class = "contact-errors" id = "secondary-contact-error"></span>
                            </div>
                        </div>
                    </div><!-- post-inner -->
                </div>
                <div class="col-md-6">
                    <div class="post-inner select-cat">
                        <div class="row form-group">
                            <label class="col-md-4" for = "contact-select-state">Your state: </label>
                            <div class="col-md-8">
                                <select autocomplete="off" required = "required" name="state" id="contact-select-state" onchange="changeUniversity('contact-select-state' , 'contact-select-school')" class="form-control contact-inputs">
                                    <option value="0" selected="selected">---Choose your state---</option>


                                    <?php
                                    $states = $states[$selected_country];
                                    foreach ($states as $state){
                                        $state = ucwords($state);
                                        echo "<option value= '$state'>$state</option>"."\n";

                                    }
                                    ?>

                                </select>
                                <span class = "contact-errors" id = "contact-state-error"></span>
                            </div>
                        </div>
                    </div><!-- post-inner -->
                </div>


                <div class="col-md-6">
                    <div class="post-inner select-cat">
                        <div class="row form-group">
                            <label class="col-md-4" for = "contact-select-school">Your school: </label>
                            <div class="col-md-8">
                                <select autocomplete="off" title = "State not selected" disabled="disabled" name="school" id="contact-select-school" class="form-control contact-inputs">
                                    <option value="0" selected="selected">--No state choosen--</option>


                                </select>
                                <span class = "contact-errors" id = "contact-school-error"></span>
                            </div>
                        </div>
                    </div><!-- post-inner -->
                </div>

                <div class="col-md-6">
                    <div class="post-inner">
                        <div class="row form-group">
                            <label class="col-md-4" for = "account-username">Account username </label>

                            <div class="col-md-8">
                                <input type="text" name="username" required = "required" class="form-control contact-inputs" id="account-username" placeholder="e.g Echo108" />
                                <span class = "contact-errors" id = "contact-username-error"></span>
                            </div>
                        </div>
                    </div><!-- post-inner -->
                </div>
                <div class="container">

                    <label for = "profile-image" class = "upload-labels" id = "profile-image-label">
                        <div id = "profile-label-container" title="select profile">
                                               <span id = "profile-image-texts"> <i id = "profile-camera-icon" class="fa fa-camera label-camera"></i>
                                                   <!--<span id="profile-image-span">image</span>-->
                                                   </span>
                        </div>
                        <button id = "use-existing-image-button" class="btn btn-outline-dark change-image-buttons">use existing image</button>
                        <button id = "change-existing-image-button" class="change-image-buttons btn btn-outline-dark">Change existing image</button>
                        <span class = "contact-errors" id = "contact-profile-error"></span>

                    </label>
                    <div class="col-md-8">
                        <input type = "file" name = "profile" id = "profile-image" name = "profile-image" class = "image-fields" accept="image/jpeg,image/gif,image/png" />
                    </div>
                    <input type="hidden" name = "action" value = "signup" id = "contact-action" />
                    <input type="hidden" name = "uploadNew" value = "true" id = "contact-upload-new" />
                </div>


            </div>
            <progress id = "profile-upload-progress" value="26" max="100" class="profile-upload-progress"></progress>
            <span id = "profile-upload-progress-percent" class = "profile-upload-progress">20%</span>
            <div class = "buttons-containers">
                <button style="display:none;" type="button" name="seller-information-submit-button" id = "1st-back-button"  class = "steps-buttons hovable-buttons back-buttons"    data-current-step = "2"><i class="fa fa-arrow-circle-o-left arrow-icons"></i> <span class = "button-icons-texts back-icon-texts">Back</span></button>

                <button type="submit"  name="seller-information-submit-button" id="seller-information-submit-button" data-upload-image = "false" data-action = "signup"  class = "steps-buttons hovable-buttons next-step-buttons" ><span id = "seller-next-enclosing-span"><span class = "button-icons-texts" id = "sellerr-info-next-text">Submit</span><i class="fa fa-arrow-circle-o-right arrow-icons" id = "next-arrow-icon"></i></span> <i class = "fa fa-spinner fa-spin" class = "loading-icons"  id = "next-account-loading-icon"></i></button>
            </div>
            <!-- seller-section -->
        </form>
    </fieldset>
</div>