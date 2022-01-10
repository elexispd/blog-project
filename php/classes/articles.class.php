<?php 

class Articles extends Database{
	private $message ="";
	private $articleText;
	private $articleImage;
	private $articleImage2;
	private $category;
	private $user_id;
	private $user_email;
	private $article_id;


	// public function articleContent(){

	// }

	// public function articleTitle(){

	// }

	// public function articleImage(){

	// }

	// public function articleImage2(){

	// }

	// public function articleCategory(){

	// }

	// public function displayArticle(){

	// }

	public function articleImage(){
		$dir = "assets/img/";
		$ext = array("jpg", "png", "jpeg", "gif");
		$extension = pathinfo(strtolower($_FILES["photo1"]["name"]), PATHINFO_EXTENSION);
		$extension2 = pathinfo(strtolower($_FILES["photo2"]["name"]), PATHINFO_EXTENSION);
		$fileName = ($_FILES["photo1"]["name"]);
		$fileName2 = ($_FILES["photo2"]["name"]);

		if (empty($fileName) && empty($fileName2)) {
			$this->message = "Select an image";
		} elseif (empty($fileName) && !empty($fileName2)) {
			if (!in_array($extension2, $ext)) {
				$this->message = "Only 'jpg', 'jpeg, 'png' and 'gif' formats are accepted";
			}
		}  elseif (!empty($fileName) && empty($fileName2)) {
			if (!in_array($extension, $ext)) {
				$this->message = "Only 'jpg', 'jpeg, 'png' and 'gif' formats are accepted";
			}
		}  elseif (!empty($fileName) && !empty($fileName2)) {
			if (!in_array($extension2, $ext) && !in_array($extension2, $ext)) {
				$this->message = "Only 'jpg', 'jpeg, 'png' and 'gif' formats are accepted";
			}
		}

		 elseif(!in_array($extension, $ext)){
			$this->message = "Only 'jpg', 'jpeg, 'png' and 'gif' formats are accepted";
		} elseif(!in_array($extension2, $ext)){
			$this->message = "Only 'jpg', 'jpeg, 'png' and 'gif' formats are accepted";
		} 
		$this->articleImage = $dir.$fileName;
		$this->articleImage2 = $dir.$fileName2;
	}

	

	

	public function articleInputs(){
		if (empty($this->articleTitle) || empty($this->articleText)) {
			$this->message = "All inputs are required";
		} elseif (strlen($this->articleTitle) <=5) {
			$this->message = "Title is too short";
		} elseif (strlen($this->articleText) <=10) {
			$this->message = "Content is too short";
		}
	}

	public function insideImage(){
		if (isset($_FILES['upload']["name"])) {
		$file = $_FILES["upload"]["tmp_name"];
		$file_name = $_FILES["upload"]["name"];
		$file_name_array = explode(".", $file_name);
		$extension = end($file_name_array);
		$new_image_name = rand(). ".".$extension;
		// chmod("upload", 0777);
		$allowed_extension  = array('jpg' , "png", "gif", "jpeg");
		if (in_array($extension, $allowed_extension)) {
			move_uploaded_file($file, "assets/img/".$new_image_name);
			$function_number = $_GET["CKEditorFuncNum"];
			$url = "../admin/assets/img/".$new_image_name;
			// $url = "../admin/".$urll;
			$message = "";
			echo "<script type='text/javascript'>window.parent.CKEDITOR.tools.callFunction($function_number, '$url', '$message');</script>";
		}
}
	}
	public function addPost($title, $text, $category){

		$this->articleTitle = $title;
		$this->articleText = $text;
		$this->category = $category;
		$this->articleCategory();
		$this->articleImage();
		$this->articleInputs();


		if (empty($this->message) && (move_uploaded_file($_FILES["photo1"]["tmp_name"], $this->articleImage) || move_uploaded_file($_FILES["photo2"]["tmp_name"], $this->articleImage2))) {
			$article_id = time()+1000000;
			$date = date("d:M:Y");
			//$actual_date = date("jS F Y", strtotime($date));
			$adminEmail = $_SESSION["admin"];
			$sq = "SELECT * FROM admin WHERE admin_email= ?";
			$st = $this->connect()->prepare($sq);
			$st->execute([$adminEmail]);
			$fetch = $st->fetchAll();
			foreach ($fetch as $value) {
				$article_author =  $value["first_name"]." ".$value["last_name"];
			}
			$sql = "INSERT INTO articles (article_id, article_text, article_date, article_title, article_author, article_image, article_image2, category) VALUES (?,?,?,?,?,?,?,?)";
			$stmt = $this->connect()->prepare($sql);	
			$stmt->execute([$article_id,$this->articleText,$date, $this->articleTitle, $article_author, $this->articleImage, $this->articleImage2,$this->category]);

			$this->message = "Uploaded Successfully";		
		}
	}


