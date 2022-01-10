setInterval(function(){
	var signup = $(".msg").text();
	var login = $(".msg").text();

	if (signup == "Sign up successful") {
		window.location.href="login.php";
	} else if(login == "Login successful"){
		window.location.href="index.php";
	}

	
}, 1000)