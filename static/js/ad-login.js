$(document).ready(function() {


    //   Login


    loginForm = $('#loginform');
    loginUsername = $('#login-username');
    loginPassword = $('#login-password');
    loginFieldSet = $('#login-fieldset');
    rememberMe = $('#remember-me');



    //Login Errors

    loginUsernameError = $('#login-username-error');
    loginPasswordError = $('#login-password-error');


    var loginType;

    //

    function  isUsername(username) {
        if (usernameRegEx.test(username)){
            if(username.length > maxUsernameLength) {
                loginUsernameError.text(usernameExceedsMaxError);
                return false;
            }
            else if(username.length < minUsernameLength) {
                loginUsernameError.text(usernameDeceedsMinError);
                return false;
            }
            else {
                loginUsernameError.text("");
                loginType = "username";
                return true;
            }

        }

        else if (isEmptyField(username)){

            loginUsernameError.text(emptyUsernameError);
            return false;
        }

        else if(emailRegEx.test(username)){
            loginUsernameError.text("");
            loginType = "email";
            return true;

        }

        else {

            loginUsernameError.text(invalidUsernameError);
            return false;
        }

    }


    function isLoginPassword(password){


        if(passwordRegEx.test(password)){
            loginPasswordError.text("");
            return true;
        }


        else if (isEmptyField(password)){
            loginPasswordError.text(emptySignupPasswordError);
            return false;
        }

        else if (password.length < minPasswordLength){

            loginPasswordError.text(passwordDeceedsMinError);
            return false;
        }

        else if (password.length > maxPasswordLength){

            loginPasswordError.text(passwordExceedsMaxError);
            return false;
        }



        else {
            loginPasswordError.text(passwordError);
            return false;
        }



    }

    function isValidLogin() {
        var username = loginUsername.val();
        var password = loginPassword.val();

        checkUsername = isUsername(username);
        checkPassword = isLoginPassword(password);

        return checkUsername && checkPassword;
    }

    loginForm.on('submit' , function (e) {


        e.preventDefault();


        if(isValidLogin()) {
            username = loginUsername.val();
            password = loginPassword.val();
            loginFieldSet.attr('disabled' , 'disabled');
            rememberMeBool = rememberMe.prop('checked');
            data = {'username' : trim(username) , 'password' : trim(password) , 'loginType' : loginType , 'rememberMe' : rememberMeBool};
            data = JSON.stringify(data);
            $.post(loginFile , {'data' : data}).done(function (data , status) {

                data = JSON.parse(JSON.stringify(data));
                if(data.success == 1) {
                    failureAlert.hide();
                    successAlert.html(data.error);
                    successAlert.show();

                    $(window).scrollTop(successAlert.scrollTop());
                    setTimeout(function () {
                        window.location.href = "/profile";
                    } ,  2000)

                }



                else if (data.success == 0){
                    signupButtonText.show();
                    failureAlert.html(data.error);
                    failureAlert.show();
                    $(window).scrollTop(failureAlert.scrollTop());
                    loginFieldSet.removeAttr("disabled");


                }

            });
        }
    });

});