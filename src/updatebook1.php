<?php
include ('model/connection.php');

/*if user or librarian not logged in redirect index page */
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
	<link rel="stylesheet" type="text/css" href="assets/css/viewbooks.css">
	<link rel="stylesheet" type="text/css" href="assets/css/borrow.css">
	<link rel="stylesheet" type="text/css" href="assets/css/librarianpage.css">
	<link href='http://fonts.googleapis.com/css?family=Ubuntu:500' rel='stylesheet' type='text/css'>

</head>
<body> 
	<div class= "menu" 
		<ul class="nav navbar-nav">
			<div class="active"> <b> MENU </b></div>
			<li><a href="librarianlogin.php">Home Page</a></li>
			<li><a href="logout.php"> Logout </a></li>
        </ul>
	</div>
	
	<div id = "page">
		<div id = "top"> 
			<img src= "assets/images/system.png" style = "height:100px; align:center;">	<br/>
		</div>	
<?php

	$barcode=(int)$_POST['barcode'];
	$bookname = mysqli_escape_string ($conn,$_POST['bookname']);
    $authorname=mysqli_escape_string ($conn,$_POST['authorname']);
	$publisher=mysqli_escape_string ($conn,$_POST['publisher']);
	$date_edition = ($_POST['dob-day']).'-'.$_POST['dob-month'].'-'.$_POST['dob-year'];  
    $date1=date_create($date_edition);
    $in=date_format($date1,"Y-m-d");
	$type=mysqli_escape_string ($conn,$_POST['type']);
		
	$sql="UPDATE book SET book_name='$bookname',authorname='$authorname',publisher='$publisher',
	date_edition='$in',type='$type' WHERE barcode=$barcode";
	$result=mysqli_query($conn,$sql);
    echo '<div id ="rules" style="margin-left:38%;margin-top: 3%;"> Book updated successfully! </div>';   
	echo '<input type="button" id = "back" value="TURN UPDATE BOOK PAGE" class="btn" onclick="document.location.href=\'updatebook.php\';"/>';
	$query = "SELECT * FROM book"; 
    $result1 = $conn->query($query);

	echo '</br></br></br><hr>';
	echo '<div class= "search-header" > <h2>Book List </h2> </div></br>';         
	while($row = $result1->fetch_assoc()){   
		echo '<div class="promo scale" style="width:300px; height=220px; background-color:#D4DDDF;margin-left: 100px;margin-bottom: 100px;">
				<div class="deal">
				 <span style="background-image: url(\'assets/images/book.png\'); color:black; height:40px;"><div id="bookN">'.$row['book_name'].'</div></span> <hr>
				 <span>Barcode:  '.$row['barcode'].' </span>
				 <span>Author Name:  '. $row['authorname'].' </span>
				 <span>Publisher  :' . $row['publisher']. '</span>
				 <span>Date Edition  :' .$row['date_edition'] .' </span>
				 <span>Type  :' . $row['type'] .'</span>	
			    </div>	
		      </div> ';
    }
?>
		
	</div>
</body>
</html>
