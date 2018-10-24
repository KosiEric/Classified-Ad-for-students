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


class LoadMoreAd extends DatabaseConnection
{

    public $sql;
    private $functions , $config , $countries;



    function __construct() {

        global  $countries;
        parent::__construct();
        $this->functions = new Functions();
        $this->config = new Configurations();
        $this->countries = $countries;



    }




    public function isReady (): bool {
        if(isset($_POST['sql'])){
            $this->sql = $_POST['sql'];
            return true;
        }

        return false;
    }
    function __destruct(){

        parent::__destruct();
    }

    public function loadMoreAd() {

        $sql = "SELECT * FROM {$this->favorite_ads_table_name} {$this->sql}";


        try {
            $result = $this->conn->prepare($sql);
            $result->execute();
            $set_type_record = $result->setFetchMode(PDO::FETCH_ASSOC);
            $record = $result->fetchAll();


            $ads = "";
            foreach ($record as $adv) {

                $ad_id = $adv["ad_id"];
                $ad = $this->functions->getAdDetails($ad_id);
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
                $views = number_format($ad["views"]);
                $number_of_favorites = $this->functions->getNumAdFavorites($ad_id);
                $favorite_count = ($number_of_favorites > 0) ? $number_of_favorites : "";
                $ads.= <<<AD_HTML


        <div class="col-xs-12 col-sm-6 col-md-3 rwrapper">
                         <div class="item-price">
                            <span><strong>{$poster_currency}</strong> {$amount_format}</span>
                        </div>
            <div class="rlisting">
                <div class="col-md-12 nopad ad-image-list-containers"  style="background-image: url('{$this->functions->getAdImages($ad_id)[0]}')">
                    <a href="/ad/{$ad_id}"> <img src="{$this->functions->getAdImages($ad_id)[0]}" class="img-responsive ad-image-listing"></a>
                </div>
                <div class="col-md-12 nopad">
                    <h3><a class="ad-list-title" href="/ad/{$ad_id}">{$title}</a></h3>
                    <p><span class="ad-list-description">{$description}</span><span class = "poster-university">{$poster_university}</span></p>
                    <div class="rfooter">
                               
<div class="item-post-date">
                                <span data-livestamp="{$time_posted}"></span>
                            </div>
                            <ul class="list-inline product-social">
                                <li><a href="#" class="ad-list-condition">{$condition}</a></li>
                                <li><a {$this->functions->favoriteAdToggle($ad_id)} ><i class="{$this->functions->favoritedAdIconToggle($ad_id)} ad-list-icons ad-fav-icon" aria-hidden="true" id = "{$ad_id}-heart-icon"></i><span id = '{$ad_id}-favs-count' class = "ad-list-num-views favorites-count {$ad_id}">{$favorite_count}</span></a></li>
                                <li><a href="#"><i class="fa fa-eye ad-list-eye ad-list-icons" aria-hidden="true"></i><span class = "ad-list-num-views">{$views}</span></a></li>
                            </ul>
                         
                    </div>
                </div>
            </div>
        </div>


                    
AD_HTML;


            }

            if($ads != ""){
                return $ads;
            }
            else {
                return 0;
            }
        }
        catch (PDOException $exception){
            return $exception;
        }

    }


}

$loadMoreAd = new LoadMoreAd();
if($loadMoreAd->isReady()){
    echo $loadMoreAd->loadMoreAd();

}


?>