<?php
	include("../database/database.php");

	if(isset($_GET["delete"])){
		$sql = "DELETE FROM ticketinfo WHERE id=".$_GET["delete"];
		$result = mysqli_query($conn,$sql);
		
		
		header("Location: ../ticket/ticket.php?delete=success");
	}

?>