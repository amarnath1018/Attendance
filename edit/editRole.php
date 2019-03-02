<?php
	include("../database/database.php");
	
	if( isset($_POST["id"]) ){
		$sql = "SELECT * FROM userroles WHERE id=".$_POST["id"];
		$result = mysqli_query($conn,$sql);
		if( mysqli_num_rows($result) > 0 ){
			$row = mysqli_fetch_assoc($result);
			$response["role"] = $row["r_name"];
			$response["description"] = $row["r_des"];
			$response["id"] = $row["id"];
			
			echo json_encode($response);
			// print_r($response);
			// exit();
		}
	}

	
?>