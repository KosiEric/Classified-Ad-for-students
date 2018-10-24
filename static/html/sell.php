

<fieldset id ="form-field" class="hideable-forms form-steps form-step-3 container">

    <form action="" method="post" enctype = "multipart/form-data" accept-charset="utf-8" id = "ad-form" name = "adpost-form">

        <span id =  "opera-warning">Opera mini users are required to disable "Data Saving Mode"  or Switch to another browser  for better user experience.</span>
        <div id = "form-container" class="containers"><button id = "clear-fields" type="reset">clear all fields</button>
            <!--Matt Bradley was born <span id="birth">on June 18, 1987</span>.-->
            <!--<time class="timeago" datetime="Tue 12 Sep 2017 12:29:49 am" title="Tue 12 Sep 2017 12:29:49 am"></time>-->
            <span id = "submit-ad-text">Submit your Ad</span>





                        <label class="input-texts" for = "select-categories">Category <i class="fa fa-asterisk asterisk"></i></label>

                            <select name="category-group" id="select-categories" class="form-control selects input-sm">

                                <?php

                                foreach ($ad_categories as $category) {

                                    $category_text = str_replace("&", " & ", $category);
                                    $category_text_upper = ucwords($category_text);

                                    echo "<option value = '$category'>$category_text_upper</option>";
                                }
                                ?>
                            </select>



            <span class = "input-texts">Subcategory<font class = "asterisk">*</font></span>
            <select name = "subCategory"  id = "select-subcategories" class = "selects" disabled="disabled">
                <option value="">-No category choosen--</option>
            </select>
            <div id = "hidden-div-content">
                <span class = "input-texts">Title<font class = "asterisk">*</font></span>
                <input class = "texts-inputs" id = "title-input" placeholder="Please write a clear title for your item" name="title"
                       value = '<?php if(isset($_SESSION['new_ad']) && !empty($_SESSION['new_ad']['title'])){
                           echo $_SESSION['new_ad']['title'];
                       } ?>' />

                <div class = "tool-tips" id = "title-tooltip" data-toggle="tooltip">Field must be between 10 and 80 characters</div>

                <span id = "num_text_remaining"><font id = "text-count">80</font> <font id = "char">characters</font> left</span>
                <span class = "input-texts" id = "description-text" >Description<font class = "asterisk">*</font></span>
                <textarea id = "description-box" name = "description" placeholder="Please provide a detailed description. you can mention as many details as possible. it will make your ad more attractive for buyers.">
<?php if(isset($_SESSION['new_ad']) && !empty($_SESSION['new_ad']['description'])){
    echo $_SESSION['new_ad']['description'];
}
else {
    echo null;
} ?>
</textarea>

                <div class = "tool-tips" id = "description-tooltip">Field must be between 50 and 10000 characters</div>
                <span class = "input-texts" id = "price-text">Price<font class = "asterisk">*</font></span>
                <input type="checkbox" id="contact-for-price" name="contact-for-price" />

                <label for="contact-for-price" id = "contact-for-price-label">Contact for price</label>


  <div class="input-group">
                                        <span class="input-group-addon">&#8358;</span>
                                        <input name = "price" id = "amount" placeholder="Enter price"  class="form-control" autocomplete = "off" value = ""  type="email">

                                    </div>

<input type="checkbox" id="negotiable"  name = "negotiable" checked>
                <label for="negotiable" id = "negotiable-label">Negotiable</label>
  <span id = "price-value">Price : <b>&#8358;</b><span id = "price-string"></span></span></span>
                <div class = "tool-tips" id = "price-tooltip">Only numbers are allowed</div>

            </div>
        </div>
        <div class="containers" id = "photo-containers">
            <div id = "progress-bar">
                <div id ="progress-bar-inside">

                </div>
                <span id = "progress-reader"></span>
            </div>
            <span id = "form-photos-text">Photos</span>
            <span id = "text-about-photos"><font id = "bolded-photo-texts">Adding photos to your ads will attract 5X more clients.</font>
  Accepted formats are .jpg, .gif and .png. Max allowed size for uploaded files is 5 MB.
  Photos with contact details are not permitted.</span>

            <div class = "tool-tips" id = "image-tooltip">first image size exceeds 5mb</div>
            <input type = "file" name = "image1" name = "file[]" id = "image1" class = "imageFiles ad-image-fields" accept="image/jpeg,image/gif,image/png" />
            <label for = "image1" class = "image-labels" id = "image1-label">
                <i class="fa fa-camera label-camera" id = "image1-camera"></i>
            </label>
            <input type = "file" name = "image2" id = "image2" name = "file[]" class = "imageFiles ad-image-fields" accept="image/jpeg,image/gif,image/png" />
            <label for = "image2" class = "image-labels" id = "image2-label">
                <i id = "image2-camera" class="fa fa-camera label-camera"></i>

            </label>
            <input type = "file" name = "image3" id = "image3" class = "imageFiles ad-image-fields" name = "file[]"  accept="image/jpeg,image/gif,image/png"/>
            <label for = "image3" class = "image-labels" id = "image3-label">
                <i class="fa fa-camera label-camera" id = "image3-camera"></i>

            </label>
            <?php  /*
  <input type = "file" name = "image4" id = "image4" class = "imageFiles"  name = "file[]" accept="image/jpeg,image/gif,image/png"/>
  <label for = "image4" class = "image-labels" id = "image4-label">
    <i class="fa fa-camera label-camera" id = "image4-camera"></i>

  </label>
  <input type = "file" name = "image5" id = "image5" class = "imageFiles" name = "file[]"  accept="image/jpeg,image/gif,image/png"/>
  <label for = "image5" class = "image-labels" id = "image5-label">
    <i class="fa fa-camera label-camera" id = "image5-camera"></i>

  </label>
*/ ?>
            <span id = "picture-warning">First picture is the display picture, <font id = "image-note">Note also that images cannot be changed later</font></span>

        </div>

        <div id = "contact-container" class="containers">
            <span id = "form-contact-text">Contact information for your  ad</span>
            <span id = "text-about-contact">The contact details you provided in your account settings will be used.

  </span>

        </div>

        </div>
        <button id = "submit-button" type="submit">
            Post my ad
        </button>
    </form>
</fieldset>


