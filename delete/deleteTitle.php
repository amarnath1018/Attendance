<?php
	include("../database/database.php");
	

	if(isset($_GET["delete"])){
		$sql = "DELETE FROM title WHERE id=".$_GET['delete'];
		$result = mysqli_query($conn,$sql);
		header("location:../home/home.php?cmd=deleted");
		
	}
?>