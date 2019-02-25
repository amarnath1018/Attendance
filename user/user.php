<?php
	session_start();
	if( isset($_SESSION["id"])){

	include("..\layout\header.php");
	
	if(isset($_POST["save"])){
		$first = mysqli_real_escape_string($conn,$_POST["first"]);
		$last = mysqli_real_escape_string($conn,$_POST["last"]);
		$username = mysqli_real_escape_string($conn,$_POST["user"]);
		$userRole = mysqli_real_escape_string($conn,$_POST["userRole"]);
		$empId = mysqli_real_escape_string($conn,$_POST["employeeId"]);
		$status = mysqli_real_escape_string($conn,$_POST["status"]);
		$officialMail = mysqli_real_escape_string($conn,$_POST["officialMail"]);
		$mob = mysqli_real_escape_string($conn,$_POST["mobile"]);
		$personalMail = mysqli_real_escape_string($conn,$_POST["personalMail"]);
		$dob = mysqli_real_escape_string($conn,$_POST["dob"]);
		$add1 = mysqli_real_escape_string($conn,$_POST["address1"]);
		$add2 = mysqli_real_escape_string($conn,$_POST["address2"]);
		$area = mysqli_real_escape_string($conn,$_POST["area"]);
		$country = mysqli_real_escape_string($conn,$_POST["country"]);
		$pincode = mysqli_real_escape_string($conn,$_POST["pin"]);
		$currentDate = date("d-m-Y");
		
		
		// print_r($mob);
		// exit();
		
		if( !empty($username) && !empty($userRole) && !empty($officialMail) &&!empty($personalMail) && !empty($first) && !empty($last) && !empty($mob) && !empty($status) ){
			if( filter_var($officialMail,FILTER_VALIDATE_EMAIL) && filter_var($personalMail,FILTER_VALIDATE_EMAIL) ){
				if( preg_match("/^[a-zA-Z]*$/",$username) && preg_match("/^[a-zA-Z]*$/",$first) && preg_match("/^[a-zA-Z]*$/",$last)){
					if( preg_match("/^[0-9]{10}+$/",$mob)){
						$sql = "INSERT INTO data(empFn,empLn,empName,empRole,empId,empStatus,empOfficialmail,empMob,empPersonalmail,
														empDob,empAddress1,empAddress2,empArea,empCountry,empPincode,date) 
											VALUES('$first','$last','$username','$userRole','$empId','$status','$officialMail','$mob','$personalMail',
													'$dob','$add1','$add2','$area','$country','$pincode','$currentDate');";
						$result= mysqli_query($conn,$sql);
						
						header("Refresh:0");
					}else{
						header("location:user.php?save=invalidNumber");
					}
				}else{
					header("location:user.php?save=invalidinputs");
				}
			}else{
				header("location:user.php?save=invalidmailformat");
			}
		}else{
			header("location:user.php?save=emptyinput");
		}
	}

