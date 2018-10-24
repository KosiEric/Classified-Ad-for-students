<div id = "submit-ad-container"><?php /* <div class="post-inner">
                <div class="row form-group">
                    <label class="col-md-4">Upload Photo: </label>
                    <div class="col-md-8">
                        <div class="upload-section">
                            <label class="upload-image" for="uploadOne">
                                <input type="file" id="uploadOne">
                            </label>

                            <label class="upload-image" for="uploadTwo">
                                <input type="file" id="uploadTwo">
                            </label>
                            <label class="upload-image" for="uploadThree">
                                <input type="file" id="uploadThree">
                            </label>

                        </div>
                    </div>
                </div>
            </div><!-- post-inner --> */ ?>
<div id = "progress-bar" class="post-ad-progress">
    <div id ="progress-bar-inside" class="post-ad-progress">
        <span id = "progress-reader">20%</span>
    </div>

</div>
<span id = "form-photos-text">Photos</span>
<span id = "text-about-photos"><font id = "bolded-photo-texts">Adding photos to your ads will attract 5X more clients.</font>
  Accepted formats are .jpg, .gif and .png. Max allowed size for uploaded files is <span id ="max-upload-image-text">5</span> MB.
  Photos with contact details are not permitted.</span>

    <span class="help-block post-ad-errors" id = "post-ad-image-error"></span>

    <div class = "tool-tips" id = "image-tooltip">first image size exceeds 5mb</div>
<input type = "file" name = "image1"  id = "image1" data-image-number = "1" class = "imageFiles ad-image-fields" accept="image/jpeg,image/gif,image/png" />
<label for = "image1" class = "image-labels" id = "image1-label" title="ad featured image">
    <i class="fa fa-camera label-camera" id = "image1-camera"></i>
</label>
<input type = "file" name = "image2" id = "image2"  data-image-number = "2" class = "imageFiles ad-image-fields" accept="image/jpeg,image/gif,image/png" />
<label for = "image2" class = "image-labels" id = "image2-label" title="Select 2nd image">
    <i id = "image2-camera" class="fa fa-camera label-camera"></i>

</label>
<input type = "file"  name = "image3" id = "image3" class = "imageFiles ad-image-fields" data-image-number = "3" name = "file[]"  accept="image/jpeg,image/gif,image/png"/>
<label for = "image3" class = "image-labels" id = "image3-label" title="Select 3rd image">
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
<span id = "picture-warning">First picture is the display picture, <font id = "image-note">Note also that images can be changed anytime.</font></span>
<div class = "buttons-containers ad-post-buttons-next-container">
    <button type="button" name="seller-information-submit-button" id = "2nd-back-button" class = "steps-buttons hovable-buttons back-buttons"    data-current-step = "2"><i class="fa fa-arrow-circle-o-left arrow-icons"></i> <span class = "button-icons-texts back-icon-texts">Back</span></button>

    <button type="submit"  title="Submit ad" name="ad-information-submit-button" id="ad-information-submit-button"  class = "steps-buttons hovable-buttons next-step-buttons" ><span id = "seller-next-enclosing-span"><span class = "button-icons-texts" id = "sellerr-info-next-text">Ok</span><i class="fa fa-arrow-circle-o-right arrow-icons" id = "next-arrow-icon"></i></span> <i class = "fa fa-spinner fa-spin" class = "loading-icons"  id = "next-account-loading-icon"></i></button>
</div>
</div>