<?php
	include("../database/database.php");
	echo "hi";
	if(isset($_GET["delete"])){
		$sql = "DELETE FROM data WHERE id=".$_GET["delete"];
		$result = mysqli_query($conn,$sql);
		header("location:../user/user.php");
	}
	
?>