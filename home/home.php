<?php
	session_start();
	if( isset($_SESSION["id"]) ){

	include("../layout/header.php");
	// $title = "Test amar";
	// $Descrip = "";

	// $id = "";

	
		if(isset($_POST["saveBtn"])){
			$title = mysqli_real_escape_string($conn,$_POST["Title"]);
			$Descrip = mysqli_real_escape_string($conn,$_POST["Description"]);
			$date = date("d-m-Y");
			// $id = $_POST["ID"];

			if( !empty($title) && !empty($Descrip) ){
				if( empty($_POST["ID"]) ){
					$sql = "INSERT INTO title(title,Description,currentDate) VALUES('$title','$Descrip','$date');";
					$result = mysqli_query($conn,$sql);
				}else{
					$sql = "UPDATE title SET title='$title',description='$Descrip',currentDate='$date' WHERE id =".$_POST["ID"]; 
					$result = mysqli_query($conn,$sql);	
				}
				header("refresh:0");
				
			}else {
				header("location:home.php?cmd=emptyinput");
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
								$sql = "SELECT * FROM title";
								$result = mysqli_query($conn,$sql);
								if( mysqli_num_rows($result) > 0 ){
									while( $row=mysqli_fetch_assoc($result) ){
							?>
										<div class="border-bottom mb-3">
											<a href="../delete/deleteTitle.php?delete=<?=$row["id"]?>"  name="delete" class="btn btn-danger btn-sm float-right">
												<li class="far fa-trash-alt"></li>
											</a>
											<a name="edit" data-amar="<?=$row["id"]?>" class="btn btn-primary btn-sm float-right mr-2 editTitle" >
												<li class="far fa-edit" ></li>
											</a>
											<b><?=$row["title"]?></b></br/>
											<small><?=$row["Description"]?></small>
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
							<div class="p-2">
								<footer>
									<p class="text-center">
										<button class="btn btn-success" name="saveBtn">Save</button>
									</p>
								</footer>
							</div>
						</form>
					</div>
					
				</div>
			</div>

		</div>
	</body>
	
<script>
	
function displayField() {
	var field = [
					{
						"label" : "Id",
						"type" : "text",
						"icon" : "fas fa-book",
						"name" : "ID",
						"Placeholder" : "ID",
						"id" : "id",
						"class" : "d-none"
						
					},
					{
						"label" : "Title",
						"type" : "text",
						"icon" : "fas fa-book",
						"name" : "Title",
						"Placeholder" : "Title",
						"id" : "title",
						"class" : ""
						
						
					},
					{
						"label" : "Description",
						"type" : "textarea",
						"icon" : "far fa-comment-alt",
						"name" : "Description",
						"Placeholder" : "",
						"id" : "description",
						"class" : ""
						
					}
				];
				
				
	console.log(field);
		
		var content = "";
		for(var i = 0; i < field.length; i++){
			if( field[i].type == "text"){
				content += '<h6 class="'+ field[i].class+ '">' + field[i].label + '</h6>'
							+ '<div class="form-group '+ field[i].class +'">'
								+ '<div class="input-group">'
									+ '<div class="input-group-prepend">'
										+ '<span class="input-group-text"><li class="'+ field[i].icon+'"></li></span>'
									+ '</div>'
									+ '<input class="form-control" value="'+ field[i].value +'" id="'+ field[i].id +'" type="'+ field[i].type +'" name="'+ field[i].name  
									
									+'" placeholder="'+ field[i].Placeholder +'">'
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
									+ '<textarea class="form-control" id="'+ field[i].id +'" type="'+ field[i].type +'" name="'+ field[i].name 
											+'" placeholder="'+ field[i].Placeholder+'">'	
									+ '</textarea>'
								+ '</div>'
							+ '</div>'
			}
		}
		
		$("#titleInput").html(content);
	}
	
	
	$("#addTitle").hide();
	
	$("#backBtn").click(()=>{
		$("#titleList").show();
		$("#addTitle").hide();
		
	});
	
	$("#addTitletBtn").click(()=>{
		$("#titleList").hide();
		$("#addTitle").show();
		displayField ();
		
	});		

	if( window.location.search == "?cmd=emptyinput" ){
		$("#titleList").hide();
		$("#addTitle").show();
		displayField ();
	}

	$(document).ready(function (){
		$(".editTitle").click( function() {
			/* e.preventDefault() */
			// $pos = $(e.currentTarget).attr('data-amar');
			// console.log(e);
			
			$("#titleList").hide();
			$("#addTitle").show();
			displayField ();
			$pos = $(this).attr('data-amar');
			$pos = parseInt($pos);

			$.ajax({
				url : "../edit/editTitle.php",
				method : "POST",
				data : {
							id : $pos
						},
				datatype : "JSON",
				success : function(response){
					response = JSON.parse(response);
					$("#title").val(response.title);
					$("#description").val(response.description);
					$("#id").val(response.id);
					console.log(typeof $pos,$pos);
				}				
			}); 
 			
		});
	});
	
</script>
</html>
<?php	
			}
?>