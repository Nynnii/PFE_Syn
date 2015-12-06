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

// Fonctions pour l'explorateur de fichier

// securiser le repertoire
function secureDir($dir){

	$remplacements = array( '%2E' => ' ', '..' => ' ', '%u2216' => ' ',);
	return	strtr($dir, $remplacements);
	
}

// permet de supprimer les accents
function removeAccents($chaine, $charset='utf-8') {
    
	$chaine = htmlentities($chaine, ENT_NOQUOTES, $charset);
    
    $chaine = preg_replace('#&([A-za-z])(?:acute|cedil|circ|grave|orn|ring|slash|th|tilde|uml);#', '\1', $chaine);
    $chaine = preg_replace('#&([A-za-z]{2})(?:lig);#', '\1', $chaine); // pour les ligatures e.g. '&oelig;'
    $chaine = preg_replace('#&[^;]+;#', '', $chaine); // supprime les autres caracteres
    
    return $chaine;
	
}

// detecte l'encodage d'une chaine de carateres et l'adapte
function fixEncoding($chaine){
	
	/********** solution 1 pour l'encodage ( fonctionne sur serveur OVH) **********/
	if( mb_detect_encoding($chaine) != 'UTF-8' )
		$chaine = utf8_encode($chaine);
	
	/********** solution 2 pour l'encodage (fonctionne sur mon serveur local WAMP) **********/
	// si la solution 1 ne fonctionne pas, commentez la solution 1 (lignes 32 et 33) et decommentez la solution 2 (ligne 37)
	// $chaine = utf8_encode($chaine);

	return $chaine;
	
}

// permet de faire un extrait d'une longue chaine
function makeExtract($chaine, $max=200) {

	$cherche_saut_de_ligne = "<br />";
	$recherche = strrpos($chaine, "<br />");
	if ($recherche == false){
		if(strlen($chaine)>=$max){
			$chaine = substr($chaine, 0, $max);
			$espace = strrpos($chaine, " ");
			$chaine = substr($chaine, 0, $espace) . "...";
		}
	}
	else {
		$debut_chaine = explode ("<br />", $chaine);
		$chaine = $debut_chaine[0] . "...";
	}
	
	return $chaine;
	
}

// permet de raccourcir une chaine
function shortenString($chaine, $max=200) {	
	
	if(strlen($chaine)>=$max)
		$chaine=substr($chaine, 0, $max)."...";
		
	return $chaine;
	
}

// ensemble des fonctions permettant d'afficher une chaine de caracteres correctement
function normalizeString($chaine) {

	return fixEncoding($chaine);
	
}

// permet de formater de la taille du fichier
function formatSize($taille) {

	$t_unites = array('octets', 'Ko', 'Mo', 'Go', 'To');
	$i = 0;
	$nombre_a_afficher = 0;

	while($taille >= 1) {
		$nombre_a_afficher = $taille;
		$taille /= 1024;
		$i++;
	}
	
	if(!$i) $i=1;
	$d = explode(".", $nombre_a_afficher);
	if($d[0] != $nombre_a_afficher) {
		$nombre_a_afficher = number_format($nombre_a_afficher, 2, ",", " ");
	}
	
	return $nombre_a_afficher." ".$t_unites[$i-1];
	
}

// permet d'obtenir les dimensions de l'image a afficher
function getFitteddimensions($base, $entree, $largeur_max, $hauteur_max) {

	$infos_image = getimagesize($base."/".$entree);
	
	if($infos_image[0] > $infos_image[1]){
		if($infos_image[0]>$largeur_max){
			$ratio = $infos_image[0]/$largeur_max;
			$infos_image[0] = $largeur_max;
			$infos_image[1] = $infos_image[1]/$ratio;		
		}	
	}
	else {
		if($infos_image[1]>$hauteur_max){
			$ratio = $infos_image[1]/$hauteur_max;
			$infos_image[1] = $hauteur_max;
			$infos_image[0] = $infos_image[0]/$ratio;		
		}		
	}
	
	return array("largeur"=>(int)$infos_image[0], "hauteur"=>(int)$infos_image[1]);
	
}

