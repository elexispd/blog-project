$(document).ready(function(){				

user login js
$("#userLogin").click(function(){
	var email = $("#userEmail").val();
	var pass = $("#userPassword").val();
	var userLogin = $(this).text();
	
	$.ajax({
		url: 'php/includes/login.inc.php',
		method: 'POST',
		data: {email:email, pass:pass, userLogin:userLogin},
		success: function(data){
			if (data == "Login successful") {
				$(".msg").html(data).css('color','green');
			} else{
				$(".msg").html(data).css('color','red');
			}
			
		},
		statusCode: {
			404: function(){
				window.location.href="admin/404.html";
			}
		}

	});
	
});
					

// User register js
$("#userRegister").click(function(){
	var fname = $("#userFirstName").val();
	var lname = $("#userLastName").val();
	var email = $("#userEmail").val();
	var username = $("#userUsername").val();
	var pass = $("#userPassword").val();
	var cpass = $("#userPasswordConfirm").val();
	var userRegister = $(this).text();
	
	$.ajax({
		url: 'php/includes/register.inc.php',
		method: 'POST',
		data: {email:email, password:pass, cpassword:cpass, fname:fname, lname:lname, username:username, userRegister:userRegister},
		success: function(data){
			if (data == "Sign up successful") {
				$(".msg").html(data).css('color','green');
			} else{
				$(".msg").html(data).css('color','red');
			}
			
		},
		statusCode: {
			404: function(){
				window.location.href="404.html";
			}
		}

	});
	
});

/********************************Comment******************************/

// $("#addCom").click(function(){
// 	var text = $("#text").val();
// 	var id= $("#id").val();
// 	var email= $("#email").val();
// 	var url= $("#url").val();
// 	var com = $(this).text();
	
// 	$.ajax({
// 		url: 'php/includes/article.inc.php',
// 		method: 'POST',
// 		data: {text:text, email:email, id:id, com:com},
// 		success: function(data){
// 			if (data == "You Commented") {
// 				$(".msg").html(data).css('color','green');
// 				// $("input").val("");
// 				setInterval(function(){
// 					window.location.href="blog.php?id="+id+"&topic=" + url;
// 				}, 500);
// 			} else{
// 				$(".msg").html(data).css('color','red');
// 			}
			
// 		},
// 		statusCode: {
// 			404: function(){
// 				window.location.href="404.html";
// 			}
// 		}

// 	});
	
// });

 // $("form").on("submit", function(e){
 // 	$.post('php/includes/article.inc.php', $(this).serialize(), function(data){
 // 	// 	if (data == "You Commented") {
	// 	// 	$(".msg").html(data).css('color','green');
	// 	// 	$("input").val("");
	// 	// 	setInterval(function(){
	// 	// 		$(".msg").html("")
	// 	// 	}, 1000);
	// 	// } else{
	// 	// 	$(".msg").html(data).css('color','red');
	// 	// }

	// 	console.log(data)
 // 	})

 // 	e.preventDefault();

 // })



})

