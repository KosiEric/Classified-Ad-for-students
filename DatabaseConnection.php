<?php

class DatabaseConnection{


    protected $database_username = "root";
    protected $database_password = "";
    protected $database_host = "localhost";
    protected $database = "app";
    public $vodka_users_table_name = "vodka_users";
    public $vodka_reports_table_name = "vodka_reports";
    public $vodka_controller_table_name = "vodka_controller";

    public $vodka_logs_table_name = "vodka_logs";
    public  $conn;
    private $logs;
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


    function __destruct()
    {
        // TODO: Implement __destruct() method.

        $this->conn = null;

    }

    public function record_exists_in_table(string  $table_name , string   $row_name , string  $value) : bool {
        $value = strtolower($value);
        $sql = "SELECT $row_name  FROM $table_name WHERE $row_name = '{$value}'";
        $result = $this->conn->prepare($sql);
        $result->execute();
        $num_rows = $result->rowCount();

        if($num_rows > 0)
            return true;
        return false;


    }


    protected  function  delete_record(string  $table_name , string   $row_name , string  $value) : bool  {

        $value = strtolower($value);
        $sql = "DELETE FROM {$table_name} WHERE {$row_name} = '{$value}'";
        $result = $this->conn->prepare($sql);
        $result->execute();
        return true;
    }


    public function  update_record (string  $table_name , string  $row_name , string $new_value , string $row_to_searc_for , $old_value) {

        $new_value = strtolower($new_value);
        $old_value = strtolower($old_value);
        $sql = "UPDATE {$table_name} SET {$row_name} = '{$new_value}' WHERE {$row_to_searc_for} = '{$old_value}'";
        $result = $this->conn->prepare($sql);
        $result->execute();
        return true;
    }

    public  function fetch_data_from_table(string $table , string $row , string $value): array

    {

        $sql = "SELECT * FROM $table  WHERE $row = '{$value}'";
        $result = $this->conn->prepare($sql);
        $result->execute();
        $set_type_record = $result->setFetchMode(PDO::FETCH_ASSOC);
        $record = $result->fetchAll();
        return $record;
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

}


?>