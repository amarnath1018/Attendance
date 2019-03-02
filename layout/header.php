<?
	include("../database/database.php");
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">

		
		<script src="..\js\jquery.js"></script>

		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
		
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

		
	</head>
	<body>
		<div class="nav p-2 justify-content-end border">
			<!--<li class="nav-item ">
				<a class="nav-link fas fa-cog " href="#"></a>
			</li>-->
			<div class="dropdown">
			  <button class="btn  dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
				<li class="fas fa-user-check"></li>
			  </button>
			  <div class="dropdown-menu " aria-labelledby="dropdownMenuButton">
				<a class="dropdown-item" href="../logout.php">Logout</a>
			  </div>
			</div>	
		</div>
		
		<div class="container-fluid">
				<div class="row">
				<div class="col-md-2 border bg-dark">
					<div id="list-example" class="list-group mt-3">
					  <a class="list-group-item list-group-item-action" href="../home/home.php">Home</a>
					  <a class="list-group-item list-group-item-action" href="../user/user.php">User</a>
					  <a class="list-group-item list-group-item-action" href="../userrole/userrole.php">User Role</a>
					  <a class="list-group-item list-group-item-action" href="../ticket/ticket.php">Ticket</a>
					</div>
				</div>

