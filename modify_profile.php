<?php
session_start();

include('filters/user_filter.php');
require 'config/dbconnect.php';
require 'includes/functions.php';
require 'includes/constants.php';

/*
if(!empty($_GET['id'])) {
	//Dans le cas où l'utilisateur existe, on va récupérer les infos sur lui en BDD en utilisant son id
	$user = find_user_by_id($_GET['id']);

	if (!$user) {
		redirect('index.php');
	}
} else {
	redirect('profile.php?id='.get_session('user_id')); //Sinon, on le redirige avec le bon id
}
*/

//Si le formulaire de connexion a été soumis
if(isset($_POST['update'])) {

	$errors = [];

	//Si tous les champs sont remplis
	if(not_empty(['city', 'country', 'sex', 'description'])) {
		extract($_POST);
		
		$q = $db->prepare('UPDATE users 
			SET firstname = :firstname, lastname = :lastname, sex = :sex, city = :city, country = :country, github = :github, employment_status = :employment_status, description = :description 
			WHERE id = :id');
		
		$q->execute([
			'firstname' => $firstname,
			'lastname' => $lastname,
			'sex' => $sex,
			'city' => $city,
			'country' => $country,
			'github' => $github,
			'employment_status' => !empty($employment_status) ? '1' : '0',
			'description' => $description,
			'id' =>get_session('user_id'),
		]);

		set_flash("Votre profil a été mis à jour.");
	} else {
		save_input_data();
		$errors[] = "Veuillez remplir tous les champs obligatoires (*)";
	}
		
	} else {
		clear_input_data();
	}

require 'views/modify_profile.view.php';
