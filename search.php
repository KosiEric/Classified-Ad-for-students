<?php

if(!class_exists("Configurations")){

    $document_root = $_SERVER['DOCUMENT_ROOT'];
    require_once ($document_root.'/security/config.php');
    require_once ($document_root.'/security/database.php');
    require_once ($document_root.'/security/functions.php');


}
// Instanciating the  functions class

$functions = new Functions();
$config = new Configurations();

$q = ($_GET["q"]) ?? "*";
$subcat = $_GET['sub'] ?? "*";
$q = urldecode($q);
$subcat = urlencode($subcat);



$result = ($_GET["result"]) ?? $q;

if($result != $q) {

  $result = urldecode($result);
}


$state = ($_GET["state"]) ?? "*";
$category = ($_GET["category"]) ?? "*";

if($category != "*"){
	$category = strtolower(str_replace("." , "&" , $category));
}


function isValidSubCategory() {
  global $subcat , $ad_sub_categories;
    if($subcat != "*"){

      foreach($ad_sub_categories as $ad_subs => $new_subs) {
        foreach ($new_subs as $new_sub) {
          # code...

          
          if($new_sub == $subcat ){
            return $new_sub;
          }


        }
      }


      return "*";



    }
    else {

return "*";

    }



}


function isValidState (string $state) : string {
global $states , $selected_country;
if($state == "*") {
	return $state;
}

elseif (in_array(ucfirst($state), $states[$selected_country])) {
	# code...
	return $state;
}

else {

	return "*";
}

}

$main_state = isValidState($state);
function isValidCategory (string $category) : string {
global $ad_categories;
if($category == "*") {
	return $category;


}


elseif(in_array(strtolower($category), $ad_categories)) {

	return $category;
}

else {

	return "*";
}

}

$main_category = isValidCategory($category);


$total_categories = array();
$maximum_category = "";


                class ReturnNumberOfResults extends DatabaseConnection {

                    private  $query , $state , $category , $functions , $school , $subcat;
                	

                	function __contruct(){
                	parent::__contruct();
                	}


                	 function __destruct() {
                		parent::__destruct();
                	}



                	public function getNumRowsReturned () { 
                		global $main_category , $main_state, $q , $total_categories , $maximum_category , $main_subCat;
                		$this->state = $main_state;
                		$this->functions = new Functions();
                        
                		$this->query = $this->functions->escape_string($q);
                    $this->subcat = $this->functions->escape_string($main_subCat);
                    $additional_subcat_sql = ($this->subcat == "*")?"" : "AND sub_category = '{$this->subcat}'";
         
        
                		$this->category = ($main_category == "*")?$main_category:$this->functions->escape_string($main_category);
                        $null_text="";
        $title_wild_card = ($this->query == "*")? "'%{$null_text}%'" : "'%{$this->query}%'"; 
        $additional_sql = ($this->state == "*")? "" : "AND state = '{$this->state}'";
        $sql1 = "SELECT * FROM $this->ads_table_name WHERE title LIKE $title_wild_card $additional_sql $additional_subcat_sql AND category LIKE  '%{$this->category}%'  AND closed = 0 ORDER BY last_updated DESC";
        $sql2 = "SELECT * FROM $this->ads_table_name WHERE title LIKE $title_wild_card $additional_sql $additional_subcat_sql AND closed = 0 ORDER BY last_updated DESC";

        $sql = ($this->category == "*")? $sql2 : $sql1; 

         try {
            $result = $this->conn->prepare($sql);
            $result->execute();
            $set_type_record = $result->setFetchMode(PDO::FETCH_ASSOC);
            $record = $result->fetchAll();
            $total_ads = 0;
 foreach ($record as $ad) {
                    
                $ad_id = $ad["ad_id"];
                if ($this->functions->getAdPosterDetails($ad_id)['active'] == 1){
                	  $total_ads += 1;
                
                  $current_ad_category = $ad["category"];
                  array_push($total_categories, $current_ad_category);


    
        }

    }

    if($total_ads != 0){
    $count_values_array = array_count_values(array_map('strtolower', $total_categories));
    arsort($count_values_array);
    /*
         Array ( [phones&tablets] => 26 [laptops&computers] => 1 )
         I want to get the first key returned(which is the key that holds the maximum value in the $count_values_array variable);

         i.e array_keys($count_values_array);

    */

         $category_keys = array_keys($count_values_array);

         /*
           
           $category_keys[0] will return the category with the maximum number of appearance

           i.e 
           $maximum category = $category_keys[0];



         */
           
           $maximum_category = $category_keys[0];

         /* The variable above will return something like "phones&tablets" for instance,
         now what i want to do is simply split this text to "Phones Tablets"
         */

         $maximum_category = ucwords(str_replace("&", " ", $maximum_category));
       }
       return $total_ads;



            }

            catch (PDOException $exception){
            return $exception;
        }




                	}






                }




