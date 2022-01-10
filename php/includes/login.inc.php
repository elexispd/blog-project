<?php 

include_once "../classes/database.class.php";
include_once "../classes/admin.class.php";
include_once "../classes/user.class.php";


$email = $_POST["email"];
$password = htmlspecialchars($_POST["pass"]);
if (isset($_POST["userLogin"])) { 
    $obj = new User();
    $obj->userLogin($email, $password);
    $msg = $obj->userMessage();

 }
else{
	 $obj = new Admin();
    $obj->login($email, $password);
    $msg = $obj->message();
}
// } else {
//     # code...
// }
// $email = $_POST[$email];
// 		$password = $_POST[$email];

    



