?>



				
				<div class="col-md-10 bg-light p-4 " style="height:calc(100vh);overflow:scroll;">
					<div class="bg-white" id="listuser">
						<div class="border-bottom p-3">
							<header>
								<div>
									<button class="btn btn-success btn-sm float-right" id="addbtn" name="adduser" type="submit">
										<li class="fas fa-plus-circle mr-2"></li>New user
									</button>
									<h5 class="text-muted"><li class="fas fa-user-friends mr-2"></li>Users</h5>
								</div>
							</header>
						</div>
						<div class="p-3">
							<table class="table table-bordered table-striped">
								<thead>
									<tr>
										<td>#</td>
										<td>Personal info</td>
										<td>Username</td>
										<td>User Role</td>
										<td>Status</td>
										<td>Created Date</td>
										<td>#</td>
									</tr>
								</thead>
								<tbody>
									<?php

										$sql = "SELECT * FROM data";
										$result = mysqli_query($conn,$sql);
										$resultCheck = mysqli_num_rows($result);
										if( $resultCheck > 0 ){
											while($row = mysqli_fetch_assoc($result)){
									?>
												<tr>
														<td><?=$row["id"]?></td>
														<td>
															<b><?=$row["empFn"]?><?=$row["empLn"]?></b><br/>
															<small><?=$row["empOfficialmail"]?></small><br/>
															<small><?=$row["empMob"]?></small>
														</td>
														<td><?=$row["empName"]?></td>
														<td><?=$row["empRole"]?></td>
														<td><button class="btn btn-success btn-sm"><?=$row["empStatus"]?></button></td>
														<td><?=$row["date"]?></td>
														<td>
															<button class="btn btn-primary btn-sm">
																<li class="far fa-edit"></li>
															</button>
															<a href="..\delete\deleteUser.php?delete=<?=$row["id"]?>" name="delete" class="btn btn-danger btn-sm">
																<li class="far fa-trash-alt"></li>
															</a>
														</td>
													</tr>
									<?php		}
										} ?>
								</tbody>
							</table>
						</div>
					</div>
						
						
						
					<div class="bg-white" id="adduser">
						<header class="border-bottom p-3">
							<div>
								<button class="btn btn-secondary float-right ml-1" id="backbtn"><li class="fas fa-angle-left"></li></button>
								<button class="btn btn-primary float-right "><li class="far fa-file"></li></button>
								<h5 class="text-muted"><li class="far fa-user mr-3"></li>Edit User</h5>
							</div>
						</header>
						
						
						<form action="user.php" method="post" >
							<div class="row my-5 px-4" id="u-details">
							
							</div>
							
							<div class="row my-3 px-4" id="u-info">
							
							</div>
							<div class="p-2">
								<footer>
									<button class="btn btn-primary " id="save" name="save" type="submit" >Save</button>
								</footer>
							</div>
						</form>
					</div>
					
					
				</div>
			</div>
		</div>
		
	</body>

