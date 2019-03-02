<?php
	session_start();
	if( isset($_SESSION["id"]) ){

	include("../layout/header.php");
	
	if(isset($_POST["saveTcktBtn"])){
		$sub = mysqli_real_escape_string($conn,$_POST["subject"]);
		$reply = mysqli_real_escape_string($conn,$_POST["comment"]);
		$name = mysqli_real_escape_string($conn,$_POST["user"]);
		$mail = mysqli_real_escape_string($conn,$_POST["mail"]);
		$mob = mysqli_real_escape_string($conn,$_POST["mob"]);
		$dept = mysqli_real_escape_string($conn,$_POST["dept"]);
		$priority = mysqli_real_escape_string($conn,$_POST["priority"]);
		$date = date("d-m-Y H:i:sa");
		
		
		if(isset($_POST["status"])){
			$status = $_POST["status"];			
		}else{
			$status = "";
		}
		
		
		if( !empty($sub) && !empty($name) && !empty($mail) && !empty($mob) && !empty($dept) && !empty($priority) ){
			if( preg_match("/^[a-zA-Z]*$/",$name) && preg_match("/^[a-zA-Z]*$/",$sub) ){
				if( filter_var($mail,FILTER_VALIDATE_EMAIL) ){
					if( preg_match("/^[0-9]{10}+$/",$mob) ){
							
						if( empty($_POST["id"]) ){
							$sql = "INSERT INTO ticketinfo(subject,reply,name,mail,mob,dept,priority,status,date)
											VALUES('$sub','$reply','$name','$mail','$mob','$dept','$priority','$status','$date');";
							
							$result = mysqli_query($conn,$sql);
						}else{
							$sql = "UPDATE ticketinfo SET subject='$sub',reply='$reply',name='$name',mail='$mail',mob='$mob',dept='$dept',priority='$priority',date='$date'
												WHERE id =".$_POST["id"]; 
							$result = mysqli_query($conn,$sql);	
						}
						
						header("Refresh:0");
						
					}else{
						header("location:ticket.php?cmd=invalidMob");
					}
				}else{
					header("location:ticket.php?cmd=invalidMail");
				}
			}else{
				header("location:ticket.php?cmd=invalidChar");
			}
		}else{
			header("location:ticket.php?cmd=emptyinput");
		}
		
	}
	
	
?>


				<div class="col-md-10 bg-light p-4 " style="height:calc(100vh)">
				
				
					<div class="bg-white" id="ticketList">
						<div class="border-bottom p-3">
							<header>
								<div>
									<button class="btn btn-success btn-sm float-right" id="addTcktBtn">
										<li class="fas fa-plus-circle mr-2"></li>New Tickets
									</button>
									<h5 class="text-muted"><li class="fas fa-ticket-alt mr-3"></li>Tickets</h5>
								</div>
							</header>
						</div>
						<div class="bg-white p-3">
							<?php
								$sql = "SELECT * FROM ticketinfo";
								$result = mysqli_query($conn,$sql);
								if( mysqli_num_rows($result) > 0 ){
									while( $row = mysqli_fetch_assoc($result) ){
							?>
								<div class="border p-2 my-2">
									<div class="row mb-3">
										<div class="col-md-4">
											<span class="ml-3">#<?=$row["id"]?></span>
										</div>
										<div class="col-md-8 ">
											<span class="card-text float-right">Created Date-<?=$row["date"]?></span>
										</div>
									</div>
									<div class="row mb-3">
										<div class="col-md-6">
											<div class="row">
												<div class="col-md-2">
													<li class="far fa-user fa-4x"></li>
												</div>
												<div class="col-md-5">
													<span><?=$row["name"]?></span><br/>
													<span>Departmant-<?=$row["dept"]?></span><br/>
													<span>Priority-<?=$row["priority"]?></span>
												</div>
											</div>
										</div>
										<div class="col-md-6">
											<span class="text-muted">Subject</span><br/>
											<span class=""><?=$row["subject"]?></span>
										</div>
									</div>
									<div class="row">
										<div class="col-md-4">
											<small class="card-text border rounded p-1">Updated Date-<?=$row["date"]?></small>
										</div>
										<div class="col-md-8">
											<a href="../delete/deleteTicket.php?delete=<?=$row["id"]?>" class="btn btn-danger btn-sm float-right">
												<li class="fas fa-trash-alt"></li>
											</a>
											<button class="btn btn-primary btn-sm float-right mr-2 editBtn" value="<?=$row["id"]?>">
												<li class="far fa-edit "></li>
											</button>
										</div>
									</div>
								</div>
										
								<?php	
									}
								}
							?>
							
						</div>
					</div>
					<form action="ticket.php" method="post" >
						<div class="row " id="addTicket">
							<div class="col-md-8 px-2 ">
								<div class="bg-white border">
									<div class=" p-3 border-bottom">
										<header>
											<div>
												<button class="btn btn-secondary btn-sm float-right ml-2" type="button" id="backBtn">
													<li class="fas fa-angle-left"></li>
												</button>
												<button class="btn btn-success btn-sm float-right " type="button">
													<li class="far fa-file"></li>
												</button>
												<h5 class="text-muted"><li class="far fa-smile mr-3"></li>New Tickets</h5>
											</div>
										</header>
									</div>
									<div class="p-3 border-bottom" id="ticInputs">
									
									</div>
									<div class="p-2 ">
										<footer>
											<p class="text-center">
												<button class="btn btn-success" name="saveTcktBtn" type="submit">Save</button>
											</p>
										</footer>
									</div> 
								</div>
							</div>
							<div class="col-md-4 px-2">
								<div class="bg-white border">
									<div class=" p-3 border-bottom">
										<header>
											<div>
												<h5 class="text-muted"><li class="far fa-smile mr-3"></li>Ticket Info</h5>
											</div>
										</header>
									</div>
									<div class="p-3" id="ticInfo">
									
									</div>
								</div>
							</div>
						</div>
					</form>
				</div>
			
			</div>
		</div>
	</body>	
<script>
	$("#addTicket").hide();
	
	$("#backBtn").click(()=>{
		$("#ticketList").show();
		$("#addTicket").hide();
	});
	
	$("#addTcktBtn").click(()=>{
		$("#ticketList").hide();
		$("#addTicket").show();
		displayField();
	});	
	
	if( window.location.search == "?cmd=invalidMob" || window.location.search == "?cmd=invalidChar" || window.location.search == "?cmd=invalidMail" 
																			|| window.location.search=="?cmd=emptyinput"){
		$("#ticketList").hide();
		$("#addTicket").show();
		displayField();
	}
	
	$(document).ready(function(){
		$(".editBtn").click(function(){
			$("#ticketList").hide();
			$("#addTicket").show();
			displayField();
			$pos = $(this).val();
			$pos = parseInt($pos);
			
			$.ajax({
				url : "../edit/editTicket.php",
				datatype : "JSON",
				method : "POST",
				data : {
							id : $pos
						},
				success : function(response){
					response = JSON.parse(response);
					$("#uId").val(response.id);
					$("#uSubject").val(response.subject);
					$("#uComment").val(response.reply);
					$("#uName").val(response.name);
					$("#uMail").val(response.mail);
					$("#uMob").val(response.mob);
					$("#uDept").val(response.dept);
					$("#uPriority").val(response.priority);
					// $("#uFile").val(response.id);
					// $("#uStatus").val(response.status);
					
					console.log(response.id);
					
				}
			});
		});
	});
	
	function displayField(){
		
		var field = [
						{
							"label" : "id",
							"type" : "text",
							"icon" : "far fa-user",
							"placeholder" : "ID",
							"name" : "id",
							"id" : "uId",
							"class" : "d-none"
							
						},
						{
							"label" : "Subject",
							"type" : "text",
							"icon" : "far fa-user",
							"placeholder" : "Subject",
							"name" : "subject",
							"id" : "uSubject",
							"class" : ""
							
						},
						{
							"label" : "Post Reply",
							"type" : "textarea",
							"icon" : "",
							"placeholder" : "",
							"name" : "comment",
							"id" : "uComment",
							"class" : ""
							
						},
						{
							"label" : "Attachments",
							"type" : "file",
							"icon" : "",
							"placeholder" : "",
							"name" : "file",
							"id" : "uFile",
							"class" : ""
							
						},
						{
							"label" : "Ticket Status",
							"type" : "checkbox",
							"icon" : "",
							"placeholder" : "",
							"name" : "status",
							"value" : "close on reply",
							"id" : "uStatus",
							"class" : ""
							
						}
					];
	
	
	var data = "";
	for( i = 0; i < field.length; i++){
		if( field[i].type == 'text' ){
			data += '<div>'
						+ '<h6 class="'+field[i].class+'">'+ field[i].label +'</h6>'
						+ '<div class="form-group '+ field[i].class +'">'
							+ '<div class="input-group">'
								+ '<div class="input-group-prepend">'
									+ '<span class="input-group-text"><li class="'+field[i].icon+'"></li></span>'
								+ '</div>'
								+ '<input type="'+ field[i].type+'" class="form-control" name="'+field[i].name
										+'" placeholder="'+field[i].placeholder+'"id="'+ field[i].id +'">'
							+ '</div>'
						+ '</div>'
					+ '</div>'
		}
		if( field[i].type == 'textarea' ){
			data += '<div>'
						+ '<h6>'+ field[i].label +'</h6>'
						+ '<div class="form-group">'
							+ '<div class="input-group">'
								+ '<textarea type="'+ field[i].type+'" class="form-control" rows="10" name="'+field[i].name
														+'" placeholder="'+field[i].placeholder+'" id="'+ field[i].id +'"></textarea>'
							+ '</div>'
						+ '</div>'
					+ '</div>'
					
		}
		if( field[i].type == 'file' ){
			data += '<div>'
						+ '<h6>'+ field[i].label +'</h6>'
						+ '<div class="form-group">'
							+ '<div class="input-group">'
								+ '<div class="custom-file">'
									+ '<input type="'+ field[i].type+'" class="custom-file-input" name="'+field[i].name
																	+'" placeholder="'+field[i].placeholder+'" id="'+ field[i].id +'">'
									+ '<label class="custom-file-label">Choose file</label>'
								+ '</div>'
							+ '</div>'
						+ '</div>'
					+ '</div>'
		}
		if( field[i].type == 'checkbox' ){
			data += '<div>'
						+ '<h6>'+ field[i].label +'</h6>'
						+ '<div class="form-group">'
							+ '<div class="checkbox">'
								+ '<label><input type="'+ field[i].type+'" name="'+field[i].name+'" value="'+field[i].value+'"class="mr-2" id="'
											+ field[i].id +'">Close on reply</label>'
							+ '</div>'
						+ '</div>'
					+ '</div>'
		}
	}
	
	
	$("#ticInputs").html(data);
	
	var infoField = [
						{
							"label" : "Name",
							"type" : "text",
							"icon" : "far fa-user",
							"name" : "user",
							"placeholder" : "Name",
							"id" : "uName",
							"class" : ""
						},
						{
							"label" : "Email Address",
							"type" : "text",
							"icon" : "far fa-envelope",
							"name" : "mail",
							"placeholder" : "Email Address",
							"id" : "uMail",
							"class" : ""
						},
						{
							"label" : "Mobile Number",
							"type" : "text",
							"icon" : "fas fa-phone",
							"name" : "mob",
							"placeholder" : "Mobile Number",
							"id" : "uMob",
							"class" : ""
						},
						{
							"label" : "Department",
							"type" : "select",
							"icon" : "far fa-user",
							"name" : "dept",
							"id" : "uDept",
							"class" : "",
							"placeholder" : "",
							"option" :[
										{
											'value' : 'sales',
											'labelName' : 'Sales'
										},
										{
											'value' : 'support',
											'labelName' : 'Support'
										}
									]
						},
						{
							"label" : "Priority",
							"type" : "select",
							"icon" : "far fa-user",
							"name" : "priority",
							"id" : "uPriority",
							"class" : "",	
							"placeholder" : "",
							"option" :[
										{
											'value' : 'low',
											'labelName' : 'Low'
										},
										{
											'value' : 'medium',
											'labelName' : 'Medium'
										},
										{
											'value' : 'high',
											'labelName' : 'High'
										}
									]
						}
					];
				
	var infoData = "";
	
	for( i = 0; i < infoField.length; i++){
		if( infoField[i].type == 'text'){
			infoData += '<div>' 
							+ '<h6>'+infoField[i].label+'</h6>'
							+ '<div class="form-group">'
								+ '<div class="input-group">'
									+ '<div class="input-group-prepend">'
										+ '<span class="input-group-text "><li class="'+infoField[i].icon+'"></span>'
									+ '</div>'
									+ '<input class="form-control" type="'+infoField[i].type+'" name="'+infoField[i].name
											+'" Placeholder="'+infoField[i].placeholder+'" id="'+ infoField[i].id +'">'
								+ '</div>'
							+ '</div>'	
						+ '</div>'
		}
		if( infoField[i].type == 'select' ){
			var selectInfo = '<select class="form-control" type="'+ infoField[i].type +'" name="'+ infoField[i].name +'" id="'+ infoField[i].id +'">';
			for( var j = 0; j < infoField[i].option.length; j++){
				selectInfo += '<option value="'+ infoField[i].option[j].value +'">'
									+ infoField[i].option[j].labelName 
								+ '</option>'
			}
			selectInfo += '</select>';
			
				infoData += '<div>' 
							+ '<h6>'+infoField[i].label+'</h6>'
							+ '<div class="form-group">'
								+ '<div class="input-group">'
									+ '<div class="input-group-prepend">'
										+ '<span class="input-group-text "><li class="'+infoField[i].icon+'"></span>'
									+ '</div>'
									+ selectInfo
								+ '</div>'
							+ '</div>'	
						+ '</div>'
		}
	}
					
	$("#ticInfo").html(infoData);
}

</script>
</html>

<?php
				}
		?>