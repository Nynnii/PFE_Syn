<?php

// Si un utilisateur existe dans la bdd (id et mail valides), alors on le redirige vers la page profile.php
if(isset($_SESSION['user_id']) || isset($_SESSION['email'])) {
	header('location: profile.php');
	exit();
}

?>