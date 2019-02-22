<?php
	include("dbh.php");
	

	if(isset($_GET["delete"])){
		$sql = "DELETE FROM updates WHERE id=".$_GET['delete'];

		$result = mysqli_query($conn,$sql);
		
		
		header("location:home.php?cmd=deleted");
		echo "Delete";
		// exit();
	}
?>