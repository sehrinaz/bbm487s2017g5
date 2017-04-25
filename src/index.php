<?php
include('model/connection.php');
function control_user(){
/* If user or admin not logged in ,redirect the index page */
if(isset($_SESSION['user']))
	if($_SESSION["auth"] == 0)
		header("Location:userlogin.php");
	elseif($_SESSION["auth"] == 1)
		header("Location:librarianlogin.php");
}
control_user();
?>
<html>
<head>
<title>Library Book Loan System</title>
<link rel="stylesheet" type="text/css" href="assets/css/homepage.css">

</head>
<body>

	<div id = "page">
		<div id = "top"> 
			<img src= "assets/images/system.png" style = "height:100px; align:center;">	<br/>
			
		</div>
		<input type='button' id = "login" value='LOGIN' class="btn" onclick="document.location.href='login.php';"/>
		<form method="POST" action="search.php" id="search">
				<div class = "search" > 
					<div class="search-header">
						<h1 style="color: white;">Search Book</h1> 
					</div>
					<input type ="text" name="bookname" placeholder="Book name" /> 
					<input type="submit" name= "submit" value="Search" class="search"/>
				</div>
		</form>
		<hr style="width:600px;margin-bottom: 32px;">
		<div class= "search-header"> <h1 style="color: white;">Book List </h1> </div>
		<div class= "books">
		 
		<?php
 
			$query = "SELECT * FROM book"; 
            $result = $conn->query($query);
               
			while($row = $result->fetch_assoc()){   
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
	</div>	

<script> 
	$(function(){
		<?php 
			if(isset($_SESSION['login'])==true ){?>
			$("#logbutton").show();
			$("#logoutbutton").hide();
	    <?php } 
			else { ?>
			$("#logoutbutton").show(); 
			$("#logbutton").hide(); 
		<?php } ?>
	});
</script> 	
		
</body>
