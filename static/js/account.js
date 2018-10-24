// Strict Mode Function Declared




$(document).ready(function () {

    //Sign up




    //Error messages for sign up


    // username and password length


    const minUsernameLength = 5; // jshint ignore:line
    const maxUsernameLength = 12; // jshint ignore:line
    const minPasswordLength = 5; // jshint ignore:line
    const maxPasswordLength = 18; // jshint ignore:line
    const minFirstNameLength = 2; // jshint ignore:line
    const maxFirstNameLength = 30; // jshint ignore:line
    const minLastNameLength = minFirstNameLength; // jshint ignore:line
    const maxLastNameLength =  maxFirstNameLength; // jshint ignore:line

    // Sign up Error messages


    var invalidEmailError = "invalid email address";
    var invalidUsernameError = "invalid username";
    var usernameExceedsMaxError = "username exceeds " + maxUsernameLength + " characters";
    var usernameDeceedsMaxError = "username must be less than " + minUsernameLength  + " characters";
    var firstNameError = "error in first name";
    var lastNameError = "error in last name";
    var passwordError = "invalid password combination";
    var passwordExceedsMaxError = "password exceeds " + maxPasswordLength + " characters";
    var passwordDeceedsMinError = "password is less than " + minPasswordLength +  " characters";
    var passwordMismatchError = "passwords do not match";
    var firstNameDeceedsMinError = "first name is less than " + minFirstNameLength +  " characters";
    var firstNameExceedsMaxError = "first name exceeds " + maxFirstNameLength +  " characters";
    var lastNameDeceedsMinError = "last name is less than " + minLastNameLength +  " characters";
    var lastNameExceedsMaxError = "first name exceeds " + maxLastNameLength +  " characters";
    var emptySignupEmaiError = "forgot email address";
    var emptySignupFirstNameError = "forgot to fill first name";
    var emptySignupLastNameError = "forgot to fill last name";
    var emptySignupPasswordError = "forgot password field";
    var emptySignupPasswordAgainError = "must fill password again"
    var failedAcceptanceError = "you must agree to our terms of usage";
    var emptyUsernameError = "forgot to enter your username or email";
    //Error messages id



    var signupEmailError = $('#signup-email-error');
    var signupFirstNameError = $('#signup-first-name-error');
    var signupLastNameError = $('#signup-last-name-error');
    var signupPasswordError = $('#signup-password-error');
    var signupPasswordAgainError = $('#signup-password-again-error');
    var signupAcceptanceError = $('#signup-acceptance-error');

    //


   // Signup fields
    var signupForm = $('#signupform');
    var signupEmail = $('#signup-email');
    var signupFirstName = $('#signup-first-name');
    var signupLastName = $('#signup-last-name');
    var signupPassword  = $('#signup-password');
    var signupPasswordAgain = $('#signup-password-again');
    var signupButton = $('#btn-signup');
    var signupAcceptanceCheckBox = $('#signup-acceptance-checkbox');
    var signupFieldSet = $('#signup-form-fieldset');








    //  Signup loading icon

    var signupLoadingIcon = $('#signup-loading-icon');



    // Signup button  text

    var signupButtonText = $('#signup-button-text');

    // Alert


    var successAlert = $('#success-alert');
    var failureAlert = $('#failure-alert');
    var alerts = $('.alerts');

// Signup Validations





    function isEmail (email) {
        
        if (emailRegEx.test(email)){
            signupEmailError.text("");
             return true;
        }

        else if (isEmptyField(email)){
            signupEmailError.text(emptySignupEmailError);
        }
        
        else {
            signupEmailError.text(invalidEmailError);
            return false;
        }
        
    }
    
    
    function  isFirstName(firstName) {
        if(firstNameRegEx.test(firstName)){
            signupFirstNameError.text("");
            return true;
        }

        else if (isEmptyField(firstName)){
            signupFirstNameError.text(emptySignupFirstNameError);
        }
        else if (firstName.length < minFirstNameLength){

            signupFirstNameError.text(firstNameDeceedsMinError);
        }

        else if (firstName.length > maxFirstNameLength){
                 signupFirstNameError.text(firstNameExceedsMaxError);
        }

        else {
            signupFirstNameError.text(firstNameError);
            return false;
        }


    }


    function  isLastName(lastName) {

        if(lastNameRegEx.test(lastName)){
             signupLastNameError.text("");
            return true;
        }


        else if (isEmptyField(lastName)){
            signupLastNameError.text(emptySignupLastNameError);
        }

        else if (lastName.length < minLastNameLength){

            signupLastNameError.text(lastNameDeceedsMinError);
        }

        else if (lastName.length > maxLastNameLength){

            signupLastNameError.text(lastNameExceedsMaxError);
        }

        
        
        else {
            signupLastNameError.text(lastNameError);
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

            signupPasswordError.text(passwordDeceedsMinError);
            return false;
        }

        else if (password.length > maxPasswordLength){

            signupPasswordError.text(passwordExceedsMaxError);
            return false;
        }



        else {
            signupPasswordError.text(passwordError);
            return false;
        }



    }


    function isPasswordAgain(firstPassword , secondPassword){

        if(isPassword(firstPassword) && (firstPassword == secondPassword)){
            signupPasswordAgainError.text("");
            return true;

        }
        else if (isEmptyField(secondPassword)){

         signupPasswordAgainError.text(emptySignupPasswordAgainError);
         return false;
        }

        else if (isPassword(firstPassword) && (firstPassword != secondPassword) ){

            signupPasswordAgainError.text(passwordMismatchError);
            return false;

        }

        else {

            return false;
        }


    }

    function isTermsAccepted (){

        if (signupAcceptanceCheckBox.prop('checked')){
            signupAcceptanceError.text("");
            return true;
        }
        else {
            signupAcceptanceError.text(failedAcceptanceError);
            return false;

        }
    }



// Main Signup Function


    function isValidSignup() {
        email = signupEmail.val();
        firstName = signupFirstName.val();
        lastName = signupLastName.val();
        password = signupPassword.val();
        passwordAgain = signupPasswordAgain.val();

        checkEmail = isEmail(email);
        checkFirstName = isFirstName(firstName);
        checkLastName = isLastName(lastName);
        checkPassword = isPassword(password);
        checkPasswordAgain = isPasswordAgain(password , passwordAgain);
        checkTerms = isTermsAccepted();

        return checkEmail && checkFirstName && checkLastName && checkPassword && checkPasswordAgain && checkTerms;


    }



    //  Actual signup Process



     signupForm.submit(function(e){

         e.preventDefault();
         if(isValidSignup()){
             signupFieldSet.attr("disabled" , "disabled");
             email = signupEmail.val().toLowerCase();
             firstName = signupFirstName.val();
             lastName = signupLastName.val();
             password = signupPassword.val();

             var data = {"email": email, "firstname": firstName, "lastname": lastName, "password": password};
             data = JSON.stringify(data);
             signupButtonText.hide();
             signupLoadingIcon.css('display' , 'inline-block');
             $.post(sendVerificationEmailFile , {data : data}).done(function (data , status) {
                  data = JSON.parse(JSON.stringify(data));
                 if(data.success == 1) {
                 failureAlert.hide();
               successAlert.html(data.error);
               successAlert.show();
               signupButtonText.text("email link sent");
               signupLoadingIcon.hide();
               signupButtonText.show();
               $(window).scrollTop(successAlert.scrollTop());
               setTimeout(function () {
                   window.location.href = "/profile";
                     } ,  2000)
                 }



             else if (data.success == 0){
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
            data = {'username' : username , 'password' : password , 'loginType' : loginType , 'rememberMe' : rememberMeBool};
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