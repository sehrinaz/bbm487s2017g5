<?php
include ('model/connection.php');

if (!isset($_SESSION["user"]))
	header("Location:index.php");
if($_SESSION["auth"] != 0)
	header("Location:index.php");

function timeDiff($firstTime,$lastTime){
	// convert to unix timestamps
	$firstTime=strtotime($firstTime);
	$lastTime=strtotime($lastTime);

	// perform subtraction to get the difference (in seconds) between times
	$timeDiff=$lastTime-$firstTime;

	// return the difference
	return $timeDiff;
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
			<li><a href="search.php" >Search For Books</a></li>
			<li><a href="viewmybooks.php">View My Books</a></li>
			<li><a href="waitbook.php" >Wait Book</a></li>
			<li><a href="selfcheckout.php">Self Checkout </a></li>
            <li><a href="selfreturn.php" >Self Return </a></li>
			<li><a href="payfine.php" style="color:pink;">Pay Fine </a></li>
			<li><a href="logout.php"> Logout </a></li>
        </ul>
	</div>
	
	<div id = "page">
		<div id = "top"> 
			<img src= "assets/images/system.png" style = "height:100px; align:center;">	<br/>
		</div>
<?php
		$loggenOnUser = $_SESSION["user"];
		/*query find the user if of logged user*/
		$sql1="SELECT id_user FROM user WHERE username='$loggenOnUser'";
		$result1=mysqli_query($conn,$sql1);
		$row1=$result1->fetch_assoc();               
		$user_id =$row1["id_user"];
		/*this query find the logged in user have any borrow book and did not return it yet*/
		$sql3="SELECT barcode,recevingdate,deliverydate FROM borrow WHERE id_user=$user_id AND deliverydate IS NULL";
		$result3=$conn->query($sql3);
		$fineamount=0;
		if(mysqli_num_rows($result3)!=0){
			while($row3=$result3->fetch_assoc()){
				$toDate = date('Y/m/d');
				$date=date_create($toDate);
				$in=date_format($date,"Y-m-d");
				$recdate=$row3['recevingdate'];
				/*Calculate the difference between two date*/
				$newdate=timeDiff($recdate,$in);
				/*find the number of days difeerences*/
				$years = abs(floor($newdate / 31536000));
				$days = abs(floor(($newdate-($years * 31536000))/86400));
				/*if difference bigger than 30,$ 0.50 is added to the user's fine account for each day*/
				if($days>30){
					$finedate=$days-30;
					$sql4="UPDATE user SET fine=$finedate*0.50 WHERE id_user=$user_id";
					$result4=mysqli_query($conn,$sql4);
					$fineamount += $finedate*0.50;
					
				}
			}
			echo '<br><div id="rules" style="margin-left:30%;">YOUR FINE AMOUNT IS '."$".$fineamount .'</div>';
			if ($fineamount != 0 )
				echo '<form  method = "post" action = "pay-fine.php" style="padding-right: 200px";><br/>
						<input type = "submit" value = "PAY FINE"/>
					  </form>';
		}
		else{
			echo '<div id ="rules" > YOU DONT HAVE ANY FINE! <br/><br/>';
		}
		
?>


	</div>
</body>
</html>