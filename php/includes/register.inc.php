<?php 
include_once "../classes/database.class.php";
include_once "../classes/admin.class.php";
include_once "../classes/user.class.php";
// Super Admin signing up other admins
session_start();
    $username = htmlspecialchars(trim($_POST["username"]));
    $email = $_POST["email"];
    $fname = htmlspecialchars($_POST["fname"]);
    $lname = htmlspecialchars($_POST["lname"]);
    $password = htmlspecialchars($_POST["password"]);
    $cpassword = htmlspecialchars($_POST["cpassword"]);
    

   

    if (isset($_POST["register"])) {
    	$obj = new Admin();
    	$obj->save($username, $email, $password, $cpassword, $fname, $lname);
    	$obj->message();
    } elseif  (isset($_POST["userRegister"])) {
    	$obj = new user();
    	$obj->save($username, $email, $password, $cpassword, $fname, $lname);
    	$msg = $obj->userMessage();
    }
    
   