// permet d'obtenir les informations sur un fichier ou un repertoire
function getInfos($base, $entree, $type) {

	$t_infos = array();
	
	switch($type){
	
		case 'repertoire':
			$t_infos = array(				
				'type' => 'repertoire', 
				'nom' => $entree,
				'date' => filemtime($base."/".$entree), 
				'taille' => (int)filesize($base."/".$entree),
				'acces' => fileatime($base."/".$entree)
			);
			break;
		
		case 'fichier':			
			switch( strtolower(pathinfo($base."/".$entree, PATHINFO_EXTENSION)) ){
				case 'jpg':
				case 'jpeg':
				case 'png':
				case 'gif':
					$infos_image = getimagesize($base."/".$entree);
					$t_infos = array(
						'type' => 'image', 
						'nom' => 'image', //pathinfo($base.'/'.$entree, PATHINFO_FILENAME), 
						'extension' => pathinfo($base.'/'.$entree, PATHINFO_EXTENSION), 
						'nom.extension' => pathinfo($base.'/'.$entree, PATHINFO_BASENAME ), 
						'mime' => $infos_image[2], 						
						'taille' => (int)filesize($base.'/'.$entree), 
						'date' => filemtime($base.'/'.$entree), 
						'acces' => fileatime($base.'/'.$entree), 
						'largeur' => $infos_image[0], 
						'hauteur' => $infos_image[1], 
						'style' => $infos_image[3]						
					);
					break;
				default:
					$t_infos = array(
						'type' => 'fichier', 
						'nom' =>  pathinfo($base.'/'.$entree, PATHINFO_FILENAME), 
						'extension' => pathinfo($base.'/'.$entree, PATHINFO_EXTENSION), 
						'nom.extension' => pathinfo($base.'/'.$entree, PATHINFO_BASENAME ), 
						'taille' => (int)filesize($base.'/'.$entree), 
						'date' => filemtime($base.'/'.$entree), 
						'acces' => filemtime($base.'/'.$entree));
					break;				
			}			
			break;
		
		case 'erreur':
			$return = array("type"=>"erreur");
			break;

		default:
			$return = array("type"=>"erreur");
			break;				
	}
	
	return $t_infos;
	
}

// comparaison des noms
function cmp_nom($a, $b) {
	
	global $order;
	
	if( removeAccents(strtolower($a['nom'])) == removeAccents(strtolower($b['nom'])) ){
		return 0;		
	}
	
	if( $order == 'asc' ) {
		if( removeAccents(strtolower($a['nom'])) < removeAccents(strtolower($b['nom'])) ){
			return -1;
		}
		
		return 1;
	}
	else {
		if( removeAccents(strtolower($a['nom'])) > removeAccents(strtolower($b['nom'])) ) {
			return -1;
		}
	
		return 1;
	}
	
}

// comparaison des noms pour l'arborescence
function cmp_nom_arborescence($a, $b) {
	
	if (removeAccents(strtolower($a['nom'])) == removeAccents(strtolower($b['nom']))) 
		return 0;
	
	
	if (removeAccents(strtolower($a['nom'])) < removeAccents(strtolower($b['nom']))) 
		return -1;
	
	return 1;

}

// comparaison des tailles
function cmp_taille($a, $b) {

	global $order;
	
	// si la taille est identique, on trie sur le nom
    if ($a['taille'] == $b['taille']) return cmp_nom($a, $b);

	if($order == 'asc')
    	return ($a['taille'] < $b['taille']) ? -1 : 1;
	else
    	return ($a['taille'] > $b['taille']) ? -1 : 1;
	
}

// comparaison des dates
function cmp_date($a, $b) {

	global $order;
	
	// si la date est identique, on trie sur le nom
    if ($a['date'] == $b['date']) return cmp_nom($a, $b);

	if($order == 'asc') 
    	return ($a['date'] < $b['date']) ? -1 : 1;
	
	else 
    	return ($a['date'] > $b['date']) ? -1 : 1;
	
}

