$(document).ready(function () {

    var accountRecoveryForm = $('#user-forgot-account-form');
    var forgotAccountFieldset = $('#forgot-account-fieldset');
    var forgotAccountEmailError = $('#forgot-accont-email-error');
    var email = $('#account-recovery-email');
   var loadingIcon  = $('#forgot-account-loading-icon');
   var buttonText = $('#button-text');
   var emailSendError =  $('#email-send-error');
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


    accountRecoveryForm.on('submit' , function (e) {

      e.preventDefault();
      e.stopPropagation();

        if(isEmail(email.val() , forgotAccountEmailError)){
loadingIcon.css('display' , 'inline-block');
buttonText.css('display' , 'none');
emailSendError.css('display' , 'none');
            forgotAccountFieldset.attr("disabled" , "disabled");
            $.post(newAccountRecoveryFile , {email : trim(email.val())}).done(function (response) {

response = JSON.parse(JSON.stringify(response));


if(response.success == "1"){
    emailSendError.html(response.error);
    buttonText.val("email sent!");
    buttonText.show();
    loadingIcon.hide();
setTimeout(function () {

    emailSendError.fadeOut('slow');
    window.location.href = "/";
} , 5000)

}
else {
    forgotAccountFieldset.removeAttr('disabled');
    emailSendError.show();
    emailSendError.html(response.error);
    loadingIcon.css('display' , 'none');
    buttonText.show();
}
            }).fail(function () {

            });
        }

    });

});