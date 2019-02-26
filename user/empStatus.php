<?php
	include("../database/database.php");
	
	if(isset($_GET["status"])){
		
		$sql = "SELECT * FROM data WHERE id=".$_GET["status"];
		$result = mysqli_query($conn,$sql);
		$row = mysqli_fetch_assoc($result);
		
		if( $row["empStatus"] == 'Active' ){
			$sql = "UPDATE data SET empStatus='InActive'  WHERE id=".$_GET["status"];
			$result = mysqli_query($conn,$sql);
			
			header("location:user.php?status=changed");
		}else{
			$sql = "UPDATE data SET empStatus='Active'  WHERE id=".$_GET["status"];
			$result = mysqli_query($conn,$sql);
			
			header("location:user.php?status=changed");
		}
	}
?>