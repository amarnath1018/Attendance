<?php
	session_start();
	if( isset($_SESSION["id"]) ){

	include("../layout/header.php");
	
	if(isset($_GET["edit"])){
		// exit();
		$sql = "SELECT * FROM updates WHERE id=".$_GET["edit"];
		$result = mysqli_query($conn,$sql);
		$row = mysqli_fetch_assoc($result);
		
		
		
		
	}

	// header("location:../home/home.php?edit=success");
?>
	<div class="col-md-10 bg-light p-4 " style="height:calc(100vh)">
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
										+ '<input class="form-control" type="'+ field[i].type +'" name="'+ field[i].name +'" value="'+<?=$row["id"]?>+'" placeholder="'+ field[i].Placeholder +'" >'
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
		
</script>	
</html>	
	

	
<?php
	}
?>