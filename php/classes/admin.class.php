<?php 

class Admin extends Database{
	private $username;
	private $password;
	private $cpassword;
	private $email;
	private $firstName;
	private $lastName;
	private $user_id;
	private $message ="";
	private $articleTitle;
	private $articleText;
	private $articleImage;


//********************************sign up************************************************/
	public function setUsername(){
		if(empty($this->username)){
			$this->message = "username is required";
		} else if (!preg_match("/^[a-zA-Z0-9]+$/", $this->username)) {
			$this->message = "invalid username";
		} else if(strlen($this->username)<=2 ){
			$this->message = "username is too short";
		} else{
			$sql = "SELECT * FROM admin WHERE username = ?";
			$stmt = $this->connect()->prepare($sql);
			$stmt->execute([$this->username]);
			$numRow = $stmt->rowCount();
			if ($numRow == 1) {
				$this->message = "Username already taken";
			}
		}
		
	}

	public function setEmail(){
		if (empty($this->email)){
			$this->message = "fill in Email";
		}
		elseif (!filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
			$this->message = "invalid email address";
		} else{
			$sql2 = "SELECT * FROM admin WHERE admin_email = ?";
					$stmt = $this->connect()->prepare($sql2);
					$stmt->execute([$this->email]);
					$numRow = $stmt->rowCount();
					if ($numRow > 0) {
						$this->message = "Email is already in use";
					} 
		}
	}

	public function setFirstName(){
		 if (empty($this->firstName)) {
			$this->message = "first name field is required";
		} else if (!preg_match("/^[a-zA-Z ]+$/", $this->firstName)) {
			$this->message = "first name should only be letters";
		}else if(strlen($this->firstName)<=2 ){
			$this->message = "first name is too short";
		}
	}

	public function setLastName(){
		 if (empty($this->lastName)) {
			$this->message = "last name field is required";
		} else if (!preg_match("/^[a-zA-Z ]+$/", $this->lastName)) {
			$this->message = "last name should only be letters";
		}else if(strlen($this->lastName)<=2 ){
			$this->message = "last name is too short";
		}
	}

	public function setPassword(){
		if (!preg_match("/^[a-zA-Z0-9]+$/", $this->password)) {
			$this->message = "password must contain letters and numbers";
		} else if(strlen($this->password)<=5 ){
			$this->message = "password must be more than 5 characters";
		} elseif ($this->password !== $this->cpassword){
			$this->message = "password does not match";
		}
	}

	

	public function save($username, $email, $password, $cpassword, $firstName, $lastName){
		$this->username = $username;
		$this->email = $email;
		$this->password = $password;
		$this->cpassword = $cpassword;
		$this->firstName = $firstName;
		$this->lastName = $lastName;
		$this->setPassword();
		$this->setUsername();
		$this->setEmail();
		$this->setLastName();
		$this->setFirstName();

		if (empty($this->message)) {
			if (isset($_SESSION["admin"]) !== false) {
				$sql = "SELECT * FROM admin WHERE admin_email = ?";
				$stmt = $this->connect()->prepare($sql);
				$stmt->execute([$_SESSION["admin"]]);
				$num = $stmt->fetch();
			
				if ($num["super_admin"] == 1) {
					$this->user_id = time()+1000000;
					$hash = password_hash($this->password, PASSWORD_DEFAULT);
					$sql = "INSERT INTO admin (user_id, admin_username, admin_email, admin_password, first_name, last_name) VALUES (?,?,?,?,?,?)";
					$stmt = $this->connect()->prepare($sql);
					$stmt->execute([$this->user_id, strtolower($this->username), $this->email, $hash, $this->firstName, $this->lastName]);
					$this->message = "Sign up successful";
				} 
				else {
					$this->message = "You must be logged in as a Super Admin";
				}
			}
		}
		else {
			
		}
	}
			
					


	//**************************************LOGIN******************************************/

	public function login($email, $password){
		$this->email = $email;
		$this->password = $password;
		$this->getEmail();
	}

	public function getEmail(){
		$sql = "SELECT * FROM admin WHERE admin_email = ?";
		$stmt = $this->connect()->prepare($sql);
		$stmt->execute([$this->email]);
		$row= $stmt->fetch();
		$numRow = $stmt->rowCount();		
		
		if ($numRow == 1) {
			$dehash = password_verify($this->password, $row["admin_password"]);
			if ($dehash == true) {
				 $this->message = "Login successful";
				session_start();
				$_SESSION["admin"] = $this->email;
			} else {
				 $this->message = "Password does not match";
			}
			
		} else {
			 $this->message = "Invalid Login details";
		}
		
	}

	public function getAdmin($email){
		$sql = "SELECT * FROM admin WHERE admin_email = ?";
		$stmt = $this->connect()->prepare($sql);
		$stmt->execute([$email]);
		$row= $stmt->fetchAll();		
		return $row;
		
	}


	public function superAdmin($session){
			$sql = "SELECT super_admin FROM admin WHERE admin_email = ? AND super_admin = ?";
			$stmt = $this->connect()->prepare($sql);
			$stmt->execute([$session, 1]);
			$num = $stmt->fetch();
			foreach ($num as $value) {
				return $value;
			}
			
	}




	/*********************************ADD POST**************************************/
	
	// private $articleId = (time()+10000000);
	

	public function image(){
		$dir = "../admin/assets/img/";
		$ext = array("jpg", "png", "jpeg", "gif");
		$extension = pathinfo(strtolower($_FILES["photo1"]["name"]), PATHINFO_EXTENSION);
		$fileName = ($_FILES["photo1"]["name"]);

		if (empty($fileName)) {
			$this->message = "Select an image";
		} elseif(!in_array($extension, $ext)){
			$this->message = "Only 'jpg', 'jpeg, 'png' and 'gif' formats are accepted";
		} 
		$this->articleImage = $dir.$fileName;
	}

	

	