// comparaison des types
function cmp_type($a, $b) {

	global $order;
	
	// si la type est identique, on trie sur le nom
    if ($a['type'] == $b['type']) return cmp_nom($a,$b);
	
	if($order == 'asc') 
    	return ($a['type'] < $b['type']) ? -1 : 1;
	
	else 
    	return ($a['type'] > $b['type']) ? -1 : 1;
		
}

// comparaison des extensions
function cmp_extension($a,$b) {
	
	global $order;
	
	// si l'extension est identique, on trie sur le nom
    if ($a['extension'] == $b['extension']) return cmp_nom($a, $b);

	if($order == 'asc')
    	return ($a['extension'] < $b['extension']) ? -1 : 1;
	else 
    	return ($a['extension'] > $b['extension']) ? -1 : 1;
	
}

// permet de dresser la liste des repertoires de 1er niveau uniquement => non recursif
function getDir($repertoire_a_lister) {

	global $t_repertoires_sensibles;
	$t_repertoires = array();
 
	if (false !==($ressource = opendir($repertoire_a_lister))) {
	
		while (false !== ($entree = readdir($ressource)))  {
		
			if( is_dir($repertoire_a_lister."/".$entree) ) {	
				if( !in_array($entree, $t_repertoires_sensibles) && !preg_match("/^\./", $entree) ) {
					$t_repertoires[] = getInfos($repertoire_a_lister, $entree, 'repertoire');				
				}			
			}

		}
		
		// tri du tableau selon le nom
		usort($t_repertoires, "cmp_nom_arborescence");
		
		closedir($ressource);
	
	}
	//else die("pas de ressources");
	
	return $t_repertoires;
	
}

// permet de dresser la liste de tout ce que contient un repertoire donne : repertoires et fichiers
function listDir($repertoire_a_lister) {

	global $t_repertoires_sensibles, $t_fichiers_sensibles, $t_extensions_sensibles, $orderby;
	$t_repertoires = array();
	$t_fichiers = array();
	
	if (false !==($ressource = opendir($repertoire_a_lister))) {
	
		while (false !== ($entree = readdir($ressource)))  {
		
			if( is_dir($repertoire_a_lister."/".$entree) ) {			
				if( !in_array($entree, $t_repertoires_sensibles) && !preg_match("/^\./", $entree) ) {
					$t_repertoires[] = getInfos($repertoire_a_lister, $entree, 'repertoire');				
				}			
			}
			else {			
				if( !in_array($entree, $t_fichiers_sensibles) && !in_array(strrchr($entree, '.'), $t_extensions_sensibles) ) 
					$t_fichiers[] = getInfos($repertoire_a_lister, $entree, 'fichier');			
			
			}
			
		}
		
		// tri des tableaux suivant l'ordre indique
		usort($t_repertoires, "cmp_" . $orderby);
		usort($t_fichiers, "cmp_" . $orderby);
		
		// fusion des 2 tableaux pour affichage
		$liste_du_repertoire = array_merge($t_repertoires, $t_fichiers);
		
		closedir($ressource);
	
	}
	//else die("pas de ressources");
	
	return $liste_du_repertoire;
	
}

function hasChildren($repertoire) {
	
	global $t_repertoires_sensibles;
 
	if (false !==($ressource = opendir($repertoire))) {
	
		while (false !== ($entree = readdir($ressource)))  {
		
			if( is_dir($repertoire."/".$entree) ) {	
				if( !in_array($entree, $t_repertoires_sensibles) && !preg_match("/^\./", $entree) ) {
					return true;				
				}			
			}

		}
		
		closedir($ressource);
	
	}
	//else die("pas de ressources");
	
	return false;;

}

// permet de constituer un fil d'Ariane
function getBreadcrumb($chemin) {
	
	$t_fildariane = array();	
	$t_fildariane = explode('/', $chemin);	
	return $t_fildariane;
	
}

// permet de rediriger vers l'adresse passe en parametre
function redirect($location) {

	if (!headers_sent()) {
		header("Location: " . $location);
	} 
	else { ?>
		<script>
			document.location.href='<?php echo $location ?>';
		</script>
	<?php }
	
	die();

}