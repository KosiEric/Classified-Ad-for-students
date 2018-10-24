function useStrict() {

    "use strict";
}
useStrict();

function isEmptyField(fields){
    if((fields.length) == 0){
        return true;
    }
    else {

        return false;
    }
}

if (!String.format) {
    String.format = function(format) {
        var args = Array.prototype.slice.call(arguments, 1);
        return format.replace(/{(\d+)}/g, function(match, number) {
            return typeof args[number] != 'undefined'
                ? args[number]
                : match
                ;
        });
    };
}

const processorFolder = "/processors/"; // jshint ignore:line
const postAdPage = '/post-ad';
const sub = {};
sub['home&furnitures'] = ["Furniture" , "Home Accessories" , "Home Appliances" , "Kitchen & Dining" , "Kitchen Appliances"];
sub["electronics&video"] = ["Audio and Music Equipment" , "Cameras, Video Cameras and Accessories" , "Computer Accessories" ,
    "Computer Hardware" , "TV & DVD Equipment" , "Video Game Consoles" , "Video Games"
];
sub["phones&tablets"] = ["Accessories" , "Mobile Phones" , "Tablets"];
sub["laptops&computers"] = ["Laptops" , "Desktop" , "Mini Laptop"];
sub["fashion&clothes"] = ["Clothing & Shoes" , "Watches" , "Jewelry" , "Accessories"];
sub["hostels&lodges"] = ["Hostel" , "Lodge" , "Roommate"];
sub["books&archive"] = ["Text Books"  , "Inspirational books" , "Inspirational CD's" , "Marvel" , "Religious" , "Musical"];


const profileUploadDir = "/uploads/profiles/";
const sendVerificationEmailFile = processorFolder + "send_verification_email.php"; // jshint ignore:line
const completeRegistrationFile =  processorFolder + "complete_registration.php"; //jshint ignore:line
const loginFile =  processorFolder + "login.php"; //jshint ignore:line
const accountRecoveryFile = processorFolder + "password_recovery.php"; //jshint ignore:line
const passwordResetFile = processorFolder + "password_reset.php"; //jshint ignore:line
const userInformationFile = processorFolder + "create_update_profile.php";
const newLoginFile = processorFolder + "new_login.php";
const updateProfileFile = processorFolder + "update_profile.php";
const resendVerificationEmailFile = processorFolder + "resend_verification_email.php";
const postAdFile = processorFolder + "post_ad.php";
const newAccountRecoveryFile = processorFolder  + "account_recovery.php";
const favoriteAdFile = processorFolder + "favorite_ad.php";
const changeAdStatusFile = processorFolder + "change_ad_status.php";
const loadMoreFile = processorFolder + "load_more_ads.php";
const adRefreshFile = processorFolder + "refresh_ad.php";
const reportAdFile = processorFolder + "report_ad.php";
const messageSellerFile = processorFolder + "message.php";
const editAdFile = processorFolder + "edit_ad.php";
const changeAdImageFile = processorFolder + "change_ad_image.php";
const changeUserActiveStatusFile = processorFolder + "change_user_active_status.php";
const loadMoreFavoriteAdsFile = processorFolder + "load_more_favorite_ads.php";
const loadMoreDefaultAdsFile = processorFolder + "load_more_default_ads.php";
const loadSearchSuggestionsFile = processorFolder + "search_suggestion.php";
const searchHomeFile = processorFolder + "search_home.php";


const minUsernameLength = 5; // jshint ignore:line
const maxUsernameLength = 12; // jshint ignore:line
const minPasswordLength = 5; // jshint ignore:line
const maxPasswordLength = 18; // jshint ignore:line
const minFirstNameLength = 2; // jshint ignore:line
const maxFirstNameLength = 30; // jshint ignore:line
const minLastNameLength = minFirstNameLength; // jshint ignore:line
const maxLastNameLength =  maxFirstNameLength; // jshint ignore:line
const minFullNameLength = 2;
const maxFullNameLength = 100;
const maxPhoneNumberLength = 11;
const minPhoneNumberLength = 11;
const maxProfileImageSize =  5;
const maxAdReportCommentLength = 500;
const minAdReportCommentLength = 10;
const minEmailNameLength = 2;
const maxEmailNameLength = 100;
const minEmailSubjectLength = 10;
const maxEmailSubjectLength = 100;
const minEmailMessageLength = 40;
const maxEmailMessageLength = 5000;


