<?php
	include("database/database.php");
	
	if(isset($_POST["signup"])){
		
		$u_first = mysqli_real_escape_string($conn,$_POST["first"]);
		$u_last = mysqli_real_escape_string($conn,$_POST["last"]);
		$u_name = mysqli_real_escape_string($conn,$_POST["username"]);
		$u_pwd = mysqli_real_escape_string($conn,$_POST["password"]);
		
		if( !empty($u_first) && !empty($u_last) && !empty($u_name) && !empty($u_pwd) ){
			if( preg_match("/^[a-zA-Z]*$/",$u_first) && preg_match("/^[a-zA-Z]*$/",$u_last) && preg_match("/^[a-zA-Z]*$/",$u_name)){
				
				$pwdhash = password_hash($u_pwd,PASSWORD_DEFAULT);
				
				$sql = "INSERT INTO admin(first,last,username,password) VALUES('$u_first','$u_last','$u_name','$pwdhash');";
				$result = mysqli_query($conn,$sql);
				header("refresh:0");
			}else{
				header("location:index.php?invalidchar");
			}
		}else{			
			header("location:index.php?cmd=emptyinputs");
		}
	}
	

?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
		
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
		
	</head>
	<body>
		<div class="container-fluid bg-dark" style="height:calc(100vh)">
			<div class="row p-5">
				<div class="col-md-5 col-sm-5 m-auto p-3 bg-light border rounded " id="loginpage">
					<form action="logincheck.php" method="post">
						<div id="login_input">
						
						</div>
						<button name="login" class="btn btn-lg btn-block bg-light text-dark border mt-4"  value="login" type="submit" >
							<li class="fas fa-user-plus mr-3 "></li>Login
						</button>
					</form>
					<div class=" my-3 ">
						<a href="#" id="signup">Create New Account</a>
					</div>
				</div>
				
				<div class="col-md-5 col-sm-5 m-auto p-3 bg-light border rounded " id="signuppage">
					<form action="index.php" method="post">
						<div id="signup_input">
						
						</div>
						<button class="btn btn-secondary mt-4" type="button" name="back" id="backBtn" >
							<li class="fas fa-angle-left"></li>Back 
						</button>
						<button class="btn btn-secondary float-right mt-4" type="submit" name="signup" >Signup </button>
					</form>
				</div>
				
			</div>
		</div>
	</body>
	
	
	
<script src="js/jquery.js"></script>
<script>
	
	var field = [	
					{
						"heading" : "Username",
						"icon" : "far fa-user",
						"type" : "text",
						"name" : "username",
						"placeholder" : "Username",
						"id" : "user"
					},
					{
						"heading" : "Password",
						"icon" : "fas fa-lock",
						"type" : "password",
						"name" : "pwd",
						"placeholder" : "Password",
						"id" : "pass"
					},
					
				];
	
	
	var inputs = "";
	for( i = 0 ; i < field.length; i++){
		inputs += '<div>'
					+ '<label class="form-text" for="'+field[i].id+'">'+ field[i].heading +'</label>'
					+ '<div class="form-group">'
						+ '<div class="input-group">'
							+ '<div class="input-group-prepend">'
								+ '<span class="input-group-text"><li class="'+ field[i].icon+'"></li></span>'
							+ '</div>'
							+ '<input type="'+ field[i].type +'" class="form-control" name="'+ field[i].name +'" placeholder="'
											+ field[i].placeholder +'"id="'+field[i].id+'" >'
						+ '</div>'
					+ '</div>'
				'</div>'
	}
	
	$("#login_input").html(inputs);
	
	$("#signuppage").hide();
	$("#signup").click(()=>{
		$("#loginpage").hide();
		$("#signuppage").show();
		
		
		var signupField = [
							{
								"heading" : "First Name",
								"icon" : "far fa-user",
								"type" : "text",
								"name" : "first",
								"placeholder" : "First",
								"id" : "user_first"
							},
							{
								"heading" : "Last Name",
								"icon" : "far fa-user",
								"type" : "text",
								"name" : "last",
								"placeholder" : "Last",
								"id" : "user_last"
							},
							{
								"heading" : "Username",
								"icon" : "far fa-user",
								"type" : "text",
								"name" : "username",
								"placeholder" : "Username",
								"id" : "user_name"
							},
							{
								"heading" : "Password",
								"icon" : "fas fa-lock",
								"type" : "password",
								"name" : "password",
								"placeholder" : "Password",
								"id" : "user_name"
							}
						];
		
		console.log(signupField);
		
	var singnupInputs = "";
	for( i = 0 ; i < signupField.length; i++){
		singnupInputs += '<div>'
							+ '<label class="form-text" for="'+ signupField[i].id+'">'+ signupField[i].heading +'</label>'
							+ '<div class="form-group">'
								+ '<div class="input-group">'
									+ '<div class="input-group-prepend">'
										+ '<span class="input-group-text"><li class="'+ signupField[i].icon+'"></li></span>'
									+ '</div>'
									+ '<input type="'+ signupField[i].type +'" class="form-control" name="'+ signupField[i].name +'" placeholder="'
													+ signupField[i].placeholder +'"id="'+signupField[i].id+'">'
								+ '</div>'
							+ '</div>'
						'</div>'
	}
		
		
	$("#signup_input").html(singnupInputs);
	
});
	
$("#backBtn").click(()=>{
	$("#loginpage").show();
	$("#signuppage").hide();
});	

console.log("test");


</script>

</html>

