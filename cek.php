<!DOCTYPE html>
<html>
<head>
	<title>ADUIN - Website Pengaduan Mahasiswa</title>
	<link rel="shortcut icon" href="https://cepatpilih.com/image/logo.png">
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">

	<link rel="stylesheet" type="text/css" href="css/style.css">
	<!-- ICONS -->
	<link rel="apple-touch-icon" sizes="76x76" href="assets/img/apple-icon.png">
	<link rel="icon" type="image/png" sizes="96x96" href="assets/img/favicon.png">

</head>
<body>
	<?php 
		include 'conn/koneksi.php';
		if(@$_GET['p']==""){
			include_once 'masuk.php';
		}
		elseif(@$_GET['p']=="login"){
			include_once 'masuk.php';
		}
		elseif(@$_GET['p']=="logout"){
			include_once 'logout.php';
		}
	?>
</body>
</html>