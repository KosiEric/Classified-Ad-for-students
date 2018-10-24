$(document).ready(function () {

inactiveAdTypeToggle = $('.inactive-ad-type');

activeAdTypeToggle = $('.active-ad-type');

var favoriteAdsToggle = $('#favorite-ads-toggle');

var userAdsToggle = $('#user-ads-toggle');

var userAdsContainer = $('#user-ads-container');
var favoriteAdsContainer = $('#favorite-ads-container')
var userAdsLoadMore = $('#user-ads-load-more');
var favoriteAdsLoadMore = $('#favorite-ads-load-more');
inactiveAdTypeToggle.on('click' , function () {

    currentTab = $(this);
    currentTab.removeClass("inactive-ad-type");
    currentTab.addClass("active-ad-type");

    $('.active-ad-type').removeClass("active-ad-type");
    $('.active-ad-type').addClass("inactive-ad-type");



});


var loadMoreAction = $(loadMore);

var loadMoreFavoriteAdsAction = $(moreFavorites);

if(loadMoreAction){

    var userID = loadMoreAction.attr('data-user-id');


    var sql1 = String.format("WHERE posted_by = '{0}'" ,userID);

    loadMoreAds(sql1);

    loadMoreAction.on('click' , function () {
       loadMoreAds(sql1);
    });

    if(loadMoreFavoriteAdsAction){
        var userID = loadMoreFavoriteAdsAction.attr('data-user-id');

        var sql2 = String.format("WHERE user_id = '{0}'" ,userID);
        loadMoreFavoriteAds(sql2);

        loadMoreFavoriteAdsAction.on('click' , function () {


            loadMoreFavoriteAds(sql2);
        });
    }

}



var changeUserAccountStatusButtonId = "#change-user-account-status-button";

if($(changeUserAccountStatusButtonId)){
	
	 changeUserAccountStatusButton = $(changeUserAccountStatusButtonId);

	 changeUserAccountStatusButton.on('click' , function () {


	     var buttonClasses = ["btn-danger" , "btn-info"];
	     var action = Number($(this).attr('data-action'));
	     var data = JSON.stringify({"action" : action , 'id' : $(this).attr('data-user-id')});
	     var classToRemove = (action == 0)?1:0;
         var button = $(this);
	     console.log(buttonClasses[classToRemove]);
	     $(this).prop('disabled',true);
         $.post(changeUserActiveStatusFile , {data : data}).done(function (response) {
             console.log(response);
             response = JSON.parse(JSON.stringify(response));
             console.log(response.success);
             if(response.success == 1){
                 button.prop("disabled",false);

                 button.attr('class' , 'btn ' +buttonClasses[action]);
                 button.attr('data-action' , classToRemove);
                 button.text(button.attr('data-action-' + classToRemove + '-text'));
             }
             else {
                 button.prop('disabled' , false);
             }


         });



     });

	
	
	
}

favoriteAdsToggle.on('click' , function () {
    if(favoriteAdsContainer.css('display') == 'none'){
        userAdsContainer.css('display' , 'none');
        favoriteAdsContainer.css('display' , 'block');

        userAdsLoadMore.css('display' , 'none');
        favoriteAdsLoadMore.css('display' , 'block');
    }

});

userAdsToggle.on('click' , function () {

    if(userAdsContainer.css('display') == 'none'){
        favoriteAdsContainer.css('display' , 'none');
        userAdsContainer.css('display' , 'block');
        userAdsLoadMore.css('display' , 'block');
        favoriteAdsLoadMore.css('display' , 'none');
    }
})
$('.inactive-ad-type').on('mousemove' , function (e) {
    e.preventDefault();
})
});