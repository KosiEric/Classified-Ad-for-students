$(document).ready(function () {
    // The function below checks if the user had previously posted an ad on the platform, hence , no need for new registration

/* Button that submits contact information */       var sellerInformationSubmitButton = $('#seller-information-submit-button');
var adSubmitButton = $('#ad-information-submit-button');
/* Button that creates new user account */          var newSignupButton = $('#new-signup-button');
/* Login Container */                               var loginBox = $('#loginbox');
/* This Button logs the user in*/                   var loginButton = $('#login-button');
/* Div that contains Seller Information Fields */   var sellerInformationContainer = $('#seller-information');

//Handle Logins
    var loginUsername = $('#login-username');
    var loginPhone = $('#login-phone');
    var adPostedBy = $('#ad-posted-by');
    var contactState , contactSchool;
   
    newSignupButton.on('click' , function (e) {

        showNextForm(2);
        showNextStep(1);
    });



    $('#1st-back-button').on('click' , function () {

        showPreviousForm(1);
        showPreviousStep(1);
    });

    $('.steps-buttons').on('click' , function (e) {
       if($(this).attr('id') != sellerInformationSubmitButton.attr('id') && $(this).attr('id') != adSubmitButton.attr('id')){
           e.preventDefault();
       }
    });

    loginButton.on('click' , function () {
       loginForm.submit();
    });
    var loginForm = $('#loginform');
    var loginFormFieldSet = $('#login-fieldset');
    var firstBackButton = $('#1st-back-button');



    function isValidLoginDetails () {

        username = loginUsername.val();
        phone = loginPhone.val();


        var checkUsername = isUsername(username , loginUsernameError);
        var checkPhone = isPrimaryContact(phone , loginPhoneError);

        return checkUsername && checkPhone;

    }
    //08028563812

    var loginUsernameError = $('#login-username-error');
    var loginPhoneError = $('#login-phone-error');

    loginForm.on('submit' , function (e) {
        e.preventDefault();
        e.stopPropagation();
        if(isValidLoginDetails()){
            loginFormFieldSet.attr('disabled' , 'disabled')
            var data = {'username' : loginUsername.val() , 'phone' : loginPhone.val()}
            data = JSON.stringify(data);
            $.post(newLoginFile , {data : data}).done(function (data , status){
                data = JSON.parse(JSON.stringify(data));

                if(data.success == 1) {
                    showNextForm(2);
                    showNextStep(1);
                    failureALert.fadeOut('slow');
                    contactUsername.val(data.profile.username)
                    contactName.val(data.profile.full_name);
                    contactEmail.val(data.profile.email_address);
                    primaryContact.val(data.profile.primary_phone);
                    contactState.val(data.profile.state);
                    changeUniversity(contactState.attr('id') , contactSchool.attr('id') , data.profile.school);
                    
                    
                    adPostedBy.val(data.profile.user_id);
                    if(!isNaN(data.profile.secondary_phone)) {

                    secondaryContact.val(data.profile.secondary_phone);
                }
                    loginFormFieldSet.removeAttr('disabled');
                    contactProfile.prop('required' , false);
                    profileLabelDiv.css('background-image' , "url(" + profileUploadDir + data.profile.profile +")");
                    profileLabelDiv.attr('title' , 'Change profile');
                    sellerInformationSubmitButton.attr('data-action' , 'update');
                }
                else {
                    failureALert.html(data.error);
                    failureALert.fadeIn('slow');
                    $(window).scrollTop(failureALert.scrollTop());

                    loginFormFieldSet.removeAttr('disabled');

                }
            });
        }
    });


    function showNextForm(nextStep) {

        $('.form-steps.hideable-forms').css('display' , 'none');

        $(".form-step-"+nextStep+".hideable-forms").css('display' , 'block');
    }

    function showPreviousForm(previousStep){
        $('.form-steps.hideable-forms').css('display' , 'none');

        $(".form-step-"+previousStep+".hideable-forms").css('display' , 'block');
    }


function showPreviousStep(step){
    step = Number(step);
    currentStep = step + 1;
    $('#ad-step-' + currentStep).removeClass('active');
    $('#ad-step-' + currentStep).addClass('disabled')

    $('#ad-step-' + step).removeClass('complete');

    $('#ad-step-' + step).addClass('active');

}
function showNextStep(currentStep) {
        currentStep = Number(currentStep);
        nextStep = currentStep + 1;
    $('#ad-step-' + nextStep).addClass('active');
    $("#ad-step-" + currentStep).removeClass('active');
    $("#ad-step-" + nextStep).removeClass('disabled');
    $("#ad-step-" + currentStep).addClass('complete');

}






    // Signup and Update Seller Information


    var contactName = $('#contact-fullname');
    var contactEmail = $('#contact-email');
    var primaryContact = $('#contact-primary-phone');
    var secondaryContact = $('#contact-secondary-phone');
    contactState = $('#contact-select-state');
    contactSchool = $('#contact-select-school');
    var contactUsername = $('#account-username');
    var action = sellerInformationSubmitButton.attr('data-action');
    var contactProfile = $('#profile-image');
    var sellerInformationForm = $('#seller-information-form');
    var profileLabelDiv = $('#profile-label-container');
    var sellerInformationFieldSet = $('#seller-information-fieldset');
    var profileUploadProgress = $('#profile-upload-progress');
    var profileUploadProgressPercent = $('#profile-upload-progress-percent');
    var profileUploadProgressClass = $('.profile-upload-progress');
    var nextAccountLoadingIcon = $('#next-account-loading-icon');
    var sellerNextEnclosingSpan = $('#seller-next-enclosing-span');


    // Error spans


    var contactNameError = $('#contact-fullname-error');
    var contactEmailError = $('#contact-email-error');
    var primaryContactError = $('#primary-contact-error');
    var secondaryContactError = $('#secondary-contact-error');
    var contactStateError = $('#contact-state-error');
    var contactSchoolError = $('#contact-school-error');
    var contactUsernameError = $('#contact-username-error');
    var contactProfileError = $('#contact-profile-error');
    var successALert = $('#success-alert');
    var failureALert = $('#failure-alert');


    function  isFullName(name , errorSpan) {

        if(fullnameRegEx.test(name)){
            errorSpan.text("");
            return true;
        }


        else if (isEmptyField(name)){
            errorSpan.text(emptyFullNameError);
            $(window).scrollTop(errorSpan.scrollTop());
            return false;
        }

        else if (name.length < minFullNameLength){

            errorSpan.text(fullNameDeceedsMinError);
            $(window).scrollTop(errorSpan.scrollTop());
            return false;
        }

        else if (name.length > maxFirstNameLength){

            errorSpan.text(fullNameExceedsMaxError);
            $(window).scrollTop(errorSpan.scrollTop());
            return false;
        }



        else {
            errorSpan.text(fullNameCharacterError);
            $(window).scrollTop(errorSpan.scrollTop());
            return false;
        }


    }
    
    function isEmail(email , errorSpan){


        if (emailRegEx.test(email)){
            errorSpan.text("");
            return true;
        }

        else if (isEmptyField(email)){
            errorSpan.text(emptySignupEmailError);
            $(window).scrollTop(errorSpan.scrollTop());
            return false;
        }

        else {
            errorSpan.text(invalidEmailError);
            $(window).scrollTop(errorSpan.scrollTop());
            return false;
        }

    }
    

    function isSecondaryContact(number , errorSpan , primaryPhone){

        if(isEmptyField(number)) {
            errorSpan.text("");
            return true;
        }
        else if (primaryPhone == number){
            errorSpan.text(secondaryPhoneIsPrimaryPhoneError);
            $(window).scrollTop(errorSpan.scrollTop());
            return false;

        }

        else if (phoneNumberRegEx.test(number)){


        
                errorSpan.text("");
                return true;


        }
        else if(number.length < minPhoneNumberLength) {
            errorSpan.text(secondaryPhoneNumberDeceedsMinError);
            $(window).scrollTop(errorSpan.scrollTop());
            return false;
        }

        else if(number.length > maxPhoneNumberLength) {
            errorSpan.text(secondaryPhoneNumberExceedsMaxError);
            $(window).scrollTop(errorSpan.scrollTop());
            return false;
        }

        else {

            errorSpan.text(invalidPhoneNumberError);
            $(window).scrollTop(errorSpan.scrollTop());
            return false;
        }
    }
    
    function  isUsername(username , errorSpan) {
        if (usernameRegEx.test(username)) {


                errorSpan.text("");
                return true;



        }

        else if(isEmptyField(username)) {
            errorSpan.text(emptyUsernameError);
            $(window).scrollTop(errorSpan.scrollTop());
            return false;
        }

        else if (username.length < minUsernameLength) {
            errorSpan.text(usernameDeceedsMinError);
            $(window).scrollTop(errorSpan.scrollTop());
            return false;
        }

       else  if (username.length > maxUsernameLength) {
            errorSpan.text(usernameExceedsMaxError);
            $(window).scrollTop(errorSpan.scrollTop());
            return false;
        }


        else {
            errorSpan.text(usernameError);
            $(window).scrollTop(errorSpan.scrollTop());
            return false;
        }


    }

    function isState(state , errorSpan) {
        var stateID = state.attr("id");
        state = document.getElementById(stateID);
        var stateValue = document.getElementById(stateID).options[state.selectedIndex].value;
        if(stateValue == 0) {
            errorSpan.text(stateNotSelectedError);
            return false;
        }
        else {
            errorSpan.text("");
            return true;
        }
    }

    var userNameWarningShown  = false;



    function isSchool(schoolField , errorSpan) {
        var schoolID = schoolField.attr("id");
        school = document.getElementById(schoolID);
        var schoolValue = document.getElementById(schoolID).options[school.selectedIndex].text;

        if(schoolValue == "Select your school" || schoolValue == ""){
            errorSpan.text(schoolNotSelectedError);
            $(window).scrollTop(errorSpan.scrollTop());
            return false;
        }
        else{
            errorSpan.text("");
            return true;
        }
    }

   function isProfileImage (errorSpan) {
if(document.getElementById(contactProfile.attr("id")).value == ""){
    errorSpan.text(profileImageNotSelectedError);
    return false;
}
            var imageValidator = new validateImages(contactProfile.attr("id") , maxProfileImageSize * 1000000);
            if(imageValidator.isImageFileSize()){
                if(imageValidator.isImageFileType()){
                    errorSpan.text("");
                    var reader = new FileReader();

                    reader.onload = function (e) {
                        profileLabelDiv.css("background-image"  ,  "url("+e.target.result+")");
                    }

                    reader.readAsDataURL(document.getElementById(contactProfile.attr("id")).files[0]);
                    return true;
                }
                else {
                    errorSpan.text(profileImageFormatError);
                    profileLabelDiv.css("background-image" , "url()");
                    return false;
                }
            }
            else {
                errorSpan.text(profileImageExceedsMaxError);
                return false;
            }


   }

   contactProfile.on('change' , function () {
       isProfileImage(contactProfileError);
       $(this).attr('data-upload-image' , 'true');
   });





    function  isUsername(username , errorSpan) {
        if (usernameRegEx.test(username)) {


            errorSpan.text("");
            return true;



        }

        else if(isEmptyField(username)) {
            errorSpan.text(emptyUsernameError);
            $(window).scrollTop(errorSpan.scrollTop());
            return false;
        }

        else if (username.length < minUsernameLength) {
            errorSpan.text(usernameDeceedsMinError);
            $(window).scrollTop(errorSpan.scrollTop());
            return false;
        }

        else  if (username.length > maxUsernameLength) {
            errorSpan.text(usernameExceedsMaxError);
            $(window).scrollTop(errorSpan.scrollTop());
            return false;
        }


        else {
            errorSpan.text(usernameError);
            $(window).scrollTop(errorSpan.scrollTop());
            return false;
        }


    }

    function  isPrimaryContact(number , errorSpan) {


        if (phoneNumberRegEx.test(number)){



            errorSpan.text("");
            return true;


        }


        else if (isEmptyField(number)){

            errorSpan.text(forgotPrimaryPhoneNumberError);
            $(window).scrollTop(errorSpan.scrollTop());
            return false;
        }
        else if(number.length < minPhoneNumberLength) {
            errorSpan.text(primaryPhoneNumberDeceedsMinError);
            $(window).scrollTop(errorSpan.scrollTop());
            return false;
        }

        if(number.length > maxPhoneNumberLength) {
            errorSpan.text(primaryPhoneNumberExceedsMaxError);
            $(window).scrollTop(errorSpan.scrollTop());
            return false;
        }

        else {

            errorSpan.text(invalidPhoneNumberError);
            $(window).scrollTop(errorSpan.scrollTop());
            return false;
        }


    }

    function tryShowWarnings() {

        this.isSupportedBrowser = function () {

            var objects = [FileReader , XMLHttpRequest , FormData , Blob];
            for (i = 0; i < objects.length; i++){
                if(typeof  objects[i] != "function"){
                    $('#warning-modal').modal('toggle');
                    return false;
                }
                else {
                    return true;
                }

            }


        }

        this.showUsernameProtectectionWarning = function () {
            if(userNameWarningShown == false){
                $('.modal-title').text("Username Protection")
                $('.modal-body').html("<p>Please note that your username must be kept secret.</p>\n" +
                    "                <p>hence, do not share it with anyone.</p>")
                $('#warning-modal').modal('show');
                userNameWarningShown = true;

            }

        }




    }

    var changeModalBoxMessage = function (showModalBox , title , msg) {
        $('.modal-title').text(title);
        $('.modal-body').html(msg);
        if(showModalBox == true) {
            $('#warning-modal').modal('show');
        }



    }
   var warnings = new tryShowWarnings()
    warnings.isSupportedBrowser();



    function isValidSellerInformation() {
        fullname = contactName.val();
        email = contactEmail.val();
        primaryPhone = primaryContact.val();
        secondaryPhone = secondaryContact.val();
        username = contactUsername.val();

        checkFullName = isFullName(fullname , contactNameError);
        checkEmail = isEmail(email , contactEmailError);
        checkPrimaryPhoneNumber = isPrimaryContact(primaryPhone , primaryContactError);
        checkSecondaryPhoneNumber = isSecondaryContact(secondaryPhone , secondaryContactError , primaryPhone);
        checkUsername = isUsername(username , contactUsernameError);
        checkState = isState(contactState , contactStateError);
        checkSchool = isSchool(contactSchool , contactSchoolError);
         return checkFullName && checkEmail && checkPrimaryPhoneNumber && checkSecondaryPhoneNumber && checkUsername && checkState
            && checkSchool;



    }
    sellerInformationForm.on('submit' , function (e) {


     //  e.stopImmediatePropagation();
e.stopPropagation();
       e.preventDefault();

        if(isValidSellerInformation()) {
            checkUsernameWarning = warnings.showUsernameProtectectionWarning();
            if (!warnings.isSupportedBrowser())
                return false;
            var formData = new FormData(document.getElementById(sellerInformationForm.attr('id')));

            var name = trim(contactName.val());
            var email = contactEmail.val();
            var primary = primaryContact.val();
            var secondary = secondaryContact.val();
            var state = contactState.find(":selected").text();
            var school = contactSchool.find(":selected").text();
            var profile = document.getElementById(contactProfile.attr("id")).files[0];
            var username = contactUsername.val();
            var formAction= sellerInformationSubmitButton.attr("data-action");

     $('.alerts').css('display' , 'none');



            formData.set("school", school);
            formData.set("name", name);
            formData.append("uploadImage" , "false");
            //formData.append("uploadImage" , "true");


            var request = new XMLHttpRequest();

if(formAction == "signup"){
if( !isProfileImage(contactProfileError)){

return false;
}
    sellerNextEnclosingSpan.css('display', 'none');
    nextAccountLoadingIcon.css('display', 'block');

    request.upload.addEventListener('progress', function (ev) {
                if (ev.lengthComputable) {
                    profileUploadProgressClass.css('display', 'block');

                    var percent = Math.round(ev.loaded / ev.total) * 100;
                    profileUploadProgress.attr('value', percent);
                    profileUploadProgressPercent.text(percent + '%');
                    }
            });

            request.upload.addEventListener('load', function (ev) {
                profileUploadProgressClass.css('display', 'none');
                profileUploadProgress.attr('value', '0');
                profileUploadProgressPercent.text('0%');


            });

request.onreadystatechange = function (ev) {

    if(this.status == 200 && this.readyState == 4){
        response = JSON.parse(request.response);




        if (response.success == 0) {

            successALert.css("display", "none");
            failureALert.html(response.error);
            failureALert.css("display", "block");
            sellerInformationFieldSet.prop('disabled' , false);
            $(window).scrollTop(failureALert.scrollTop());
            nextAccountLoadingIcon.css('display', 'none');
            sellerNextEnclosingSpan.css('display', 'inline-block');
        }

        else if (response.success == 1){

            nextAccountLoadingIcon.css('display', 'none');
            sellerNextEnclosingSpan.css('display', 'inline-block');

            successALert.html(response.error);
            $(window).scrollTop(successALert.scrollTop());
            //  changeModalBoxMessage(true, "Account created successfully", "Click on Next to post your Ad");
            if(window.location.pathname == postAdPage) {




                sellerInformationSubmitButton.attr('data-action', 'update');

            showNextForm(3);
            showNextStep(2);
            sellerInformationFieldSet.prop("disabled" , false);
            successALert.css("display" , "none");
            successALert.html("");
            adPostedBy.val(response.user_id);
        }

        else {

                window.location.href = '/';
            }

            }


    }

}


            request.open("POST", userInformationFile, true);
            request.setRequestHeader("Cache-control", "no-cache");
            request.send(formData);


        }

        else if(formAction == "update"){

    sellerNextEnclosingSpan.css('display', 'none');
    nextAccountLoadingIcon.css('display', 'block');

    if(contactProfile.attr('data-upload-image') == "true" && isProfileImage(contactProfileError)){
        formData.set("uploadImage" , "true");
        request.upload.addEventListener('progress', function (ev) {


            if (ev.lengthComputable) {
                profileUploadProgressClass.css('display', 'block');

                var percent = Math.round(ev.loaded / ev.total) * 100;
                profileUploadProgress.attr('value', percent);
                profileUploadProgressPercent.text(percent + '%');

            }

        });

        request.upload.addEventListener('load', function (ev) {
            profileUploadProgressClass.css('display', 'none');
            profileUploadProgress.attr('value', '0');
            profileUploadProgressPercent.text('0%');


        });


    }
      else {formData.append("uploadImage" , "false");
    }

    request.onreadystatechange = function (ev) {



        if (this.status == 200 && this.readyState == 4) {
                response = JSON.parse(request.response);



            failureALert.css("display", "none");
            successALert.css("display", "block");
            if (response.success == 0) {
                failureALert.html(response.error);
                failureALert.css("display", "block");
                sellerInformationFieldSet.prop('disabled' , false);
                $(window).scrollTop(failureALert.scrollTop());
            }

            else if (response.success == 1){
                nextAccountLoadingIcon.css('display', 'none');
                sellerNextEnclosingSpan.css('display', 'inline-block');

                successALert.html(response.error);
                $(window).scrollTop(successALert.scrollTop());
                //  changeModalBoxMessage(true, "Account created successfully", "Click on Next to post your Ad");


                  sellerInformationSubmitButton.attr('data-action', 'update');


                  showNextForm(3);
                  showNextStep(2);
                  sellerInformationFieldSet.prop("disabled", false);
                  successALert.css("display", "none");
                  successALert.html("");


              }


        }


    }

    request.open("POST", updateProfileFile, true);
    request.setRequestHeader("Cache-control", "no-cache");
    request.send(formData);


}



               }

    });

 //  showNextStep(2);
 // showNextForm(3);
    var secondBackButton = $('#2nd-back-button');
    secondBackButton.on('click' , function () {

       showPreviousForm(2);
       showPreviousStep(2);
         });

});

function changeUniversity(stateID , schoolID , newSchoolOptionValue = "") {
    var defaultSchoolTitleAtrr = "State not selected";
    var carList = document.getElementById(stateID);
    var modelList = document.getElementById(schoolID);
    var selCar = carList.options[carList.selectedIndex].value;
    while (modelList.options.length) {
        modelList.remove(0);
    }
    var cars = carsAndModels[selCar];
    if (cars) {
        var i;
        for (i = 0; i < cars.length; i++) {
        	var car = new Option(cars[i], i);
            modelList.options.add(car);
            if(newSchoolOptionValue != "" && cars[i] == newSchoolOptionValue){
        		console.log(newSchoolOptionValue);
        	
        		car.setAttribute('selected' , 'selected');
            
            }
            
        
        }

        $('#' + schoolID).removeAttr("disabled title");
    }
    else {
        var option0 = new Option("---Choose your state---" , 0 , true);
        modelList.options.add(option0);

        $('#' + schoolID).attr({"disabled" : "disabled" , "title" : defaultSchoolTitleAtrr});
    }
}



