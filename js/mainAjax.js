$("#register").click(function(){
	// var email = $("#text").val();
	
	$.ajax({
		url: 'register.php',
		method: 'POST',
		data: 'email='+email,
		success: function(data){
			$("#re").html(data);
		},
		statusCode: {
			404: function(){
				$("#re").text("page not found");
			}
		}

	});
})

