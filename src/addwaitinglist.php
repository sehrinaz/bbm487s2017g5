<?php
	include('model/connection.php');
function control_user(){
     if(!isset($_SESSION['user']))
		header("Location:index.php"); 
	 if($_SESSION["auth"] != 0)
		header("Location:index.php");
}

     if (isset($_SESSION["user"])) {
		$loggedOnUser = $_SESSION["user"];
        $sql1="SELECT id_user FROM user WHERE username='$loggedOnUser'";
        $result1=mysqli_query($conn,$sql1);
        $row1=$result1->fetch_assoc();               
        $id =$row1["id_user"];
		$wDate = date('Y/m/d', time());
		$date=date_create($wDate);
		$in=date_format($date,"Y-m-d");
        $barcode= (int)($_POST['barcode']);
        $bookname = mysqli_escape_string ($conn,$_POST['bookname']);
		$sql3 = "SELECT available FROM book WHERE barcode=$barcode AND book_name='$bookname'";
		$resultcontrol=mysqli_query($conn,$sql3);
		$rowcontrol=$resultcontrol->fetch_assoc();
		
		if(!isset($rowcontrol['available'])) 
			$error = "Barcode or book name is invalid! There is no book this name with this barcode in the system.";
		/*if book is avalible show the message to user*/
		else if ($rowcontrol['available'] == 1 ) 
			$error = "Book is available ! You can borrow this book..";
		
		else {
			/*query find the borrowed books from the borrow table in database*/
			$check_book_owner_sql = "SELECT * FROM borrow where barcode=$barcode and deliverydate IS NULL and id_user = $id";
			$result_owner = mysqli_query($conn, $check_book_owner_sql);
			/*query find the waiting books knowledges from waitinglist table in database which match user_id and barcode*/
			$check_already_added_sql = "SELECT * FROM waitinglist where barcode=$barcode and id_user = $id";
			$result = mysqli_query($conn, $check_already_added_sql);
			/*show the query result*/
			if (mysqli_num_rows($result_owner) > 0)
				$error = "You can not wait this book. Because you borrowed!";
			else if(mysqli_num_rows($result) > 0)
				$error = "You have already waiting this book!";
			else {
				$sql="INSERT INTO waitinglist (barcode,id_user,book_name,added_date) VALUES ('$barcode','$id','$bookname','$in')";
				$result=mysqli_query($conn,$sql);
			}
			
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
			<li><a href="search.php"> Search For Books</a></li>
			<li><a href="viewmybooks.php"> View My Books</a></li>
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
		
<?php 
		if (isset($error)) {
			echo ' <div id = "error" > ERROR : '. $error . ' </div>';
		}
		else {
			echo ' <div id ="rules" > Your name has been added to your waiting list. We will notify you when the book is available.
				   </div>';
		}
				
?>

	</div>	
	
</body> 
</html>