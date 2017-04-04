<?php
include('config.php');
if( $admin->is_logged_in() ){ header('Location: index.php'); } 
//process login form if submitted
if(isset($_POST['submit'])){
	$id = $_POST['id'];
	$password = $_POST['password'];
	
	if($admin->login($id,$password)){ 
		header('Location: index.php');
		exit;
	
	} else {
		$error[] = 'Wrong username or password or your account has not been activated.';
	}
}
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<!-- Latest compiled and minified CSS -->

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
  
<title>Admin Login</title>
</head>

<body>
	<br>
            <div class="row -block center-block">
                <div class="col-xs-10 col-xs-offset-1 col-sm-8 col-sm-offset-2 col-md-4 col-md-offset-4">
                    <div class="login-panel panel panel-default">
                    
                        <div class="panel-heading">Log in</div>
                        <div class="panel-body">
                            <form role="form" method="post" action="">
                            <hr>

				<?php
				//check for any errors
				if(isset($error)){
					foreach($error as $error){
						echo '<p class="bg-danger">'.$error.'</p>';
					}
				}
				if(isset($_GET['action'])){
					//check the action
					switch ($_GET['action']) {
						case 'active':
							echo "<h2 class='bg-success'>Your account is now active you may now log in.</h2>";
							break;
						case 'reset':
							echo "<h2 class='bg-success'>Please check your inbox for a reset link.</h2>";
							break;
						case 'resetAccount':
							echo "<h2 class='bg-success'>Password changed, you may now login.</h2>";
							break;
					}
				}
				
				?>
                                <fieldset>
                                    <div class="form-group">
                                        <input class="form-control" placeholder="Username" name="id" >
                                    </div>
                                    <div class="form-group">
                                        <input class="form-control" placeholder="Password" name="password" type"password" value="">
                                    </div>
                                    <div>
                                        
                                    </div>
                                    
                                    <input class="btn btn-primary" name="submit" type="submit" value="Login" />
                                </fieldset>
                            </form>
                        </div>
                    </div>
                </div><!-- /.col-->
            </div><!-- /.row -->	




	<script src="../style/js/jquery-1.11.1.min.js"></script>
	<script src="../style/js/bootstrap.min.js"></script>
</body>
</html>
