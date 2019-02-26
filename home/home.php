<?php
	session_start();
	if( isset($_SESSION["id"]) ){

	include("../layout/header.php");
	
	if(isset($_POST["save"])){
		$title = mysqli_real_escape_string($conn,$_POST["Title"]);
		$Descrip = mysqli_real_escape_string($conn,$_POST["Description"]);
		$date = date("d-m-Y");
		
		
		if( !empty($title) && !empty($Descrip) ){
			$sql = "INSERT INTO updates(title,description,date) VALUES('$title','$Descrip','$date');";
			$result = mysqli_query($conn,$sql);
			header("refresh:0");
		}else{
			header("location:home.php?emptyinput");
		}
	}
	
?>
				
				<div class="col-md-10 bg-light p-4 " style="height:calc(100vh)">
					<div class="bg-white" id="titleList">
						<div class="border-bottom p-3">
							<header>
								<div>
									<button class="btn btn-success btn-sm float-right" id="addTitletBtn">
										<li class="fas fa-plus-circle mr-2"></li>Add Title
									</button>
									<h5 class="text-muted"><li class="fas fa-comments mr-3"></li>Recent Updates</h5>
								</div>
							</header>
						</div>
						<div class="p-3">
							<?php
								$sql = "SELECT * FROM updates";
								$result = mysqli_query($conn,$sql);
								if( mysqli_num_rows($result) > 0 ){
									while( $row=mysqli_fetch_assoc($result) ){
							?>
										<div class="border-bottom mb-3">
												<a href="../edit/editTitle.php?edit=<?=$row["id"]?>" name="edit" id="editTitle" class="btn btn-primary btn-sm float-right ml-2">
													<li class="far fa-edit"></li>
												</a>
												<a href="../delete/deleteTitle.php?delete=<?=$row["id"]?>"  name="delete" class="btn btn-danger btn-sm float-right">
													<li class="far fa-trash-alt"></li>
												</a>
												<b><?=$row["title"]?></b></br/>
												<small><?=$row["description"]?></small>
											</div>
								<?php	}
								}
								?>
						</div>
					</div>
					
					<div class="bg-white" id="addTitle">
						<div class="border-bottom p-3">
							<header>
								<div>
									<button class="btn btn-secondary btn-sm float-right ml-2" id="backBtn">
										<li class="fas fa-angle-left"></li>
									</button>
									<button class="btn btn-success btn-sm float-right" id="">
										<li class="far fa-file-alt "></li>
									</button>
									<h5 class="text-muted"><li class="fas fa-pen mr-3"></li>Add Title</h5>
								</div>
							</header>
						</div>
						<form method="post" action="home.php">
							<div class="p-3 border-bottom" id="titleInput">
								
							</div>
							<div class="p-3">
								<footer>
									<button class="btn btn-success" name="save">Save</button>
								</footer>
							</div>
						</form>
					</div>
					
				</div>
			</div>

		</div>
	</body>
	
<script>
	$("#addTitle").hide();
	$("#backBtn").click(()=>{
		$("#titleList").show();
		$("#addTitle").hide();
		
	});
	$("#editTitle").click(()=>{
		$("#titleList").hide();
		$("#addTitle").show();
	});
	
	$("#addTitletBtn").click(()=>{
		$("#titleList").hide();
		$("#addTitle").show();
		
		var field = [
						{
							"label" : "Title",
							"type" : "text",
							"icon" : "fas fa-book",
							"name" : "Title",
							"Placeholder" : "Title"
						},
						{
							"label" : "Description",
							"type" : "textarea",
							"icon" : "far fa-comment-alt",
							"name" : "Description",
							"Placeholder" : ""
						}
					];
					
			console.log(field);
					
			var content = "";
			for(var i = 0; i < field.length; i++){
				if( field[i].type == "text"){
					content += '<h6>' + field[i].label + '</h6>'
								+ '<div class="form-group">'
									+ '<div class="input-group">'
										+ '<div class="input-group-prepend">'
											+ '<span class="input-group-text"><li class="'+ field[i].icon+'"></li></span>'
										+ '</div>'
										+ '<input class="form-control" type="'+ field[i].type +'" name="'+ field[i].name +'" placeholder="'+ field[i].Placeholder +'" >'
									+ '</div>'
								+ '</div>'
				}
				if( field[i].type == "textarea" ){
					content += '<h6>' + field[i].label + '</h6>'
								+ '<div class="form-group">'
									+ '<div class="input-group input-group-lg">'
										+ '<div class="input-group-prepend">'
											+ '<span class="input-group-text"><li class="'+ field[i].icon+'"></li></span>'
										+ '</div>'
										+ '<textarea class="form-control" type="'+ field[i].type +'" name="'+ field[i].name +'" placeholder="'+ field[i].Placeholder+'">'
										+ '</textarea>'
									+ '</div>'
								+ '</div>'
				}
			}
		
		$("#titleInput").html(content);
		
	});

</script>
</html>
<?php	
			}
?>