<?php

// Si un utilisateur n'existe pas dans la bdd (id et mail invalides), alors on le redirige vers la page profile.php
if(isset($_SESSION['user_id']) && isset($_SESSION['email'])) {
	header('location: profile.php');
	exit();
}

?>