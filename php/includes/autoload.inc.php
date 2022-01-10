<?php 
spl_autoload_register('autoload');

function autoload($name){
	$url = $_SERVER["HTTP_HOST"].$_SERVER["REQUEST_URI"];
	if (strpos("url", "php/includes") !==false) {
		$path = "../classes/";
	} 
	// elseif(strpos("url", "/admin/register.php")){
	// 	$path = "../php/classes/";
	// }
	 else {
		$path = "php/classes/";
	}
	$extention = ".class.php";
	$full = $path.$name.$extention;
	require $full;	

	
	
}