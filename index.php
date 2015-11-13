<?php
require 'config/dbconnect.php';
require 'includes/constants.php';
require 'includes/functions.php';

//Si le formulaire a été soumis
	if(isset($_POST['register'])) {
		//Si tous les champs sont remplis
		if(not_empty(['firstname', 'lastname', 'class', 'email', 'password', 'password_confirm'])) {
			$errors = []; //On crée un tableau qui va contenir nos erreurs
			
			extract($_POST);
			
			if(mb_strlen($firstname) < 2) {
				$errors[] = "Votre prénom est trop court. (2 caractères minimum)";
			}
			if(mb_strlen($lastname) < 2) {
				$errors[] = "Votre nom est trop court. (2 caractères minimum)";
			}
			if(mb_strlen($class) != 4) {
				$errors[] = "Veuillez insérer votre promo. (ex: 2016)";
			}
			if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
				$errors[] = "Votre adresse email n'est pas valide.";
			}
			if (mb_strlen($password < 6)) {
				$errors[] = "Votre mot de passe est trop court. (6 caractères minimum)";
			} else {
				if($password != $password_confirm) {
					$errors[] = "Vos deux mots de passe ne sont pas identiques.";
				}
			}
			
			if (is_used('email', $email, 'users')) {
				$errors[] = "Cette adresse mail est déjà utilisée";
			}
			
			if(count($errors) == 0) {
				//Envoi mail d'activation
				$to = $email;
				$subject = WEBSITE_NAME. " - Activation de compte";
				$token = sha1($firstname.$email.$password);
				
				ob_start();
				require('templates/email/activation_mail.php');
				$content = ob_get_clean();
				
				$headers = 'MIME-Version: 1.0' . "\r\n";
				$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
				
				mail($to, $subject, $content, $headers);
				
				//Informer l'utilisateur pour qu'il vérifie sa boite de reception
				echo "mail d'activation envoye !";
			}
		} else {
			$errors[] = "Tous les champs n'ont pas été rempli.";
		}
	}
	
	
require("views/index.view.php");