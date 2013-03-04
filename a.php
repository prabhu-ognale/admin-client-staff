<?php 

	header("Content-type: text/html; charset=utf-8");
	include('common.php');
	$action = $_GET['action'];
	$page = $_GET['page'];
	$fn   = $_GET['fn'];
	if(!isset($_GET['page'])) $page='home'; 
	switch($page)
	{
		case 'project':
			include(MODEL_DOC_PATH.'project.php');
			$project = new Project;
			if($action == 'add_edit_project')
			{
				$ans = $project->add_edit_project($_POST);
				echo $ans;
			}
		break;
		
		case 'message':
			include(MODEL_DOC_PATH.'message.php');
			$message = new Message;
			if($action ==  'send')
			{
				$ans = $message->send_msg($_POST);
				echo $ans;	
			}
			elseif($action == 'get_name')
			{
				$ans = array('PHP', 'MySQL', 'SQL', 'PostgreSQL', 'HTML', 'CSS', 'HTML5', 'CSS3', 'JSON') ;	
				echo json_encode($ans);
			}
		break;
		
		case 'client':
			include(MODEL_DOC_PATH.'client.php');
			$client = new Client;
			if($action = 'add_edit_client')
			{
				$ans =$client->add_edit_client($_POST);
				echo $ans;
			}
			
		break;
		
		case 'user':
			if($action == 'login')
			{
				include_once(MODEL_DOC_PATH.'login.php');
				$login = new Login;
				if($fn == 'login')
				{
					$ans = $login->login_auth($_POST['username'],$_POST['password']);
					echo $ans;
				}
				elseif($fn=='logout')
				{
					$ans = $login->ajax_logout();
					echo $ans;
				}
			}
			elseif($action == 'signup')
			{
				include_once(MODEL_DOC_PATH.'user_reg.php');
				$user_reg = new User_Reg();
				if($fn == 'add_user')
				{
					$ans = $user_reg->add_edit_user($_POST);
					echo $ans;	
				}
				elseif($fn == 'check_username')
				{
					$ans = $user_reg->check_user_name($_REQUEST['name']);
					echo $ans;	
				}	
			}
		break;

	}


?>