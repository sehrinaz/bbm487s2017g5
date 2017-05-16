<?php
include ('model/connection.php');
function control_user(){
	/*if user or librarian not logged in redirect index page */
	if(!isset($_SESSION['user']))
		header("Location:index.php");
	if($_SESSION["auth"] != 0)
	header("Location:index.php");
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

	<div class= "menu" 
		<ul class="nav navbar-nav">
			<div class="active"> <b>MENU </b></div>
			<li><a href="userlogin.php">Home Page</a></li>
			<li><a href="search.php" >Search For Books</a></li>
			<li><a href="viewmybooks.php">View My Books</a></li>
			<li><a href="waitbook.php" >Wait Book</a></li>
			<li><a href="selfcheckout.php">Self Checkout </a></li>
            <li><a href="selfreturn.php" >Self Return </a></li>
			<li><a href="payfine.php" style="color:pink;">Pay Fine </a></li>
			<li><a href="logout.php"> Logout </a></li>
        </ul>
	</div>
	
	<div id = "page">
		<div id = "top"> 
			<img src= "assets/images/system.png" style = "height:100px; align:center;">	<br/>
		</div>
<?php 
		$loggenOnUser = $_SESSION["user"];
		$sql1="SELECT id_user FROM user WHERE username='$loggenOnUser'";
		$result1=mysqli_query($conn,$sql1);
		$row1=$result1->fetch_assoc();               
		$user_id =$row1["id_user"];
		$sql="SELECT barcode FROM borrow WHERE id_user=$user_id";
		$result = mysqli_query($conn,$sql);
		$sql4="UPDATE user SET fine=0.0 WHERE id_user=$user_id";
		$result4=mysqli_query($conn,$sql4);
		while ($row=$result->fetch_assoc()){
			/*query update the available property of borrowed book*/
			$barcode = $row['barcode'];
			$sql2="UPDATE book SET available=1 WHERE barcode=$barcode";
			$result2=mysqli_query($conn,$sql2);	
			$delDate = date('Y/m/d', time());
			$date=date_create($delDate);
			$in=date_format($date,"Y-m-d");
			/*query add a delivery date for the borrowed book */
			$sql11 = "UPDATE borrow SET deliverydate='$in' WHERE  id_user=$user_id AND barcode=$barcode AND deliverydate IS NULL";
			$r = mysqli_query($conn,$sql11);  
		}
		echo '<div margintop="center" id ="rules" > You paid your fine! <br/> Your fine amount is $0.0<br/></div>';
		
?>

	</div>
</body>
</html>