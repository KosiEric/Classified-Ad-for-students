<?php

header('Content-Type: application/json');
session_start();
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

global $countries , $selected_country , $selected_state , $home_page_site_url , $home_page_site_name , $image_folder;

class editAd extends DatabaseConnection
{


    /* TODO: Declaring all the class variables */

    private $track_ad_link,  $data , $image_error = "",  $error , $title , $amount , $category , $sub_category , $description , $contact_for_price , $network_error = "connection failed,try checking your network connection",
        $condition , $negotiable , $ad_id , $posted_by , $post_date , $post_time , $functions , $photo_names , $ad_image1 , $ad_image2 , $ad_image3;


    private function success_message () : string  {
        global  $default_site_pages;
        $track_ad_link = array_keys($default_site_pages)[0]; // from config.php
        return "Ad edited successfully,  click <strong><a href = '{$track_ad_link}'>Here</a> to Track all your ads</strong>";
    }

    function __construct()
    {

        /* TODO : Parent::__construct() Establishes a database connection i.e DatabaseConnection Class in Security/database */


        parent::__construct();
        $this->functions = new Functions();

    }
    function __destruct()
    {
        // TODO: Parent::__destruct() ends the  the  database connection i.e DatabaseConnection Class in Security/database

        parent::__destruct();

    }

    public  final   function isReady () : bool
    {

        if($_SERVER["REQUEST_METHOD"] == "POST") {

            $this->data = ($_POST) ?? null;
            if($this->data != null)
                return true;
            return false;

        }

    }


    private final  function  setDetails () : bool {
        $conn=mysqli_connect("{$this->database_host}","{$this->database_username}","{$this->database_password}","{$this->database}");

        $this->title = mysqli_real_escape_string($conn , ucfirst($_POST["adTitle"]));
        $this->category = $_POST['adCategory'];
        $this->sub_category = $_POST['adSubCategory'];
        $this->condition = $_POST['adItemCondition'];
        $this->description = mysqli_real_escape_string($conn , ucfirst($_POST["adDescription"]));

        $this->amount = $_POST["adAmount"];

        $this->negotiable = $_POST["adNegotiable"];
         $this->posted_by = $_POST["adPostedBy"];
        $this->post_date = date("Y-m-d h:i:sa");
        $this->post_time = time();
        $this->contact_for_price = $_POST["contactForPrice"];
        $configurations = new Configurations();
        $this->ad_id = $_POST["adID"];




        return true;



    }

    private  final function  update_ad () : bool  {


        $sql = "UPDATE {$this->ads_table_name} SET title = '{$this->title}' , contact_for_price = '{$this->contact_for_price}' , description = '{$this->description}' , category = '{$this->category}' , sub_category = '{$this->sub_category}' , product_condition = '{$this->condition}' , amount = '{$this->amount}' 
, negotiable = '{$this->negotiable}' , last_updated = '{$this->post_time}' , closed = '0' WHERE ad_id = '{$this->ad_id}'";

        try {

            $result = $this->conn->prepare($sql);
            $result->execute();

            return true;

        }

        catch (PDOException $exception) {
            echo "Error occured {$exception->getMessage()}";
            return false;
        }



    }



    public function  processor () {
        global $number_of_ads_images; // from config.php;
        if($this->isReady()){
            if($this->setDetails()) {

                if ($this->update_ad()) {
                    $this->error = array("success" => 1, "error" => $this->success_message());
                    $this->error = json_encode($this->error);
                    return $this->error;
                } else {
                    $this->error = array("success" => 0, "error" => $this->network_error);
                    $this->error = json_encode($this->error);
                    return $this->error;
                }


            }

        }

    }



}

$edit_ad = new editAd();
//post_ad->isReady();

echo $edit_ad->processor();
?>


