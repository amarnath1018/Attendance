<?php
	include("../database/database.php");
	
	
	if(isset($_GET["edit"])){
		$sql = "SELECT * FROM updates WHERE id="$_GET["edit"];
		$result = mysqli_query($conn,$sql);
		
	}






	header("location:../home/home.php?edit=success");
?>