<?php
	
	if(isset($_POST["gönder"])) {
		if ($_FILES["resim"]["type"] == "image/jpeg") { 
			$dosyaadi = $_FILES["resim"]["name"];
			$yolu = "resimler/";
			$randad = array("f","ft","ftt");
			$uzanti = substr($dosyaadi,-4,4);
			$sayi = rand(1,100000);
			
			$yeniisim = $yolu . $randad[rand(0,2)] . $sayi . $uzanti ;
			
			if(move_uploaded_file($_FILES["resim"]["tmp_name"], $yeniisim)){
				echo '<script language="javascript">';
				echo 'alert("Fotoğraf kaydedildi.")';
				echo '</script>';
			}

		}
		else {
			echo '<script language="javascript">';
			echo 'alert("Hatalı format!")';
			echo '</script>';
		}
	}
	
	if (isset($_POST["sil"])) {
			
		$tasinacakyer = 'resimler/kullanilan/';
		$bulunduguyer =	'resimler/';
		
		$secilen= $_POST['secilen'];
		
		foreach ($secilen as $filename) {			
			rename($bulunduguyer.$filename,$tasinacakyer.$filename);			
		}
		echo '<script language="javascript">';
		echo 'alert("Fotoğraf silindi.")';
		echo '</script>';
	}

?>

<html>
<head>

<meta name="robots" content="noindex,nofollow"/>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css">
<link rel="stylesheet" href="//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css">

<style>

	#fotoUpload {
		  height: 150px;
		  top: 0px;
		  background-color: #9AE2AE;
		  text-align:center;
		  padding:5px;
	}

	h3, input {
		margin: 6px;
	}
	#choosePhoto {
		  position: fixed;
		  height: 35px;
		  width: 93.5%;
		  bottom:0px; 
		  background-color: #9AE2AE;
		  text-align: center;
	}

	#choosePhoto > input {
		width: 20px;
		height: 10px;
	}
	#deletePhoto{
		text-align:center;
		background-color: #9AE2AE;
	}
	#sayfa {
		position:absolute;
		margin-left: 60px;
		margin-right: 60px;
		background-color: #F4E9EE;
		text align:center;
	}

	.button{
		padding:6px;
		font-weight:bold;
	}

	.file {
		position:absolute;
		left:40%;
		right:60%;
	}
</style>
</head>

<body>
	<div id="Sayfa">
	<div id = "fotoUpload" >
		<form action="" method="post" enctype="multipart/form-data">
			<h3> Fotoğraf Yükle </h3><hr>
				<div class="file"><input type="file" name="resim" ></div><br>
				<input class="button" type="submit" value="Gönder" name="gönder" style="margin-top:15px;">
		</form>
	</div>
	<br>
		
<?php
	$dir    = 'resimler';
	$files1 = scandir($dir);

	echo '<div id="choosePhoto"><form action="" onSubmit="return confirm(&#39Emin misiniz?&#39);" method="post" >
	 <input type ="submit" class="button" name="sil" value="SİL" style = "width:80px;height:35px;margin-top:2px;;"/></div>
	 <div id="deletePhoto"><h3>Fotoğraf sil </h3></div>';
	
	foreach ($files1 as $file) {

		if(strlen($file)>4 AND $file!="kullanilan"){
			
			echo "<div style='float:left;display:block;margin-right:5px;height:300px' class='panel panel-success'>
					<div class='panel-heading'>
					  <h3 class='panel-title'> <input type='checkbox' value='{$file}' name='secilen[]'> {$file} </h3>
					</div>
					<div class='panel-body'>
					 <img height='230px' src='resimler/{$file}'>
					</div>
				  </div>";
		}
	}
	echo '</form><br></div>';
	
?>

</body>
</html>