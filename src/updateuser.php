<?php
include('model/connection.php');
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
		if (!isset($_POST['id'])) {
			echo '<form  method = "post" action = "" style="padding-right: 200px; margin-left:12%;"";>
					Enter the id of the user you want to update : <br>
					<input type = "text" id="barcode" name = "id" style="width: 300px;" placeholder="User ID" ><br/><br/>
					<input type = "submit" value = "FIND USER" style="width:120px;"/>
				</form>';
			
			$query = "SELECT * FROM user"; 
			$result1 = $conn->query($query);   
			echo '</br></br></br><hr>';
			echo '<div class= "search-header"> <h2> User List </h2> </div></br>';
			while($row = $result1->fetch_assoc()){   
				echo '<div class="promo scale" style="width:300px; height=220px; background-color:#D4DDDF;margin-left: 100px;margin-bottom: 100px;">
					  <div class="deal">
						<span style=" color:black; height:40px;"><div id="bookN">'.$row['id_user'].'</div></span> <hr>	 
						<span>Username:  '. $row['username'].' </span>
						<span>E-mail  :' .$row['email'] .' </span>
						 <span>Birthdate  :' . $row['birthdate'] .'</span>
						 <span>Job  :' . $row['job'] .'</span>	
						 <span>Authorization  :' . $row['authorization'] .'</span>	
						 <span>Fine :' . $row['fine'] .'</span>	
						 </div>	
					 </div> ';
			}
		}
		else {
		   $id=$_POST['id'];
		   $sqlcontrol = "SELECT * FROM user WHERE id_user=$id"; 
           $result1 = $conn->query($sqlcontrol);
		   $rowcontrol=$result1->fetch_assoc();
		   
			if (!isset($rowcontrol['id_user'])){
				echo '	<div id="error" style="margin-left:-2%;"> Invalid user id!</div>';
				echo '<form  method = "post" action = "" style="padding-right: 200px margin-left:10%;";>
					Enter the id of the user you want to update : <br>
					<input type = "text" id="barcode" style="width: 300px;" name = "id" style="width: 300px;" placeholder="User ID" ><br/><br/>
					<input type = "submit"  value = "FIND USER" style="width:120px;"/>
				</form>';
				
				$query = "SELECT * FROM user"; 
				$result1 = $conn->query($query);   
				echo '</br></br></br><hr>';
				echo '<div class= "search-header"> <h2> User List </h2> </div></br>';
				while($row = $result1->fetch_assoc()){   
					echo '<div class="promo scale" style="width:300px; height=220px; background-color:#D4DDDF;margin-left: 100px;margin-bottom: 100px;">
						  <div class="deal">
							<span style=" color:black; height:40px;"><div id="bookN">'.$row['id_user'].'</div></span> <hr>	 
							<span>Username:  '. $row['username'].' </span>
							<span>E-mail  :' .$row['email'] .' </span>
							 <span>Birthdate  :' . $row['birthdate'] .'</span>
							 <span>Job  :' . $row['job'] .'</span>	
							 <span>Authorization  :' . $row['authorization'] .'</span>	
							 <span>Fine :' . $row['fine'] .'</span>	
							 </div>	
						 </div> ';
				}
			}
			else {
				$id= $_POST['id'];
				$username = $rowcontrol['username'];
				$password = $rowcontrol['password'];
				$email = $rowcontrol['email'];
				$authorization = $rowcontrol['authorization'];
				$job = $rowcontrol['job'];
				$fine = $rowcontrol['fine'];
				echo '<form  method = "post" action = "updateuser1.php" style="padding-right: 200px;"><br/>
						<input type = "text"  id="id" name = "id" style="display:none;" value="'.$id .'" >
						Username:<br/><input type = "text" id="username" name = "username" style="width: 300px;"  value="'.$username .'" ><br/>
						Password:<br/><input type = "text" id="password" name = "password" style="width: 300px;"  value="'.$password .'" ><br/>
						Email:<br/><input type = "text" id="email" name = "email" style="width: 300px;"  value="'.$email .'" ><br/>
						Authorization:<br/><input type = "text" id="authorization" name = "authorization" style="width: 300px;"  value="'.$authorization .'"" ><br/>
						Job:<br/><input type = "text" id="job" name = "job" style="width: 300px;"  value="'.$job .'"" ><br/>
						Fine amount:<br/><input type = "text" id="fine" name = "fine" style="width: 300px;"  value="'.$fine .'"" ><br/>
					    </select><br/><br/><input type = "submit" style="width:150px;" value = "UPDATE USER"/>
					</form>';			
			}
		}
		
?>	  
	</div>

</body>
</html>