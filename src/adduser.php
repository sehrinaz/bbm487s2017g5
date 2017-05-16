
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
			<div class="active"> <b> MENU </b></div>
			<li><a href="librarianlogin.php">Home Page</a></li>
			<li><a href="logout.php"> Logout </a></li>
        </ul>
	</div>
	
	<div id = "page">
		<div id = "top"> 
			<img src= "assets/images/system.png" style = "height:100px; align:center;">	<br/>
		</div>
		
		<form  method = "post" action = "addinguser.php" style="padding-right: 200px";>
			<br/>
			<input type = "text" id="username" name = "username" style="width: 300px;" placeholder="User name" ><br/><br/>
			<input type = "text" id="password" name = "password" style="width: 300px;" placeholder="Password" ><br/><br/>
			<input type = "text" id="email" name = "email" style="width: 300px;" placeholder="E-mail" ><br/><br/>
			<label for="dob-day" class="control-label" style="margin-left: 15px;">Birthdate </label>
			<select name="dob-day" id="dob-day">
			<option value="">Day</option>
		<?php 
			for ($i=1 ; $i<31 ; $i++) 
				echo '<option value="'.$i.'">'.$i.'</option>';
			
			echo '</select><select name="dob-month" id="dob-month"><option value="">Mount</option>';
			
			for ($i=1 ; $i<13 ; $i++) 
				echo '<option value="'.$i.'">'.$i.'</option>';
			
			echo '</select><select name="dob-year" id="dob-year"><option value="">Year</option>';
			
			for ($i=1960 ; $i<2017 ; $i++) 
				echo '<option value="'.$i.'">'.$i.'</option>';
			
			echo '</select><br />';
							
		?> 
			<input type = "text" id="job" name = "job" style="width: 300px;" placeholder="Job : " ><br/><br/>
			<input type = "text" id="authorization" name = "authorization" style="width: 300px;" placeholder="Authorization : " ><br/><br/>
			<input type = "submit" value = "ADD USER"/>
		</form>
			  
	</div>

</body> 
</html>
