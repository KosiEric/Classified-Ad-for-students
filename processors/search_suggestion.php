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
    private $functions , $data , $config , $countries , $state , $category;



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
        $additional_sql = ($this->state == "*")? "" : "AND state = '{$this->state}'";
        $sql1 = "SELECT * FROM $this->ads_table_name WHERE title LIKE '%{$this->query}%' AND category LIKE  '%{$this->category}%'  AND closed = 0 $additional_sql ORDER BY last_updated DESC LIMIT {$this->config->number_of_search_suggestions_to_display}";
        $sql2 = "SELECT * FROM $this->ads_table_name WHERE title LIKE '%{$this->query}%'   AND closed = 0 $additional_sql ORDER BY last_updated DESC LIMIT {$this->config->number_of_search_suggestions_to_display}";

        $sql = ($this->data['category'] == "*")? $sql2 : $sql1; 

        
    
        try {
            $result = $this->conn->prepare($sql);
            $result->execute();
            $set_type_record = $result->setFetchMode(PDO::FETCH_ASSOC);
            $record = $result->fetchAll();


            $ads = "";
            $results_number = 1;
            $first_result = "";
            $total_ads_title = "";
                
                if(count($record) == 0){
                          return 0;
                
                }
            foreach ($record as $ad) {
                
                $ad_id = $ad["ad_id"];
                $title = strtolower($ad['title']);
                $query = strtolower($this->query);
                if ($this->functions->getAdPosterDetails($ad_id)['active'] == 1){
                /* if($this->state != "*" && ($this->functions->getAdPosterDetails($ad_id)["state"] != $this->state)) 
                      continue;
                */
                if($results_number == 1){
                  $first_result.=$ad["title"];

                } 

                $results_number++;
                $title_words = explode(" ", $ad["title"]);
                 $title_string = "";
                 $continue = false;

                 if (substr($title, 0 , strlen($query)) == $query) {
                      $substring = substr($title, 0 , strlen($query));
                      $other_words = substr($title, strlen($query));
                                           $title_string = "<font class = 'search-words'>$substring</font> {$other_words}";
                                          
                     $continue = true;
                      }

                foreach ($title_words as $words => $word) {
                    if($continue){
                        continue;
                    }
                    $word_letters = str_split($word);
                   
                         $total_word_letters = ""; 
                         $total_word_string = "";
                    foreach ($word_letters as $letters => $letter) {
                        # code...
                          $total_word_letters.= $letter;
                      
                      

                      if(strtolower($total_word_letters) == strtolower($this->query)) {
                          $total_word_string = "<font class = 'search-words'>$total_word_letters</font>";


                      }
                      else {
                        $total_word_string .= $letter;
                      }

                    }
                    

                    $title_string.= $total_word_string." ";


                    






                    # code...
                }

                $cat = str_replace("&", ".", $this->category);
                $encoded_string = urlencode($query);
                $encoded_string_2 = urlencode($ad["title"]);
                $total_ads_title.= "<a class='search-suggestion search-results' href = '/search?q={$encoded_string}&result={$encoded_string_2}&state={$this->state}&cat={$cat}'><span class = search-suggestion-texts>$title_string</span></a>";





                                               //$total_words.="<a class='search-suggestion search-results' href = '/ad/{$ad_id}'>$total_word</a>



                
            }

            

}
if ($total_ads_title != ""){
return json_encode(Array("ads" => $total_ads_title , "firstResult" => $first_result));

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

$loadSuggestions = new LoadSuggestions();
if($loadSuggestions->isReady()){
    echo $loadSuggestions->LoadSuggestions();

}


?>