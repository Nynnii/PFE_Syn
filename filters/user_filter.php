<?php

// Si un utilisateur n'existe pas dans la bdd (id et mail invalides), alors on le redirige vers la page longin.php
if(!isset($_SESSION['user_id']) && !isset($_SESSION['email'])) {
	header('location: login.php');
	exit();
}

?>