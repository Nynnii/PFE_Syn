<?php 
/****************************************************
 EXPLORATEUR PHP                       
****************************************************/
/** repertoire racine destine a etre parcouru, par defaut : ./documents/   **/
define('BASE', 'documents');


/**  extensions identifiees et associees a une icone placee dans 'images/48/' ou 'images/96/'   **/
$t_extensions_reconnues = array(
	'css',
	'doc',
	'flv',
	'gif',
	'html',
	'jpeg',
	'jpg',
	'mov',
	'mp4',
	'mpeg',
	'pdf',
	'php',
	'png',
	'ppt',
	'rar',
	'swf',
	'txt',
	'wmv',
	'xls',
	'zip'
	);

/** correspondance des extensions en francais **/
$t_extensions = array(
	'css'=>'Feuille de style',
	'doc'=>'Microsoft Word',
	'flv'=>'Fichier FLV',
	'gif'=>'Image GIF',
	'html'=>'Page web',
	'jpeg'=>'Image JPEG',
	'jpg'=>'Image JPEG',
	'mov'=>'Fichier MOV',
	'mp4'=>'Fichier MP4',
	'mpeg'=>'Fichier MPEG',
	'pdf'=>'Adobe Acrobat',
	'php'=>'Script PHP',
	'png'=>'Image PNG',
	'ppt'=>'Microsoft Power Point',
	'rar'=>'Archive WinRar',
	'swf'=>'Fichier SWF',
	'txt'=>'Document texte',
	'wmv'=>'Fichier WMV',
	'xls'=>'Microsoft Excel',
	'zip'=>'Archive WinZip'
);

/**  repertoires a ne pas montrer a l'internaute en sus des repertoires caches commencant par un . => ., .., .htaccess, etc... **/
$t_repertoires_sensibles = array(
	'lost+found'
);

/**  listing des fichiers a ne pas montrer a l'internaute en sus les fichiers caches **/
$t_fichiers_sensibles = array(
	'index.php'
);

/**  listing des extensions des fichiers a ne pas montrer a l'internaute **/
$t_extensions_sensibles = array(
	'.bak'
);

?>