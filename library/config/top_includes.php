<?php
error_reporting(E_ERROR | E_WARNING | E_PARSE);
ini_set('display_errors', 'On');

if(!isset($_SESSION)){
    session_start();

}

// LIBRARY PATH
define('LIBRARY_PATH',$_SERVER['DOCUMENT_ROOT'] . '/library/');

// CLASS PATH
define('CLASS_PATH', LIBRARY_PATH . 'classes/');

include_once(LIBRARY_PATH . 'includes/general_functions.php');