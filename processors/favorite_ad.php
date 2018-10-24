<?php

header('Content-Type: application/json');

function isValidRequest()
{
    $request_method = $_SERVER['REQUEST_METHOD'];
    $expected_request_method = 'POST';
    if ($request_method != $expected_request_method) {
        return false;

    }


    exit("Request failed");

}



require_once '../security/functions.php';
require_once '../security/config.php';

class favoriteAd extends  DatabaseConnection {

    private $data ,  $user_id , $ad_id , $action ,$functions , $error;

    function __construct()
    {
        parent::__construct();
        $this->functions = new Functions();
    }

    function  __destruct()
    {
        // TODO: Implement __destruct() method.

        parent::__destruct();
    }

    public function  isReady () :bool {
        if (isset($_POST["data"]) and !empty($_POST["data"])){
            return true;
        }
        else {
            return false;
        }
    }

    public function  setDetails () : bool {
        $this->data = json_decode($_POST["data"] , true);
        $this->user_id = $this->data["user_id"];
        $this->action = $this->data["action"];
        $this->ad_id = $this->data["ad_id"];
        return true;
    }

    public function  takeAction () : bool {
        global $general_date;
        $time = time();
      if($this->action == 1){

$sql = "INSERT INTO {$this->favorite_ads_table_name} (user_id , ad_id , date_favorited , time_favorited) VALUES  ('{$this->user_id}' , '{$this->ad_id}' , '{$general_date}' , '{$time}')";

            if( $this->conn->exec($sql)){

                return true;
            }

            else   {

                //echo $exception->getMessage();
                return false;
            }


        }
        else if($this->action == 0){

            $sql = "DELETE FROM favorite_ads WHERE ad_id = '{$this->ad_id}' AND user_id ='{$this->user_id}'";

            if( $this->conn->exec($sql)){

                return true;
            }

            else   {

                //echo $exception->getMessage();
                return false;
            }

        }
    }

    public function  processor() {
        if($this->isReady()){
            if($this->setDetails()){
                if($this->takeAction()){
                    $new_action = ($this->action == 0)? 1 : 0;
                    $this->error = Array("success" => 1 , "action" => intval($new_action) , "numberOfFavorites" => $this->functions->getNumAdFavorites($this->ad_id));
                   $this->error = json_encode($this->error);
                    return $this->error;
                }
            }
        }
    }

}

$favorite_ad = new FavoriteAd();
echo $favorite_ad->processor();
?>