require_once ('req/other.php');
$home_page_site_name = ucfirst($home_page_site_name);
$site_features = "Electronics , Phones , Tablets , Home , Furniture and More";
$page_title = ($result!="*")?"$result • {$home_page_site_name} " : "Search • {$home_page_site_name} ";
$page_description = "Search for  items you're looking, here on   {$home_page_site_name}.com Posted by Students";
$page_keywords = "E-commerce,Phones,Tablets,Fashion,Clothes,Laptops,Computers,Beauty,Care,students";
$selected_state = "Rivers";
$include_bootstrap = true;
$include_custom_check_box = false;
$include_bootstrap_js = true;
?>
<!DOCTYPE html <?php echo $other_doctype_attribute; ?>>
<html lang="en-us"  xmlns = "http://www.w3.org/1999/xhtml" dir="ltr">
<head>

    <?php require_once SITE_CONFIGURATIONS['HTML_FOLDER'].'meta.php'; ?>
    <?php
    if(!$functions->isLoggedInUser()){ ?>
        <link rel="stylesheet" href="<?php echo SITE_CONFIGURATIONS['CSS_FOLDER']?>default-login.css" />

    <?php } ?>
    
    <link rel="stylesheet" href="<?php echo SITE_CONFIGURATIONS['CSS_FOLDER']?>bootstrap.min.css"/>
    <link rel="stylesheet" href="<?php echo SITE_CONFIGURATIONS['CSS_FOLDER']?>animate.css">
    <link rel="stylesheet" href="<?php echo SITE_CONFIGURATIONS['CSS_FOLDER']?>owl.carousel.css">
    <link rel="stylesheet" href="<?php echo SITE_CONFIGURATIONS['CSS_FOLDER']?>main.css" />
    <link rel="stylesheet" href="<?php echo SITE_CONFIGURATIONS['CSS_FOLDER']?>responsive.css" />
    <script src="<?php echo SITE_CONFIGURATIONS['JS_FOLDER']?>universities.js"></script>
    
        <script src="<?php echo SITE_CONFIGURATIONS['JS_FOLDER']?>moment.js"></script>
        <script type="text/javascript" src="<?php echo SITE_CONFIGURATIONS["JS_FOLDER"].'search-home.js'; ?>"></script>

            <script src="<?php echo SITE_CONFIGURATIONS['JS_FOLDER']?>filter.js"></script>
           <script src="<?php echo SITE_CONFIGURATIONS['JS_FOLDER']?>livestamp.js"></script>
<style type="text/css">
.search-image-2 , .search-image-3{
	display: none;
}
.search-images {
	max-width : 180px;
	height : 120px;
 	width : auto;
    display: none;
}
</style>
</head>
<body><?php require_once SITE_CONFIGURATIONS["HTML_FOLDER"].'default-header.php'; ?>
<?php  $main_subCat = isValidSubCategory(); // require_once SITE_CONFIGURATIONS["HTML_FOLDER"].'search.php'; ?>

<div class="container-fluid">
        <div class="container container-pad" id="property-listings">
            
            <div class="row">

              <div class="col-md-12">
              <span id="search-filter-slider">
  <img  class = "search-filter-icons-text" src = "<?php echo SITE_CONFIGURATIONS["IMG_FOLDER"]."slider.png"; ?>" id = "search-filter-icon"/>
  <span class="search-filter-text search-filter-icons-text" id="search-filter-text">FILTER</span>

<?php require_once SITE_CONFIGURATIONS["HTML_FOLDER"].'search-filter.php'; ?>
</span>

              	<div class="d-flex justify-content-center align-items-center" id="main">
    <div class="inline-block align-middle">

    	<h2 class="font-weight-normal lead" id="desc"><?php 
         $returnNumberOfResults = new ReturnNumberOfResults();

    	$total_results = $returnNumberOfResults->getNumRowsReturned();
        $search_result_statement = "";

    	if($total_results == 0){


$search_result_statement = "Sorry , no results found for your search";



}


else if($result != "*" && !empty($result)){

  $search_result_statement = "Showing results \"for $result\"";
}

else if ($q != "*" and !empty($result)) {
  $search_result_statement = "Showing results \"for $q\"";
}

else {
  $search_result_statement = "Results found mostly in $maximum_category";
}


echo $search_result_statement;





    		?>


    		</h2>
    </div>
</div>
<div class="container search-filters-container" id = "search-filters-container">



</div>


                <p>Search Results Found : <span id = "number_of_search_results"> <?php


echo $total_results;
                  ?></span></p>
              </div>
            </div>
            
            <div class="row" id = "main-search-container">
            	
            	       </div><!-- End row-->
        </div><!-- End container -->
    </div>

 <p class = "load-more-icon" id = "user-ads-load-more" ><span id = "load-more-action" 
 	data-q = "<?php echo($q); ?>" data-subcat = "<?php echo $main_subCat ?>" data-ads-images = "<?php echo($config->number_of_ads_images); ?>" data-total = "0" data-state = "<?php echo isValidState($main_state);?>" data-category = "<?php echo isValidCategory($main_category); ?>"
  data-max-ad = "<?php echo $config->number_of_search_results_to_display;?>" <?php  if($total_results == 0){ echo "style='display:none;' data-load-more = '0'" ; } else {echo "data-load-more = '1' data-total-ads='0'";}?>> <span class = "load-more-plus-text">+</span><span class="load-more-text">load more</span></span>
    </p>
<div class="container loading-image-container" id = "ads-loading-image-container"><img class="img-responsive" src="<?php echo SITE_CONFIGURATIONS['IMG_FOLDER'].'spin.gif';?>" id = "loading-more-ads-image"/></div>

<?php require_once SITE_CONFIGURATIONS["HTML_FOLDER"].'default-footer.php'; ?>
</body>
</html>