	public function displayArticles($pager){
		$sql = "SELECT * FROM articles ORDER BY id DESC  LIMIT $pager, 4";
		$stmt = $this->connect()->query($sql);
		$fetch  = $stmt->fetchAll();
		return $fetch;
	}


	/**********************************DISPLAY SINGLE ARTICLES****************************/
	public function singleArticle($id, $title){
		$id = $id;
		$title = $title;
		$sql = "SELECT * FROM articles WHERE article_id = ? AND article_title = ?";
		$stmt = $this->connect()->prepare($sql);
		$stmt->execute([$id, $title]);
		$fetch  = $stmt->fetchAll();
		return $fetch;
	}

	public function filterImage($id){
		$id = $id;
		$sql = "SELECT * FROM articles WHERE article_id = ?";
		$stmt = $this->connect()->prepare($sql);
		$stmt->execute([$id]);
		$fetch  = $stmt->fetchAll();
		foreach ($fetch as $value) {
			$checkPhoto = substr($value["article_image"], strrpos($value["article_image"], "/")+1);
			if (!empty($checkPhoto)) {
				return $value["article_image"];
			} else {
				return 	$value["article_image2"];
			}
									
		}
	}

	//////////////////////////RELATED ARTICLES///////////////////////////////////
	public function relatedArticles($art){
		$art = $art;
		$sql = "SELECT * FROM articles WHERE category = ? ORDER BY id DESC LIMIT 3";
		$stmt = $this->connect()->prepare($sql);
		$stmt->execute([$art]);
		$fetch  = $stmt->fetchAll();
		return $fetch;
	}


	/**************************************category*************************************/
	public function articleCategory(){
		if (empty($this->category)) {
			$this->message = "Choose a category";
		} 
	}

	public function displayCategories(){
		$sql = "SELECT * FROM categories";
		$stmt = $this->connect()->query($sql);
		$stmt->execute();
		$fetch = $stmt->fetchAll();
		return $fetch;
	}

	/**************************************You Might Like Widget*************************************/

	public function widget(){
		$sql = "SELECT * FROM articles ORDER BY RAND() LIMIT 4";
		$stmt = $this->connect()->query($sql);
		$stmt->execute();
		$fetch = $stmt->fetchAll();
		return $fetch;
	}

	

	/**********************************select users**************************/
	public function users($email){
		$sql = "SELECT * FROM users WHERE user_email = ?";
		$stmt = $this->connect()->prepare($sql);
		$stmt->execute([$email]);
		$fetch = $stmt->fetchAll();
		
		foreach ($fetch as  $value) {
			$this->user_id = $value["user_id"];
			$this->user_email = $value["user_email"];
		}
	}


	/**************************************comments***************************************/

	public function addComment($comment, $email, $article_id){
		$comment_id = time()+10000000;
		$date = date("d:M:Y");
		$this->email = $email;
		$this->users($email);

		if (empty($this->user_email)) {
			$this->message ="Please Login";
		} else if (empty($comment)) {
			$this->message ="Field cannot be empty";
		} else{
			$sql = "INSERT INTO comments (comment_id, comment_text, user_id, user_email, article_id, comment_date) VALUES (?,?,?,?,?,?)";
			$stmt = $this->connect()->prepare($sql);
			$stmt->execute([$comment_id, $comment, $this->user_id, $this->user_email, $article_id, $date]);
			if (!$sql) {
				$this->message ="Please, login before you comment";
			} else {
				$this->message ="You Commented";
			}
			
			
		}
		
	}

	public function displayComment($id){
		$sql ="SELECT * FROM comments WHERE article_id = ?";
		$stmt = $this->connect()->prepare($sql);
		$stmt->execute([$id]);
		echo json_encode($stmt->fetchAll());
		
	}

	public function totalComment($id){
		$sql ="SELECT * FROM comments WHERE article_id = ?";
		$stmt = $this->connect()->prepare($sql);
		$stmt->execute([$id]);
		$num = $stmt->rowCount();
		echo json_encode($num);
	}
	

	/***********************************pagination************************************/
	public function display($pager){
		$sql ="SELECT * FROM record limit $pager, 4";
		$stmt = $this->connect()->query($sql);
		//$num = $stmt->rowCount();
		return $stmt->fetchAll();	
	}
	public function pagination(){
		$sql ="SELECT * FROM articles";
		$stmt = $this->connect()->query($sql);
		$num = $stmt->rowCount();
		return $num;
	}

	/**************************************message*****************************************/

	public function message(){
		echo $this->message;
	}



}