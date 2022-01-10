<?php 
include_once "../classes/database.class.php";
include_once "../classes/admin.class.php";
include_once "../classes/articles.class.php";

// $artObj = new Articles();
// $message = $artObj->displayArticles();
// echo $message;

session_start();

if (isset($_SESSION["user"])) {
	$session = $_SESSION["user"];
}
$comObj = new Articles();

if (isset($_POST["id"])) {
	$id = $_POST['id'];
	// $text = $_POST['text'];
	$text = $_POST['content'];
	$email = $_POST['email'];
 	$comObj->addComment($text, $email, $id);
 	$comObj->message();


 } else{
 	echo "";
 }



