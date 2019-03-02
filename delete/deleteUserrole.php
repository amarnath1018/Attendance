<?php
	include("../database/database.php");
	if( isset($_GET["delete"]) ){
		$sql = "DELETE FROM userroles WHERE id=".$_GET["delete"];
		$result = mysqli_query($conn,$sql);
		header("location:../userrole/userrole.php?delete=success");
	}
?>