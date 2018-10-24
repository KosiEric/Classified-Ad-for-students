<form id = "search-filter-form">
  <div class="well carousel-search hidden-phone" id = "search-filter-form-child">
    <div class="btn-group row search-filter-menus">

      <a data-state = "<?php if($main_state == "*"){echo "0";} else {echo $main_state;}?>" data-show-school = "<?php if($main_state == "*"){echo "0";} else {echo "1";}?>"  data-state-text = "<?php echo($main_state);?>" class="btn dropdown-toggle btn-select search-filter-texts" data-toggle="dropdown" href="#" id="filter-state">
        <u><?php if($main_state == "*"){
          echo "Your state";} else {echo ucfirst($main_state);}?></u> <span class="caret dropdown"></span></a>
      <ul class="dropdown-menu filter-dropdown-menu">
        
        <?php foreach($states[$selected_country] as $state){

echo "<li><a href='#' data-for = 'state'>$state</a></li>";


}
          ?>
        <li class="divider"></li>
        <li><a href="#" class="filter-divider data-close">Close <i class="filter-close fa fa-times"></i></a></li>
      </ul>
    </div>
    
    <div class="btn-group row search-filter-menus">
      <a data-school = "*" id = "filter-school" class="btn dropdown-toggle btn-select2 search-filter-texts" data-toggle="dropdown" href="#"><u>School</u><span class="caret dropdown"></span></a>
      <ul class="dropdown-menu search-filter-menus filter-dropdown-menu" id = "filter-school-menu">
        <?php if($main_state == "*"){?>
        <li id = "default-school-menu-li"  class="school-list-items"><a  data-for = "school" href="#">School</a></li>
      <?php } ?>
        <li class="divider" id = "filter-school-divider"></li>
        <li><a href="#" class="filter-divider data-close" >Close <i class="filter-close filter-close-icon-for-school fa fa-times"></i></a></li>
      </ul>
    </div>

    <div class="btn-group row search-filter-menus">
      <a id = "filter-category"  data-category-text = "<?php echo ucwords(str_replace("&" , " & " , $main_category)); ?>" data-category = "<?php echo $main_category;?>" class="btn dropdown-toggle btn-select2 search-filter-texts" data-toggle="dropdown" href="#"><u><?php if($main_category == "*"){ echo "Category";} else {echo 
        ucwords(str_replace("&", " & ", $main_category));}?></u><span class="caret dropdown"></span></a>
      <ul class="dropdown-menu filter-dropdown-menu">
       <?php

                                $category_icons = Array("home" , "television" , "tablet" , "desktop" , "shopping-bag" , "bed" , "book");
                                $counter = 0;
                                foreach ($ad_categories as $category) {

                                    $category_text = str_replace("&" , " & " , $category);
                                    $category_text_upper = ucwords($category_text);
                                    $current_icon = $category_icons[$counter];
                                    $search_category_text = str_replace("&", ".", $category);

                                    echo     "<li>
 <a data-for = 'category' href='#' tabindex='-1'><span class='header-category-icon-containers'><i class='fa fa-$current_icon category-icons'></i> </span><span class = 'header-category-link-text'>$category_text_upper</span></a>

 
 </li>";
                                    $counter++;
                                }
                                ?>
        <li class="divider"></li>
        <li><a href="#" class="filter-divider data-close " data-close = "1">Close <i class="filter-close fa fa-times close-for-category"></i></a></li>
      </ul>
    </div>

    <div class="btn-group row search-filter-menus ">
      <a id = "filter-sub" data-subcat = "<?php echo $main_subCat; ?>" class="btn dropdown-toggle btn-select2 search-filter-texts" data-toggle="dropdown" href="#"><u><?php echo $sub_text_to_display = ($main_subCat == "*")?"Subcategory" : $main_subCat; ?></u> <span class="caret dropdown ro"></span></a>
      <ul class="dropdown-menu filter-dropdown-menu">
        <?php if ($main_category != "*"){


              foreach ($ad_sub_categories[$main_category] as $subcat) {
                # code...
                echo "<li class='subcat-list-items'><a data-for = 'subcat' href = '#'>$subcat</a></li>";
              }
}

else if ($main_subCat != "*") {

  echo "<li class='subcat-list-items'><a href = '#'>$main_subCat</a></li>";
}
         ?>



       
        <li class="divider" id="filter-sub-divider"></li>
        <li><a href="#" class="filter-divider data-close">Close <i class="filter-close fa fa-times"></i></a></li>
      </ul>
    </div>
    <div class="btn-group search-filter-menus">
      <!--
      <button type="button" id="search-filter-submit-button" class="btn btn-primary pull-right text-center"><span id="go-button-text">Go!</span></button>
    -->
    </div>
  </div>
</form>
<!-- Search box End -->

