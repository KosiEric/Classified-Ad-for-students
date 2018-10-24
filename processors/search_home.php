<?php

//header('Content-Type: application/json');
function isValidRequest()
{
    $request_method = $_SERVER['REQUEST_METHOD'];
    $expected_request_method = 'POST';
    if ($request_method != $expected_request_method) {
        return false;

    }


    exit("Request failed");

}




require_once '../security/config.php';
require_once '../security/database.php'; // Required for Necessary Database Connections.
require '../phpmailer/PHPMailerAutoload.php';


class LoadSuggestions extends DatabaseConnection
{

    public $query;
    private $functions , $data , $config , $countries , $state , $category , $school , $subcat;



    function __construct() {

        global  $countries;
        parent::__construct();
        $this->functions = new Functions();
        $this->config = new Configurations();
        $this->countries = $countries;
        


    }




    public function isReady (): bool {
        if(isset($_POST['data'])){
            $this->data = json_decode($_POST['data'] , true);
            $this->query = $this->data["query"];
            $this->state = $this->data["state"];
            $this->category = $this->data["category"];
            $this->max = $this->data["max"];
            $this->total = $this->data["total"];
            $this->school = $this->data["school"];
            $this->subcat = $this->data["subcat"];


            return true;
        }

        return false;
    }


    function __destruct(){

        parent::__destruct();
    }

