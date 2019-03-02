<?php
	include("../database/database.php");
	
	if( isset($_POST["id"]) ){
		$sql = "SELECT * FROM title WHERE id=".$_POST["id"];
		$result = mysqli_query($conn,$sql);
		// if(mysqli_num_rows($result) > 0 ){
			$row = mysqli_fetch_assoc($result);
			$response["title"] = $row["title"];
			$response["description"] = $row["Description"];
			$response["id"] = $row["id"];
			
			echo json_encode($response);
					
		// }
	}

	
?>




























