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

class postAd extends DatabaseConnection
{


    /* TODO: Declaring all the class variables */

    private $track_ad_link,  $data , $image_error = "",  $error , $title , $amount , $category , $sub_category , $description , $contact_for_price , $network_error = "connection failed,try checking your network connection",
    $condition , $negotiable , $ad_id , $posted_by , $post_date , $post_time , $functions , $photo_names , $ad_image1 , $ad_image2 , $ad_image3 , $state ,$school ;


   private function success_message () : string  {
       global  $default_site_pages;
       $track_ad_link = array_keys($default_site_pages)[0]; // from config.php
       return "Ad Posted successfully,  click <strong><a href = '{$track_ad_link}'>Here</a> to Track all your ads</strong>";
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

    private function  image_upload_error(int $image_number ) : string  {

        return "sorry , image {$image_number} failed to upload, try uploading another";
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
        $this->state = $this->functions->getUserDetails($this->posted_by)["state"];
        $this->school = $this->functions->getUserDetails($this->posted_by)["school"];
        $this->post_date = date("Y-m-d h:i:sa");
        $this->post_time = time();
        $this->contact_for_price = $_POST["contactForPrice"];
        $configurations = new Configurations();
        $this->ad_id = $this->functions->generateID($configurations->length_of_ad_id);

        $this->ad_image1 = $_FILES["image1"];
        $this->ad_image2 = $_FILES["image2"];
        $this->ad_image3 = $_FILES["image3"];

        $photo1extension = $this->functions->getExtension($this->ad_image1["name"]);
       $photo2extension = $this->functions->getExtension($this->ad_image2["name"]);
       $photo3extension = $this->functions->getExtension($this->ad_image3["name"]);
       $this->photo_names = "{$this->ad_id}-1{$photo1extension},{$this->ad_id}-2{$photo2extension},{$this->ad_id}-3{$photo3extension}";
        if($this->record_exists_in_table($this->ads_table_name , "ad_id" , $this->ad_id)){
            $this->setDetails();

        }


        return true;


   }

   private  final function  insert_into_ads () : bool  {

        $sql = "INSERT INTO {$this->ads_table_name} (id , ad_id , title , contact_for_price , description , category , sub_category , product_condition , 
amount , negotiable , photos , posted_by , post_date , post_time , last_updated , state , school ,  views , closed) VALUES (null , '{$this->ad_id}' , '{$this->title}' , 
'{$this->contact_for_price}' ,'{$this->description}' , '{$this->category}' , '{$this->sub_category}' , '{$this->condition}' , '{$this->amount}' , '{$this->negotiable}' , '{$this->photo_names}' , 
'{$this->posted_by}' , '{$this->post_date}' , '{$this->post_time}' , '{$this->post_time}' , '{$this->state}', '{$this->school}', '0' , '0')";

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




    private function  isValidImage (int $image_number) :  bool
    {
        global $max_ad_image_size;
        $functions = $this->functions;
        $images = Array("a" , $this->ad_image1 , $this->ad_image2 , $this->ad_image3);
        $ads_images_directories = Array("a" , $functions->ad_image_1_upload_directory , $functions->ad_image_2_upload_directory , $functions->ad_image_3_upload_directory);

        $image = $images[$image_number];
        $file_name = $image['name'];
        $file_size = $image['size'];
        $file_type = $image['type'];
        $file_error = $image['error'];
        $tmp_name = $image['tmp_name'];


        $functions = $this->functions;
        $is_image = $functions->isImage($tmp_name);
        $is_file_type = $functions->isFileType($file_name , 'image' , $ads_images_directories[$image_number]);
        $is_file_size = $functions->isFileSize($file_size , $max_ad_image_size);

        if($is_image){
            if($is_file_type) {
                if($is_file_size) {
                    return true;
                }
                else {
                    $max_image_size_mb = round($max_ad_image_size / 1000000);
                    $this->image_error = "Max image size allowed : {$max_image_size_mb} for for image {$image_number}";
                    return false;
                }
            }
            else {

                $this->image_error = "Only .png , .jpg  and .jpeg images are allowed for image {$image_number}";
                return false;
            }
        }
        else {
            $this->image_error = "Only .png , .jpg  and .jpeg images are allowed for image {$image_number}";
            return false;
        }




    }


    private  final function  upload_image ($image , $image_number)
    {
        $functions = $this->functions;

        $filename = $image["name"];
        $tmp_name = $image["tmp_name"];
        $new_name = $functions->changeFileName($filename, "{$this->ad_id}-{$image_number}");
        $ads_images_directories = Array("" , $functions->ad_image_1_upload_directory , $functions->ad_image_2_upload_directory , $functions->ad_image_3_upload_directory);
        $target_dir = $ads_images_directories[$image_number];
        $new_filename = $target_dir . $new_name;
        if (move_uploaded_file($tmp_name, $new_filename)) {
            return true;
        } else {
            $this->image_error = $this->image_upload_error($image_number);
            return false;
        }
    }

    public function  processor () {
        global $number_of_ads_images; // from config.php;
    if($this->isReady()){
       if($this->setDetails()) {
           for ($i = 1; $i <= $number_of_ads_images; $i++) {

               if (!$this->isValidImage($i)) {

                   $this->error = Array("success" => 0, "error" => $this->image_error);
                   $this->error = json_encode($this->error);
                   return $this->error;
               }
           }
           $images_to_upload = Array("a", $this->ad_image1, $this->ad_image2, $this->ad_image3);
           for ($i = 1; $i <= $number_of_ads_images; $i++) {
               if (!$this->upload_image($images_to_upload[$i], $i)) {
                   $this->error = array("success" => 0, "error" => $this->image_error);
                   $this->error = json_encode($this->error);
                   return $this->error;
               }
           }

           if ($this->insert_into_ads()) {
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

$post_ad = new postAd();
//post_ad->isReady();

 echo $post_ad->processor();
?>


