<?php
session_start();

include('filters/user_filter.php');
require 'config/dbconnect.php';
require 'includes/constants.php';
require 'includes/functions.php';

if(!empty($_GET['id'])) {
	$data = find_code_by_id($_GET['id']);

	if(!$data) {
		$code = "";
	} else {
		$code = $data->code;
	}
} else {
	$code = "";
}

//Si le formulaire de connexion a été soumis
if(isset($_POST['save'])) {
	if(not_empty(['code'])) {
		extract($_POST);

		$q = $db->prepare('INSERT INTO codes(code) VALUES(?)');
		$success = $q->execute([$code]);

		if($success) {
			//Afficher le code source
			$id = $db->lastInsertId();
			redirect('show_code.php?id='.$id);
		} else {
			set_flash("Erreur lors de l'ajout du code source.");
			redirect("share_code.php");
		}

	} else {
		redirect('share_code.php');
	}
}

?>
	
<?php require("views/share_code.view.php"); ?>