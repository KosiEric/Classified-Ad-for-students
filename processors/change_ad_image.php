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

    private  $data , $image_error = "",  $error , $network_error = "connection failed,try checking your network connection",
         $ad_id  , $post_date , $post_time , $functions , $photo_names , $ad_image , $image_number;


    private function success_message () : string  {
        global  $default_site_pages;
        $track_ad_link = array_keys($default_site_pages)[0]; // from config.php
        return "image uploaded successfully";
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


    public final  function  setDetails () : bool {
        $conn=mysqli_connect("{$this->database_host}","{$this->database_username}","{$this->database_password}","{$this->database}");

        $this->ad_id = $_POST['adID'];


        $this->image_number = $_POST['imageNumber'];
        $this->ad_image = $_FILES["image".$this->image_number];

        $this->post_time = time();

        $photoextension = $this->functions->getExtension($this->ad_image["name"]);


       $this->photo_names = "{$this->ad_id}-{$this->image_number}{$photoextension}";
        return true;


    }


    private function  isValidImage (int $image_number) :  bool
    {
        global $max_ad_image_size;
        $functions = $this->functions;
        $images = Array("a" , $this->ad_image);
        $ads_images_directories = Array("a" , $functions->ad_image_1_upload_directory , $functions->ad_image_2_upload_directory , $functions->ad_image_3_upload_directory);

        $image = $images[1];
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

    private  final function  update_ad () : bool  {


        $sql = "UPDATE {$this->ads_table_name} SET  
last_updated = '{$this->post_time}' , closed = '0' WHERE ad_id = '{$this->ad_id}'";

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


    private  final function  delete_and_upload_image ($image , $image_number)
    {
        $functions = $this->functions;

        $filename = $image["name"];
        $tmp_name = $image["tmp_name"];
        $new_name = $functions->changeFileName($filename, "{$this->ad_id}-{$image_number}");
        $old_image = realpath($functions->getAdImages($this->ad_id)[$this->image_number - 1]);
        if(!unlink($old_image))
            return false;

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

                    if (!$this->isValidImage($this->image_number)) {

                        $this->error = Array("success" => 0, "error" => $this->image_error);
                        $this->error = json_encode($this->error);
                        return $this->error;

                }
                $images_to_upload = Array("a", $this->ad_image);
                    if (!$this->delete_and_upload_image($images_to_upload[1], $this->image_number)) {
                        $this->error = array("success" => 0, "error" => $this->image_error);
                        $this->error = json_encode($this->error);
                        return $this->error;
                    }
                }

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

$post_ad = new postAd();
//post_ad->isReady();

echo $post_ad->processor();
?>


