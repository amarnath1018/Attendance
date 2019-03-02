<?php
	include("../database/database.php");
	if(isset($_GET["delete"])){
		$sql = "DELETE FROM userdata WHERE id=".$_GET["delete"];
		$result = mysqli_query($conn,$sql);
		header("location:../user/user.php");
	}
	
?>