<div class="product-section avtpost-fields hideable-forms form-steps form-step-3">
    <fieldset id = "post-ad-fieldset">
        <form name = "post-ad-form" id = "post-ad-form" enctype="multipart/form-data" accept-charset="utf-8" autocomplete="on" data-ad-id = "<?php echo $_GET['id']; ?>" method="post" data-num-upload-images = "0">
            <div class="row">

                <div class="col-xs-12">
                    <h3>Edit Your ad</h3>
                    <button id = "ad-clear-fields" type="reset">clear all fields</button>
                </div>
                <div class="col-md-6">
                    <div class="post-inner">
                        <div class="row form-group">
                            <label class="col-md-4" for="post-ad-title">Title <i class="asterisk">*</i> </label>
                            <div class="col-md-8">
                                <input require="require" type="text" value="<?php echo $ad['title'];?>" autocomplete="off" name = "adTitle" class="form-control ad-post-inputs" id="post-ad-title" placeholder="Please write a clear title for your item">
                                <span class="help-block post-ad-errors" id = "post-ad-title-error"></span>
                            </div>

                        </div>

                    </div><!-- post-inner -->
                </div>

                <div class="col-md-6">
                    <div class="post-inner select-cat">
                        <div class="row form-group">
                            <label class="col-md-4">Category <i class="asterisk">*</i></label>
                            <div class="col-md-8">
                                <select  name="adCategory" autocomplete="off" id="post-ad-category" class="form-control drop-down-arrow-background">
                                    <option value = "">---Choose a category---</option>

                                    <?php

                                    foreach ($ad_categories as $category) {
                                        $selected = "";
                                        if ($category == $ad['category']){
                                            $selected = "selected='selected'";
                                        }

                                        $category_text = str_replace("&", " & ", $category);

                                        $category_text_upper = ucwords($category_text);
                                        $value = str_replace(" & " , "&" , $category_text);

                                        echo "<option value = '$value' $selected>$category_text_upper</option>";
                                    }
                                    ?>
                                </select>
                                <span class="help-block post-ad-errors" id = "post-ad-category-error"></span>

                            </div>
                        </div>
                    </div><!-- post-inner -->
                </div>
                <div id = "form-drop-down">
                    <div class="col-md-6">
                        <div class="post-inner select-cat">
                            <div class="row form-group">
                                <label class="col-md-4">Subcategory <i class="asterisk">*</i></label>
                                <div class="col-md-8">
                                    <select  name="adSubCategory"  autocomplete="off" id="post-ad-subcategory" class="form-control drop-down-arrow-background">

