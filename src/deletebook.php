<?php
include ('model/connection.php');

if(!isset($_SESSION['user']))
	header("Location:index.php");
if($_SESSION["auth"] != 1)
	header("Location:index.php");

if (isset($_POST['barcode'])) {
	$barcode=$_POST['barcode'];
	$sqlcontrol="SELECT available FROM book WHERE barcode=$barcode";
    $resultcontrol=mysqli_query($conn,$sqlcontrol);
    $rowcontrol=$resultcontrol->fetch_assoc();
	
	if(!isset($rowcontrol['available'])) {
		$error = "Invalid barcode number!";
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
			if (isset($_POST['barcode'])) {
				if(isset($error)) 
					echo '	<div id="error" style="margin-left:-1%;">'. $error . '</div>';			
				else {
					echo '<div id ="rules" style="margin-left:38%;margin-top: 3%;"> Book deleted successfully! </div>';		
				$barcode= (int)($_POST['barcode']);
				$sql="DELETE FROM book WHERE barcode=$barcode";
				$result=mysqli_query($conn,$sql);
				}

				echo '<input type="button" id = "back" value="TURN DELETE BOOK PAGE" class="btn" onclick="document.location.href=\'deletebook.php\';"/>';

			}
			
			else { 
				echo '<form  method = "post" action = "" style="padding-right: 200px";><br/>
							<input type = "text" id="barcode" name = "barcode" style="width: 300px;" placeholder="Barcode" ><br/><br/>
							<input type = "submit" value = "DELETE BOOK" style="width:120px;"/>
					</form>';
			}
				$query = "SELECT * FROM book"; 
				$result1 = $conn->query($query);
				echo '</br></br></br><hr>';
				echo '<div class= "search-header" style="margin-bottom:-50px;margin-top:13px;"> <h2>Book List </h2> </div>';
				while($row = $result1->fetch_assoc()){   
					echo '<div class="promo scale" style="width:300px; height=220px; background-color:#D4DDDF;margin-left: 100px;margin-bottom: 40px; margin-top:70px;">
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