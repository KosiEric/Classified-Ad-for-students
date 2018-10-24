<?php
if(!class_exists("Configurations")){
    require_once ("config.php");
    require_once ("database.php");
}
date_default_timezone_set('UTC');
class Functions {

      public  $profile_upload_directory = "../uploads/profiles/";
      private $ad_image_upload_directory = "../uploads/ads_images/";
      public $ad_image_1_upload_directory , $ad_image_2_upload_directory , $ad_image_3_upload_directory;
      private $database;
     public  static function encrypt_js_file(string  $filename , string $file_type = "application/javascript" ): string {

            #$file_type = "application/javascript";
            $document_root = $_SERVER['DOCUMENT_ROOT'];
            $static_folder = SITE_CONFIGURATIONS['STATIC_FOLDER'];
            $encoded_file = base64_encode(file_get_contents($static_folder."/js/".$filename));
            return "data:$file_type;base64,$encoded_file";






    }
    public final function escape_string (string $string){
        $conn=mysqli_connect("{$this->database->database_host}","{$this->database->database_username}","{$this->database->database_password}","{$this->database->database}");

        return  mysqli_real_escape_string($conn , $string);

    }

    public function __construct()
    {
        $this->database = new DatabaseConnection();
        //parent::__construct();
        $this->ad_image_1_upload_directory = $this->ad_image_upload_directory."image1/";
        $this->ad_image_2_upload_directory = $this->ad_image_upload_directory."image2/";
        $this->ad_image_3_upload_directory = $this->ad_image_upload_directory."image3/";
    }


    public  static function encrypt_css_file(string  $filename , string $file_type = "text/css" ): string {

        #$file_type = "text/css";
        $document_root = $_SERVER['DOCUMENT_ROOT'];
        $static_folder = SITE_CONFIGURATIONS['STATIC_FOLDER'];
        $encoded_file = base64_encode(file_get_contents($static_folder."/css/".$filename));

        return "data:$file_type;base64,$encoded_file";






    }

    public  function getTotalNumberOfAds()

    {

        $sql = "SELECT * FROM {$this->database->ads_table_name}  WHERE ad_id != '134' AND closed != '1';";
        $result = $this->database->conn->prepare($sql);
        $result->execute();
        $set_type_record = $result->setFetchMode(PDO::FETCH_ASSOC);
        $record = $result->fetchAll();
        return count($record);
    }


    public static  function userCookieExists() : bool {
         $active_user_cookie = ($_COOKIE["current_active_user"]) ?? null;
         if($active_user_cookie != null)
             return true;
         return false;

}

public  static function encrypt_png_file(string  $filename , string $file_type = "image/png" ): string {

        #$file_type = "text/css";
        $document_root = $_SERVER['DOCUMENT_ROOT'];
        $static_folder = SITE_CONFIGURATIONS['STATIC_FOLDER'];
        $encoded_file = base64_encode(file_get_contents($static_folder."/img/".$filename));

        return "data:$file_type;base64,$encoded_file";






    }


    public  function generateID (int  $length) : string {

        $letters = Array("A" , "B" , "C" , "D" , "E" , "F" , "G" , "H" ,  "I" , "J" , "K" ,"L" ,"M" ,"N" ,"O" ,"P" ,"Q" ,"R" ,"S" , "T" ,
            "U" ,"V" ,"W" ,"X" ,"Y" ,"Z" ,"a" ,"b" ,"c" ,"d" ,"e" ,"f" ,"g" ,"h" ,"i" ,"j" ,"k" ,"l" ,"m" ,"n" ,"o" ,
            "p" ,"q" ,"r" ,"s" ,"t" ,"u" ,"v" ,"w" ,"x" ,"y" ,"z" ,"0" ,"1" ,"2" ,"3" ,"4" ,"5" ,"6" ,"7" ,"8"
        , "9"  , "_");

        $random_string = "";
        $string_length = count($letters);
        for($i = 0; $i < $length; $i++) {
            $random_string.= $letters[rand(0 , $string_length-1)];

        }

        return $random_string;
    }


    public function isFileSize (int $filesize , int $max_size){

        if($filesize > $max_size){

            return false;
        }

        else {

            return true;
        }


    }
    public  function getExtension (string  $filename) : string {
        $lastIndexOfDot = strrpos($filename, '.');
        $extension = substr($filename, $lastIndexOfDot);
        return $extension;
    }

    public  function getFileExtention (string  $name , string $target_directory) : string {
        $target_dir = $target_directory;
        $target_file = $target_dir . basename($name);
        $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
        $target_dir = $target_directory;
        return ".$imageFileType";

    }

    public function changeFileName(string  $filename , string  $new_name) : string {
        $image_string = "";
        $image_string.=$new_name.$this->getExtension($filename);
        return $image_string;
    }
    public function isFileType (string $filename , string $type , string $target_directory) : bool {
        $image_array = Array ("png" , "jpg" , "jpeg");
        $video_array = Array("mp4" , "3gp");
        $target_dir = $target_directory;
        $target_file = $target_dir . basename($filename);
        $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
        if(strtolower($type) == 'image'){

            if(in_array($imageFileType , $image_array)){

                return true;
            }

            else {

                return false;
            }


        }

        elseif (strtolower($type) == 'video'){

            if(in_array($imageFileType , $video_array)){

                return true;
            }

            else {

                return false;
            }
        }

    }

    public function  isImage (string $tmp_name) : string {

        $image_size = getimagesize($tmp_name);
        if($image_size !== false){

            return true;
        }

        else {

            return false;
        }
    }

    public function getAdsByUser($user_id){
         
         $ads = $this->database->fetch_data_from_table_desc($this->database->ads_table_name , "posted_by" , $user_id);
         return $ads;

    }



