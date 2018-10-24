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




require_once '../../security/config.php';
require_once '../../security/database.php'; // Required for Necessary Database Connections.
require '../../phpmailer/PHPMailerAutoload.php';

global $countries , $selected_country , $selected_state , $home_page_site_url , $home_page_site_name , $image_folder;

    class sendVerificationEmail extends DatabaseConnection
    {


        /* TODO: Declaring all the class variables */

        private $firstname, $data, $error, $success, $lastname, $email, $password, $verification_code, $verification_timestamp, $verification_date,
            $email_address_exists_error = "email address already exists ", $email_send_error = "failed to send email verification link, try again",
            $success_message = "email verification link sent to ";


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


        public final static  function isReady ()
        {

            if($_SERVER["REQUEST_METHOD"] == "POST") {

                echo "Request received";
            }
            else {
                echo "Request failed";
            }

        }



    }

    $send_verification_email = new sendVerificationEmail();
    $send_verification_email->isReady();
?>


