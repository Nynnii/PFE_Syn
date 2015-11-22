<?php
session_start();
require 'config/dbconnect.php';
require 'includes/constants.php';
require 'includes/functions.php';

//Si le formulaire de connexion a été soumis
if(isset($_POST['login'])) {
	//Si tous les champs sont remplis
	if(not_empty(['email', 'password'])) {
		extract($_POST);
		
		$q = $db->prepare("SELECT id FROM users WHERE email = :email AND password = :password AND active = '1'");
		
		$q->execute([
			'email' => $email,
			'password' => sha1($password)
		]);
		
		$userHasBeenFound = $q->rowCount();
		
		if($userHasBeenFound) {
			redirect('profile.php');
		} else {
			set_flash('Combinaison adresse mail, mot de passe incorrecte.', 'danger');
			save_input_data();
		}
		
	} else {
		clear_input_data();
	}
}
	
?>
	
<?php require("views/login.view.php"); ?>