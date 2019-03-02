<?php

	session_start();
	include("database/database.php");

	if( isset($_POST["login"])) {
		$user = mysqli_real_escape_string($conn,$_POST["username"]);
		$pwd = mysqli_real_escape_string($conn,$_POST["pwd"]);


		if( !empty($user) && !empty($pwd)){
			$sql = "SELECT * FROM admin WHERE username = '$user'";			
			$result = mysqli_query($conn, $sql);			
			$row = mysqli_num_rows($result);

			if( mysqli_num_rows($result) > 0 ){
				$row = mysqli_fetch_assoc($result);
				$hashpwdcheck = password_verify($pwd, $row["password"]);
				if( $hashpwdcheck == true ) {
					$_SESSION["id"] = $row["id"];
					
					header("location:home/home.php");
				}
				if( $hashpwdcheck == false ){
					header("location:index.php?cmd=notmatching");
				}
			}else{
				header("location:index.php?cmd=Nouser");
			}
			
		}else{
			header("location:index.php?cmd=emptyinput");
		}
	}else{
		echo "something wrong";
	}
?>