$(document).ready(function(){


// admin login js
$("#login").click(function(){
	var email = $("#inputEmail").val();
	var pass = $("#inputPassword").val();
	
	$.ajax({
		url: '../php/includes/login.inc.php',
		method: 'POST',
		data: {email:email, pass:pass},
		success: function(data){
			if (data == "Login successful") {
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

// admin register js
$("#register").click(function(){
	var fname = $("#inputFirstName").val();
	var lname = $("#inputLastName").val();
	var email = $("#email").val();
	var username = $("#username").val();
	var pass = $("#inputPassword").val();
	var cpass = $("#inputPasswordConfirm").val();
	var register = $(this).text();
	
	$.ajax({
		url: '../php/includes/register.inc.php',
		method: 'POST',
		data: {email:email, password:pass, cpassword:cpass, fname:fname, lname:lname, username:username, register:register},
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


// add Category
$("#addCat").click(function(){
	var addCat = $("#cat").val();
	var cat = $(this).text();
	
	$.ajax({
		url: '../php/includes/admin.inc.php',
		method: 'POST',
		data: {addCat:addCat, cat:cat},
		success: function(data){
			if (data == "Category Has Been Added Successfully") {
				$(".msg").html(data).css('color','green');
				$("input").val("");
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



})

