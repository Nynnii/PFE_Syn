<?php
session_start();

include('filters/user_filter.php');
require 'config/dbconnect.php';
require 'includes/constants.php';
require 'includes/functions.php';

?>
	
<?php require("views/share_code.view.php"); ?>