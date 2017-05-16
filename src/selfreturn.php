<?php
include ('model/connection.php');
	
	if(!isset($_SESSION['user']))
		header("Location:index.php");
	if($_SESSION["auth"] != 0)
	header("Location:index.php");
	
	if (isset($_POST['barcode'])) {
		$loggenOnUser = $_SESSION["user"];
		$sql1="SELECT id_user FROM user WHERE username='$loggenOnUser'";
		$result1=mysqli_query($conn,$sql1);
		$row1=$result1->fetch_assoc();               
		$user_id =$row1["id_user"];
		$sql="SELECT id_user FROM borrow WHERE id_user=$user_id";
		$result = mysqli_query($conn,$sql);
		if($row=$result->fetch_assoc()){
			$barcode = $_POST['barcode'];
			$sql12="SELECT barcode FROM book WHERE barcode='$barcode'";
			$result12=mysqli_query($conn,$sql12);
			if(! $row12=$result12->fetch_assoc()) {
				$error = "Invalid barcode number.Please check number and try again.";
			}
			$sql3="SELECT barcode FROM borrow WHERE id_user=$user_id AND barcode=$barcode";
			$result3=mysqli_query($conn,$sql3);
			if (!$result3->fetch_assoc()) {
				if (!isset($error))
					$error = "You did not borrow this book!";
			}
			$sql2="UPDATE book SET available=1 WHERE barcode=$barcode";
			$result2=mysqli_query($conn,$sql2);	
			$delDate = date('Y/m/d', time());
			$date=date_create($delDate);
			$in=date_format($date,"Y-m-d");
			$sql11 = "UPDATE borrow SET deliverydate='$in' WHERE  id_user=$user_id AND barcode=$barcode AND deliverydate IS NULL";
			$r = mysqli_query($conn,$sql11);  
		}
		else{
			$error = "You do not have any borrow book.So you could not do this operation.";
		}
	}

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
			<li><a href="viewmybooks.php">View My Books</a></li>
			<li><a href="waitbook.php" >Wait Book</a></li>
			<li><a href="selfcheckout.php">Self Checkout </a></li>
            <li><a href="selfreturn.php" style="color:pink;">Self Return </a></li>
			<li><a href="payfine.php">Pay Fine </a></li>
			<li><a href="logout.php"> Logout </a></li>
        </ul>
	</div>
	
	<div id = "page">
		<div id = "top"> 
			<img src= "assets/images/system.png" style = "height:100px; align:center;">	<br/>
		</div>
		
		<form  method = "post" action = "" style="padding-right: 200px";>
			<br/>
			<input type = "text" id="barcode" name = "barcode" style="width: 300px;" placeholder="Barcode" ><br/><br/>
			<input type = "submit" value = " SELF RETURN"/>
         </form>
		  
		 <?php 
			if (isset($_POST['barcode'])) {
				if (isset($error))
					echo '<div id="error" >'. $error . '</div>';
				else {
					echo '<div id ="rules" style="margin-left:31%;margin-top: 3%;"> Book return successfully! </div>';
				}
			}
		?>
	</div>
</body>
</html>