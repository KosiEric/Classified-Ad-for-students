$(document).ready(function() {




    var searchText = $('#search-text');

    var searchButton = $('#search-button');
    var emptySearchTextIcon = $('#empty-search-text-icon');
    var emptySearchTextWarning = $('#empty-search-text-warning');
    var defaultChangeStateText = $('#change-state-text').text();
    var changeStateText = $('#change-state-text');
    var categoryChangeText = $('#category-change-text');
    var defaultCategoryText = categoryChangeText.text();
    var headerCategoryLinkText = "header-category-link-text";
    var searchSuggestions = $('#search-suggestions');
    var noResultsFound = $('#no-results-found');
    var state = "";
    var category = "";
    var headerSearchForm = $('#header-search-form');
    
    if(isEmptyField(searchText.val())){
        searchButton.prop("disabled" , true);
        headerSearchForm.on('submit' , function(e){

          e.preventDefault();
          e.stopPropagation();
          e.stopImmediatePropagation();
        });




    }

    

searchText.on('blur' , function() {

    searchSuggestions.html("");
    searchSuggestions.css("display" , "none");

});

    emptySearchTextIcon.on('click' , function(){


        if(!isEmptyField(searchText.val())){
            searchText.val("");
            emptySearchTextWarning.css('display', 'inline-block');

        }

        searchSuggestions.css('display' , 'none');
$('.search-results').css('display' , 'none');

if(document.getElementById('no-results-found')){

$('#no-results-found').css('display' , 'none');
    }
    });

/*
searchText.on('blur' , function() {
searchSuggestions.css('display' , 'none');
$('.search-results').css('display' , 'none');


});
*/
    searchText.on('keyup' , function(event) {
        /* Act on the event */
        


          
          
          if(isEmptyField($(this).val())){

            emptySearchTextWarning.css('display', 'inline-block');
                     


          }


          else {
            searchSuggestions.css("display" , "block");
            emptySearchTextWarning.css('display', 'none');

            state = (changeStateText.text() == defaultChangeStateText)? "*" : changeStateText.text();
           
            

            category = (categoryChangeText.text() == defaultCategoryText)? "*" : categoryChangeText.text().split(' ').join("").toLowerCase();


            
           var query = $(this).val(); 
           data = JSON.stringify({"state" : state , "category" : category , "query" : query});

  
           $.post(loadSearchSuggestionsFile, {data: data}, function(data, textStatus, xhr) {
               /*optional stuff to do after success */
$('.search-results').css('display' , 'none');

               if(data != 0){
                    var resultReturned = JSON.parse(data);
                    var ads = resultReturned.ads;
                    var location = String.format("/search?q={0}&category={1}&result={2}&state={3}", query.split(" ").join("+") ,category.replace("&" , ".") , resultReturned.firstResult.split(" ").join('+') , state);

                searchButton.prop("disabled" , false);
                                            searchButton.on('click' , function(e){

          
          window.location.href = location;


        

        });

                
searchSuggestions.css('display' , 'block');
$('.search-results').css('display' , 'none');
if(document.getElementById('no-results-found')){
$('#no-results-found').css('display', 'none');
}
$(ads).appendTo(searchSuggestions);


               }

               
else {
searchSuggestions.css('display' , 'block');
searchButton.prop("disabled" , true);
headerSearchForm.on("click" , function(e) {
e.preventDefault();
})                
$('.search-results').css('display' , 'none');
if(!document.getElementById('no-results-found')){
    $("<a class='search-suggestion' id = 'no-results-found'><span class = search-suggestion-texts>No results found</span></a>").appendTo(searchSuggestions)
}
}

            

           });             






           



          }

    });





	
$('#list').click(function(event){event.preventDefault();$('#products .item').addClass('list-group-item');});
            $('#grid').click(function(event){event.preventDefault();$('#products .item').removeClass('list-group-item');$('#products .item').addClass('grid-group-item');});


});