    public function  getFavoriteAdsByUser($user_id){
        $ads = $this->database->fetch_data_from_table_desc($this->database->favorite_ads_table_name , "user_id" , $user_id);
        return $ads;


    }

    public function  getActiveUserID() {

        return $_COOKIE["current_active_user"];
    }


    public function short_to_length(string $string ,int $length ,  int $number_of_dots = 3):string {
         $new_string = substr($string , 0 , $length);
         for ($i = 1; $i <= $number_of_dots; ++$i){
             $new_string.=".";
         }

         return $new_string;

    }

    public function getAdPosterProfileImage ($ad_id) : string {
         return $this->profile_upload_directory.$this->getAdPosterDetails($ad_id)["profile"];
    }

    public function  getAdImages(string  $ad_id) : array {

         
         $ad_images = $this->database->fetch_data_from_table($this->database->ads_table_name , "ad_id" , $ad_id)[0]["photos"];
         $ad_images = explode("," , $ad_images);
         $ads_image = Array($this->ad_image_1_upload_directory.$ad_images[0] ,$this->ad_image_2_upload_directory.$ad_images[1] ,
             $this->ad_image_3_upload_directory.$ad_images[2]);
         return $ads_image;

         }

    public function  getAdDetails (string  $ad_id) : array  {

        
        $ad_details = $this->database->fetch_data_from_table($this->database->ads_table_name , "ad_id" , $ad_id)[0];

        return $ad_details;

    }

    public  function  getActiveUserDetails (){
         if(!$this->isLoggedInUser()){
             return null;
         }

         else{

             $user_id = $_COOKIE['current_active_user'];
             return $this->database->fetch_data_from_table_desc($this->database->users_table_name , 'user_id' ,  $user_id)[0];
         }
    }

    public function getUserDetails ($user_id) {

             return $this->database->fetch_data_from_table_desc($this->database->users_table_name , 'user_id' ,  $user_id)[0];

    }
    public function  getAdPosterDetails (string  $ad_id) : array {
        
        $posted_by = $this->database->fetch_data_from_table($this->database->ads_table_name , "ad_id" , $ad_id)[0]["posted_by"];

        $poster_details = $this->database->fetch_data_from_table($this->database->users_table_name , "user_id" , $posted_by)[0];
        return $poster_details;
    }

    public function  postedByCurrentUser (string  $ad_id): bool {

         if(isset($_COOKIE["current_active_user"]) and !empty($_COOKIE["current_active_user"])){
             if($this->getAdPosterDetails($ad_id)["user_id"] == $_COOKIE["current_active_user"]){
                 return true;
             }
             else {
                 return false;
             }

         }

         else {

             return false;
         }
    }


    public function  updateNumberOfViews (string  $ad_id){
         $number_of_ad_views = (int)$this->database->fetch_data_from_table($this->database-ads_table_name , "ad_id" , $ad_id)[0]["views"];
         $number_of_ad_views+=1;
         $this->database->update_record($this->ads_table_name , 'views' , "{$number_of_ad_views}" , "ad_id" , "{4ad_id}");
      }

    public function  isLoggedInUser(){
        if(isset($_COOKIE["current_active_user"]) and !empty($_COOKIE["current_active_user"])) {

            return true;
        }
        else {
            return false;
        }

    }

    public function isFavoritedByUser($ad_id) {
if(!$this->isLoggedInUser()){
    return false;
}
         $sql = "SELECT *  FROM {$this->database->favorite_ads_table_name} WHERE ad_id = '{$ad_id}' and user_id = '{$this->getActiveUserID()}'";
        $result = $this->database->conn->prepare($sql);
        $result->execute();
        $num_rows = $result->rowCount();

        if($num_rows > 0)
            return true;
        return false;



    }

    public function getNumAdFavorites($ad_id){

        $sql = "SELECT *  FROM {$this->database->favorite_ads_table_name} WHERE ad_id = '{$ad_id}'";
        $result = $this->database->conn->prepare($sql);
        $result->execute();
        $num_rows = $result->rowCount();

        return $num_rows;
    }

    public function favoritedAdIconToggle($ad_id){
          if($this->isLoggedInUser()){
              if($this->isFavoritedByUser($ad_id)){
                  return "fa fa-heart";
              }
              else {
                  return "fa fa-heart-o";
              }
          }
          else {
              return "fa fa-heart-o";
          }


     }

    function favoriteAdToggle ($ad_id) {
         $action  = "";
         if($this->isFavoritedByUser($ad_id)){
             $action = "0";
         }
         else {
             $action = "1";
         }
         if($this->isLoggedInUser()){
             $num_of_favorites = $this->getNumAdFavorites($ad_id);
             return "href = '#' data-action = '{$action}' data-num-favorites = '{$num_of_favorites}' class = 'favorite-ad-links' data-current-user-id = '{$this->getActiveUserID()}' data-ad-id= {$ad_id}";
         }
         else {
             return "href='#myModal' data-toggle='modal'";
         }
    }

    public  function  getCurrentUser () : string {
         if($this->isLoggedInUser()){
             return $this->getActiveUserID();
         }
         else {
             return "user";
         }
    }



    public  static function encrypt_jpg_file(string  $filename , string $file_type = "image/jpeg" ): string {

        #$file_type = "text/css";
        $document_root = $_SERVER['DOCUMENT_ROOT'];
        $static_folder = SITE_CONFIGURATIONS['STATIC_FOLDER'];
        $encoded_file = base64_encode(file_get_contents($static_folder."/img/".$filename));

        return "data:$file_type;base64,$encoded_file";






    }

}

?>