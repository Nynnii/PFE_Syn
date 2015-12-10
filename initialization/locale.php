<?php

$authorized_languages = array('fr', 'en');

// Si l'url comporte lang et reconnait une langue du tableau authorize_languages
if(!empty($_GET['lang']) && in_array($_GET['lang'], $authorized_languages)) {
	$_SESSION['locale'] = $_GET['lang'];
} else {
	if(empty($_SESSION['locale'])) {
	$_SESSION['locale'] = $authorized_languages[0];
	}
}

require 'lang/all.php';