<?php
include('model/connection.php');

 function control_login_user(){

/* Find user or admin  logged in */
if(isset($_SESSION['user']))
	if($_SESSION["auth"] == 0)
		header("Location:userlogin.php");
	elseif($_SESSION["auth"] == 1)
		header("Location:librarianlogin.php");
}

if(isset($_POST['username']) && $_POST['password']) {
	$username = $_POST['username'];
	$password = $_POST['password'];
/*control the username and password*/
	$sql_check = mysqli_query($conn,"select * from user where username='".$username."' and password='".$password."' ") or die(mysql_error());
	if(mysqli_num_rows($sql_check))  {
		$_SESSION["login"] = "true";
		$_SESSION["user"] = $username;
		$_SESSION["pass"] = $password;
		$row = mysqli_fetch_array($sql_check);
		$_SESSION["id"] = $row["user_id"];
		$_SESSION["auth"] = $row["authorization"];
	/*	if($row["authorization"]==0)
			header("Location:../userlogin.php");
		else
			header("Location:../librarianlogin.php");*/
			control_login_user();
	}
	else 
		/*if username or password wrong show the message*/
		$error = "Wrong username password combination.";
	
}
?>
<!DOCTYPE html>
<html> 
<head>
<title> LBLS </title>

	<link rel="stylesheet" type="text/css" href="assets/css/main.css">
	<link rel="stylesheet" type="text/css" href="assets/css/login.css">
	<link href='http://fonts.googleapis.com/css?family=Ubuntu:500' rel='stylesheet' type='text/css'>

</head>
<body> 
	<div id = "page">
		<div id = "top"> 
			<img src= "assets/images/system.png" style = "height:100px; align:center;">	<br/>
		</div>
		
		<div class= "form" >	
			<form method="POST" action="" id="login">	
			<hr style="width: 445px;margin-bottom: 32px;">
				<div class="login">
					<div class="login-header">
						<h1>Login</h1>
					</div>
					<div class="login-form">
						<h3>Username:</h3>
						<input type="text" name="username" placeholder="Username"/><br>
						<h3>Password:</h3>
						<input type="password" name="password" placeholder="Password"/>
						<br>
						<?php 
							if(isset($error))
								echo $error.'<br>';
						?>
						<input type="submit" value="Login" class="login-button"/>
					 </div>
				</div>
			</form>
			<hr style="width:445px; margin-bottom: 32px;">
		</div>
	</div>

</body> 
<html>
