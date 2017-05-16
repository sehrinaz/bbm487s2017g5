<?php
include ('model/connection.php');
/*if user or librarian not logged in redirect index page */

if(!isset($_SESSION['user']))
	header("Location:index.php");
if($_SESSION["auth"] !=	1 )
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
		$id= (int)($_POST['id']);
        $username = mysqli_escape_string ($conn,$_POST['username']);
        $password=mysqli_escape_string ($conn,$_POST['password']);
		$email=mysqli_escape_string ($conn,$_POST['email']);
		$job=mysqli_escape_string ($conn,$_POST['job']);
		$fine=mysqli_escape_string ($conn,$_POST['fine']);
		$authorization=mysqli_escape_string ($conn,$_POST['authorization']);
		
		$sql="UPDATE user SET username='$username',password='$password',email='$email',
		job='$job',authorization ='$authorization',fine='$fine' WHERE id_user=$id";
		$result=mysqli_query($conn,$sql);
		echo '<div id ="rules" style="margin-left:38%;margin-top: 3%;"> User updated successfully! </div>';   
		echo '<input type="button" id = "back" value="TURN UPDATE USER PAGE" class="btn" onclick="document.location.href=\'updateuser.php\';"/>';
        
		echo '</br></br></br><hr>';
		echo '<div class= "search-header" > <h2>User List </h2> </div></br>';    
		$query = "SELECT * FROM user"; 
        $result1 = $conn->query($query);
		
		while($row = $result1->fetch_assoc()){   
			echo '<div class="promo scale" style="width:300px; height=220px; background-color:#D4DDDF;margin-left: 100px;margin-bottom: 100px;">
					 <div class="deal">
					 <span color:black; height:40px;"><div id="bookN">'.$row['id_user'].'</div></span> <hr>
					 <span>Username:  '. $row['username'].' </span>
					 <span>Password  :' . $row['password']. '</span>
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
