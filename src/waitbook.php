<?php
include ('model/connection.php');
/*control the user or librarian login if they do not login go to the index page*/
	function control_user_login(){
	if(!isset($_SESSION['user']))
		header("Location:index.php");
	if($_SESSION["auth"] != 0)
	header("Location:index.php");
}
control_user_login();
?>

<!DOCTYPE html>
<html> 
<head>
<title> LBLS </title>
	<link rel="stylesheet" type="text/css" href="assets/css/userpage.css">
	<link rel="stylesheet" type="text/css" href="assets/css/homepage.css">
	<link rel="stylesheet" type="text/css" href="assets/css/viewbooks.css">
	<link rel="stylesheet" type="text/css" href="assets/css/borrow.css">
	<link href='http://fonts.googleapis.com/css?family=Ubuntu:500' rel='stylesheet' type='text/css'>

</head>
<body> 
	<div class= "menu" 
		<ul class="nav navbar-nav">
			<div class="active"> <b>MENU </b></div>
			<li><a href="userlogin.php">Home Page</a></li>
			<li><a href="search.php" >Search For Books</a></li>
			<li><a href="viewmybooks.php" >View My Books</a></li>
			<li><a href="waitbook.php" style="color:pink;">Wait Book</a></li>
			<li><a href="selfcheckout.php">Self Checkout </a></li>
            <li><a href="selfreturn.php">Self Return </a></li>
			<li><a href="#">Pay Fine </a></li>
			<li><a href="logout.php"> Logout </a></li>
        </ul>
	</div>
	
	<div id = "page">
		<div id = "top"> 
			<img src= "assets/images/system.png" style = "height:100px; align:center;">	<br/>
		</div>
		<!--create a form and add text boxes and button for the operation
		and orient the form a php page which do the operation with use
		given user knowledge-->
		<form method = "post" action = "addwaitinglist.php" style="padding-right: 200px;" >
		<br/>
			<input type = "text" id="barcode" name = "barcode" style="width: 300px;" placeholder="Barcode" >
			<input type = "text" id="bookname" name = "bookname" style="width: 300px;" placeholder="Book Name" ><br/>
			<input type = "submit" value = "Wait Book"/>
        </form>
	</div>
</body>