<?php
include ('model/connection.php');

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
		if (!isset($_POST['barcode'])) {
			echo '<form  method = "post" action = "" style="padding-right: 200px";>
					Enter the barcode of the book you want to update : <br>
					<input type = "text" id="barcode" name = "barcode" style="width: 300px;" placeholder="Barcode : " ><br/><br/>
					<input type = "submit" value = "FIND BOOK" style="width:120px;"/>
				</form>';
			$query = "SELECT * FROM book"; 
			$result1 = $conn->query($query);
			echo '</br></br><hr>';
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
			/* barcode control */
		   $barcode=(int)$_POST['barcode'];
		   $sqlcontrol = "SELECT * FROM book WHERE barcode=$barcode"; 
           $result1 = $conn->query($sqlcontrol);
		   $rowcontrol=$result1->fetch_assoc();
	
		   if(!isset($rowcontrol['barcode'])) {
				$error = "Invalid barcode number.Try again!";
				echo '	<div id="error" style="margin-left:-16%;">'. $error . '</div>';
							echo '<form  method = "post" action = "" style="padding-right: 200px";>
					Enter the barcode of the book you want to update : <br>
					<input type = "text" id="barcode" name = "barcode" style="width: 300px;" placeholder="Barcode : " ><br/><br/>
					<input type = "submit" value = "FIND BOOK" style="width:120px;"/>
				</form>';
				$query = "SELECT * FROM book"; 
				$result1 = $conn->query($query);
				echo '</br></br><hr>';
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
		        $barcode= $_POST['barcode'];
				$bookname = $rowcontrol['book_name'];
				$authorname = $rowcontrol['authorname'];
				$publisher = $rowcontrol['publisher'];
				$type = $rowcontrol['type'];
				
				echo ' <form  method = "post" action = "updatebook1.php" style="padding-right: 200px";>
							<input type = "text"  id="barcode" name = "barcode" style="display:none;" value="'.$barcode .'" ><br/>
							Book name:<br/> <input type = "text" id="bookname" name = "bookname" style="width: 300px;" value="'.$bookname.'" ><br/>
							Author name:<br/> <input type = "text" id="authorname" name = "authorname" style="width: 300px;" value="'.$authorname.'" ><br/>
							Publisher:<br/> <input type = "text" id="publisher" name = "publisher" style="width: 300px;" value="'.$publisher.'" ><br/>
							Type:<br/> <input type = "text" id="type" name = "type" style="width: 300px;"value="'.$type.'" ><br/>
							<label for="dob-day" class="control-label" style="margin-left: 15px;"> Date edition </label>
							<select name="dob-day" id="dob-day">';
							for ($i=1 ; $i<31 ; $i++) 
								echo '<option value="'.$i.'">'.$i.'</option>';
						
							echo ' </select>
							<select name="dob-month" id="dob-month">
							<option value="">Mount</option>';
							for ($i=1 ; $i<13 ; $i++) 
								echo '<option value="'.$i.'">'.$i.'</option>';
					
							echo '</select>
							<select name="dob-year" id="dob-year">
							<option value="">Year</option>';
							for ($i=1980 ; $i<2017 ; $i++) 
								echo '<option value="'.$i.'">'.$i.'</option>';
					
							echo '</select><br/><br/><br/><input type = "submit" style="width:150px;" value = "UPDATE BOOK"/>
							</form>';
		   }				
		}
?>
	</div>
</body>
</html>