<?php
error_reporting(-1);
ini_set('display_errors', 'On');

// LIBRARY PATH
define('LIBRARY_PATH',$_SERVER['DOCUMENT_ROOT'] . '/library/');

// CLASS PATH
define('CLASS_PATH', LIBRARY_PATH . 'classes/');

include_once(LIBRARY_PATH . 'includes/general_functions.php');