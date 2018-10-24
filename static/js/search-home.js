var loadMoreSearch , loadMoreAction;
$(document).ready(function() {



loadMoreAction = $('#load-more-action');
var searchState =  loadMoreAction.attr('data-state');
var searchCategory = loadMoreAction.attr('data-category');
var searchSubCat = loadMoreAction.attr('data-subcat');
var loadMoreIcon = $('#load-more-icon');

var userAdsLoadMore = $('#user-ads-load-more');
var loadMore = loadMoreAction.attr('data-load-more');
var q = loadMoreAction.attr('data-q');
var maxAd = Number(loadMoreAction.attr("data-max-ad"));
var totalAdsLoaded = Number(loadMoreAction.attr("data-total"))
var mainSearchContainer = $('#main-search-container');
const searchImagesFadeTimeout = 1000;
const searchImagesFadeInterval = 10000;
adsLoadingImageContainer  = $(adsLoadingImageContainer);
var numberOfAdsImages = Number(loadMoreAction.attr("data-ads-images"));
var numberOfSearchResults = $('#number_of_search_results');
var searchFilterSlider = $('#search-filter-slider');
var searchFilterForm = $('#search-filter-form');




$('.search-filter-icons-text').on('click' , function() {

if(searchFilterForm.css('display') == 'block'){
  searchFilterForm.css('display', 'none');

}
else {
searchFilterForm.css('display', 'block');

}
});




loadMoreSearch = function(obj) {
		adsLoadingImageContainer.css('display' , 'block');
    userAdsLoadMore.css('display' , 'none');

if(obj == null){


state = loadMoreAction.attr('data-state');

school= "*" ;
category = loadMoreAction.attr('data-category');
subcat = loadMoreAction.attr('data-subcat');



}

else {
state = (obj.state == null)?loadMoreAction.attr('data-state'): obj.state;

school= (obj.school == null)?"*" : obj.school;
category = (obj.category == null)?loadMoreAction.attr('data-category'):obj.category;
subcat = (obj.subcategory == null)?loadMoreAction.attr('data-subcat'):obj.subcategory;
}

var data = JSON.stringify({"state" : state , "school" : school ,  "category" : category , "subcat" : subcat ,  "query" : q , "max" : maxAd , "total" : (obj==null)?totalAdsLoaded:0}); 


$.post(searchHomeFile, {data: data}, function(result, textStatus, xhr) {
	/*optional stuff to do after success */
	adsLoadingImageContainer.css("display" , "none");
	$(".search-images-containers").each(function(index, el) {
       	$(this).css("background-image" , "url("+$(this).attr('data-bg-image-1') +")");
      });


if(obj && obj.refresh == "1" ){
     mainSearchContainer.html("");


 }

if(result != 0) {

   if(!obj){
	 totalAdsLoaded += maxAd;
	 
     loadMoreAction.attr("data-total-ads" , totalAdsLoaded);
     
     }
     result = JSON.parse(result);
     
     
              $(result.ads).appendTo(mainSearchContainer);

     numberOfSearchResults.text(result.total_ads);
     userAdsLoadMore.css("display" , "block");
  
      
      var currentBgImageIndex = 2;
  

      $(".search-images-containers").each(function(index, el) {
       	$(this).css("background-image" , "url("+$(this).attr('data-bg-image-1') +")");
      });

        setInterval(function(){

if(currentBgImageIndex > numberOfAdsImages){
          currentBgImageIndex = 1;
}

setTimeout(function() {
	 $(".search-images-containers").each(function(index, el) {
          $(this).css("opacity" , ".5");
      });
} , 200);

        	   
setTimeout(function() {
	$(".search-images-containers").each(function(index, el) {
                 	currentBg = $(this).attr('data-bg-image-' + currentBgImageIndex);
                  
                	$(this).css({"background-image" : "url(" + currentBg +")" , "opacity" : 1});
         })} , 1000);


                    
            /*

  setTimeout(function() {
	$(".search-images-containers").each(function(index, el) {
                	$(this).css("opacity" , 1);
                }, 200);

});




*/
         

  setTimeout(function() {

     currentBgImageIndex++;
  } , 8800); 
         
         



        } , searchImagesFadeInterval);


                        







     
}

else {

  userAdsLoadMore.css("visibility" , "none");
  numberOfSearchResults.text(0);
}

});

}

if(loadMore == 1){

loadMoreSearch();

}

userAdsLoadMore.on('click', function(){

	loadMoreSearch();
});


});