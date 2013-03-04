<?php 

	session_start();
	error_reporting(E_ALL ^ E_NOTICE ^ E_DEPRECATED);
	//error_reporting(0);
	

	define('THEME', 'default');
	define('SITE_NAME', 'Ognale Software');
	define('SITE_URL', 'http://localhost/ognale');
	define('BASE_URL', SITE_URL.'/');
	
	define('DOC_PATH', dirname(__FILE__));
	
	define('CORE_DOC_PATH',DOC_PATH.'/core/');
	define('MODULE_DOC_PATH',DOC_PATH.'/modules/');
	define('MODEL_DOC_PATH',DOC_PATH.'/model/');
	define('THEME_DOC_PATH', DOC_PATH.'/theme/'.THEME);
	
	define('THEME_BASE_PATH', BASE_URL.'theme/'.THEME.'/');
	
	
	// define Table 
	define('TBL_PREFIX','og_');
	define('CLIENT', TBL_PREFIX.'client_details');
	define('USER', TBL_PREFIX.'user_details');
	define('PROFILE', TBL_PREFIX.'user_profile');
	define('PROJECT_DETAILS', TBL_PREFIX.'project_details');
	define('USER_LEVEL', TBL_PREFIX.'user_level');
	define('MESSAGE', TBL_PREFIX.'message');
	
	include(CORE_DOC_PATH.'class.controller.php');


?>