$(document).ready(function (){


    var minPhoneNumberLength = $('#signup-primary-phone').attr('minlength');
    var maxPhoneNumberLength = $('#signup-primary-phone').attr('maxlength');


    // Signup fields

    var signupLegend = $('#signup-legend');
    var signupForm = $('#signup-form');
    var signupUsername = $('#signup-username');
    var signupPrimaryPhoneNumber = $('#signup-primary-phone');
    var signupSecondaryPhoneNumber = $('#signup-secondary-phone');
    var signupEmail = $('#signup-email');
    var signupPassword  = $('#signup-password');
    var signupButton = $('#signup-button');
    var signupFieldSet = $('#signup-form-fieldset');
    var togglePasswordView = $('#toggle-password-view');
 //RegEx


// Button Texts

    var signupButtonTexts = $('.signup-button-texts');
    var signupLoadingIcon = $('#signup-loading-icon');
    var signupButtonText = $('#signup-button-text');

    // Success and failure ALerts

    var successAlert = $('#success-alert');
    var failureAlert = $('#failure-alert');





    function isUsername (username) {


        if (usernameRegEx.test(username)){
            if(username.length > maxUsernameLength) {
                signupUsernameError.text(usernameExceedsMaxError);
                return false;
            }
            else if(username.length < minUsernameLength) {
                signupUsernameError.text(usernameDeceedsMinError);
                return false;
            }
            else {
                signupUsernameError.text("");
                return true;
            }

        }

        else if (isEmptyField(username)){

            signupUsernameError.text(emptySignupUsernameError);
            return false;
        }

        else {

            signupUsernameError.text(invalidUsernameError);
            return false;
        }
    }

    function isPrimaryPhoneNumber(number) {

        if (phoneNumberRegEx.test(number)){
if(number.length > maxPhoneNumberLength) {
    signupPrimaryPhoneNumberError.text(primaryPhoneNumberExceedsMaxError);
    return false;
}
else if(number.length < minPhoneNumberLength) {
    signupPrimaryPhoneNumberError.text(primaryPhoneNumberDeceedsMinError);
    return false;
}
else {
    signupPrimaryPhoneNumberError.text("");
    return true;
}

        }

        else if (isEmptyField(number)){

            signupPrimaryPhoneNumberError.text(forgotPrimaryPhoneNumberError);
            return false;
        }

        else {

            signupPrimaryPhoneNumberError.text(invalidPhoneNumberError);
            return false;
        }
    }

    function isSecondaryPhoneNumber(number) {

        if(isEmptyField(number)) {
            signupSecondaryPhoneNumberError.text("");
            return true;
        }
        else if (signupPrimaryPhoneNumber.val() == signupSecondaryPhoneNumber.val()){
            signupSecondaryPhoneNumberError.text(secondaryPhoneIsPrimaryPhoneError);
            return false;

        }

        else if (phoneNumberRegEx.test(number)){
            if(number.length > maxPhoneNumberLength) {
                signupSecondaryPhoneNumberError.text(secondaryPhoneNumberExceedsMaxError);
                return false;
            }
            else if(number.length < minPhoneNumberLength) {
                signupSecondaryPhoneNumberError.text(secondaryPhoneNumberDeceedsMinError);
                return false;
            }
            else {
                signupSecondaryPhoneNumberError.text("");
                return true;
            }

        }

        else {

            signupSecondaryPhoneNumberError.text(invalidPhoneNumberError);
            return false;
        }



    }
    function isPassword(password){


        if(passwordRegEx.test(password)){
            signupPasswordError.text("");
            return true;
        }


        else if (isEmptyField(password)){
            signupPasswordError.text(emptySignupPasswordError);
            return false;
        }

        else if (password.length < minPasswordLength){

            signupPasswordError.text(signupPasswordDeceedsMinError);
            return false;
        }

        else if (password.length > maxPasswordLength){

            signupPasswordError.text(signupPasswordExceedsMaxError);
            return false;
        }



        else {
            signupPasswordError.text(signupPasswordError);
            return false;
        }



    }
// TooglePasswordView Controller
togglePasswordView.on('click' , function () {

  password = signupPassword.val();
  if(!isEmptyField(password)){
      currentView = togglePasswordView.attr('data-current-view');
      if (currentView == "password"){
          togglePasswordView.text("Hide password");
          signupPassword.attr("type" , "text");
          $(this).attr('data-current-view' , 'text');
      }
      else {
          togglePasswordView.text("Show password");
          signupPassword.attr("type" , "password");
          $(this).attr('data-current-view' , 'password');
      }

  }
});

    function isValidSignup() {
        username = signupUsername.val();
        primaryPhoneNumber = signupPrimaryPhoneNumber.val();
        secondaryPhoneNumber = signupSecondaryPhoneNumber.val();
        email = signupEmail.val();
        password = signupPassword.val();

        checkUsername = isUsername(username);
        checkPrimaryPhoneNumber = isPrimaryPhoneNumber(primaryPhoneNumber);
        checkSecondaryPhoneNumber = isSecondaryPhoneNumber(secondaryPhoneNumber);
        checkPassword = isPassword(password);

        return checkUsername && checkPrimaryPhoneNumber && checkSecondaryPhoneNumber && checkPassword;


    }


    signupForm.submit(function (e) {

        e.preventDefault();
        if (isValidSignup()) {

            username = signupUsername.val();
            primaryPhoneNumber = signupPrimaryPhoneNumber.val();
            secondaryPhoneNumber = signupSecondaryPhoneNumber.val();
            email = signupEmail.val();
            password = signupPassword.val();
            var data = {"username": username, "primaryPhoneNumber": primaryPhoneNumber, "secondaryPhoneNumber": secondaryPhoneNumber, "email": email , "password" : password};
            data = JSON.stringify(data);
            signupFieldSet.attr("disabled" , "disabled");
            signupButtonTexts.css("display" , "none");
            signupLoadingIcon.css("display" , "inline-block");
            signupLegend.hide();
            $.post(completeRegistrationFile, {data: data}).done(function (data, status) {
                console.log(data);
                data = JSON.parse(JSON.stringify(data));
                console.log(data);

                if(data.success == 1){
                    failureAlert.hide();
                    successAlert.html(data.error);
                    successAlert.show();
                    signupButtonText.text("Successful!");
                    signupLoadingIcon.hide();
                    signupButtonText.show();
                    $(window).scrollTop(successAlert.scrollTop());
                    togglePasswordView.on('click' , function(e){
                        e.preventDefault();
                    });

                    setTimeout(function () {

                        window.location.href  = "/profile";
                    } , 5000);

                }
                else if (data.success == 0) {

                    signupButtonText.show();
                    signupLoadingIcon.css('display' , 'none');
                    failureAlert.html(data.error);
                    failureAlert.show();
                    $(window).scrollTop(failureAlert.scrollTop());
                    signupFieldSet.removeAttr("disabled");

                }

            });

        }
    });



});