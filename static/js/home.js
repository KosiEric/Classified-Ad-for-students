

$(document).ready(function () {


   $('.selected-state-links').on('click' , function(){

       $('#desktop-modal-popup-for-state').fadeIn('slow');
    });

   $('.modal-closers').on('click' , function () {

       $('#desktop-modal-popup-for-state').fadeOut('slow');
    });

   $('#change-state-form').on('submit' , function (e) {
   e.preventDefault();
   var states = document.getElementById('modal-select-state');
   var currentState = states.options[0].text;
   var selectedState = states.options[states.selectedIndex].text;

   if (currentState == selectedState){
       $('#desktop-modal-popup-for-state').fadeOut('slow');
   }
   else {


   }

   })

   function changeContentState () {

   }




});