	public function inputs(){
		if (empty($this->articleTitle) || empty($this->articleText)) {
			$this->message = "All inputs are required";
		} elseif (strlen($this->articleTitle) <=5) {
			$this->message = "Title is too short";
		} elseif (strlen($this->articleText) <=10) {
			$this->message = "Content is too short";
		}
	}
	public function addPost($title, $text){

		$this->articleTitle = $title;
		$this->articleText = $text;
		$this->image();
		$this->inputs();

		if (empty($this->message) && move_uploaded_file($_FILES["photo1"]["tmp_name"], $this->articleImage)) {
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
			$sql = "INSERT INTO articles (article_id, article_text, article_date, article_title, article_author, article_image) VALUES (?,?,?,?,?,?)";
			$stmt = $this->connect()->prepare($sql);	
			$stmt->execute([$article_id,$this->articleText,$date, $this->articleTitle, $article_author, $this->articleImage]);
			$this->message = "Uploaded Successfully";		
		}
	}


/**************************************ADD CATEGORY******************************************/
		public function addCategory($cat){
			$cat_n = strtolower($cat);
			$cat_name = ucfirst($cat_n);

			$category_id = time()+10000000;

			if (empty($cat)) {
				$this->message = "Field is empty";
			} elseif (strlen($cat) <=2 ) {
				$this->message = "Category name is too short";
			}

			else{
				$sq = "SELECT * FROM categories WHERE category_name = ?";
				$stm = $this->connect()->prepare($sq);
				$stm->execute([$cat_name]);
				$num = $stm->rowCount();
				if ($num  == 1 ) {
					$this->message = "Category Already Exist";
				} else{
					$sql = "INSERT INTO categories (category_id, category_name) VALUES (?,?)";
					$stmt = $this->connect()->prepare($sql);
					$stmt->execute([$category_id, $cat_name]);
					$this->message = "Category Has Been Added Successfully";
				}	
			}
		}

		public function displayCategories(){
			$sql = "SELECT * FROM categories";
			$stmt = $this->connect()->query($sql);
			$fetch  = $stmt->fetchAll();
			return $fetch;
		}




	/*_____________________________________________________________________________*/


	public function displayArticles(){
		$sql = "SELECT * FROM articles";
		$stmt = $this->connect()->query($sql);
		$fetch  = $stmt->fetchAll();
		return $fetch;
	}



	public function message(){
		echo $this->message;
	}

	/*****************************************************display Admin*********************************************/

	public function totalAdmin(){
		$sql = "SELECT * FROM admin";
		$stmt = $this->connect()->query($sql);
		$num = $stmt->rowCount();
		return $num;
	}


	/*****************************************************Display Users**********************************************/

	public function displayUsers(){
		$sql = "SELECT * FROM users";
		$stmt = $this->connect()->query($sql);
		$stmt->execute();
		return $stmt->fetchAll();
	}

	public function totalUsers(){
		$sql = "SELECT * FROM users";
		$stmt = $this->connect()->query($sql);
		$num = $stmt->rowCount();
		return $num;
	}

	/****************************************Display Users**************************************/

	public function displayAdmins(){
		$sql = "SELECT * FROM admin";
		$stmt = $this->connect()->query($sql);
		$stmt->execute();
		return $stmt->fetchAll();
	}

	/******************************************DELETE USER***********************************/
	public function deleteUser($id){
		$sql = "DELETE FROM users WHERE user_id = ?";
		$stmt = $this->connect()->prepare($sql);
		$stmt->execute([$id]);
		header("location:index.php");
	}

	/******************************************DELETE Article***********************************/
	public function deleteArticle($id){
		$sql = "DELETE FROM articles WHERE user_id = ?";
		$stmt = $this->connect()->prepare($sql);
		$stmt->execute([$id]);
		header("location:posts.php");
	}

/******************************************DELETE Article***********************************/
	public function deleteComment($id){
		$sql = "DELETE FROM comments WHERE comment_id = ?";
		$stmt = $this->connect()->prepare($sql);
		$stmt->execute([$id]);
	}

	/******************************************DELETE USER***********************************/
	public function deleteAdmin($id){
		$sql = "DELETE FROM admin WHERE admin_id = ?";
		$stmt = $this->connect()->prepare($sql);
		$stmt->execute([$id]);
		header("location:tables.php");
	}

/********************************************VIEW POSTS***************************************/

	public function displayPost(){
		$sql = "SELECT * FROM articles";
		$stmt = $this->connect()->query($sql);
		$stmt->execute();
		return $stmt->fetchAll();
	}

	public function totalPost(){
		$sql = "SELECT * FROM articles";
		$stmt = $this->connect()->query($sql);
		$num = $stmt->rowCount();
		return $num;
	}

/********************************************VIEW POSTS***************************************/

	public function displayComment(){
		$sql = "SELECT * FROM comments";
		$stmt = $this->connect()->query($sql);
		$stmt->execute();
		return $stmt->fetchAll();
	}

	public function totalComment(){
		$sql = "SELECT * FROM comments";
		$stmt = $this->connect()->query($sql);
		$num = $stmt->rowCount();
		return $num;
	}

/*****************************************Total page view by IP address************************************/

	public function pageCounter($ip){
		$sql = "SELECT ip_address FROM page_view WHERE ip_address = ?";
		$stmt = $this->connect()->prepare($sql);
		$stmt->execute([$ip]);
		$num = $stmt->rowCount();
		if ($num == 0) {
			$s = "INSERT INTO page_view (ip_address) VALUES (?)";
			$ss = $this->connect()->prepare($s);
			$ss->execute([$ip]);
		} 

		return $num;
		

	}









}

