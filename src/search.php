<?php
include('model/connection.php');


?>
<html>
<head>
<title>Library Book Loan System</title>
	<link rel="stylesheet" type="text/css" href="assets/css/search.css">
	<link rel="stylesheet" type="text/css" href="assets/css/homepage.css">
	<link rel="stylesheet" type="text/css" href="assets/css/userpage.css">
</head>
<body>

<?php
	/* if user logged in shows menubar dont show librarian*/		
	if(isset($_SESSION['user']) && $_SESSION["auth"] == 0 ) {
		echo '<div class= "menu" 
				<ul class="nav navbar-nav">
					<div class="active"> <b>MENU </b></div>
					<li><a href="index.php">Home Page</a></li>
					<li><a href="search.php" style="color:pink;">Search For Books</a></li>
					<li><a href="viewmybooks.php">View My Books</a></li>
					<li><a href="waitbook.php">Wait Book</a></li>
					<li><a href="selfcheckout.php">Self Checkout </a></li>
					<li><a href="selfreturn.php">Self Return </a></li>
					<li><a href="#">Pay Fine </a></li>
					<li><a href="logout.php"> Logout </a></li>
				</ul>
			</div>';
	}
	else {
		echo '<div class= "menu" 
			     <ul class="nav navbar-nav">
					<div class="active"> <b>MENU </b></div> 
					<li><a href="userlogin.php">Home Page</a></li>
					<li><input type=\'button\' style="margin-left:15%;margin-top: 5%;" id = "login" value="LOGIN" class="btn" onclick="document.location.href=\'login.php\';"/></li>
			     </ul>
			 </div>';
					
	}
?>
	
<div id="page">
	<div id = "top"> 
		<img src= "assets/images/system.png" style = "height:100px; align:center;">	<br/>
	</div>
	<form method="POST" action="" id="search" style="margin-left: -18%;">
			<div class = "search" > 
				<div class="search-header">
					<h1 style="color: white;">Search Book</h1> 
				</div>
				<input type ="text" name="bookname" placeholder="Book name" /> 
				<input type="submit" name= "submit" value="Search" class="search"/>
			</div>
	</form>
	
	<div class= "books">	 
		
		<?php
			if (isset($_POST['bookname'])) {
				$bookname = mysqli_escape_string ($conn,$_POST['bookname']);
				/*query for the find all books in the database which the same as given bookname by user*/
				$sql = "SELECT * FROM book WHERE book_name='$bookname' ";
				$result1 = $conn->query($sql);
				$i = 0;
				if($result1->num_rows > 0){
					
					while($row = $result1->fetch_assoc()){  
						/*print the result of query*/
					   echo '<div class="promo scale" style="width:300px; height=220px; background-color:#D4DDDF;margin-left: 100px;margin-bottom: 100px;">
							 <div class="deal">
							 <span style="background-image: url(\'assets/images/book.png\'); color:black; height:60px;">'.$row['book_name'].'</span> <hr>
							 <span>Barcode:  '.$row['barcode'].' </span>
							 <span>Author Name:  '. $row['authorname'].' </span>
							 <span>Publisher  :' . $row['publisher']. '</span>
							 <span>Date Edition  :' .$row['date_edition'] .' </span>
							 <span>Type  :' . $row['type'] .'</span>';
							 if (isset($_SESSION['user'])) {
								if ($row ['available'] == 1 ) { 
										echo '<form method="POST" action="borrow.php" id="borrow'.$i.'">
											  <input type="hidden" name="barcode" id="hiddenField" value="'. $row['barcode'] . '" />
											  <button id= "borrow" type="submit" form="borrow'.$i.'">  Borrow Book  </button></form>';
								}
								else {
									echo '<form method="POST" action="addwaitinglist.php" id="wait'.$i.'">
										  <input type="hidden" name="barcode" id="hiddenField" value="'. $row['barcode'] . '" />
										   <input type="hidden" name="bookname" id="hiddenField" value="'. $row['book_name'] . '" />
										  <button id= "borrow" type="submit" form="wait'.$i.'">  Wait This Book  </button></form>';
								}
							 }
							 echo '</div>	
							 </div> ';
							 $i++;
					}
				}else {
					echo '<div id="err" >Did not find a record matching the book name you searched for.</div>'; 
				}
			}
		?>

	
	 </div>
	 
</div>


</body>


</html>