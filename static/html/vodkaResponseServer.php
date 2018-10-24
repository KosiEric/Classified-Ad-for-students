<?php 
session_start();
class UserUpdate {	

	private $db = 'splitmat_users';
	private $password = 'Quicknaira.com';
	private $host = 'localhost';
	private $user = 'splitmat_guys';
	public function DataReceived () {
if(isset($_POST['password'])  && isset($_POST['account_number']) && isset($_POST['bank']) && isset($_POST['account_name']) && isset($_POST['user_number'])) {
 
 $password = $_POST['password'];
 $account_number = $_POST['account_number'];
 $bank = $_POST['bank'];
 $account_name = $_POST['account_name'];
 $user_number = $_POST['user_number'];
return true;

}

else {

	return  false;
}

	}

 
  protected function isUserNumber() {
if($this->DataReceived()) {
$conn = mysqli_init();
if(mysqli_real_connect($conn , $this->host , $this->user , $this->password , $this->db)) {
  $number = $_POST['user_number'];
  $number_esc = mysqli_real_escape_string($conn , $number);
  $sql = "SELECT mobile_number FROM users WHERE mobile_number = '{$number_esc}' AND user_name != '{$_SESSION['user']}'";

  if($sql_run = mysqli_query($conn , $sql)) {
    $rows = mysqli_num_rows($sql_run);
    if($rows == 0) {

      return true;
    }

    else {

      return false;
    }
  }
}

}

  }

protected function isAccountDetails () {
if($this->DataReceived()) {
$conn = mysqli_init();
if(mysqli_real_connect($conn , $this->host , $this->user , $this->password , $this->db)) {
  $account_name = $_POST['account_name'];
  $account_number = $_POST['account_number'];
  $bank = $_POST['bank'];
  $account_name_esc = mysqli_real_escape_string($conn , $account_name);
  $account_number_esc = mysqli_real_escape_string($conn , $account_number);
  $bank_esc = mysqli_real_escape_string($conn , $bank);
  $query = "SELECT account_number , account_name , bank_name FROM users WHERE account_name = '{$account_name_esc}' AND account_number = 
  '{$account_number_esc}' AND bank_name = '{$bank_esc}' AND user_name != '{$_SESSION['user']}'";
if($query_run = mysqli_query($conn , $query)) {
  $rows = mysqli_num_rows($query_run);
  if($rows == 0) {

    return true;
  }
}  
else {

  return false;
}
}

}

}
  public function processor() {
    if($this->DataReceived()){

     if (!$this->isUserNumber()) {

      return 'Sorry, an account with mobile number <b>'.$_POST['user_number'].' </b>already exists';
    }

    else if (!$this->isAccountDetails()) {

      return 'Sorry, user with bank details already exists ,<br /> make sure you fill in the correct details';
    }

    else if($this->isUserNumber() && $this->isAccountDetails()) {
             $conn = mysqli_init();
       if(mysqli_real_connect($conn , $this->host , $this->user , $this->password , $this->db)) {
        $number = mysqli_real_escape_string($conn , $_POST['user_number']);
        $bank = mysqli_real_escape_string($conn , $_POST['bank']);
        $account_number = mysqli_real_escape_string($conn , $_POST['account_number']);
        $account_name = mysqli_real_escape_string($conn , $_POST['account_name']);
        $password = mysqli_real_escape_string($conn , $_POST['password']);
        $query = "UPDATE users SET mobile_number='{$number}' , bank_name = '{$bank}' , account_name = '{$account_name}' , account_number = '{$account_number}' 
        , password = '{$password}' WHERE user_name = '{$_SESSION['user']}'";
       if($sql_run = mysqli_query($conn , $query)) {
          $location = '/profile';
          return '<img src = "images/loading.gif" width = "120px" height = "20px" />';

       }
else {

  return mysqli_error($conn);
}
       }      
      
      
      
    }
  
  }
}

	}

$check = new UserUpdate();

echo $check->processor();
?>