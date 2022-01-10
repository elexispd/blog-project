<?php 
include_once "../classes/database.class.php";
// include_once "../classes/admin.class.php";
include_once "../classes/articles.class.php";
$obj = new Articles();



// if (isset($_POST["get"])) {
// 	$obj->displayComment($_POST["get"]);
// } 

 // // echo $comments;
 //   $total = $obj->totalComment($_POST["id"]);   
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['cmd'])) {
	
	// function main(){
	// 	try {
	// 		$obj->displayComment($_POST["get"]);

	// 	} catch (PDOException $e) {
	// 		die("database connection failed");
	// 	}
	// }

	// function totalComment(){
	// 		$sql ="SELECT * FROM comments WHERE article_id = ?";
	// 		$stmt = connect()->prepare($sql);
	// 		$stmt->execute([$_POST['id']]);
	// 		$num = $stmt->rowCount();
	// 		echo json_encode($num);
	// }

	switch ($_POST['cmd']) {
		case 'comments':
			$obj->displayComment($_POST["id"]);
			break;
		case 'total':
			$obj->totalComment($_POST["id"]);
			break;
		
		
	}

}