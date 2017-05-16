<?php
include('model/connection.php');

/* If user or admin not logged in then redirect to index page */
if(!isset($_SESSION['user']))
	header("Location:index.php");
if($_SESSION["auth"] != 1)
	header("Location:index.php");

?>

<!DOCTYPE html>
<html> 
<head>
<title> LBLS </title>
	<link rel="stylesheet" type="text/css" href="assets/css/userpage.css">
	<link rel="stylesheet" type="text/css" href="assets/css/homepage.css">
	<link rel="stylesheet" type="text/css" href="assets/css/librarianpage.css">
	<link href='http://fonts.googleapis.com/css?family=Ubuntu:500' rel='stylesheet' type='text/css'>
	<script src="https://code.jquery.com/jquery-1.10.2.js"></script>
</head>
<body> 
	<div class= "menu" 
		<ul class="nav navbar-nav">
			<div class="active"> <b>MENU </b></div>
			<li><a href="librarianlogin.php" style="color:pink;">Home Page</a></li>
			<li><a href="logout.php"> Logout </a></li>
        </ul>
	</div>
	<div id = "page">
		<div id = "top"> 
			<img src= "assets/images/system.png" style = "height:100px; align:center;">	<br/>
		</div>
	</div>
	<div class="ddmenu" >
		<div class="dropdown">
			<button class="dropbtn">Manipulate Book</button>
			<div class="dropdown-content">
				<a href="addbook.php">Add Book</a>
				<a href="deletebook.php">Delete Book</a>
				<a href="updatebook.php">Update Book</a>
			</div>
		</div>
			<div class="dropdown">
			<button class="dropbtn">Manipulate User</button>
			<div class="dropdown-content">
				<a href="adduser.php">Add User</a>
				<a href="deleteuser.php">Delete User</a>
				<a href="updateuser.php">Update User</a>
			</div>
		</div>
	</div>
	

</body> 

<script>


</script>
</html>