// Email regular expression



// First Name regular expression


var firstNameRegEx = /^[a-zA-Z]{2,40}$/;
var lastNameRegEx =  /^[a-zA-Z]{2,40}$/;
var fullnameRegEx = /^[a-zA-Z ]{2,100}$/;
var adReportRegEx = (/^[a-zA-Z0-9.,_;:\-'" ]{10,500}$/);

var emailSubjectRegEx = (/^[a-zA-Z0-9.,_;:\- ]{10,500}$/);
var emailNameRegEx = /^[a-zA-Z ]{2,40}$/;
var emailMessageRegEx = (/^[a-zA-Z0-9.,_;:\-'" ]{10,500}$/);

var passwordRegEx = /^[a-zA-Z0-9]{5,18}$/;
var usernameRegEx = /^[a-zA-Z0-9]{5,12}$/;
var phoneNumberRegEx = /^(\d{11,11})$/;

var invalidEmailError = "invalid email address";
var invalidUsernameError = "invalid username";
var usernameExceedsMaxError = "username exceeds " + maxUsernameLength + " characters";

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
var emptySignupEmailError = "forgot email address";
var emptySignupFirstNameError = "forgot to fill first name";
var emptySignupLastNameError = "forgot to fill last name";
var emptySignupPasswordError = "forgot password field";
var emptySignupPasswordAgainError = "must fill password again";
var failedAcceptanceError = "you must agree to our terms of usage";
var emptyUsernameError = "forgot to enter your username";
var emptyFullNameError = "forgot to enter your full name";
var fullNameDeceedsMinError = "name is less than " + minFullNameLength +  " characters";
var fullNameExceedsMaxError = "name exceeds " + maxFullNameLength +  " characters";
var fullNameCharacterError = "name contains unwanted character(s)";
var usernameError = "disallowed character(s) in username";
var stateNotSelectedError = "State not selected yet";
var schoolNotSelectedError = "School not selected";
var invalidPhoneNumberError = "invalid contact detail";
var usernameDeceedsMinError = "username is less than " + minUsernameLength  + " characters";
var primaryPhoneNumberExceedsMaxError = "primary phone number exceeds " + maxPhoneNumberLength;
var primaryPhoneNumberDeceedsMinError = "primary phone is less than " + minPhoneNumberLength;
var emptySignupUsernameError = "forgot username field";
var secondaryPhoneNumberExceedsMaxError = "secondary phone number exceeds " + maxPhoneNumberLength;
var secondaryPhoneNumberDeceedsMinError = "secondary phone is less than " + minPhoneNumberLength;
var adReportContainsInValidTextError = "Comment contains invalid character(s)";
var forgotPrimaryPhoneNumberError = "forgot to fill primary contact";
var signupUsernameError = $('#signup-username-error');
var signupPrimaryPhoneNumberError = $('#signup-primary-phone-error');
var signupSecondaryPhoneNumberError = $('#signup-secondary-phone-error');
var signupPasswordError = $('#signup-password-error');
var signupPasswordExceedsMaxError = "password exceeds " + maxPasswordLength + " characters";
var signupPasswordDeceedsMinError = "password is less than " + minPasswordLength + " characters";
var secondaryPhoneIsPrimaryPhoneError = "primary and secondary contacts cannot be the same";
var profileImageExceedsMaxError = "image exceeds maximum of " + maxProfileImageSize + "mb";
var profileImageFormatError = "image must be .jpg , .png , or .jpeg format";
var profileImageNotSelectedError = "profile image not selected yet.";
var emptyAdReportError = "Please add a comment to help us understand what's wrong with this item.";
var adReportExceedsMaxError = "Your comment is greater than max of " + maxAdReportCommentLength + " characters";
var adReportDeceedsMinError = "Your comment is less than min of " + minAdReportCommentLength + " characters";
var emptyMessageEmailError = "enter your email address";
var invalidMessageEmailError = "enter a valid email address";


var emptyEmailNameError = "enter your contact name";
var emailNameDeceedsMinError = "Your contact name is less than " + minEmailNameLength + " characters";
var emailNameExceedsMaxError = "Your contact name exceeds " + maxEmailNameLength + " characters";
var invalidEmailNameError = "your contact name contains disallowed characters";
var emptyEmailAddressError = "please enter your contact email";
var invalidEmailAddressError = "enter a valid email address";
var emailSubjectDeceedsMinError = "your message subject is less than " + minEmailSubjectLength + " characters";
var emailSubjectExceedsMaxError = "your message subject exceeds " + maxEmailSubjectLength + " characters";
var emailSubjectContainsInvalidCharacterError = "Your message subject contains disallowed character(s)";
var emptyEmailSubjectError  = "enter your subject message";





var emailMessageDeceedsMinError = "your message is less than " + minEmailMessageLength + " characters";
var emailMessageExceedsMaxError = "your message exceeds " + maxEmailMessageLength + " characters";
var emailMessageContainsInvalidCharacterError = "Your message body contains disallowed character(s)";
var emptyEmailBodyMessage = "enter your message";


var adImageFormatError = function (imageNumber) {
    return "image " + imageNumber + " must be .jpg , .jpeg , .png formats"
};
function trim(x) {
    return x.replace(/^\s+|\s+$/gm,'');
}





function validateImages (elemID , minImageFileSize) {

    if (!window.FileReader && !window.Blob) {
        // All the File APIs are supported.


        return true;

    }

    var control = document.getElementById(elemID);

    file = control.files[0];
    this.fileType = file.type;
    this.fileSize = file.size;

    this.imageFileFormats = ["image/png", "image/jpeg"];
    this.minImageFileSize = minImageFileSize;


    this.isImageFileSize = function () {

        if (this.fileSize <= this.minImageFileSize) {

            return true;
        }
        else {
            return false;
        }
    }

    this.isImageFileType = function () {
        if ($.inArray(this.fileType, this.imageFileFormats) > -1) {

            return true;
        }
        else {

            return false;
        }
    }

}
    $(document).ready(function () {
var maxAdReportCommentSpan = $('#max-ad-report-comment-length');
if(maxAdReportCommentSpan){
    maxAdReportCommentSpan.text(maxAdReportCommentLength);
}
        /*
            var checkNetworkConnection = setInterval(function () {

                $.post('https://webhook.site/3631788d-d05e-4ade-b3fd-fe09de7821e4' ,  {name : "Snoott"}).done(function () {

                    $('#connection-lost-alert').fadeOut('slow');
                }).fail(function () {
                    $('#connection-lost-alert').fadeIn('slow');
                })

            } , 5000);

        */
$('#max-upload-image-text').text(maxAdImageSizeInMb);
        if ($('#email-not-verified-warning-container')) {

            var unveriifedEmailAddress = $('#unverified-email-address');
            var emailNotVerifiedWarningContainer = $('#email-not-verified-warning-container');
            var timeToShowResendEmailResponse = 4 // in seconds

            var resendVerficationEmailLink = $('#resend-verification-link');
            resendVerficationEmailLink.on('click' , function (e) {
                e.preventDefault();
                resend_verification_email();
            })

            function resend_verification_email() {

$('#email-not-verified-warning-container').html("Please wait...");
                $.post(resendVerificationEmailFile, {email: unveriifedEmailAddress.text()}).done(function (response) {

                   response = JSON.parse(JSON.stringify(response));

                    if (response.success == 1) {
                        emailNotVerifiedWarningContainer.html(response.error);
                        setTimeout(function () {
                            emailNotVerifiedWarningContainer.fadeOut('slow');
                        }, timeToShowResendEmailResponse * 1000);


                    }

                    else {
                        emailNotVerifiedWarningContainer.html(response.error);
                        setTimeout(function () {
                            emailNotVerifiedWarningContainer.fadeOut('slow');
                        }, timeToShowResendEmailResponse * 1000);
                    }

                }).fail(function () {

                    emailNotVerifiedWarningContainer.html("Connection failed, try checking your internet connection.");
                });
            }
        }


    });
var emailRegEx = /^([a-zA-Z0-9_\-\._]+)@([a-zA-Z0-9_\-\._]+)\.([a-zA-Z0-9_\-\.]{2,5})$/;


const maxAdTitleLength = 70;
const minAdTitleLength = 10;
const minAdDescriptionLength = 30;
const maxAdDescriptionLength = 5000;
const maxAdImageSize = 7000000;
const maxAdImageSizeInMb = 7;


var adTitleDeceedsMinError = "Ad title is less than " + minAdTitleLength + " characters";
var adTitleExceedsMaxError = "Ad title is more than " + maxAdTitleLength + " charecters";
var adTitleContainsUnwantedCharactersError = 'Your title contains unwanted characters';
var adDescriptionDeceedsMinError = "Ad description is less than " + minAdDescriptionLength + " characters";
var adDescriptionExceedsMaxError =  "Ad description is more than " + maxAdDescriptionLength + " characters";
var emptyAdTitleError = "Enter your ad title";
var emptyAdDescriptionError = "Enter description for your ad";
var adAmountContainsLettersError = "product amount is invalid";
var adCategoryNotSelectedError = "choose a category for your Ad";
var adAmountEmptyError = "You've not entered the amount for your product."
var adImageExceedsMaxError = function(imageNumber) {

    return "ad image " + imageNumber + " Exceeds max size of " + maxAdImageSizeInMb + " mb";
};
adImageNotSelectedError = function (imageNumber ) {

    return "Ad image " + imageNumber + " Not selected";
};

const loadingMoreAdsImage = "#loading-more-ads-image";
const mainAdsContainer = "#main-ads-container";
const loadMore = "#load-more-action";
var adsLoadingImageContainer = "#ads-loading-image-container";

function loadMoreAds (sql1 , maxAd = null , loadFile = null) {

    var loadMoreAction = $(loadMore);
    if(loadMoreAction.attr('data-load-more') != 0) {
         loadMoreAction.css('display', 'none');
        $(adsLoadingImageContainer).css("display", "block");

        var maxAd = (maxAd != null) ? maxAd : Number(loadMoreAction.attr('data-max-ad'));
        var startPosition = Number(loadMoreAction.attr('data-total-ads'));
        var sql2 = String.format("ORDER BY id DESC LIMIT {0},{1}", startPosition, maxAd);
        var sql = String.format(sql1 + "{0}" + sql2 + "{1}", ' ', ';');
        loadFile = (loadFile == null)?loadMoreFile : loadFile;
        console.log(sql);
        $.post(loadFile, {sql: sql}).done(function (response) {

            $(adsLoadingImageContainer).css("display", "none");

            if (response != 0) {

            //   document.getElementById($(mainAdsContainer).attr('id')).innerHTML += response;
               $(response).appendTo(mainAdsContainer);
                loadMoreAction.css('display', 'initial');
                loadMoreAction.attr('data-total-ads' , maxAd + startPosition);
                $('.favorite-ad-links').on('click' , handleFavorites);
            }
            else {
                loadMoreAction.attr('data-load-more' , 0);
                loadMoreAction.css({'visibility' : 'hidden' , 'display' : 'block'});

            }


        });
    }
    else {


    }
}

const moreFavorites = "#more-favorites-action";
const mainFavoritesContainer = "#main-favorites-container";

function loadMoreFavoriteAds (sql1 , maxAd = null , loadFile = null) {

    var loadMoreAction = $(moreFavorites);
    if(loadMoreAction.attr('data-load-more') != 0) {
        loadMoreAction.css('display', 'none');
        $(adsLoadingImageContainer).css("display", "block");

        var maxAd = (maxAd != null) ? maxAd : Number(loadMoreAction.attr('data-max-ad'));
        var startPosition = Number(loadMoreAction.attr('data-total-ads'));
        var sql2 = String.format("ORDER BY id DESC LIMIT {0},{1}", startPosition, maxAd);
        var sql = String.format(sql1 + "{0}" + sql2 + "{1}", ' ', ';');

        loadFile = (loadFile == null)?loadMoreFavoriteAdsFile : loadFile;
        $.post(loadFile, {sql: sql}).done(function (response) {

            $(adsLoadingImageContainer).css("display", "none");

            if (response != 0) {

                $(response).appendTo(mainFavoritesContainer);
                loadMoreAction.css('display', 'initial');
                loadMoreAction.attr('data-total-ads' , maxAd + startPosition);
            }
            else {
                loadMoreAction.attr('data-load-more' , 0);
                loadMoreAction.css({'visibility' : 'hidden' , 'display' : 'block' , 'margin-top' : '20px;' });
            }


        });
    }
    else {


    }
}




function isAdImage (errorSpan , fieldID , adImageNumber , adImageLabel) {
    if(document.getElementById(fieldID).value == ""){
        errorSpan.text(adImageNotSelectedError(adImageNumber));
        return false;
    }
    var imageValidator = new validateImages(fieldID , maxAdImageSize);
    if(imageValidator.isImageFileSize()){
        if(imageValidator.isImageFileType()){
            errorSpan.text("");
            var reader = new FileReader();

            reader.onload = function (e) {
                adImageLabel.css("background-image"  ,  "url("+e.target.result+")");
            }

            reader.readAsDataURL(document.getElementById(fieldID).files[0]);
            return true;
        }
        else {
            errorSpan.text(adImageFormatError(adImageNumber));
            adImageLabel.css("background-image" , "url()");
            return false;
        }
    }
    else {
        errorSpan.text(adImageExceedsMaxError(adImageNumber));
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


 function  handleFavorites (e) {

     e.preventDefault();
     e.stopPropagation();
     var currentLink = $(this);
     userId = $(this).attr("data-current-user-id");
     action = $(this).attr('data-action');
     numberOfFavoriteAds = $(this).attr("data-num-favorites");
     adId = $(this).attr("data-ad-id");

     message = {"user_id": userId, "action": action, "ad_id": adId};
     message = JSON.stringify(message);

     $.post(favoriteAdFile, {data: message}).done(function (data) {
         console.log(data);
         response = JSON.parse(JSON.stringify(data));
         if (response.success == 1) {
             currentLink.attr("data-action", response.action);
             if (response.numberOfFavorites >= 1) {
                 $('#' + adId + '-favs-count').html(response.numberOfFavorites);
             }
             else {
                 $('#' + adId + '-favs-count').html("");
             }

             if (response.action == 1) {

                 $('#' + adId + '-heart-icon').removeClass("fa fa-heart");
                 $('#' + adId + '-heart-icon').addClass("fa fa-heart-o");
             }
             else if (response.action == 0) {

                 $('#' + adId + '-heart-icon').removeClass("fa fa-heart-o");
                 $('#' + adId + '-heart-icon').addClass("fa fa-heart");
             }
         }

     });

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


$(document).ready(function () {
    var defaultLoginForm = $('#default-login-form');
    var defaultLoginFormFieldSet = $('#default-login-fieldset');
    var defaultLoginUsername = $('#default-login-username');
    var defaultLoginPhone = $('#default-login-phone');
    var defaultLoginUsernameError = $('#default-login-username-error');
    var defaultLoginPhoneError = $('#default-login-phone-number-error');





    function isValidLoginDetails () {

        username = defaultLoginUsername.val();
        phone = defaultLoginPhone.val();


        var checkUsername = isUsername(username , defaultLoginUsernameError);
        var checkPhone = isPrimaryContact(phone , defaultLoginPhoneError);

        return checkUsername && checkPhone;

    }
    //08028563812
    $('.favorite-ad-links').on('click' , handleFavorites);

    defaultLoginForm.on('submit' , function (e) {
        e.preventDefault();
        e.stopPropagation();
        if(isValidLoginDetails()){
             var data = {'username' : defaultLoginUsername.val() , 'phone' : defaultLoginPhone.val()}
            defaultLoginFormFieldSet.prop('disabled' , true);

            data = JSON.stringify(data);
            $.post(newLoginFile , {data : data}).done(function (data , status){
                data = JSON.parse(JSON.stringify(data));

                if(data.success == 1) {
                    pathname = window.location.pathname.toString();

                    window.location.reload();               }
                else {
                    defaultLoginFormFieldSet.prop("disabled" , false);
                    defaultLoginPhoneError.html(data.error);

                }
            });
        }
    });

});