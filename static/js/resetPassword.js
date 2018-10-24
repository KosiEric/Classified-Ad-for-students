$(document).ready(function () {

// For account Recovery

    var accountRecoveryForm = $('#account-recovery-form');

    var invalidEmailError = "email address not valid";
    var emptyEmailAddressError = "forgot email address";

    var recoveryEmailError = $('#email-error');
    var recoverLoadingIcon = $('#recover-loading-icon');
    var recoverText = $('#signup-button-text');
    var accountRecoveryEmail = $('#email');
    var successAlert = $('#success-alert');
    var failureAlert = $('#failure-alert');
    var recoverButtonText = $('#signup-button-text');
    var recoverFieldset = $('#recover-fieldset');




    function isEmail (email) {

        if (emailRegEx.test(email)){
            recoveryEmailError.text("");
            return true;
        }

        else if (isEmptyField(email)){
            recoveryEmailError.text(emptySignupEmailError);
        }

        else {
            recoveryEmailError.text(invalidEmailError);
            return false;
        }

    }

    accountRecoveryForm.on('submit' , function (e) {
        failureAlert.hide();
        e.preventDefault();
        var email = accountRecoveryEmail.val();
        if(isEmail(email)){

        var data = {"email" : email.toLowerCase()};
        data = JSON.stringify(data);

            recoverButtonText.hide();
            recoverLoadingIcon.css("display" , "inline-block");
            recoverFieldset.attr("disabled" , "disabled");
            $.post(accountRecoveryFile , {data : data}).done(function (data , status) {


                console.log(data);
                data = JSON.parse(JSON.stringify(data));



                 if(data.success == 1){
                    failureAlert.hide();
                    successAlert.html(data.error);
                    successAlert.show();
                    recoverButtonText.text("reset link sent");
                    recoverLoadingIcon.hide();
                    recoverButtonText.show();
                    $(window).scrollTop(successAlert.scrollTop());

                    setTimeout(function () {

                        window.location.href  = "/";
                    } , 5000);

                }
                else if (data.success == 0) {

                    recoverButtonText.show();
                    recoverLoadingIcon.css('display' , 'none');
                    failureAlert.html(data.error);
                    failureAlert.show();
                    $(window).scrollTop(failureAlert.scrollTop());
                    recoverFieldset.removeAttr('disabled');

                }

            });

            }

    });



    //  Reset Password for a specific user



    function isPassword(password){


        if(passwordRegEx.test(password)){
            passwordError.text("");
            return true;
        }


        else if (isEmptyField(password)){
            passwordError.text(emptySignupPasswordError);
            return false;
        }

        else if (password.length < minPasswordLength){

            passwordError.text(passwordDeceedsMinError);
            return false;
        }

        else if (password.length > maxPasswordLength){

            passwordError.text(passwordExceedsMaxError);
            return false;
        }



        else {
            passwordError.text(passwordError);
            return false;
        }



    }


    function isPasswordAgain(firstPassword , secondPassword){

        if(isPassword(firstPassword) && (firstPassword == secondPassword)){
            passwordAgainError.text("");
            return true;

        }
        else if (isEmptyField(secondPassword)){

            passwordAgainError.text(emptySignupPasswordAgainError);
            return false;
        }

        else if (isPassword(firstPassword) && (firstPassword != secondPassword) ){

            passwordAgainError.text(passwordMismatchError);
            return false;

        }

        else {

            return false;
        }


    }


    function isValidPassword() {

        password = passwordField.val();
        passwordAgain = passwordAgainField.val();

        isPasswordCheck = isPassword(password);
        isPasswordAgainCheck = isPasswordAgain(password , passwordAgain);

        return isPasswordCheck && isPasswordAgainCheck;
    }

    if(resetPasswordForUser){

        var passwordField = $('#password');
        var passwordAgainField = $('#password-again');
        var passwordError = $('#password-error');
        var passwordAgainError = $('#password-again-error');
        var passwordResetForm = $('#password-reset-form');
        var passwordResetIcon = $('#reset-loading-icon');
        var resetButtonText = $('#reset-button-text');
        var resetFieldSet = $('#reset-fieldset');
        var emailField = $('#email');
        var password = passwordField.val();
        passwordResetForm.on('submit' , function (e) {
            e.preventDefault()
            if(isValidPassword()){
                var data = {"userID" : emailField.attr('data-user-id') , "password" : password};
                data = JSON.stringify(data);

                resetButtonText.hide();
                passwordResetIcon.css("display" , "inline-block");
                resetFieldSet.attr("disabled" , "disabled");
                $.post(passwordResetFile , {data : data}).done(function (data , status) {


                    console.log(data);
                    data = JSON.parse(JSON.stringify(data));



                    if(data.success == 1){
                        failureAlert.hide();
                        successAlert.html(data.error);
                        successAlert.show();
                        resetButtonText.text("password changed!");
                        passwordResetIcon.hide();
                        resetButtonText.show();
                        $(window).scrollTop(successAlert.scrollTop());

                        setTimeout(function () {

                            window.location.href  = "/account";
                        } , 5000);

                    }
                    else if (data.success == 0) {

                        resetButtonText.show();
                        passwordResetIcon.css('display' , 'none');
                        failureAlert.html(data.error);
                        failureAlert.show();
                        $(window).scrollTop(failureAlert.scrollTop());
                        resetFieldSet.removeAttr('disabled');

                    }
            });

        }





    });

    }

});

