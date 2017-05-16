
<?php
include('model/connection.php');
function control_user(){
/* If user or admin not logged in then redirect to index page */
if(!isset($_SESSION['user']))
	header("Location:index.php");
if($_SESSION["auth"] != 1)
	header("Location:index.php");
}
control_user();
if (isset($_POST['barcode'])) {
	$barcode=$_POST['barcode'];
	$sqlcontrol="SELECT available FROM book WHERE barcode=$barcode";
    $resultcontrol=mysqli_query($conn,$sqlcontrol);
    $rowcontrol=$resultcontrol->fetch_assoc();
	
	if(isset($rowcontrol['available'])) {
		$error = "The system already has a book on this [ $barcode ] barcode!";
	}
	else {
			$barcode= (int)($_POST['barcode']);
			$bookname = mysqli_escape_string ($conn,$_POST['bookname']);
			$authorname=mysqli_escape_string ($conn,$_POST['authorname']);
			$publisher=mysqli_escape_string ($conn,$_POST['publisher']);

			$date_edition = ($_POST['dob-day']).'-'.$_POST['dob-month'].'-'.$_POST['dob-year'];  
			$date1=date_create($date_edition);
			$in=date_format($date1,"Y-m-d");
			$type=mysqli_escape_string ($conn,$_POST['type']);
			$available=1;
			$sql="INSERT INTO book (barcode,book_name,authorname,publisher,date_edition,type,available) VALUES
			 ('$barcode','$bookname','$authorname','$publisher','$in','$type','$available')";
			 mysqli_query($conn,$sql);
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
		if(!isset($error))
			echo '<div id ="rules" style="margin-left:31%;margin-top: 3%;"> Book added successfully! </div>';
		else 
			echo '	<div id="error" >'. $error . '</div>';
		
		$query = "SELECT * FROM book"; 
        $result1 = $conn->query($query);
		echo '<input type="button" id = "back" value="TURN ADD BOOK PAGE" class="btn" onclick="document.location.href=\'addbook.php\';"/>';
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
	}
	else {	
		echo '	<form  method = "post" action = "addbook.php" style="padding-right: 200px";><br/>
				<input type = "text" id="barcode" name = "barcode" style="width: 300px;" placeholder="Barcode : " ><br/><br/>
				<input type = "text" id="bookname" name = "bookname" style="width: 300px;" placeholder="Book name : " ><br/><br/>
				<input type = "text" id="authorname" name = "authorname" style="width: 300px;" placeholder="Author name : " ><br/><br/>
				<input type = "text" id="publisher" name = "publisher" style="width: 300px;" placeholder="Publisher :" ><br/><br/>
				<label for="dob-day" class="control-label" style="margin-left: 15px;">Date edition </label>
				<select name="dob-day" id="dob-day">
				<option value="">Day</option>';
				for ($i=1 ; $i<31 ; $i++) {
						echo '<option value="'.$i.'">'.$i.'</option>';
				}
				echo '
				</select>
				<select name="dob-month" id="dob-month">
				<option value="">Mount</option>';
				for ($i=1 ; $i<13 ; $i++) {
					echo '<option value="'.$i.'">'.$i.'</option>';
				} 
				echo '       
				</select>
				<select name="dob-year" id="dob-year">
				<option value="">Year</option>';
					for ($i=1980 ; $i<2017 ; $i++) {
						echo '<option value="'.$i.'">'.$i.'</option>';
					}
				echo'
				</select><br />
				<br><input type = "text" id="type" name = "type" style="width: 300px;" placeholder="Type : " ><br/><br/>
				<input type = "submit" value = " ADD BOOK"/>
				</form>';
	}
?> 
	</div>


</body> 
</html>
