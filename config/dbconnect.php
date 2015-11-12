<?php

// On définit l'identité de la bdd
define('DB_HOST', 'localhost');
define('DB_NAME', 'syn');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
try {
	$db = new PDO("mysql:host=".DB_HOST."; dbname=".DB_NAME, DB_USERNAME, DB_PASSWORD); // On utilise PDO pour permettre la portabilité des bases de données. Par exemple, si un jour on a un problème avec mysql, il suffira de remplacer par une autre bdd comme pgsql.
	
	$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOexception $e) {
	die('Erreur de connexion a la bdd: '.$e->getMessage());
}