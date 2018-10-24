<div id="breadcrumb-section" class="section">
    <div class="container">
        <div class="page-title text-center">
            <h1>Ad Details Page</h1>
            <ol class="breadcrumb">
                <li><a href="#">Home</a></li>
                <li class="active">Ads</li>
            </ol>
        </div>
    </div>
</div><!-- breadcrumb-section -->
<div id="search-section">
    <div class="container">
        <form action="#" id = "header-search-form">
            <div class="search-section">
                <ul>
                    <li>
                        <div class="dropdown category-dropdown">
                            <a data-toggle="dropdown" href="#"><span class="change-text" id = "category-change-text">All Categories</span> <i class="fa fa-angle-down search-category-dropdown-arrow"></i></a>
                            <ul class="dropdown-menu category-change" id = "search-category-dropdown">
                                <?php

                                $category_icons = Array("home" , "television" , "tablet" , "desktop" , "shopping-bag" , "bed" , "book");
                                $counter = 0;
                                foreach ($ad_categories as $category) {

                                    $category_text = str_replace("&" , " & " , $category);
                                    $category_text_upper = ucwords($category_text);
                                    $current_icon = $category_icons[$counter];


                                    echo     "<li>
 <a href='#' data-category = '$category' class='search-category-dropdown' tabindex='-1'><span class='header-category-icon-containers'><i class='fa fa-$current_icon category-icons search-category-icons'></i></span><span data-category = '$category' class = 'header-category-link-text search-category-link-text'>$category_text_upper</span></a>

 
 </li>";
                                    $counter++;
                                }
                                ?>
                            </ul>
                        </div><!-- category-change -->
                    </li>
                    <li>
                        <div class="dropdown category-dropdown">
                            <a data-toggle="dropdown" href="#"><span class="change-text" id="change-state-text">All Locations</span> <i class="fa fa-angle-down search-state-dropdown-arrow"></i></a>
                            <ul class="dropdown-menu category-change" id = "state-change">
                                <?php

                                $states_2 = $states[$selected_country];
                                foreach ($states_2 as $state){
                                    echo "<li><a data-state = '$state' href = '#'>$state</a>";
                                }

                                ?>

                            </ul>
                        </div><!-- category-change -->
                    </li>
                    <li>
<div id = "search-text-input-container">

                        <input type="text" autocomplete="off" placeholder = "e.g. iPhone 7"   id = "search-text" class="form-control" placeholder="" />
    <span id = "empty-search-text-icon">&times;</span>
    <span id = "empty-search-text-warning">search keyword</span>
                  
</div>
<div class="search-suggestions" id="search-suggestions">

      
</div>

                    </li>
                    <li>
                        <button type="submit" class="form-control btn btn-primary" id = "search-button" value="Search">
<span id="search-icon-container"><i class="fa fa-search" id = "search-icon"></i></span>
                        Search</button>
                    </li>
                </ul>
            </div>
        </form>

    </div>
</div><!-- search-section -->

