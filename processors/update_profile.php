<?php

header('Content-Type: application/json');
//session_start();


require_once '../security/functions.php';
require_once '../security/config.php';
require_once '../security/database.php'; // Required for Necessary Database Connections.

global $countries , $selected_country , $selected_state , $home_page_site_url , $home_page_site_name , $image_folder;

class updateUserProfile extends DatabaseConnection
{


    /* TODO: Declaring all the class variables */

    private  $data, $name, $email, $primary_contact , $secondary_contact , $state , $school ,  $username, $profile , $action ,  $error, $success,  $verification_code,
        $email_address_exists_error = "email address already registered", $userID ,
        $success_message = "Account updated successfully!" , $functions , $image_error , $primary_contact_exists_error = "Sorry , 
        primary contact belongs to another profile" , $secondary_contact_exists_error = "secondary contact belongs to another profile" , $network_error = "seems we are having issues with your connection!" ,
        $password_reset_code , $email_verification_code , $image_upload_error = "failed to upload image, please try again sometime" , $user_profile_image
     ,  $existing_user_details , $upload_image;



    function __construct()
    {

        /* TODO : Parent::__construct() Establishes a database connection i.e DatabaseConnection Class in Security/database */


        parent::__construct();

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

    public final function setDetails () : bool
    {
        if (isset($_POST["email"])) {
            $time = time();
            $this->name = ucwords($_POST["name"]);
            $this->email = strtolower($_POST["email"]);
            $this->primary_contact = $_POST["primary"];
            $this->secondary_contact = $_POST["secondary"];
            $this->state = $_POST["state"];
            $this->school = $_POST["school"];
            $this->username = $_POST["username"];
            $this->profile = $_FILES["profile"];
            $this->functions = new Functions();
            $this->existing_user_details = $this->fetch_data_from_table($this->users_table_name, "user_id", $_COOKIE["current_active_user"])[0];
            $this->userID = $this->existing_user_details["user_id"];
            $this->upload_image = $_POST["uploadImage"];
            return true;


        }
        else {
            return false;
        }
    }


    private  final  function  is_email() : bool
    {
        $current_email_address = strtolower($this->existing_user_details["email_address"]);
        $email_address = strtolower($this->email);

        if ($current_email_address == $email_address) {

            return true;
        }
        elseif ($this->record_exists_in_table($this->users_table_name, "email_address", $this->email)){
               return false;
        }

        else {
            return true;
        }
    }


    private  final function is_primary_contact () : bool {
    if($this->primary_contact == $this->existing_user_details["primary_phone"]){
        return true;
    }

    else if($this->primary_contact == $this->existing_user_details["secondary_phone"]) {
        return true;
    }
    elseif(!$this->record_exists_in_table($this->users_table_name , "primary_phone" , $this->primary_contact) &&
            !$this->record_exists_in_table($this->users_table_name , "secondary_phone" , $this->primary_contact)){
            return true;
        }

        return false;
    }



    private final function is_secondary_contact () : bool {

        if($this->secondary_contact == $this->existing_user_details["secondary_phone"]){
            return true;
        }
        else if($this->secondary_contact == $this->existing_user_details["primary_phone"]){
            return true;
        }
        else if(!$this->record_exists_in_table($this->users_table_name , "primary_phone" , $this->secondary_contact) &&
            !$this->record_exists_in_table($this->users_table_name , "secondary_phone" , $this->secondary_contact)){
            return true;
        }
        return false;
    }

    private  function  isValidImage () :  bool
    {
        global $max_user_profile_image_size;

        $profile = $_FILES['profile'];


        $file_name = $profile['name'];
        $file_size = $profile['size'];
        $file_type = $profile['type'];
        $file_error = $profile['error'];
        $tmp_name = $profile['tmp_name'];


        $functions = $this->functions;
        $is_image = $functions->isImage($tmp_name);
        $is_file_type = $functions->isFileType($file_name , 'image' , $functions->profile_upload_directory);
        $is_file_size = $functions->isFileSize($file_size , $max_user_profile_image_size);

        if($is_image){
            if($is_file_type) {
                if($is_file_size) {
                    return true;
                }
                else {
                    $max_image_size_mb = round($max_user_profile_image_size / 1024);
                    $this->image_error = "Max image size allowed : $max_image_size_mb";
                    return false;
                }
            }
            else {

                $this->image_error = "Only .png , .jpg  and .jpeg images are allowed";
                return false;
            }
        }
        else {
            $this->image_error = "Only .png , .jpg  and .jpeg images are allowed";
            return false;
        }




    }



    private  final function  upload_image () : bool
    {
        $functions = $this->functions;

        $filename = $this->profile["name"];
        $tmp_name = $this->profile["tmp_name"];
        $new_name = $functions->changeFileName($filename, $this->userID);

        $target_dir = $functions->profile_upload_directory;
        $new_filename = $target_dir . $new_name;
        if (move_uploaded_file($tmp_name, $new_filename)) {
            $this->user_profile_image = $new_name;
            return true;
        } else {
            $this->image_error = $this->image_upload_error;
            return false;
        }
    }

    private function  updateProfile() : bool {
        global  $selected_country;
        $selected_country = ucwords($selected_country);
        if($this->user_profile_image){
            $profile_image = $this->user_profile_image;
        }
        else {
            $profile_image = $this->existing_user_details["profile"];
        }

        $sql = "UPDATE {$this->users_table_name} set username = '{$this->username}' ,  email_address = '{$this->email}' , 
      
        full_name = '{$this->name}' , primary_phone = '{$this->primary_contact}' , secondary_phone = '{$this->secondary_contact}' , 
        state = '{$this->state}' , country = '{$selected_country}', school = '{$this->school}' , profile = '{$profile_image}' WHERE user_id = '{$this->userID}' 
";
        $result = $this->conn->prepare($sql);
        $result->execute();
        return true;

    }

    private function try_set_email_unverified () : bool {
        if(strtolower($this->existing_user_details["email_address"]) != strtolower($this->email)){
            $this->update_record($this->users_table_name , "email_verified" , "0" , "user_id"  , $this->userID);
            return true;
        }
        return true;
    }

    public function  processor ()  {


        if($this->isReady() && $this->setDetails()){

            if($this->is_email()) {

if($this->is_primary_contact()){

    if($this->is_secondary_contact()){

$this->update_record($this->ads_table_name, "school" , $this->school , "posted_by" , $this->userID);
        $this->update_record($this->ads_table_name, "state" , $this->state , "posted_by" , $this->userID);

        if($this->upload_image == "true"){

            if($this->isValidImage()){    
if($this->upload_image()) {
    $this->update_record($this->users_table_name , "profile" , $this->user_profile_image , "user_id" , $this->userID);
    if($this->updateProfile()){

        $time = time();

        $thirty_days_from_now = (86400 * 30) + $time;

        setcookie("current_active_user" , $this->userID , $thirty_days_from_now , "/");

        $this->error = Array("success" => 1 , "error" => $this->success_message);
        $this->error = json_encode($this->error);
        return $this->error;
    }
    else {
        $this->error = Array("success" => 0 , "error" => $this->network_error);
        $this->error = json_encode($this->error);
        return $this->error;
    }

}
else {

    $this->error = Array("success" => 0 , "error" => $this->image_error);
    $this->error = json_encode($this->error);
    return $this->error;
}
            }
            else {
                $this->error = Array("success" => 0 , "error" => $this->image_error);
                $this->error = json_encode($this->error);
                return $this->error;
            }
        }
        else if ($this->updateProfile()){
            $this->try_set_email_unverified();
            $time = time();

            $thirty_days_from_now = (86400 * 30) + $time;


            setcookie("current_active_user" , $this->userID , $thirty_days_from_now , "/");
            $this->error = Array("success" => 1 , "error" => $this->success_message);
            $this->error = json_encode($this->error);
            return $this->error;
        }
        else {
            $this->try_set_email_unverified();
            $this->error = Array("success" => 0 , "error" => $this->network_error);
            $this->error = json_encode($this->error);
            return $this->error;
        }
    }
    else {
        $this->error = Array("success" => 0 , "error" => $this->secondary_contact_exists_error);
        $this->error = json_encode($this->error);
        return $this->error;
    }
}
else {
    $this->error = Array("success" => 0 , "error" => $this->primary_contact_exists_error);
    $this->error = json_encode($this->error);
    return $this->error;
}
            }
            else {
                $this->error = Array("success" => 0 , "error" => $this->email_address_exists_error);
                $this->error = json_encode($this->error);
                return $this->error;
            }
        }
    }

}

$update_profile = new updateUserProfile;
echo $update_profile->processor();


?>


