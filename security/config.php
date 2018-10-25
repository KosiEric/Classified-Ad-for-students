<?php
mb_internal_encoding("utf-8");
$document_root = $_SERVER['DOCUMENT_ROOT'];
$email_verification_code_length = 16;
$password_recovery_code_length = 32;
define("STATIC_FOLDER" , "/static/" ,  true );
$home_page_site_name = "Gidimi";
$default_green_color = "#00A851";
$olx_green_color = "#21C1A4";
$password_reset_code_length = 16;
$user_id_length = 6;
$max_user_profile_image_size = 5000000;
$max_ad_image_size = 7000000;
$number_of_ads_images = 3;
$site_blog_page = "https://blog.".strtolower($home_page_site_name).".com";
$ad_categories = Array("home&furnitures" , "electronics&video" , "phones&tablets" , "laptops&computers" , "fashion&clothes" , "hostels&lodges" , "books&archive");
$ad_sub_categories = Array(
    "home&furnitures" => Array("Furniture" , "Home Accessories" , "Home Appliances" , "Kitchen & Dining" , "Kitchen Appliances") ,
    "electronics&video" => Array("Audio and Music Equipment" , "Cameras, Video Cameras and Accessories" , "Computer Accessories" ,
        "computer hardware" , "TV & DVD Equipment" , "Video Game Consoles" , "Video Games") ,
    "laptops&computers" => Array("Laptops" , "Desktop" , "Mini Laptop") ,
    "fashion&clothes" => Array("Clothing & Shoes" , "Watches" , "Jewelry" , "Accessories"),
    "hostels&lodges" => Array("Hostel" , "Lodge" , "Room mate"),
     "phones&tablets" => Array("Accessories" , "Mobile Phones" , "Tablets") ,
    "books&archive" => Array("Text Books"  , "Inspirational books" , "Inspirational CD's" , "Marvel" , "Religious" , "Musical")
);

$country_number_min_max  = Array("Nigeria" => Array(/*minimum phone number length */11 , /* maximum phone number length */11 , /* phone number example */ "0708  441  9546" , /*Internatioal format */ "+234"));

$home_page_header_text = "The best ideas come as a joke.";
$home_page_site_url = $home_page_site_name.".com";
$default_site_pages = Array("/track-ads" => "Track your Ads" , "/privacy" => "Privacy policy" , "/terms" => "Terms of Use" ,  "/contact" => "Contact us" , "/faq" => "FAQ" , "https://blog.".strtolower($home_page_site_name).".com" => "Blog");

$selected_country = "Nigeria";
$facebook_page = "GidimiHQ";
$twitter_page = "GidimiHQ";
$instagram_page = "GidimiHQ";
$selected_state = "Rivers";
$site_author_url = "https://twitter.com/realkosieric";
$general_date = date("Y-m-d h:i:sa");
$states = Array("Nigeria" => Array("Abia" , "Abuja" ,  "Adamawa" , "Akwa Ibom" , "Anambra" , "Bauchi" , "Bayelsa" , "Benue" , "Borno" , "Cross River" , "Delta" ,
    "Ebonyi" , "Edo" , "Ekiti" , "Enugu" , "Gombe" , "Imo"  , "Jigawa" , "Kaduna" , "Kano" , "Katsina" , "Kebbi" , "Kogi" , "Kwara" , "Lagos"
, "Nassarawa" , "Niger" , "Ogun" , "Ondo" , "Osun" , "Oyo" , "Plateau" , "Rivers" , "Sokoto" , "Taraba" , "Yobe" , "Zamfara") , "Ghana" => Array(""));
$countries = Array("Nigeria" => Array("currency" => "Naira" , "currency_sign" => "&#8358;" , "helpline" => "+1 (423)  516   039 6" , "reference" => 'Nigerians' ,  'head_office' => "Block 2A Quarters 3,  Port Harcourt Int'l Airport, Rivers Nigeria."));
define("SITE_CONFIGURATIONS" , Array("SITE_AUTHOR" => "Kosi Eric" , "CONTACT_EMAIL" => "support@gmail.com" , "IMG_FOLDER" => STATIC_FOLDER."img/", "FORMS_FOLDER" => STATIC_FOLDER."forms/", "HTML_FOLDER" => $document_root."/".STATIC_FOLDER."html/" ,   "JS_FOLDER" => STATIC_FOLDER."js/", "CSS_FOLDER" => STATIC_FOLDER."css/" , "SITE_LOGO" => STATIC_FOLDER."img/favnew.png" ,
    "PRIMARY_EMAIL_SERVER"=>"smtp.gmail.com" , "PRIMARY_EMAIL" => "itskosieric@gmail.com" , "MESSAGE_EMAIL" => "itskosieric@gmail.com", "MESSAGE_EMAIL_PASSWORD" => "4mdcfohb" , "PRIMARY_EMAIL_PASSWORD" => "4mdcfohb" , "site_contact_email" => "contact@".strtolower($home_page_site_name).".com" ,  "COUNTRY_FLAGS_FOLDER" => STATIC_FOLDER."img/countries/") , true);
$site_pages = $default_site_pages;

$site_author = SITE_CONFIGURATIONS['SITE_AUTHOR'];
$image_folder = SITE_CONFIGURATIONS["IMG_FOLDER"];


class Configurations {


    private $security;
    public $amount_of_ads = 10;
    public $number_of_ads_images = 3;
    public $ad_description_length_to_show = 40;
    public  $ad_title_length_to_show = 25;
    public $ad_university_length_to_show = 22;
    public $number_of_search_results_to_display = 10;
    public $length_of_ad_id = 7;
    public $length_of_report_id = 7;
    public $length_of_msg_id = 7;
    public $ad_conditions = Array("Good" , "New" ,  "Old" , "Damaged");
    public $number_of_user_ads_to_load = 10;
    public $number_of_favorites_ads_to_load = 10;
    public $number_of_home_ads_to_load = 20;
    public $number_of_search_suggestions_to_display =20;
    public function __construct()

    {
        $server_name = $_SERVER["SERVER_NAME"];
        $https = ($_SERVER["REQUEST_SCHEME"] == "https")? "https://" : "http://";

        $this->security = Array(
            "server_name" => $server_name ,
            "author" => "BrokBouy Kosi" ,
            "database_username" => "root" ,
            "database_password" => "" ,
            "database_host" => "localhost",
            "database_name" => "Gidimi_database",
            "full_url" => "{$https}wwww.{$server_name}");
             }


    public static function  customErrorHandler($errno , $errstr , $errfile , $errline){

        return $errno;

    }



    public  function getSecurityProperty (string $property) : string
    {

        $value = $this->security[$property];
        if($value){
            return $value;
        }
        else {
            return "sorry, key not found";
        }


    }
    }






$confgurations = new Configurations();



?>