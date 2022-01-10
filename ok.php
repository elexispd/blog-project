<?php 
include_once "../php/classes/database.class.php";
include_once "../php/classes/admin.class.php";

$adminObj = new Admin();
 $ip = $_SERVER["REMOTE_ADDR"];
    $page = $adminObj->pageCounter($ip);


 ?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>


	<input type="text" name="email" id="email">
	<button type="button" id="reg">click</button>
	<span id="re"></span>
<!-- <button>click</button>
<span id="sa"></span> -->

 <?php 

 	$time =  date("h:m:a"); echo $time;


 ?>

<script src="js/jquery.js"></script>
<script src="js/mainAjax.js"></script>
<script src="js/main.js"></script>
<script>
	$("#reg").click(function(){
	var email = $("#email").val();
	
	// $.ajax({
	// 	url: '',
	// 	method: 'POST',
	// 	data: 'email='+email,
	// 	success: function(data){
	// 		$("#re").html(data);
	// 	},
	// 	statusCode: {
	// 		404: function(){
	// 			$("#re").text("page not found");
	// 		}
	// 	}

	// });


})
</script>



</body>
</html>

