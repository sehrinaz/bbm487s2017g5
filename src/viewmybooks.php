<?php
include('model/connection.php');
function control_user(){
if (!isset($_SESSION["user"]))
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
	<link href='http://fonts.googleapis.com/css?family=Ubuntu:500' rel='stylesheet' type='text/css'>

</head>
<body> 
	<div class= "menu" 
		<ul class="nav navbar-nav">
			<div class="active"> <b>MENU </b></div>
			<li><a href="userlogin.php">Home Page</a></li>
			<li><a href="search.php" >Search For Books</a></li>
			<li><a href="viewmybooks.php" style="color:pink;">View My Books</a></li>
			<li><a href="waitbook.php">Wait Book</a></li>
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
    
        control_user();

		$loggenOnUser = $_SESSION["user"];
		/*query find the user if of logged user*/
		$sql1="SELECT id_user FROM user WHERE username='$loggenOnUser'";
		$result1=mysqli_query($conn,$sql1);
		$row1=$result1->fetch_assoc();               
		$user_id =$row1["id_user"];
		/*query find the borrow books of logged user from borrow table in tha database
		according to match logged user id */
		$sql="SELECT barcode,recevingdate,deliverydate FROM borrow WHERE id_user=$user_id";
		$result = $conn->query($sql);
		/*show the results of query*/
		if (mysqli_num_rows($result) == 0 ) {
			echo '<div class= "borrowList" > <h2>- You have not borrowed any books.</h2></div>';
		}
		else {
			echo '<div class= "borrowList" >
					<h2>- List of books you borrowed up to this day:</h2>
					<table class="rwd-table">
						<tr style="font-size: 17px;">
							<th>Book Name</th>
							<th>Barcode</th>
							<th>Receiving Date</th>
							<th>Delivery Date</th>
						</tr>';
				
			while($row=$result->fetch_assoc()) {			
				$barcode=$row['barcode'];
				/*this query find the bookname of given barcode by user*/
				$sql2="SELECT book_name FROM book WHERE barcode=$barcode;";
				$result2=mysqli_query($conn,$sql2);
				while($row2=$result2->fetch_assoc()) {
					echo "<tr> <td>".$row2['book_name']. "</td>"  ;
				}

				echo  "<td>".$row['barcode'] ."</td><td>".$row['recevingdate']."</td><td>".$row['deliverydate'] ."</td></tr>";
			}
			echo "</table></div>";	
		}
?>
			
			 

		</div>
	</div>
	

</body> 
<html>
