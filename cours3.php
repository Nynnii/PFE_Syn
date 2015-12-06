<?php

session_start();
include('filters/user_filter.php');
require 'config/dbconnect.php';
require 'includes/constants.php';

require_once('config/config.inc.php');
require_once('config/settings.inc.php');
require_once('includes/functions.php');


require 'views/cours3.view.php';

