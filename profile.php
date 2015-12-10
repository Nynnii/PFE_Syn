<?php
session_start();

include('filters/user_filter.php');
require 'config/dbconnect.php';
require 'includes/functions.php';
require 'includes/constants.php';
require 'initialization/locale.php';


if(!empty($_GET['id'])) {
	//Dans le cas où l'utilisateur existe, on va récupérer les infos sur lui en BDD en utilisant son id
	$user = find_user_by_id($_GET['id']);

	//var_dump($user->firstname);

	//die();

	if (!$user) {
		redirect('index.php');
	}
} else {
	redirect('profile.php?id='.get_session('user_id')); //Sinon, on le redirige avec le bon id
}

require 'views/profile.view.php';
