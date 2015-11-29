<?php
session_start();

include('filters/guest_filter.php');
require 'config/dbconnect.php';
require 'includes/functions.php';

if(!empty($_GET['user']) && 
	is_used('firstname', $_GET['user'], 'users') && 
	!empty($_GET['token'])
) {
	$firstname = $_GET['user'];
	$token = $_GET['token'];
	
	$q = $db->prepare('SELECT email, password FROM users WHERE firstname = ?');
	$q->execute([$firstname]);
		
	$data = $q->fetch(PDO::FETCH_OBJ);

	$token_verif = sha1($firstname.$data->email.$data->password);
	
	if($token == $token_verif) {
		$q = $db->prepare("UPDATE users SET active = '1' WHERE firstname = ?");
		$q->execute([$firstname]);

		set_flash('Votre compte à été activé.', 'success');
		
		redirect('profil.php');
	} else {
		set_flash('Paramètres invalides.', 'danger');
		redirect('index.php');
	}
} else {
	redirect('index.php');
}