    public function LoadSuggestions() {
        $this->query = $this->functions->escape_string($this->query);
        $this->category = ($this->category == "*")?$this->category:$this->functions->escape_string($this->category);
        $this->school =  $this->functions->escape_string($this->school);
        $this->subcat = $this->functions->escape_string($this->subcat); 
        $additional_sql = ($this->state == "*")? "" : "AND state = '{$this->state}'";
        $additional_school_sql = ($this->school=="*")? "" : "AND school = '{$this->school}'";
        $additional_subcat_sql = ($this->subcat == "*")?"" : "AND sub_category = '{$this->subcat}'";
        $null_text = "";
        $title_wild_card = ($this->query == "*")? "'%{$null_text}%'" : "'%{$this->query}%'";


         $sql1 = "SELECT * FROM $this->ads_table_name WHERE title LIKE $title_wild_card AND category LIKE  '%{$this->category}%' $additional_sql $additional_school_sql $additional_subcat_sql AND closed = 0 ORDER BY last_updated DESC LIMIT {$this->total} ,  {$this->config->number_of_search_results_to_display}";
        $sql2 = "SELECT * FROM $this->ads_table_name WHERE title LIKE $title_wild_card  $additional_sql $additional_school_sql $additional_subcat_sql AND closed = 0 ORDER BY last_updated DESC LIMIT {$this->total} ,    {$this->config->number_of_search_results_to_display}";
        $sql3 =  "SELECT * FROM $this->ads_table_name WHERE title LIKE $title_wild_card AND category LIKE  '%{$this->category}%' $additional_sql $additional_school_sql $additional_subcat_sql AND closed = 0 ORDER BY last_updated DESC";

        $sql4 = "SELECT * FROM $this->ads_table_name WHERE title LIKE $title_wild_card  $additional_sql $additional_school_sql $additional_subcat_sql AND closed = 0 ORDER BY last_updated DESC";

        $sql5 =  ($this->data['category'] == "*")? $sql4 : $sql3; 

        $sql = ($this->data['category'] == "*")? $sql2 : $sql1; 

        
    
        try {
            $result = $this->conn->prepare($sql);
            $result_2 = $this->conn->prepare($sql5);


            $result->execute();
            $result_2->execute();

            $set_type_record = $result->setFetchMode(PDO::FETCH_ASSOC);
            $set_type_record_2 = $result_2->setFetchMode(PDO::FETCH_ASSOC);


            $record = $result->fetchAll();
            $record_2 = $result_2->fetchAll();
            //print_r($record_2);
            $length_of_result = count($record_2);


            $ads = "";

            $total_ads_title = "";
                
                if(count($record) == 0){
                          return 0;
                
                }
            foreach ($record as $ad) {

                $ad_id = $ad["ad_id"];
                
                $query = strtolower($this->query);
                if ($this->functions->getAdPosterDetails($ad_id)['active'] == 1){
                
                $amount_format = "";

                $description = str_replace('<br />', ' ', $this->functions->short_to_length($ad["description"], $this->config->ad_description_length_to_show, 3));
                $title = $this->functions->short_to_length($ad["title"], $this->config->ad_title_length_to_show, 3);
                $poster_university = $this->functions->short_to_length($this->functions->getAdPosterDetails($ad_id)["school"], $this->config->ad_university_length_to_show);
                $poster_country = $this->functions->getAdPosterDetails($ad_id)["country"];
                $poster_currency = "";

                if (is_numeric($ad["amount"])) {
                    $amount_format = number_format($ad["amount"]);
                    $poster_currency = $this->countries[$poster_country]["currency_sign"];

                } else {
                    $amount_format = $ad["amount"];
                    $poster_currency = "";
                }

                $time_posted = $ad["post_time"];
                $condition = $ad["product_condition"];
                $views = ($ad["views"] > 1)?number_format($ad["views"]) : "";
                $views_text = ($ad["views"] > 1)? "<i class='fa fa-eye' class='search-views-text'></i>" : "";
                $number_of_favorites = $this->functions->getNumAdFavorites($ad_id);
                $favorite_count = ($number_of_favorites > 0) ? $number_of_favorites : "";   
                $category_text = ucwords(str_replace("&", " " , $ad["category"]));
                $ads.= 
                <<<AD_HTML
                
<div class="col-sm-6">  
                    <!-- Begin Listing: 609 W GRAVERS LN-->

                    <div class="brdr bgc-fff pad-10 box-shad btm-mrg-20 property-listing">
                        <div class="media">
                            <a class="pull-left search-images-containers" data-bg-image-1 = "{$this->functions->getAdImages($ad_id)[0]}" data-bg-image-2 = "{$this->functions->getAdImages($ad_id)[1]}"
                            data-bg-image-3 = "{$this->functions->getAdImages($ad_id)[2]}" style="background-image: url('{$this->functions->getAdImages($ad_id)[0]}')" href="/ad/{$ad_id}" target="_parent" href = "/ad/{$ad_id}">
                            <img alt="{$title} image 1" class="img-responsive search-image-1 search-images" src="{$this->functions->getAdImages($ad_id)[0]}" />
                            <img alt="{$title} image 2"  class="img-responsive search-image-2 search-images" src="{$this->functions->getAdImages($ad_id)[1]}" class = "other-search-images"  />
                            <img alt="{$title} image 3"  class="img-responsive search-image-3 search-images" src="{$this->functions->getAdImages($ad_id)[2]}" />
                            
                            

                            </a>

                            <div class="clearfix visible-sm"></div>

                            <div class="media-body fnt-smaller">
                                <a href="#" target="_parent"></a>

                                <h4 class="media-heading">
                                  <a href="#" target="_parent"><span class ="search-list-price">{$poster_currency}{$amount_format}</span> <small class="pull-right search-list-views">{$views_text} {$views} </small></a></h4>


                                <ul class="list-inline mrg-0 btm-mrg-10 clr-535353">
                                  <span class="search-ad-list-title">{$title}</span>
                                    <li class = "search-list-university"><i class = "fa fa-graduation-cap    search-university-icon"></i><span class="search-result-poster-university">{$poster_university}</span></li>

                                    <!--<li style="list-style: none">|</li>-->

                                    <li class = "search-category-list"><i class="fa fa-bars search-category-list-icon" ></i>{$category_text}</li>

                                    <!--<li style="list-style: none">|</li>-->

                                    <li class = "search-time-posted-list"><i class="fa fa-clock-o search-list-time"></i><span data-livestamp="{$time_posted}"></span></li>
                                </ul>

                                <p class="hidden-xs search-list-description">{$description}</p><span class="fnt-smaller fnt-lighter search-list-ad-condition" fnt-arial">Condition : {$condition}</span>
                            </div>
                        </div>
                    </div><!-- End Listing-->

                  </div><!-- End Col -->

AD_HTML;
                
                
            }

            

}

if($ads == ""){
  return 0;
}
else {
  return json_encode(Array("ads" => $ads , "total_ads" => $length_of_result));
}

          }
        catch (PDOException $exception){
            return $exception;
        }

    }




}

$loadSuggestions = new LoadSuggestions();
if($loadSuggestions->isReady()){
    echo $loadSuggestions->LoadSuggestions();

}


?>