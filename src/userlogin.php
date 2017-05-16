<?php
include('model/connection.php');
function control_user(){
/* If user or admin not logged in then redirect to index page */
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
	<link href='http://fonts.googleapis.com/css?family=Ubuntu:500' rel='stylesheet' type='text/css'>
	<script src="assets/sweetalert/sweetalert2.min.js"></script>
	<link rel="stylesheet" href="assets/sweetalert/sweetalert2.min.css">
</head>
<body> 
	<div class= "menu" 
		<ul class="nav navbar-nav">
			<div class="active"> <b>MENU </b></div>
			<li><a href="userlogin.php" style="color:pink;">Home Page</a></li>
			<li><a href="search.php"> Search For Books</a></li>
			<li><a href="viewmybooks.php"> View My Books</a></li>
			<li><a href="waitbook.php">Wait Book</a></li>
			<li><a href="selfcheckout.php">Self Checkout </a></li>
			<li><a href="selfreturn.php">Self Return </a></li>
			<li><a href="payfine.php">Pay Fine </a></li>
			<li><a href="logout.php"> Logout </a></li>
        </ul>
	</div>
	<div id = "page">
		<div id = "top"> 
			<img src= "assets/images/system.png" style = "height:100px; align:center;">	<br/>
		</div>
		<h1 style="text-align:left;margin-left: 18%;border-bottom-style: groove;margin-right: 25%;color: #3E1D1F;font-size: 50px;"> Book List </h1>
		<div class= "books">	
		
		<?php
            control_user();
            /*query find the all book knowledges from book table in the database*/
			$query = "SELECT * FROM book"; 
            $result = $conn->query($query);
              
			$i = 0;
			while($row = $result->fetch_assoc()){   
               echo '<div class="promo scale" style="width:300px; height=220px; background-color:#D4DDDF;margin-left: 100px;margin-bottom: 100px;">
					 <div class="deal">
					 <span style="background-image: url(\'assets/images/book.png\'); color:black; height:60px;">'.$row['book_name'].'</span> <hr>
					 <span>Barcode:  '.$row['barcode'].' </span>
					 <span>Author Name:  '. $row['authorname'].' </span>
					 <span>Publisher  :' . $row['publisher']. '</span>
					 <span>Date Edition  :' .$row['date_edition'] .' </span>
					 <span>Type  :' . $row['type'] .'</span>';
					 if (isset($_SESSION['user'])) {
					 	/*if choosen book is available user can do borrow operation*/
						if ($row ['available'] == 1 ) { 
								echo '<form method="POST" action="borrow.php" id="borrow'.$i.'">
									  <input type="hidden" name="barcode" id="hiddenField" value="'. $row['barcode'] . '" />
								      <button id= "borrow" type="submit" form="borrow'.$i.'">  Borrow Book  </button></form>';
						}
						/*if choosen book is not available user can do wait book operation*/
						else {
							echo '<form method="POST" action="addwaitinglist.php" id="wait'.$i.'">
								  <input type="hidden" name="barcode" id="hiddenField" value="'. $row['barcode'] . '" />
								   <input type="hidden" name="bookname" id="hiddenField" value="'. $row['book_name'] . '" />
								  <button id= "borrow" type="submit" form="wait'.$i.'">  Wait This Book  </button></form>';
						}
					}
					echo '</div></div> ';	
			$i++;
			}
             
        $loggenOnUser = $_SESSION["user"];
        $sql1="SELECT id_user FROM user WHERE username='$loggenOnUser'";
        $result1=mysqli_query($conn,$sql1);
        $row1=$result1->fetch_assoc();               
        $user_id =$row1["id_user"];  

        $sql2="SELECT barcode FROM waitinglist WHERE id_user=$user_id";
        $result2=mysqli_query($conn,$sql2);
		$var = "";
        while($row2=$result2->fetch_assoc()){
        	$book=$row2['barcode'];
        	$sql3="SELECT * FROM book WHERE barcode=$book AND available=1";
        	$result3=$conn->query($sql3);
        	if($row3=$result3->fetch_assoc()){
                   $var=$var."'".$book."-".$row3['book_name']."' "."<br>";
				   $sql2="DELETE FROM waitinglist WHERE id_user=$user_id AND barcode=$book";
				   $conn->query($sql2);
        	}
        }
		if (strcmp($var,"") !=0) {
			$var = $var ."Book in your waiting list is available now!";
			echo '<script type="text/javascript"> swal({ title:"'.$var.'",
																	width: 500,
																	padding: 50,
																	background: \'#fff url(//bit.ly/1Nqn9HU)\'
													   })
			</script>';
		}


		?>

	
		 </div>
		
	</div>

</body> 
</html>
