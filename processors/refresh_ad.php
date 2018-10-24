<?php

header('Content-Type: application/json');

function changeAdStatus()
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

class ChangeAdStatus extends  DatabaseConnection
{

    private  $ad_id, $functions , $error;

    function __construct()
    {
        parent::__construct();
        $this->functions = new Functions();
    }

    function __destruct()
    {
        // TODO: Implement __destruct() method.

        parent::__destruct();
    }

    public function isReady(): bool
    {
        if (isset($_POST["id"]) and !empty($_POST["id"])) {
            return true;
        } else {
            return false;
        }
    }

    private function  setDetails () : bool {
        $this->ad_id = $_POST["id"];
        return true;
    }

    public function  takeAction () : bool  {
        $time = time();
        $this->update_record($this->ads_table_name , 'last_updated' , "{$time}" , 'ad_id' , $this->ad_id);
        return true;


    }
    public function  Processor () {
        if($this->isReady()){
            if($this->setDetails()){
                if($this->takeAction()){
                    $this->error = Array("success" => "1" , "error" => "None");
                    $this->error = json_encode($this->error);
                    return $this->error;
                }

            }
        }
    }

}

$change_ad_status = new ChangeAdStatus();
echo $change_ad_status->Processor();