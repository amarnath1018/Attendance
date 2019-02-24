<?
	include("..\database\database.php");
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
		
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
		
	</head>
	<body>
		<div class="nav p-3 justify-content-end border">
			<li class="nav-item ">
				<a class="nav-link fas fa-cog " href="#"></a>
			</li>
			<li class="nav-item">
				<a class="nav-link fas fa-user-check" href="..\home\logout.php"></a>
			</li>
		</div>
		
		<div class="container-fluid">
			<div class="row">
				<div class="col-md-2 border bg-dark">
					<div id="list-example" class="list-group mt-3">
					  <a class="list-group-item list-group-item-action" href="..\home\home.php">Home</a>
					  <a class="list-group-item list-group-item-action" href="..\user\user.php">User</a>
					  <a class="list-group-item list-group-item-action" href="..\userrole\userrole.php">User Role</a>
					  <a class="list-group-item list-group-item-action" href="..\ticket\ticket.php">Ticket</a>
					</div>
				</div>
		