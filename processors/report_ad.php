<?php

header('Content-Type: application/json');
//session_start();
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
require_once '../security/database.php'; // Required for Necessary Database Connections.
require '../phpmailer/PHPMailerAutoload.php';


class reportAd extends DatabaseConnection
{
    private $comment , $reason , $ad_id , $report_id , $data , $functions , $configurations , $error , $time , $success_msg = "Report sent successfully!";

    public function __construct()
    {
        // TODO: Implement __destruct() method.
        parent::__construct();
        $this->functions = new Functions();
        $this->configurations = new Configurations();
    }

    public function __destruct()
    {
        // TODO: Implement __destruct() method.
        parent::__destruct();
    }

    private final function setDetails () : bool {
        $this->data = json_decode($_POST['data'] , true);
        $functions  = new Functions();
        $this->comment = $functions->escape_string(strtolower($this->data["comment"]));
        $this->reason =  $this->data['reason'];
        $this->ad_id = $this->data["ad_id"];
        $this->report_id = $this->functions->generateID($this->configurations->length_of_report_id);
        $this->time = time();
        if($this->record_exists_in_table($this->reported_ads_table_name , 'report_id' , $this->report_id))
              $this->setDetails();
        return true;

}

private final function  isReady () : bool {
        if(isset($_POST['data']) and !empty($_POST['data']))
            return true;
        return false;

}

private final  function  mainAction () {
        $sql = "INSERT INTO {$this->reported_ads_table_name} (ad_id , report_id , time_reported , reason , comment)  
                VALUES ('{$this->ad_id}' , '{$this->report_id}' , '{$this->time}' , '{$this->reason}' , '{$this->comment}')";
        if( $this->conn->exec($sql)){

        return true;
    }

    else   {

        //echo $exception->getMessage();
        return false;
    }



}

public  final  function  Processor (){
        if($this->isReady()){
            if($this->setDetails()){
                if($this->mainAction()){
                    $a_year_from_now = (86400 * 365) + $this->time;
                    $current_reported_ads = null;
                    if(isset($_COOKIE['reported_ads'])){
                         $current_reported_ads = json_decode($_COOKIE['reported_ads'] , true);
                         array_push($current_reported_ads , $this->ad_id);
                     }
                     else {
                        $current_reported_ads = Array($this->ad_id);
                     }

                    setcookie("reported_ads" , json_encode($current_reported_ads) , $a_year_from_now , "/");
                    $this->error = Array("success" => "1" , "error" => $this->success_msg);
                    return json_encode($this->error);

                }
            }
        }
}
}


$report_ad = new reportAd();
echo $report_ad->Processor();