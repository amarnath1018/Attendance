<?php
	include("../database/database.php");
	
	if( isset($_POST["id"]) ){
		$sql = "SELECT * FROM ticketinfo WHERE id=".$_POST["id"];
		$result = mysqli_query($conn,$sql);
		if( mysqli_num_rows($result) > 0 ){
			$row = mysqli_fetch_assoc($result);
			$response["id"] = $row["id"];
			$response["subject"] = $row["subject"];
			$response["reply"] = $row["reply"];
			$response["status"] = $row["status"];
			$response["name"] = $row["name"];
			$response["mail"] = $row["mail"];
			$response["mob"] = $row["mob"];
			$response["dept"] = $row["dept"];
			$response["priority"] = $row["priority"];
			
			echo json_encode($response);
			
			// print_r($response);
			// exit();
		}
	}

	
?>