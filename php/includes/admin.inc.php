<?php 
include_once "../classes/database.class.php";
include_once "../classes/admin.class.php";

/***************************add Category*************************/


if (isset($_POST["cat"])) {
 	$catObj = new Admin();
 	$catObj->addCategory(htmlspecialchars(trim($_POST["addCat"])));
 	$catObj->message();


 } else{
 	echo "";
 }


