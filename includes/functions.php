<?php

if (!function_exists('not-empty')) {
	//On vérifie si l'utilisateur a bien rempli chaque champs
	function not_empty($fields = []) { 
		if(count($fields) != 0) {
			foreach ($fields as $field) {
				//Si l'un des champs est vide, on retourne false
				if (empty($_POST[$field]) || trim($_POST[$field]) == "") {
					return false;
				}
			}
			return true; //Si tous les champs sont remplis, on retourne true
		}
	}
}

if (!function_exists('is_used')) {
	function is_used($field, $value, $table) {
		global $db;
		
		$q = $db->prepare("SELECT id FROM $table WHERE $field = ?"); //On prépare la requête pour éviter les injections SQL
		$q->execute([$value]);
		
		$count = $q->rowCount();
		
		$q->closeCursor(); //On ferme le curseur lorsqu'on a fini d'éxécuter la requête
		
		return $count; // On aura 0 (false) dans le cas où la valeur n'existe pas déjà dans la bdd ou 1 (true) dans le cas où elle existe déjà
	}
}
