<?php
header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT');
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");

$timezone = "Asia/Calcutta";
date_default_timezone_set($timezone);

include('common.php');

$page = (isset($_GET['page'])) ? $_GET['page'] : 'home';

switch($page)
{
	case 'home':
	include_once(MODULE_DOC_PATH . 'home/home.php');
	$home->render();
	break;
	
	case 'user':
	include_once(MODULE_DOC_PATH . 'user/user.php');
	$user->render();
	break;
	
	case 'admin':
	include_once(MODULE_DOC_PATH . 'admin/admin.php');
	$admin->render();
	break;
	
	
	case 'staffs':
	include_once(MODULE_DOC_PATH . 'staffs/staffs.php');
	$staffs->render();
	break;
	
	case 'client':
	include_once(MODULE_DOC_PATH . 'clients/clients.php');
	$clients->render();
	break;

	case 'home':
	include_once(MODULE_DOC_PATH . 'home/home.php');
	$home->render();
	break;
}

?>