<script>
	$("#adduser").hide();
		
	
	$("#backbtn").click(()=>{
		$("#adduser").hide();
		$("#listuser").show();
	});
	
	
	var count = 1;
	
	$("#addbtn").click(()=>{
		var field = [
						{
							"class" : "col-md-3 mb-3",
							"headline" : "First Name",
							"icon" : "far fa-user",
							"type" :"text",
							"name" : "first",
							"placeholder" : "First Name"
						},
						{
							"class" : "col-md-3",
							"headline" : "Last Name",
							"icon" : "far fa-user",
							"type" :"text",
							"name" : "last",
							"placeholder" : "Last Name"
						},
						{
							"class" : "col-md-3 mb-3",
							"headline" : "Username",
							"icon" : "far fa-user",
							"type" :"text",
							"name" : "user",
							"placeholder" : "Username"
						},
						{
							"class" : "col-md-3",
							"headline" : "User Role",
							"icon" : "fas fa-user-friends",
							"type" :"select",
							"name" : "userRole",
							"placeholder" : "",
							"option" : [{
											'label' : 'Admin',
											'value' : 'Admin' 
										},{
											'label' : 'Demonstration',
											'value' : 'Demonstration' 
										}]
						},
						{
							"class" : "col-md-3 mb-3",
							"headline" : "Employee ID",
							"icon" : "far fa-user",
							"type" :"text",
							"name" : "employeeId",
							"placeholder" : "ID"
						},
						{
							"class" : "col-md-3 mb-3",
							"headline" : "Status",
							"icon" : "far fa-check-circle",
							"type" :"select",
							"name" : "status",
							"option" : [{
								'label' : 'Active',
								'value' : 'Active' 
							},{
								'label' : 'InActive',
								'value' : 'Inactive' 
							}]
						},
						{
							"class" : "col-md-6",
							"headline" : "Official E-mail Address",
							"icon" : "far fa-envelope",
							"type" :"text",
							"name" : "officialMail",
							"placeholder" : "E-mail Address"
						},
						{
							"class" : "col-md-6",
							"headline" : "Mobile Number",
							"icon" : "fas fa-phone",
							"type" :"text",
							"name" : "mobile",
							"placeholder" : "Mobile Number"
						},
						
						{
							"class" : "col-md-6",
							"headline" : "Personal E-mail Address",
							"icon" : "far fa-envelope",
							"type" :"text",
							"name" : "personalMail",
							"placeholder" : "E-mail Address"
						}
					];
					
		var field2 = [
						{
							"class" : "col-md-6 mb-3",
							"headline" : "Date Of Birth",
							"icon" : "fas fa-calendar-alt",
							"type" :"date",
							"name" : "dob",
							"placeholder" : ""
							
						},
						{
							"class" : "col-md-6",
							"headline" : "Address Line1",
							"icon" : "far fa-address-card",
							"type" :"text",
							"name" : "address1",
							"placeholder" : "Address Line1"
						},
						{
							"class" : "col-md-6 mb-3",
							"headline" : "Address Line2",
							"icon" : "far fa-address-card",
							"type" :"text",
							"name" : "address2",
							"placeholder" : "Address Line2"
						},
						{
							"class" : "col-md-3",
							"headline" : "Area or City",
							"icon" : "fas fa-map-marker-alt",
							"type" :"text",
							"name" : "area",
							"placeholder" : "Area or City"
						},
						{
							"class" : "col-md-3",
							"headline" : "Country",
							"icon" : "fas fa-globe",
							"type" :"text",
							"name" : "country",
							"placeholder" : "Country"
						},
						{
							"class" : "col-md-6 mb-3",
							"headline" : "Pincode",
							"icon" : "fas fa-map-marked",
							"type" :"text",
							"name" : "pin",
							"placeholder" : "Pincode"
						}
					]; 
					
		var primaryDetail = "";
		
		for(var i=0 ; i < field.length ; i++){
			if( field[i].type == 'text'){
				primaryDetail += '<div class="'+field[i].class+'">' 
								+ '<h6>'+field[i].headline+'</h6>'
								+ '<div class="form-group">'
									+ '<div class="input-group">'
										+ '<div class="input-group-prepend">'
											+ '<span class="input-group-text "><li class="'+field[i].icon+'"></span>'
										+ '</div>'
										+ '<input class="form-control" id="'+field[i].id+'" type="'+field[i].type+'" name="'+field[i].name
												+'" Placeholder="'+field[i].placeholder+'">'
									+ '</div>'
								+ '</div>'	
							+ '</div>'
			}
			
			if( field[i].type == 'select'){
				
				console.log(field[i]);
				
				var selectContent = '<select class="form-control" id="'+field[i].id+'" type="'+field[i].type+'" name="'+field[i].name+'" >';
				
				for(var j=0; j< field[i].option.length; j++){
					selectContent += '<option value="'+ field[i].option[j].value +'">' + field[i].option[j].label +'</option>';
				}
				selectContent += '</select>';
				
				
				primaryDetail += '<div class="'+field[i].class+'">' 
							+ '<h6>'+field[i].name+'</h6>'
							+ '<div class="form-group">'
								+ '<div class="input-group">'
									+ '<div class="input-group-prepend">'
										+ '<span class="input-group-text "><li class="'+field[i].icon+'"></span>'
									+ '</div>'
									+ selectContent
								+ '</div>'
							+ '</div>'
						+ '</div>'
			}
		}
		
		   var secondaryDetail = "";
		for(var i=0; i < field2.length; i++){
			secondaryDetail += 	'<div class="'+field2[i].class+'">' 
							+ '<h6>'+field2[i].headline+'</h6>'
							+ '<div class="form-group">'
								+ '<div class="input-group">'
									+ '<div class="input-group-prepend">'
										+ '<span class="input-group-text "><li class="'+field2[i].icon+'"></span>'
									+ '</div>'
									+ '<input class="form-control" id="'+field2[i].id+'" type="'+field2[i].type+'" name="'+field2[i].name
											+'" Placeholder="'+field2[i].placeholder+'">'
								+ '</div>'
							+ '</div>'
						+ '</div>'	
					
		}
		
		
		console.log(secondaryDetail);
		
		
		$("#u-details").html(primaryDetail);
		$("#u-info").html(secondaryDetail);
		$("#adduser").show();
		$("#listuser").hide();

	});

/*$("#addRole").click(()=>{
	var field = [
					{
						"class" : "col-md-12 col-sm-12 mb-3",
						"headline" : "User Role Name",
						"icon" : "fas fa-user-friends",
						"type" :"text",
						"name" : "role",
						"placeholder" : "User Role Name"
					},
					{
						"class" : "col-md-12 col-sm-12 mb-3",
						"headline" : "Description",
						"icon" : "fas fa-user-friends",
						"type" :"text",
						"name" : "role",
						"placeholder" : "User Role Name"
					}
				];
})*/

	
</script>
</html>
<?php
				}
		?>