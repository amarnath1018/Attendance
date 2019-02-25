<?php
	session_start();
	if( isset($_SESSION["id"])){

	include("..\layout\header.php");

	if(isset($_POST["saveRoleBtn"])){
		$role = mysqli_real_escape_string($conn,$_POST["role"]);
		$description = mysqli_real_escape_string($conn,$_POST["textarea"]);
		$currentDate = date("d-m-Y");
		
		if( !empty($role) && !empty($description) ){
			if(preg_match("/^[a-zA-Z]*$/",$role)){
				$sql = "INSERT INTO userroles(r_name,r_des,date) VALUES('$role','$description','$currentDate');";
				$result = mysqli_query($conn,$sql);
				header("Refresh:0");
			}else{
				header ("location:userrole.php?save=invalidformat");
			}
		}else{
			header ("location:userrole.php?save=emptyinput");
		}
		
		
	}


?>
	
				<div class="col-md-10 bg-light p-4 " style="height:calc(100vh)">
				
					<div class="bg-white" id="listRole">
						<div class="border-bottom p-3">
							<header>
								<div>
									<button class="btn btn-success btn-sm float-right" id="addRoleBtn">
										<li class="fas fa-plus-circle mr-2"></li>New User Roles
									</button>
									<h5 class="text-muted"><li class="fas fa-user-friends mr-3"></li>User Roles</h5>
								</div>
							</header>
						</div>
						<div class=" p-3">
							<table class="table table-bordered table-striped">
								<thead>
									<tr>
										<td>S.No</td>
										<td>User Role Name</td>
										<td>Description</td>
										<td>Created Date</td>
										<td></td>
									</tr>
								</thead>
								<tbody id="outerTbody">
									<?php
										$sql = "SELECT * FROM userroles";
										$result = mysqli_query($conn,$sql);
										if( mysqli_num_rows($result) > 0 ){
											while( $row = mysqli_fetch_assoc($result) ){
									?>
												<tr>
													<td><?=$row["id"]?></td>
													<td><?=$row["r_name"]?></td>
													<td><?=$row["r_des"]?></td>
													<td><?=$row["date"]?></td>
													<td>
														<button class="btn btn-primary btn-sm">
															<li class="far fa-edit"></li>
														</button>
														<a href="../delete/deleteUserrole.php?delete=<?=$row["id"]?>" name="delete" class="btn btn-danger btn-sm">
															<li class="far fa-trash-alt"></li>
														</a>
													</td>
												</tr>
										<?php	}
										} ?>
								</tbody>
							</table>
						</div>
					</div>
					
					<div class="bg-white" id="addRole">
						<header class="p-3 border-bottom">
							<div>
								<button class="btn btn-secondary btn-sm float-right mr-2" id="backBtn"><li class="fas fa-angle-left "></li></button>
								<button class="btn btn-success btn-sm float-right mr-2"><li class="far fa-file"></li></button>
								<h6 class="text-muted"><li class="fas fa-user-friends mr-3"></li>New User Roles</h6>
							</div>
						</header>
						<div>
							<form action="userRole.php" method="post" >
								<div class="p-4" id="uRoleInputs">
									<!--
									<div>
										<p class="">Permission</p>
										<table class="table table-bordered">
											<thead class="bg-light">
												<tr>
													<td>List</td>
													<td>Add</td>
													<td>Edit</td>
													<td>Delete</td>
													<td>View</td>
												</tr>
											</thead>
											<tbody id="innerTbody" >
												
											</tbody>
										</table>
									</div>-->
								</div>
								<div class="p-3 border-top">
									<footer>
										<button class="btn btn-primary" name="saveRoleBtn">Save</button>
									</footer>
								</div>	
									
							</form>

						</div>
					</div>
					
				</div>
			</div>
		</div>
		
	</body>

<script>
	$("#addRole").hide();
	
	$("#backBtn").click(()=>{
		$("#listRole").show();
		$("#addRole").hide();
	});
	
	
	$("#addRoleBtn").click(()=>{
		$("#listRole").hide();
		$("#addRole").show();
		
		var field = [
						{ 	
							"label" : "User Role Name",
							"icon" : "fas fa-user-friends",
							"type" : "text",
							"name" : "role"
						},
						{ 	
							"label" : "Description",
							"icon" : "far fa-comment-alt",
							"type" : "textarea",
							"name" : "textarea"
						}
					];
		
		console.log(field);
		var data = "";
		
		for( i = 0; i < field.length; i++ ){
			if(field[i].type == 'text'){
				data += '<h6>'+field[i].label+'</h6>'
						+ '<div class="form-group">'
							+ '<div class="input-group">'
								+ '<div class="input-group-prepend">'
									+ '<span class="input-group-text">'
										+ '<li class="'+field[i].icon+'"></li>'
									+ '</span>'
								+'</div>'
								+'<input class="form-control" name="'+field[i].name+'" type="'+field[i].type+'" >'
							+'</div>'
						+'</div>';
			}
			if( field[i].type == 'textarea' ){
				data += '<h6>'+field[i].label+'</h6>'
						+ '<div class="form-group">'
							+ '<div class="input-group" >'
								+ '<div class="input-group-prepend">'
									+ '<span class="input-group-text">'
										+ '<li class="'+field[i].icon+'"></li>'
									+ '</span>'
								+'</div>'
								+'<textarea class="form-control" rows="5" name="'+field[i].name+'" type="'+field[i].type+'" ></textarea>'
							+'</div>'
						+'</div>';
			}
		}
		
		
		
		
		$("#uRoleInputs").html(data);
		
		
		
		
		
		
		
		
		
		
		
		
		
		/*var field = [
					{
						"label1" : "Contact List",
						"label2" : "Contact Add",
						"label3" : "Contact Edit",
						"label4" : "Contact Delete",
						"label5" : "Contact View",
						"name" : ""
					},
					{
						"label1" : "Client List",
						"label2" : "",
						"label3" : "Client Edit",
						"label4" : "Client Delete",
						"label5" : ""
					},
					{
						"label1" : "Lead List",
						"label2" : "Lead Add",
						"label3" : "Lead Edit",
						"label4" : "Lead Delete",
						"label5" : ""
					},
					{
						"label1" : "Project List",
						"label2" : "Project Add",
						"label3" : "Project Edit",
						"label4" : "Project Delete",
						"label5" : ""
					},
					{
						"label1" : "Quote List",
						"label2" : "Quote Add",
						"label3" : "Quote Edit",
						"label4" : "Quote Delete",
						"label5" : "Quote View"
					},
					{
						"label1" : "Invoice List",
						"label2" : "Invoice Add",
						"label3" : "Invoice Edit",
						"label4" : "Invoice Delete",
						"label5" : "Invoice View"
					},
					{
						"label1" : "Recurring Invoice  List",
						"label2" : "Recurring Invoice  Add",
						"label3" : "Recurring Invoice  Edit",
						"label4" : "Recurring Invoice  Delete",
						"label5" : "Recurring Invoice  View"
					},
					{
						"label1" : "Ticket List",
						"label2" : "Ticket Add",
						"label3" : "Ticket Edit",
						"label4" : "Ticket Delete",
						"label5" : ""
					},
					{
						"label1" : "Domains List",
						"label2" : "Domains Add",
						"label3" : "Domains Edit",
						"label4" : "Domains Delete",
						"label5" : ""
					},
					{
						"label1" : "Expense List",
						"label2" : "Expense Add",
						"label3" : "Expense Edit",
						"label4" : "Expense Delete",
						"label5" : ""
					},
					{
						"label1" : "User List",
						"label2" : "User Add",
						"label3" : "User Edit",
						"label4" : "User Delete",
						"label5" : ""
					},
					{
						"label1" : "Subscriber List",
						"label2" : "Subscriber Add",
						"label3" : "Subscriber Edit",
						"label4" : "Subscriber Delete",
						"label5" : ""
					}
				];
			console.log(field);	
			
		var table = "";	
		for(var i=0 ; i < field.length ; i++){
			if( field[i].label5 != "" && field[i].label2 != "" ){	
				table += '<tr>' 
							+ '<td>' 
								+ '<div class="form-check">' 
									+ '<input class="form-check-input" type="checkbox" >'
									+ '<label class="form-check-label">'+ field[i].label1 +'</label>'
								+ '</div>'
							+ '</td>'
							+ '<td>' 
								+ '<div class="form-check">' 
									+ '<input class="form-check-input" type="checkbox" >'
									+ '<label class="form-check-label">'+ field[i].label2 +'</label>'
								+ '</div>'
							+ '</td>'
							+ '<td>' 
								+ '<div class="form-check">' 
									+ '<input class="form-check-input" type="checkbox" >'
									+ '<label class="form-check-label">'+ field[i].label3 +'</label>'
								+ '</div>'
							+ '</td>'
							+ '<td>' 
								+ '<div class="form-check">' 
									+ '<input class="form-check-input" type="checkbox" >'
									+ '<label class="form-check-label">'+ field[i].label4 +'</label>'
								+ '</div>'
							+ '</td>'
							+ '<td>' 
								+ '<div class="form-check">' 
									+ '<input class="form-check-input" type="checkbox" >'
									+ '<label class="form-check-label">'+ field[i].label5 +'</label>'
								+ '</div>'
							+ '</td>'
						+ '</tr>'
			}else if( field[i].label2 == "" && field[i].label5 == ""){
				table += '<tr>' 
							+ '<td>' 
								+ '<div class="form-check">' 
									+ '<input class="form-check-input" type="checkbox" >'
									+ '<label class="form-check-label">'+ field[i].label1 +'</label>'
								+ '</div>'
							+ '</td>'
							+ '<td>' 
									
							+ '</td>'
							+ '<td>' 
								+ '<div class="form-check">' 
									+ '<input class="form-check-input" type="checkbox" >'
									+ '<label class="form-check-label">'+ field[i].label3 +'</label>'
								+ '</div>'
							+ '</td>'
							+ '<td>' 
								+ '<div class="form-check">' 
									+ '<input class="form-check-input" type="checkbox" >'
									+ '<label class="form-check-label">'+ field[i].label4 +'</label>'
								+ '</div>'
							+ '</td>'
							+ '<td>' 
								
							+ '</td>'
						+ '</tr>'
			}else if(field[i].label5 == ""){
				table += '<tr>' 
							+ '<td>' 
								+ '<div class="form-check">' 
									+ '<input class="form-check-input" type="checkbox" >'
									+ '<label class="form-check-label">'+ field[i].label1 +'</label>'
								+ '</div>'
							+ '</td>'
							+ '<td>' 
								+ '<div class="form-check">' 
									+ '<input class="form-check-input" type="checkbox" >'
									+ '<label class="form-check-label">'+ field[i].label2 +'</label>'
								+ '</div>'
							+ '</td>'
							+ '<td>' 
								+ '<div class="form-check">' 
									+ '<input class="form-check-input" type="checkbox" >'
									+ '<label class="form-check-label">'+ field[i].label3 +'</label>'
								+ '</div>'
							+ '</td>'
							+ '<td>' 
								+ '<div class="form-check">' 
									+ '<input class="form-check-input" type="checkbox" >'
									+ '<label class="form-check-label">'+ field[i].label4 +'</label>'
								+ '</div>'
							+ '</td>'
							+ '<td>' 
								
							+ '</td>'
						+ '</tr>'
			}
						
		}
		console.log(table);
					
	$("#innerTbody").html(table);*/

});
</script>
</html>	
	
<?php
		}
?>
