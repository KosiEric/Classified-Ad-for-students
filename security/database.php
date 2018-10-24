<?php

if(!class_exists("Configurations")){

    require_once('config.php');




}

if(!class_exists("Functions")) {
    require_once 'functions.php';
}






class DatabaseConnection extends  Functions {


    public $database_username = "root";
    public $database_password = "";
    public $database_host = "localhost";
    public $database = "app";
    public  $conn;
    protected   $password_recovery_table_name = "password_recovery";
    public  $users_table_name = "users";
    public   $unverified_emails_table_name = "unverified_emails";
    public  $profiles_table_name = "profiles";
    public  $ads_table_name = "ads";
    public $reported_ads_table_name = "reported_ads";
    public $favorite_ads_table_name = "favorite_ads";
    public  $messages_table_name = "messages";
    /*
    private final  function create_users_table() : bool {





    }
*/
    /**
     * @return bool
     */
    final protected  function establish_database_connection () : bool {

        try {

            $database = $this->database;
            $username = $this->database_username;
            $password = $this->database_password;
            $database_host = $this->database_host;

            $this->conn = new PDO("mysql:dbname=$database;host=$database_host" , $username , $password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE , PDO::ERRMODE_EXCEPTION);
        #    echo "Connection successful";
            return true;
        }

        catch (PDOException $exception) {

            echo "Connection failed : ".$exception->getMessage();
            return false;


        }


    }



    function __construct()
    {

    $this->establish_database_connection();
    }


    private function  open_database_connection () {

        $database_username = $this->database_username;
        $database_password = $this->database_password;

    }

    public final  function  create_reported_ads_table () : bool {

        $sql = "Create table {$this->reported_ads_table_name}(
    id int AUTO_INCREMENT PRIMARY KEY NOT NULL , 
    ad_id varchar(100) not null , 
    report_id varchar(100) not null UNIQUE,
    time_reported varchar(100) not null ,
    reason varchar(100) not null , 
    comment varchar(100) not null
   )";

        try {
            $this->conn->exec($sql);
            return true;
        }
        catch (PDOException $exception){
            return false;
        }
    }
    public final function create_email_verification_table () : bool {


        $unverified_emails_table_name = $this->unverified_emails_table_name;
        $sql = "CREATE TABLE {$unverified_emails_table_name}(

    id INT UNSIGNED AUTO_INCREMENT PRIMARY  KEY, 
    first_name VARCHAR(100)  NOT NULL ,
    last_name VARCHAR(100)  NOT NULL ,
    email_address VARCHAR (100) NOT NULL , 
    password VARCHAR(100) NOT NULL , 
    verification_code VARCHAR (100) NOT NULL ,
    verification_date VARCHAR (100) NOT NULL , 
    verification_timestamp VARCHAR (100) NOT NULL 
     
)";


        try {

            $this->conn->exec($sql);
            //echo "Table Created successfully";
            return true;
        }

        catch (PDOException $exception) {
           // echo "Error occured {$exception->getMessage()}";
            return false;
        }


    }

