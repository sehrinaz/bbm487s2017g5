<?php
	include('model/connection.php');
	if (!isset($_SESSION["user"]))
		header("Location:index.php");
	 if($_SESSION["auth"] != 0)
		header("Location:index.php");
            
  
	if (isset($_POST['barcode'])) {
		$loggenOnUser = $_SESSION["user"];
        $sql1="SELECT id_user FROM user WHERE username='$loggenOnUser'";
        $result1=mysqli_query($conn,$sql1);
        $row1=$result1->fetch_assoc();               
        $user_id =$row1["id_user"];
        /*this query control the number of borrowed book which do not return the library*/
        $sqlborrow="SELECT *FROM borrow WHERE id_user='$user_id' AND deliverydate is null";
        $result_control=mysqli_query($conn,$sqlborrow);
        $number=mysqli_num_rows($result_control);
        /*if user borrowed three books show this message.*/
        if($number==3){
    	$error = "You can borrow three books in same time.Please self return borrowed books and try again.";
        }else if($number<3){
		$recDate = date('Y/m/d', time());
	    $date=date_create($recDate);
        $in=date_format($date,"Y-m-d");
        $barcode=(int)($_POST['barcode']);
        $sqlcontrol="SELECT available FROM book WHERE barcode=$barcode";
        $resultcontrol=mysqli_query($conn,$sqlcontrol);
        $rowcontrol=$resultcontrol->fetch_assoc();
		if(!isset($rowcontrol['available'])) {
			$error = "Barcode number is invalid! There is no book that number in the system.";
		}
		
        elseif($rowcontrol['available']== 1){
			$sql="INSERT INTO borrow (id_user,barcode,recevingdate) VALUES ($user_id,'$barcode','$in')";
            $result=mysqli_query($conn,$sql);
            $sql1="SELECT * FROM borrow";
            $result1=mysqli_query($conn,$sql1);
            $sql2="UPDATE book SET available=0 WHERE barcode=$barcode";
            $result2=mysqli_query($conn,$sql2);
			$sonuc = "okey!";
        }
		else{
			if (!isset($error))
				$error = "This book is not available.You must not borrow it.";
		}
     }
 }
	 /* if no post this page wants to connect only url redirect to main page */
	/* else 
		 header("Location:userlogin.php"); */
	
?>


<!DOCTYPE html>
<html> 

<head>
<title> LBLS </title>
	<link rel="stylesheet" type="text/css" href="assets/css/userpage.css">
	<link rel="stylesheet" type="text/css" href="assets/css/homepage.css">
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
			<li><a href="waitbook.php">Wait Book</a></li>
			<li><a href="selfcheckout.php" style="color:pink;">Self Checkout </a></li>
			<li><a href="selfreturn.php">Self Return </a></li>
			<li><a href="payfine.php">Pay Fine </a></li>
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
			echo ' <div id ="rules" > YOU BORROWED THIS BOOK! We want to remind some rules: <br/><br/>
									  <ul>
									  <li style="color:black;">- You must deliver the book you bought within 1 month.</li>
									  <li style="color:black;">- A $ 0.5 fine per day will be for books not delivered on time!</li>
									  </ul> 
				   </div>';
		}
				
?>

	</div>	
	
</body> 
</html>