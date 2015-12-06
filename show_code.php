<?php
session_start();

require 'config/dbconnect.php';
require 'includes/constants.php';
require 'includes/functions.php';

if(!empty($_GET['id'])) {
	$data = find_code_by_id($_GET['id']);

	if(!$data) {
		redirect('share_code.php');
	}
} else {
	redirect('share_code.php');
}


?>
	
<?php require("views/show_code.view.php"); ?>