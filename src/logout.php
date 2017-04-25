<?php
session_start();
ob_start();
session_destroy();
echo '<div style="margin:10% 0% 0% 14.5%;position: absolute;font-size: 30px;font-weight: bold;">Your session has been successfully terminated.You are redirected to home page..</div>';
header("Refresh: 2; url=index.php");
ob_end_flush();
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
			<img src= "assets/images/loading.gif" style= "height:80px; width:80px; align:center; margin-top:10%">
		</div>
</div>