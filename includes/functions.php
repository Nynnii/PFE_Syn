<?php

if (!function_exists('e')) {
	function e($string) {
		if($string) {
			return htmlspecialchars($string);
		}
	}
}

//Obtenir une valeur de SESSION grâce à une clé
if (!function_exists('get_session')) {
	function get_session($key) {
		if ($key) {
			return !empty($_SESSION[$key])
				? e($_SESSION[$key])
				: null;
		}
	}
}

//Vérifier si l'utilisateur est connecté
if (!function_exists('is_logged_in')) {
	function is_logged_in() {
		return isset($_SESSION['user_id']) || isset($_SESSION['email']);
	}
}

//Obtenir une valeur de SESSION grâce à une clé
if (!function_exists('get_avatar_url')) {
	function get_avatar_url($email) {
		return "http://gravatar.com/avatar/".md5(strtolower(trim(e($email))));
	}
}

//Trouver un utilisateur par son id
if (!function_exists('find_user_by_id')) {
	function find_user_by_id($id) {
		global $db;

		$q = $db->prepare('SELECT firstname, lastname, email, status, class, city, country, sex, github, employment_status, description FROM users WHERE id = ?');
		
		$q->execute([$id]);

		$data = current($q->fetchAll(PDO::FETCH_OBJ));

		$q->closeCursor();

		return $data;
	}
}

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

if (!function_exists('set_flash')) {
	function set_flash($message, $type = 'info'){
		$_SESSION['notification']['message'] = $message;
		$_SESSION['notification']['type'] = $type;
	}
}

if (!function_exists('redirect')) {
	function redirect($page) {
		header('location: ' . $page);
		exit();
	}
}

if (!function_exists('save_input_data')) {
	function save_input_data() {
		foreach ($_POST as $key => $value) {
			if(strpos($key, 'password') === false) {
				$_SESSION['input'][$key] = $value;
			}
		}
	}
}

if (!function_exists('get_input')) {
	function get_input($key) {
		return !empty($_SESSION['input'][$key])
			? e($_SESSION['input'][$key])
			: null;
	}
}

if (!function_exists('clear_input_data')) {
	function clear_input_data() {
		if (isset($_SESSION['input'])) {
			$_SESSION['input'] = [];
		}
	}
}

//Gère l'état actif de nos onglets dans le header
if (!function_exists('set_active')) {
	function set_active($file, $class='active') {
		$path = explode('/', $_SERVER['SCRIPT_NAME']);
		$page = array_pop($path);
		if($page == $file.'.php') {
			return $class;
		} else {
			return "";
		}
	}
}