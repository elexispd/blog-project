<?php 

class User extends Database{
	private $username;
	private $password;
	private $cpassword;
	private $email;
	private $firstName;
	private $lastName;
	private $user_id;
	private $message ="";


//********************************sign up************************************************/
	public function setUsername(){
		if(empty($this->username)){
			$this->message = "username is required";
		} else if (!preg_match("/^[a-zA-Z0-9]+$/", $this->username)) {
			$this->message = "invalid username";
		} else if(strlen($this->username)<=2 ){
			$this->message = "username is too short";
		} else{
			$sql = "SELECT * FROM users WHERE username = ?";
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
			$sql2 = "SELECT * FROM users WHERE user_email = ?";
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
				$this->user_id = time()+1000000;
				$hash = password_hash($this->password, PASSWORD_DEFAULT);
				$sql = "INSERT INTO users (user_id, username, user_email, user_password) VALUES (?,?,?,?)";
				$stmt = $this->connect()->prepare($sql);
				$stmt->execute([$this->user_id, strtolower($this->username), $this->email, $hash]);
				$this->message = "Sign up successful";
					
				}
				
		
	}

	//**************************************LOGIN******************************************/

	public function userLogin($email, $password){
		$this->email = $email;
		$this->password = $password;
		$this->getEmail();
	}

	public function getEmail(){
		$sql = "SELECT * FROM users WHERE user_email = ?";
		$stmt = $this->connect()->prepare($sql);
		$stmt->execute([$this->email]);
		$row= $stmt->fetch();
		$numRow = $stmt->rowCount();		
		
		if ($numRow == 1) {
			$dehash = password_verify($this->password, $row["user_password"]);
			if ($dehash == true) {
				$this->message = "Login successful";
				session_start();
				$_SESSION["user"] = $this->email;
			} else {
				$this->message = "password does not match";
			}
			
		} else {
			$this->message = "Invalid Login details";
		}
		
	}

	public function userMessage(){
		echo $this->message;
	}
}

