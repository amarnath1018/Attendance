<?php
	include("../database/database.php");
	
	if(isset ($_POST["id"])){
		$sql = "SELECT * FROM  userdata WHERE id =".$_POST["id"];
		$result = mysqli_query($conn,$sql);
		if( mysqli_num_rows($result) > 0 ){
			$row = mysqli_fetch_assoc($result);
			$response["id"] = $row["id"];
			$response["empName"] = $row["empName"];
			$response["empRole"] = $row["empRole"];
			$response["empFn"] = $row["empFn"];
			$response["empLn"] = $row["empLn"];
			$response["empMob"] = $row["empMob"];
			$response["empStatus"] = $row["empStatus"];
			$response["empId"] = $row["empId"];
			$response["empPersonalmail"] = $row["empPersonalmail"];
			$response["empOfficialmail"] = $row["empOfficialmail"];
			
			
			echo json_encode($response);
			
		}
	}
?>


