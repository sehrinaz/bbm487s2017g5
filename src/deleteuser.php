<?php
include ('model/connection.php');

if(!isset($_SESSION['user']))
	header("Location:index.php");
if($_SESSION["auth"] != 1)
	header("Location:index.php");

if (isset($_POST['id'])) {
	$id=$_POST['id'];
	$sqlcontrol="SELECT username FROM user WHERE id_user=$id";
    $resultcontrol=mysqli_query($conn,$sqlcontrol);
    $rowcontrol=$resultcontrol->fetch_assoc();
	
	if(!isset($rowcontrol['username'])) {
		$error =  "Invalid user id!";
	}
	else {
		$sql="DELETE FROM user WHERE id_user=$id";
		$result=mysqli_query($conn,$sql);
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
		if (!isset($_POST['id'])) {
			echo '<form  method = "post" action = "" style="padding-right: 200px";><br/>
					<input type = "text" id="id" name = "id" style="width: 300px; margin-left:18%;" placeholder="User ID" ><br/><br/>
					<input type = "submit" style="margin-left:18%;" value = "DELETE USER"/>
					</form>';
		}
		else {
			if(isset($error)) 
				echo '	<div id="error" style="margin-left:-1%;">'. $error . '</div>';	
			else 
				echo '<div id ="rules" style="margin-left:38%;margin-top: 3%;"> User deleted successfully! </div>';	
			
			echo '<input type="button" id = "back" value="TURN DELETE USER PAGE" class="btn" onclick="document.location.href=\'deleteuser.php\';"/>';
		}
		$query = "SELECT * FROM user"; 
		$result1 = $conn->query($query);   
		echo '</br></br></br><hr>';
		echo '<div class= "search-header"> <h2> User List </h2> </div></br>';
		while($row = $result1->fetch_assoc()){   
			echo '<div class="promo scale" style="width:300px; height=220px; background-color:#D4DDDF;margin-left: 100px;margin-bottom: 100px;">
				  <div class="deal">
					<span style=" color:black; height:40px;"><div id="bookN">ID : '.$row['id_user'].'</div></span> <hr>	 
					<span>Username:  '. $row['username'].' </span>
					<span>E-mail  :' .$row['email'] .' </span>
					 <span>Birthdate  :' . $row['birthdate'] .'</span>
					 <span>Job  :' . $row['job'] .'</span>	
					 <span>Authorization  :' . $row['authorization'] .'</span>	
					 <span>Fine :' . $row['fine'] .'</span>	
					 </div>	
				 </div> ';
	}
		?>
		  
	</div>
</body>
</html>