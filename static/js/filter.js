var filterState , filterSchool , filterCategory , filterSub , filterSchoolMenu , defaultSchoolMenuLi , 
filterSchoolDivider , filterSubDivider , changeSubCategoryOptions , changeSchoolOptions;
jQuery(document).ready(function() {





filterState = $("#filter-state");
filterSchool = $("#filter-school");
filterCategory = $("#filter-category");
filterSub = $('#filter-sub');
filterSchoolMenu = $('#filter-school-menu');
defaultSchoolMenuLi = $("#default-school-menu-li");
filterSchoolDivider = $("#filter-school-divider")
filterSubDivider = $('#filter-sub-divider');


changeSubCategoryOptions = function(currentFilterCategory , categoryText) {
                $(".subcat-list-items").css('display' , 'none'); 
             for (var i = 0; i < sub[currentFilterCategory].length; ++i) {
  	            currentListItem = String.format("<li class='subcat-list-items'><a onclick = 'simpleChangeSub($(this));' data-for = 'subcat' href='#'>{0}</a></li>" , sub[currentFilterCategory][i]);
  	            //console.log(currentListItem);
  	
	$(currentListItem).insertBefore(filterSubDivider);

  } 

  filterCategory.attr('data-category-text', categoryText);



} 


changeSchoolOptions = function(filterState) {

	$('.school-list-items').css('display' , 'none');
   
    for (var i = 0; i < carsAndModels[filterState].length; ++i){
        currentList = String.format("<li class = 'school-list-items'><a data-for='school' href='#' onclick = 'simpleChangeSub($(this));'>{0}</a></li>" , carsAndModels[filterState][i]);
        $(currentList).insertBefore(filterSchoolDivider);

    }

    $('#filter-state').attr("data-state-text" , filterState);


}


if (Number(filterState.attr("data-show-school")) == 1) {
           defaultSchoolMenuLi.css("display" , "none");
           var currentFilterState = $.trim(filterState.text().toString());
           
             for (var i = 0; i < carsAndModels[currentFilterState].length; ++i) {
  	            currentListItem = String.format("<li><a onclick = 'simpleChangeSub($(this));' data-for = 'subcat' href='#'>{0}</a></li>" , carsAndModels[currentFilterState][i]);
  	            //console.log(currentListItem);

	$(currentListItem).insertBefore(filterSchoolDivider);

  } 

}

$(".dropdown-menu li a").on('click' , function(){
 
 
 simpleChangeSub($(this));
 
});


});



 function simpleChangeSub (obj) {

 filterState = $("#filter-state");
	 if(!obj.hasClass('data-close')){
    var selText = obj.text();
    

  obj.parents('.btn-group.search-filter-menus').find('.dropdown-toggle').html(selText);


  optionsFor = obj.attr('data-for');
  switch (optionsFor) {
  	case 'state' :
  		// statements_1
  		
        currentState = filterState.attr('data-state-text');
        
        if(currentState != selText){
        	changeSchoolOptions($.trim(selText));
  		
  		filterSchool.text("Select School");
  		filterState.attr('data-state-text' , $.trim(selText));
  		loadMoreAction.attr('data-state' , $.trim(selText));

  		defaultSchoolMenuLi.hide();
  		loadMoreSearch({
            	             "category" : filterCategory.attr('data-category'), 
            	             "state" : filterState.attr("data-state-text") , 
            	             "school" : filterSchool.attr("data-school")   ,  
            	             "subcategory" : filterSub.attr("data-subcat") ,
            	             "refresh" : "1" 
            	         });          
              

  }else {}


  		break;
  	case 'category'	:
  	newCat = selText.split(' ').join('').toLowerCase();
  	
  	 currentCategory = filterCategory.attr("data-category-text");
  	   
  	   	        if(selText != currentCategory) {
  	   	        	filterSub.attr('data-subcat' , "*");
            	changeSubCategoryOptions($.trim(newCat) , selText);
            filterSub.text("Select Subcategory");
            filterCategory.attr('data-category-text' , selText);
            filterCategory.attr('data-category' , newCat);
            
            obj.parents('.btn-group').find('.dropdown-toggle').html(selText);
            loadMoreAction.attr({'data-category' : $.trim(newCat) , 'data-subcat' : "*"}); 
            loadMoreSearch({
            	             "category" : newCat, 
            	             "state" : filterState.attr("data-state-text") , 
            	             "school" : filterSchool.attr("data-school")   ,  
            	             "subcategory" : filterSub.attr("data-subcat") ,
            	             "refresh" : "1" 
            	         });          
              
/*
            $(".dropdown-menu li a").on('click' , function(){
 
 simpleChangeSub($(this));
 
}); */            	
            }
            else { }



            break;

  	case 'school':
  	    filterSchool.attr('data-school' , $.trim(selText));
  	    loadMoreAction.attr({
  	    	'data-school': $.trim(selText),
  	    });

  	    loadMoreSearch({
            	             "category" : filterCategory.attr('data-category'), 
            	             "state" : filterState.attr("data-state-text") , 
            	             "school" : filterSchool.attr("data-school")   ,  
            	             "subcategory" : filterSub.attr("data-subcat"),
            	             "refresh" : "1" 
            	         });      
  	    break;
  		// statements_def
  		

       
  		//break;


   case 'subcat' :
   filterSub.attr('data-subcat' , $.trim(selText));
  	    loadMoreAction.attr({
  	    	'data-subcat': $.trim(selText),
  	    });



  	    loadMoreSearch({
            	             "category" : filterCategory.attr('data-category'), 
            	             "state" : filterState.attr("data-state-text") , 
            	             "school" : filterSchool.attr("data-school")   ,  
            	             "subcategory" : $.trim(selText) ,
            	             "refresh" : "1" 
            	         });      
  	    
  
  }

  
               
}




}






$("#btnSearch").click(function(){
  alert($('.btn-select').text()+", "+$('.btn-select2').text());
});

