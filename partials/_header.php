<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0"> <!-- Cette ligne va adapter l'écran du site web aux mobiles (smartphone et tablettes)-->

		<link rel="stylesheet" href="assets/css/main.css">
		<link rel="stylesheet" href="assets/css/bootstrap.min.css">
		<link rel="stylesheet" href="assets/font-awesome/css/font-awesome.min.css">
		<link rel="stylesheet" href="assets/js/google-code-prettify/prettify.css">


		<!-- CSS page Cours -->
		<link rel="stylesheet" href="assets/css/normalize.css" />
		<link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
		<link rel="stylesheet" type="text/css" href="assets/js/shadowbox-3.0.3/shadowbox.css" />
		
		<title><?php 
				echo isset($title)
					? $title .' - '.WEBSITE_NAME
					: WEBSITE_NAME;
			?></title>
	</head>
	<body>
		<div id="wrap">
	<?php include 'partials/_nav.php'; ?>
	<?php include 'partials/_flash.php'; ?>