<?php foreach($ad_sub_categories[$ad['category']] as $sub_category){
    $selected = "";
    if($sub_category == $ad['sub_category']){
        $selected = "selected='selected'";


    }

    $subcategory_value = strtolower(str_replace(' & ' , '&' , $sub_category));
    echo "<option value='{$subcategory_value}' $selected>$sub_category</option>";

};
?>

                                    </select>
                                    <span class="help-block post-ad-errors" id = "post-ad-sub-category-error"></span>

                                </div>
                            </div>
                        </div><!-- post-inner -->
                    </div>


                    <div class="col-md-6">
                        <div class="post-inner select-cat">
                            <div class="row form-group">
                                <label class="col-md-4">Condition <i class="asterisk">*</i></label>
                                <div class="col-md-8">
                                    <select name="adItemCondition" autocomplete="off" id="post-ad-condition" class="form-control drop-down-arrow-background">
                                        <?php foreach ($configurations->ad_conditions as $ad_condition) {
                                            $selected = "";
                                            if($ad['product_condition'] == $ad_condition){
                                                $selected = "selected='selected'";
                                            }
                                            $condition_to_lower = strtolower($ad_condition);
                                            echo "<option value='{$condition_to_lower}' $selected>$ad_condition</option>";
                                        }?>

                                    </select>
                                </div>
                            </div>
                        </div><!-- post-inner -->
                    </div>




                    <div class="col-md-6">
                        <div class="post-inner choose-options">
                            <div class="row form-group">
                                <label class="col-md-4">Price option </label>
                                <div class="col-md-8">
                                    <div class="row">
                                        <div class="col-md-6">

                                            <div class="choose-option">
                                                <input type="checkbox" <?php if(!is_numeric($ad['amount'])){ echo "checked='checked'"; }?> id="contact-for-price"  name = "contactForPrice" autocomplete="off"  />
                                                <label for="contact-for-price" id = "contact-for-price-label">Contact for price</label>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="choose-option" style="display: none;">
                                                <input type="checkbox" id="enter-price"  name = "enterPrice" checked="checked" autocomplete="off"/>
                                                <label for="enter-price" id = "enter-price-label">Enter price</label>

                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div><!-- post-inner -->
                    </div>
                    <div class="col-md-6" id = "ad-amount-container">
                        <div class="post-inner">
                            <div class="row form-group">
                                <label class="col-md-4">Amount <span>(<?php echo $countries[$selected_country]["currency_sign"];?><span id = "price-string"><?php if(is_numeric($ad['amount'])){ echo number_format($ad['amount']); } ?></span>)</span> <i class="asterisk">*</i>	</label>
                                <div class="col-md-8">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <input id="post-ad-amount" value = "<?php if(is_numeric($ad['amount'])){ echo $ad['amount']; } ?>" <?php if(!is_numeric($ad['amount'])){ echo "disabled='disabled'"; }?>name="adAmount" class="form-control ad-post-inputs" placeholder="Enter amount" require="" type="text" />

                                        </div>

                                        <div class="col-md-6">
                                            <div class="checkbox choose-option">
                                                <input type="checkbox" id="ad-negotiable"  name = "adNegotiable" <?php if(!is_numeric($ad['amount'])){ echo "disabled='disabled'"; }?> checked="checked">
                                                <label for="ad-negotiable" id = "ad-negotiable-label">Negotiable</label>
                                                <span class="help-block post-ad-errors" id = "post-ad-amount-error"></span>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div><!-- post-inner -->

                    </div>
                    <div class="col-md-6">
                        <div class="post-inner">
                            <div class="row form-group">
                                <label class="col-md-4">Description <i class="asterisk">*</i></label>
                                <div class="col-md-8">
                        <textarea require = "require" class="form-control ad-post-inputs" id="post-ad-description"
                                  placeholder="Please provide a detailed description. you can mention as many details as possible. it will make your ad  2x More attractive for buyers." rows="6" name = "adDescription"><?php echo str_replace('<br />' , '&#10;' , $ad['description']); ?></textarea>
                                    <span class="help-block post-ad-errors" id = "post-ad-decription-error"></span>
                                    <input type="hidden" id = "ad-posted-by" name="adPostedBy" value="<?php $functions = new Functions(); if($functions->isLoggedInUser()){ echo $_COOKIE['current_active_user'];} else {
                                        echo '';
                                    }?>" />
                                </div>
                            </div>
                        </div><!-- post-inner -->
                    </div>
                </div>

            </div><!-- product-section -->

            <div class="col-md-6 main-upload-section"></div>

            <?php require_once SITE_CONFIGURATIONS["HTML_FOLDER"].'edit-ad-2.php'; ?>
        </form>
<fieldset  id = "ad-image-1-form-fieldset">
        <form id = "ad-image-1-form" data-ad-image-number = "1" class = "ad-upload-image-form" name="uploadAdImageForm1" enctype="multipart/form-data" accept-charset="utf-8" method="post">

        </form>

</fieldset>
        <fieldset  id = "ad-image-2-form-fieldset">
        <form id = "ad-image-2-form" data-ad-image-number = "2" class="ad-upload-image-form" name="uploadImageForm2" enctype="multipart/form-data" accept-charset="utf-8" method="post">
        </form>
        </fieldset>
        <fieldset  id = "ad-image-3-form-fieldset">
        <form id = "ad-image-3-form" data-ad-image-number = "3" class="ad-upload-image-form" name="uploadImageForm3" enctype="multipart/form-data" accept-charset="utf-8" method="post">
        </form>
    </fieldset>
</div>