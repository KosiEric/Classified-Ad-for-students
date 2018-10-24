$(document).ready(function () {



    var adTitle = $('#post-ad-title');
    var adCategory = $('#post-ad-category');
    var adSubCategory = $('#post-ad-subcategory');
    var adDescription = $('#post-ad-description');
    var adAmount = $('#post-ad-amount');
    var productCondition  = $('#post-ad-condition');
    var enterPrice = $('#enter-price');
    var contactForPrice = $('#contact-for-price');
    var adNegotiable = $('#ad-negotiable');
    var formFieldSet = $('#post-ad-fieldset');
    var formDropDownGroup = $('#form-drop-down');
    var adAmountContainer = $('#ad-amount-container');
    var priceString = $('#price-string');
    var postAdForm = $('#post-ad-form');
    var adSubmitButton = $('#ad-information-submit-button');
    var adImageError = $('#post-ad-image-error');
    var progressReader = $('#progress-reader');
    var progressBar = $('#progress-bar-inside');
    var progressDivs = $('.post-ad-progress');
    var successAlert = $('#success-alert');
    var failureAlert = $('#failure-alert');
    var adPostedBy = $('#ad-posted-by');
    var uploadImageButtons = $('.ad-change-image-buttons');

    /* Errors spans */


    var adTitleError = $('#post-ad-title-error');
    var adCategoryError = $('#post-ad-category-error');
    var adAmountError = $('#post-ad-amount-error');
    var adDescriptionError = $('#post-ad-decription-error');
    var adImageError = $('#post-ad-image-error');
    var adUploadImageForms = $('.ad-upload-image-form');

    enterPrice.on('click' , function () {
        if($(this).prop('checked')){
            contactForPrice.prop('checked' , false);
            adAmount.prop('disabled' , false);
            adNegotiable.prop('disabled' , false);
        }
        else {
            contactForPrice.prop('checked', true);
            adAmount.prop('disabled' , true);
            adNegotiable.prop('disabled' , true);

        }
    });
    contactForPrice.on('click' , function () {
        if($(this).prop('checked')){
            enterPrice.prop('checked' , false);
            adAmount.prop('disabled' , true);
            adNegotiable.prop('disabled' , true);


        }
        else {
            enterPrice.prop('checked' , true);
            adAmount.prop('disabled' , false);
            adNegotiable.prop('disabled' , false);

        }
    });

    adAmount.on('keyup' , function () {
        amountEntered = Number($(this).val());

        if(!isNaN(amountEntered) && amountEntered != 0){

            priceString.text(amountEntered.toLocaleString());
        }
        else  {
            priceString.text(null);
        }
    });




    adCategory.on('change' , function () {

        changeSubcategory(adCategory.attr('id') , adSubCategory.attr('id') , "Category" , sub);
        categoryGroup = document.getElementById(adCategory.attr('id'));
        if(categoryGroup.options[categoryGroup.selectedIndex].value != ""){
            formDropDownGroup.slideDown('slow');
            $(this).prop('required' , false);
        }
        else {
            formDropDownGroup.slideUp('slow');
            $(this).prop('required' , true);
        }
    });

    function  isAdTitle(title , errorSpan) {
        if(isEmptyField(title)) {
            errorSpan.text(emptyAdTitleError);
            $(window).scrollTop(errorSpan.scrollTop());
            return false;
        }

        else if (title.length < minAdTitleLength) {
            errorSpan.text(adTitleDeceedsMinError);
            $(window).scrollTop(errorSpan.scrollTop());
            return false;
        }

        else  if (title.length > maxAdTitleLength) {
            errorSpan.text(adTitleExceedsMaxError);
            $(window).scrollTop(errorSpan.scrollTop());
            return false;
        }


        else {

            errorSpan.text("");
            return true;
        }

    }

    function isAdSubcategory(errorSpan , adCategory ) {
        categoryGroup = document.getElementById(adCategory.attr('id'));
        if(categoryGroup.options[categoryGroup.selectedIndex].value != ""){
            errorSpan.text("");
            return true;
        }
        else {
            errorSpan.text(adCategoryNotSelectedError);
            $(window).scrollTop(errorSpan.scrollTop());
            return false;
        }

    }

    function isAdDescription(errorSpan , description) {
        if(isEmptyField(description)) {
            errorSpan.text(emptyAdDescriptionError);
            $(window).scrollTop(errorSpan.scrollTop());
            return false;
        }

        else if (description.length < minAdDescriptionLength) {
            errorSpan.text(adDescriptionDeceedsMinError);
            $(window).scrollTop(errorSpan.scrollTop());
            return false;
        }

        else  if (description.length > maxAdDescriptionLength) {
            errorSpan.text(adDescriptionExceedsMaxError);
            $(window).scrollTop(errorSpan.scrollTop());
            return false;
        }


        else {
            errorSpan.text("");

            return true;
        }

    }

    function isProductAmount(errorSpan , amount) {

        if(contactForPrice.prop("checked")){
            errorSpan.text("");
            return true;
        }

        else if (isEmptyField(amount)){
            errorSpan.text(adAmountEmptyError);
            $(window).scrollTop(errorSpan.scrollTop());
            return false;
        }
        else if(!(isNaN(amount))){
            errorSpan.text("");
            return true;
        }


        else {
            errorSpan.text(adAmountContainsLettersError);
            $(window).scrollTop(errorSpan.scrollTop());
            return false;
        }


    }


adUploadImageForms.on('submit' , function (e) {
e.preventDefault();
e.stopPropagation();
e.stopImmediatePropagation();

    var currentForm = $(this);

    imageNumber = $(this).attr('data-ad-image-number');

    imageLabel = $('#image' + imageNumber +"-label");
    if(isAdImage(adImageError , 'image'+imageNumber , imageNumber  , imageLabel)){
        imageLabel.attr('title' , 'Change ad image ' + imageNumber);
        $('#ad-image-'+imageNumber+'-form-fieldset').prop('disabled' , true);

        uploadImageButtons.css('visibility' , 'hidden');
        $('#image-'+imageNumber+'-upload-button').css('visibility' , 'visible');
          formData = new FormData(document.getElementById($(this).attr('id')));

        formData.set("imageNumber" , currentForm.attr('data-ad-image-number'));
        formData.set('adID' , postAdForm.attr('data-ad-id'));


        request = new XMLHttpRequest();

        request.upload.addEventListener('progress' , function (ev) {
            $('.post-ad-progress').css('display' , 'block');
            ratioTimesHundred = (ev.loaded / ev.total) * 100;
            percentage = Math.round(ratioTimesHundred);
            progressDivs.css('display' , 'block');
            progressBar.css('width' , percentage + '%');
            progressReader.css('display' , 'initial');
            progressReader.text(percentage + '%');


        });


        request.upload.addEventListener('load' , function (ev) {
            progressDivs.css('display' , 'none');
            progressBar.css('width' , '0%');
            progressReader.css('display' , 'none');
            progressReader.text('');

        });


        request.addEventListener('readystatechange' , function (ev) {
            if(this.readyState == 4 && this.status == 200 && this.statusText == "OK"){

                console.log(request.response);
                response = JSON.parse(request.response);


                if(response.success == 1){
                    $('#ad-image-'+imageNumber+'-form-fieldset').prop('disabled' , false);
                    failureAlert.css("display" , "none");

                    successAlert.html(response.error);
                    successAlert.css("display" , "block");
                    $(window).scrollTop(successAlert.scrollTop());

                    setTimeout(function () {
                        $('#image-'+imageNumber+'-upload-button').css('visibility' , 'hidden');
                        $(window).scrollTop($(this).scrollTop());

                        successAlert.html('');
                        successAlert.css("display" , "none");


                    } , 3000);

                }
                else if(response.success == 0 ){
                    $('#ad-image-'+imageNumber+'-form-fieldset').prop('disabled' , false);
                    successAlert.css("display" , "none");
                    failureAlert.html(response.error);
                    failureAlert.css("display" , "block");
                }

            }

        });


        request.open('POST' , changeAdImageFile , true);

        request.setRequestHeader('Cache-control' , 'no-cache');
        request.send(formData);
    }

    else {

        uploadImageButtons.css('visibility' , 'hidden');

    }



});












    function changeSubcategory(categoryID , subcategoryID , categoryName  , categoryObject) {
        var defaultSchoolTitleAtrr = categoryName + " not selected";
        var carList = document.getElementById(categoryID);
        var modelList = document.getElementById(subcategoryID);
        var selCar = carList.options[carList.selectedIndex].value;
        while (modelList.options.length) {
            modelList.remove(0);
        }
        var cars = categoryObject[selCar];
        if (cars) {
            var i;
            for (i = 0; i < cars.length; i++) {
                var car = new Option(cars[i], i);
                modelList.options.add(car);
            }

            $('#' + subcategoryID).removeAttr("disabled title");
        }
        else {
            var option0 = new Option("---Choose a category---" , 0 , true);
            modelList.options.add(option0);

            $('#' + subcategoryID).attr({"disabled" : "disabled" , "title" : defaultSchoolTitleAtrr});
        }
    }

    $('.ad-image-fields').on('change' , function () {
        imageNumber = $(this).attr('data-image-number');
        imageLabel = $('#image' + imageNumber +"-label");
        if(isAdImage(adImageError , $(this).attr('id') ,imageNumber  , imageLabel)){
            imageLabel.attr('title' , 'Change ad image ' + imageNumber);
            $(this).attr('data-upload-new-image' , '1');


            uploadImageButtons.css('visibility' , 'hidden');
            $('#image-'+imageNumber+'-upload-button').css('visibility' , 'visible');




        }

        else {

            uploadImageButtons.css('visibility' , 'hidden');

        }



    });

    var isValidProductDetails = function () {
        var title = adTitle.val();
        var amount = adAmount.val();
        var description = adDescription.val();

        checkTitle = isAdTitle(title , adTitleError);
        checkCategory = isAdSubcategory(adCategoryError , adCategory);
        checkAmount = isProductAmount(adAmountError , amount);
        checkDescription = isAdDescription(adDescriptionError , description);

        return checkTitle && checkCategory && checkAmount && checkDescription && checkAmount;



    };
    function showNextStep(currentStep) {
        currentStep = Number(currentStep);
        nextStep = currentStep + 1;
        $('#ad-step-' + nextStep).addClass('active');
        $("#ad-step-" + currentStep).removeClass('active');
        $("#ad-step-" + nextStep).removeClass('disabled');
        $("#ad-step-" + currentStep).addClass('complete');

    }


    postAdForm.on('submit' , function (e) {

        e.stopImmediatePropagation();
        e.stopPropagation();
        e.preventDefault();

        if(isValidProductDetails()){

            formData = new FormData(document.getElementById(postAdForm.attr('id')));
            cat = document.getElementById(adCategory.attr('id'));
            subcat = document.getElementById(adSubCategory.attr('id'));
            cond = document.getElementById(productCondition.attr('id'));
            category = cat.options[cat.selectedIndex].value;
            subCategory = subcat.options[subcat.selectedIndex].text;
            condition = cond.options[cond.selectedIndex].text;
            description = adDescription.val();
            descriptionText = trim(description.replace(/\n\r?/g, '<br />'));
            formData.set('adCategory' , category);
            formData.set('adSubCategory' , subCategory);
            formData.set('adItemCondition' , condition);
            formData.set('adDescription' , descriptionText);
            formData.set('adPostedBy' , adPostedBy.val());
            formData.set('numUploadImages' , $(this).attr('data-num-upload-images'));
            formData.set('adID' , $(this).attr('data-ad-id'));


            if (contactForPrice.prop('checked')){
                formData.set('adAmount' , 'N/A');
                formData.set('adNegotiable' , '0');
                formData.set('contactForPrice' , '0');
            }
            else {
                formData.set('contactForPrice' , '1');
                if(adNegotiable.prop('checked')){
                    formData.set('adNegotiable' , '1');
                }
                else {
                    formData.set('adNegotiable' , '1');
                }
            }
            formFieldSet.prop("disabled" , true);
            request = new XMLHttpRequest();



            request.addEventListener('readystatechange' , function (ev) {
                if(this.readyState == 4 && this.status == 200 && this.statusText == "OK"){

                    response = JSON.parse(request.response);

                    if(response.success == 1){
                        failureAlert.css("display" , "none");

                        successAlert.html(response.error);
                        successAlert.css("display" , "block");
                        $(window).scrollTop(successAlert.scrollTop());
                        showNextStep(3);

                        setTimeout(function () {
                            window.location.href = "/ad/" + postAdForm.attr('data-ad-id');
                        } , 5000);

                    }
                    else if(response.success == 0 ){
                        successAlert.css("display" , "none");
                        failureAlert.html(response.error);
                        failureAlert.css("display" , "block");
                        formFieldSet.prop("disabled" , false);
                    }

                }

            });


            request.open('POST' , editAdFile , true);
            request.setRequestHeader('Cache-control' , 'no-cache');
            request.send(formData);
        }



    });


});