public function create_messages_table(){
        $sql = "CREATE TABLE {$this->messages_table_name} (
    
    id int not null AUTO_INCREMENT PRIMARY KEY,
    name varchar(1000) NOT null , 
    subject varchar(1000) not null ,
    body varchar(10000) not null,
    message_id varchar(1000) not null,
    sent_to varchar(100) not null,
    time_sent varchar(20000) not null,
    ad_id varchar(1000) not null,
    message_read varchar(1000) not null
    
    )";


    try {

        $this->conn->exec($sql);
        //echo "Table Created successfully";
        return true;
    }

    catch (PDOException $exception) {
        // echo "Error occured {$exception->getMessage()}";
        return false;
    }


}
    public final function create_favorite_ads_table () : bool {


        $unverified_emails_table_name = $this->unverified_emails_table_name;
        $sql = "create TABLE {$this->favorite_ads_table_name} (
    
    
    id int AUTO_INCREMENT PRIMARY KEY NOT NULL , 
    ad_id VARCHAR(300) NOT NULL, 
    user_id varchar(2000) NOT NULL,
    date_favorited varchar(399) NOT NULL , 
    time_favorited varchar(300) NOT NULL
    )";


        try {

            $this->conn->exec($sql);
            //echo "Table Created successfully";
            return true;
        }

        catch (PDOException $exception) {
            // echo "Error occured {$exception->getMessage()}";
            return false;
        }


    }

    public  function fetch_data_from_table_desc(string $table , string $row , string $value): array

    {

        $sql = "SELECT * FROM $table  WHERE $row = '{$value}' order by id DESC ";
        $result = $this->conn->prepare($sql);
        $result->execute();
        $set_type_record = $result->setFetchMode(PDO::FETCH_ASSOC);
        $record = $result->fetchAll();
        return $record;
    }

    public function create_password_recovery_table() : bool
    {
        $password_recovery_table_name = $this->unverified_emails_table_name;
        $sql = "CREATE TABLE {$password_recovery_table_name}(
   id INT AUTO_INCREMENT PRIMARY  KEY NOT NULL ,
   user_id VARCHAR  (100) NOT NULL ,
   email_address VARCHAR  (1000) NOT NULL ,
   date_created VARCHAR (100) NOT NULL , 
   token VARCHAR (100) NOT NULL 

)";
        try {

            $this->conn->exec($sql);
            echo "Table Created successfully";
            return true;
        }

        catch (PDOException $exception) {
            echo "Error occured {$exception->getMessage()}";
            return false;
        }


    }


    public final function  create_profiles_table () : bool {

        $users_table_name = $this->users_table_name;
        $sql = "CREATE TABLE {$users_table_name}(
        
    id INT UNSIGNED AUTO_INCREMENT PRIMARY  KEY,
    username VARCHAR (100) NOT NULL ,
    user_id VARCHAR (100) NOT NULL , 
    email_address VARCHAR (100) NOT NULL , 
    primary_phone VARCHAR (100) NOT NULL ,
    secondary_phone VARCHAR (100) NOT NULL , 
    profile VARCHAR (100) NOT NULL , 
    full_name VARCHAR(100)  NOT NULL ,
    state  VARCHAR (100) NOT NULL , 
    school VARCHAR (200) NOT NULL , 
    country  VARCHAR (100) NOT NULL , 
    registration_date VARCHAR (100) NOT NULL ,
    registration_timestamp VARCHAR (100) NOT NULL ,
    email_verified VARCHAR (100) NOT NULL  , 
    last_seen VARCHAR (100) NOT NULL , 
    active VARCHAR (100) NOT NULL , 
    password_reset_code  VARCHAR (100) NOT NULL , 
    email_verification_code VARCHAR (100) NOT NULL 
    
)";

        try {

            $this->conn->exec($sql);
            echo "Table Created successfully";
            return true;
        }

        catch (PDOException $exception) {
            echo "Error occured {$exception->getMessage()}";
            return false;
        }


    }
    public final function create_users_table () : bool {
        $users_table_name = $this->users_table_name;
        $sql = "CREATE TABLE {$users_table_name}(
        
    id INT UNSIGNED AUTO_INCREMENT PRIMARY  KEY,
    username VARCHAR (100) NOT NULL ,
    user_id VARCHAR (100) NOT NULL , 
    email_address VARCHAR (100) NOT NULL , 
    primary_phone VARCHAR (100) NOT NULL ,
    secondary_phone VARCHAR (100) NOT NULL , 
    password VARCHAR(100) NOT NULL ,  
    profile VARCHAR (100) NOT NULL , 
    first_name VARCHAR(100)  NOT NULL ,
    last_name VARCHAR(100)  NOT NULL ,
    business_type  VARCHAR (100) NOT NULL ,   
    state  VARCHAR (100) NOT NULL , 
    country  VARCHAR (100) NOT NULL , 
    registration_date VARCHAR (100) NOT NULL ,
    registration_timestamp VARCHAR (100) NOT NULL ,
    email_verified VARCHAR (100) NOT NULL  , 
    last_seen VARCHAR (100) NOT NULL , 
    active VARCHAR (100) NOT NULL 
)";


        try {

            $this->conn->exec($sql);
            echo "Table Created successfully";
            return true;
        }

        catch (PDOException $exception) {
             echo "Error occured {$exception->getMessage()}";
            return false;
        }


    }



    function __destruct()
    {
        // TODO: Implement __destruct() method.

    $this->conn = null;

    }



    public  final  function record_exists_in_table(string  $table_name , string   $row_name , string  $value) : bool {
        $value = strtolower($value);
        $sql = "SELECT $row_name  FROM $table_name WHERE $row_name = '{$value}'";
        $result = $this->conn->prepare($sql);
        $result->execute();
        $num_rows = $result->rowCount();

        if($num_rows > 0)
            return true;
        return false;


    }
    protected  function create_ad_table () : bool {

$sql = " create table {$this->ads_table_name} (
    
    id int AUTO_INCREMENT PRIMARY KEY NOT NULL , 
    ad_id varchar(2000) NOT NULL,
    title varchar(3000) NOT NULL , 
    description varchar(10000) not null , 
    category varchar(3000) not null , 
    sub_category varchar(3000) not null , 
    product_condition varchar(3000) not null , 
    amount varchar(3000) not null , 
    negotiable varchar(3000) not null ,
    contact_for_price VARCHAR (200) not NULL ,
    photos varchar(3999) not null , 
    posted_by varchar (399) not null , 
    post_date varchar(3993) not null , 
    post_time varchar(4673) not null , 
    last_updated varchar(3939) not null ,
    state varchar(3535) not null,
    school varchar(3547) not null, 
    views VARCHAR (400) not null,
    closed varchar(300) not null 
    );";
        try {

            $this->conn->exec($sql);
            echo "Table Created successfully";
            return true;
        }

        catch (PDOException $exception) {
            echo "Error occured {$exception->getMessage()}";
            return false;
        }


    }

    protected  final function  delete_record(string  $table_name , string   $row_name , string  $value) : bool  {

        $value = strtolower($value);
       $sql = "DELETE FROM {$table_name} WHERE {$row_name} = '{$value}'";
        $result = $this->conn->prepare($sql);
        $result->execute();
         return true;
    }


    public  final  function  update_record (string  $table_name , string  $row_name , string $new_value , string $row_to_searc_for , $old_value) {

        $new_value = strtolower($new_value);
        $old_value = strtolower($old_value);
        $sql = "UPDATE {$table_name} SET {$row_name} = '{$new_value}' WHERE {$row_to_searc_for} = '{$old_value}'";
        $result = $this->conn->prepare($sql);
        $result->execute();
        return true;
    }

    protected final function fetch_data_from_table(string $table , string $row , string $value): array

    {

        $sql = "SELECT * FROM $table  WHERE $row = '{$value}'";
        $result = $this->conn->prepare($sql);
        $result->execute();
        $set_type_record = $result->setFetchMode(PDO::FETCH_ASSOC);
        $record = $result->fetchAll();
        return $record;
    }

}


#$database_connection = new DatabaseConnection();
#$database_connection->create_password_recovery_table();
#$database_connection->create_users_table();
#$database_connection->create_email_verificatin_table();

#$database_connection->create_profiles_table();
?>
