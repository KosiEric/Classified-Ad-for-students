$(document).ready(function () {

    var adImageZoom = $('#ad-image-zoom-icon-container');
    var closeZoomImage = $('#close-zoom-image');
    var currentZoomImageNumber = $('#current-zoomed-image-number');
    var adImageZoomLeftContainer = $('#ad-image-zoom-left-container');
    var adImageZoomRightContainer = $('#ad-image-zoom-right-container');
    var adImage1 = $('#ad-image-1');
    var adImage2 = $('#ad-image-2');
    var adImage3 =$('#ad-image-3');
    var maxAdImageNumber = Number(currentZoomImageNumber.attr('data-max-ad-images'));
    var adZoomInIcon = $('#ad-zoomin-icon');
    var reportAdCommentText = $('#report-ad-comment-text');
    var reportAdCommentTextCssTop = reportAdCommentText.css('top');
    var reportAdCommentBox = $('#report-ad-comment-box');
    var adReportCommentError = $('#ad-report-error');
    var adReportCommentTextTyped = $('#comment-num-typed');
    var reportAdSubmitButton = $('#report-ad-submit');
    var reportAdForm = $('#report-ad-form');
    var reportAdRadioButtons = $('.report-ad-reason-radiobutton');
    var reportAdFieldSet = $('#report-ad-fieldset');
    var reportAdFormModal = $('#report-ad-form-modal');
    var reportAdModalLink = $('#report-ad-modal-link');
    var contactSellerActionDropDown = $('#contact-seller-action-dropdown');
    var contactSellerFormContainer = $('#contact-seller-form');
    var contactSellerForm = $('#contact-form');
    var contactFormFieldSet = $('#contact-form-fieldset');
    var messageContactName = $('#message-name');
    var messageNameError = $('#message-name-error');
    var messageEmail = $('#message-email');
    var messageEmailError = $('#message-email-error');
    var messageSellerError = $('#contact-seller-error');
    var messageSubject = $('#message-subject');
    var messageSubjectError = $('#message-subject-error');
    var pleaseWaitMessage = 'Please wait..';
    var messageBody = $('#message-body');
    var messageBodyError = $('#message-body-error');
    var showHiddenContact = $('#show-hidden-contact');
    var hiddenSellerContact = $('#hidden-seller-contact');



    showHiddenContact.on('click' , function () {

        document.getElementById($(this).attr('id')).style.display = 'none';
       hiddenSellerContact.css('display' , 'inline-block');
      // $(window).scrollTop(hiddenSellerContact.scrollTop());
    });


     reportAdCommentBox.on('focus' , function () {

        reportAdCommentText.css('top' , '0px');
    });

    reportAdCommentBox.on('blur' , function () {
       if(isEmptyField($(this).val())){
           reportAdCommentText.css('top' , reportAdCommentTextCssTop);
       }
    });


    reportAdCommentBox.on('keyup' , function (e) {
        if(reportAdCommentBox.val().length  <= maxAdReportCommentLength){
            adReportCommentTextTyped.text(reportAdCommentBox.val().length);

        }
        else {
            e.preventDefault();
        }
       if(isAdReport($(this).val() , adReportCommentError)){
    return true;
       }


    });

    contactSellerActionDropDown.click(function () {
        contactSellerFormContainer.slideToggle('slow');
    });


    //The action below controls what happens when the report ad form is submitted


    reportAdForm.submit(function (e) {
e.preventDefault();
e.stopImmediatePropagation();
e.stopPropagation();

if(isAdReport(reportAdCommentBox.val() , adReportCommentError)){

    var descriptionText = reportAdCommentBox.val().replace(/\n\r?/g, '<br />');
    var data = {comment : descriptionText , ad_id : reportAdCommentBox.attr('data-ad-id') , reason : $("input[name='report-ad-reason']:checked"). val()};
    data = JSON.stringify(data);
    reportAdFieldSet.prop('disabled' , true);
    $.post(reportAdFile , {'data' : data} , function (response , status) {

        responseReceived = JSON.parse(JSON.stringify(response));
 if(responseReceived.success == 1){
     adReportCommentError.text(responseReceived.error);
     setTimeout(function () {

         reportAdFormModal.modal('toggle');
         reportAdModalLink.css('display' , 'none');
     }, 2000);
 }
    });
}
    });
if($('#change-ad-status')){

    changeAdStatusButton = $('#change-ad-status');

    changeAdStatusButton.on('click' , function () {
        $(this).prop('disabled' , true);
      id = $(this).attr('data-ad-id');
      action = $(this).attr('data-action');
      data = {id : id , action : action};
      data = JSON.stringify(data);
      $.post(changeAdStatusFile , {data : data}).done(function (response) {
          response = JSON.parse(JSON.stringify(response));
          if(response.success == 1){
             window.location.reload();
         }
         else {
              $(this).prop('disabled' , false);
          }


      });
    })
}

var isMessageName = function (name , error) {

    if(isEmptyField(name)){
        error.text(emptyEmailNameError);
        return false;
    }
    else if(name.length < minEmailNameLength){
        error.text(emailNameDeceedsMinError);
        return false;
    }
    else if(name.length > maxEmailNameLength){
        error.text(emailNameExceedsMaxError);
        return false;
    }
    else if(!emailNameRegEx.test(name)){
        error.text(invalidEmailNameError);
        return false;
    }

    else {
        error.text("");
        return true;
    }

};


var isMessageSubject = function(subject , error){
    if(isEmptyField(subject)){
        error.text(emptyEmailSubjectError);
        return false;
    }

    else if (subject.length < minEmailSubjectLength){
        error.text(emailSubjectDeceedsMinError);
        return false;
    }
    else if (subject.length > maxEmailSubjectLength){
        error.text(emailSubjectExceedsMaxError);
        return false;
    }

    else if(!emailSubjectRegEx.test(subject)){
        error.text(emailSubjectContainsInvalidCharacterError);
        return false;
    }

    else {

        error.text("");
        return true;
    }


    };

var isMessageBody = function (message , error) {
    if(isEmptyField(message)){
        error.text(emptyEmailBodyMessage);
        return false;
    }

    else if (message.length < minEmailMessageLength){
        error.text(emailMessageDeceedsMinError);
        return false;
    }
    else if(message.length > maxEmailMessageLength){
        error.text(emailMessageExceedsMaxError);
        return false;
    }

    else if(!emailMessageRegEx.test(message)){
        error.text(emailMessageContainsInvalidCharacterError);
        return false;
    }

    else {
        error.text("");
        return true;
    }
};

var isMessageEmail = function (email , error ) {
    if(isEmptyField(email)){
        error.text(emptyMessageEmailError);
        return false;
    }

    else if(!emailRegEx.test(email)){
        error.text(invalidMessageEmailError);
        return false;
    }

    else {
        error.text("");
        return true;
    }
};

    function  isMessageDetails() {
        messageName  = messageContactName.val();
        subject = messageSubject.val();
        message = messageBody.val();
        email = messageEmail.val();

        checkName = isMessageName(messageName , messageNameError);
        checkEmail = isMessageEmail(email , messageEmailError);
        checkSubject = isMessageSubject(subject , messageSubjectError);
        checkMessage = isMessageBody(message ,messageBodyError);
        return checkName && checkSubject && checkEmail && checkMessage ;
    }


    // The action below handles the onsubmit event when sending message to the ad poster

    contactSellerForm.on('submit' , function (e) {
        e.preventDefault();
        e.stopPropagation();
        e.stopImmediatePropagation();

        if(isMessageDetails()){

            adId = $(this).attr('data-ad-id');
            var data = {name : messageContactName.val() , email : messageEmail.val() , subject : messageSubject.val() , body : messageBody.val()
            , sentTo : $(this).attr('data-sent-to') , ad_id : $(this).attr('data-ad-id')};
            data = JSON.stringify(data);
            contactFormFieldSet.prop('disabled' , true);
            messageSellerError.text(pleaseWaitMessage);
            $.post(messageSellerFile , {'data' : data} , function (response , status) {
                  console.log(response);
                 response = JSON.parse(JSON.stringify(response));
                 if(response.success == 1){
                     messageSellerError.text(response.error);
setTimeout(function () {
    contactSellerFormContainer.css('display' , 'none');

}, 2000);
contactSellerActionDropDown.prop('disabled' , true);

                 }

                 else if(response.success == 0){
                     contactFormFieldSet.prop('disabled' , false);
                     messageSellerError.text(response.error);

                 }

            });
        }


    });


// Validates the details entered in the message seller form



// Validates inputs entered in report ad modal pop-up

var isAdReport = function (adReportText , adReportError) {
    if(isEmptyField(adReportText)){
        adReportError.text(emptyAdReportError);
        return false;
    }
    else if(adReportText.length < minAdReportCommentLength){
        adReportError.text(adReportDeceedsMinError);
        return false;
    }
    else if (adReportText.length > maxAdReportCommentLength){
        adReportError.text(adReportExceedsMaxError);
        return false;
    }
    else if (!adReportRegEx.test(adReportText)){
        adReportError.text(adReportContainsInValidTextError);
        return false;
    }
    else {
        adReportError.text("");
        return true;
    }

};



if($('#ad-updated-status')){
    adUpdatedStatus = $('#ad-updated-status');
    adRefreshLink = $('#ad-refresh-link');
    adRefreshIcon = $('#ad-refresh-icon');

    adRefreshLink.on('click' , function () {
       $(this).prop('disabled' , true);
       adRefreshIcon.addClass('fa-spin');
       id = $(this).attr('data-ad-id');
       action = adRefreshLink.attr('data-disabled');
       if(action != 0){
           return false;
       }

        $.post(adRefreshFile , {id : id}).done(function (response) {
            console.log(response);
            response = JSON.parse(JSON.stringify(response));
            if(response.success == 1){
                adRefreshIcon.css('display' , 'none');
                adUpdatedStatus.css('display' , 'inline-block');
            }
            else {

                adRefreshIcon.css('display' , 'inline-block');
                adRefreshIcon.removeClass('fa-spin');
            }


        });


    });
}

    var enlargeImageModal  = $('#enlarge-image-modal');


// Get the image and insert it inside the modal - use its "alt" text as a caption
    var img = document.getElementById('myImg');
    var modalImg = $('#img01');
    var captionText = $("#caption");

adZoomInIcon.on('click' , function () {

    //enlargeImageModal.css('display' , 'block');
    currentImage = $('.item.active').attr('data-image');
    currentShowingimage = $('#ad-image-' + currentImage);
    enlargeImageModal.css('display' , 'block');
    modalImg.attr('src' ,currentShowingimage.attr('src'));
    currentZoomImageNumber.text(currentImage);
    currentZoomImageNumber.attr('data-current-image' , currentImage);
});

adImageZoomLeftContainer.on('click' , function () {
    currentZoomImage = currentZoomImageNumber.attr('data-current-image');
    nextAdZoomImageToShow = Number(currentZoomImage) - 1;
    if (nextAdZoomImageToShow == 0){
        modalImg.attr('src' ,adImage3.attr('src'));
        currentZoomImageNumber.attr('data-current-image' , maxAdImageNumber);
        currentZoomImageNumber.text(maxAdImageNumber);

    }
    else {
       modalImg.attr('src' , $('#ad-image-'+ nextAdZoomImageToShow).attr('src'));
       currentZoomImageNumber.attr('data-current-image' , nextAdZoomImageToShow);
        currentZoomImageNumber.text(nextAdZoomImageToShow);
    }
});

    adImageZoomRightContainer.on('click' , function () {
        currentZoomImage = currentZoomImageNumber.attr('data-current-image');
        nextAdZoomImageToShow = Number(currentZoomImage) + 1;
        if (nextAdZoomImageToShow == maxAdImageNumber + 1){
            modalImg.attr('src' ,adImage1.attr('src'));
            currentZoomImageNumber.attr('data-current-image' , '1');
            currentZoomImageNumber.text('1');

        }
        else {
            modalImg.attr('src' , $('#ad-image-'+ nextAdZoomImageToShow).attr('src'));
            currentZoomImageNumber.attr('data-current-image' , nextAdZoomImageToShow);
            currentZoomImageNumber.text(nextAdZoomImageToShow);
        }
    });






// Get the <span> element that closes the modal

// When the user clicks on <span> (x), close the modal
    closeZoomImage.on('click' , function () {

        enlargeImageModal.css('display' , 'none');

    });

});