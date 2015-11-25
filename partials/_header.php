<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0"> <!-- Cette ligne va adapter l'écran du site web aux mobiles (smartphone et tablettes)-->
		<link rel="stylesheet" href="assets/css/main.css">
		<link rel="stylesheet" href="assets/css/bootstrap.min.css">
		
		<title><?php 
				echo isset($title)
					? $title .' - '.WEBSITE_NAME
					: WEBSITE_NAME;
			?></title>
	</head>
	<body>
	<?php include 'partials/_nav.php'; ?>
	<?php include 'partials/_flash.php'; ?>

