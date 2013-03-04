<?php
include_once(CORE_DOC_PATH . '/class.table.php');
include_once(CORE_DOC_PATH . '/class.functions.php');
include_once(CORE_DOC_PATH . '/class.html.php');
class Control extends myTable
{
	public $db;
	public $sess_userID = 0;
	public $sess_userTYPE = '';
	public $sess_userNAME = '';
	public $site_conf;
	public $perm;
	
	public function Control()
	{
		$this->db  =  new myTable();
		$this->fn  =  new Functions();
		$this->htm =  new Html;
		$this->sess_userID 		= trim($_SESSION['sess_userID']);
		$this->sess_userTYPE 	= trim($_SESSION['sess_userTYPE']);
		$this->sess_userNAME 	= trim($_SESSION['sess_userNAME']);
	}
	
	public function js($file)
	{
		$js = '';
		if(is_array($file))
		{
			foreach($file as $key)
			{
				$js .= '<script type="text/javascript" charset="utf-8" src="'.THEME_BASE_PATH.'js/'.$key.'.js"></script>';
			}	
		}
		else
		{
			$js .= '<script type="text/javascript" charset="utf-8" src="'.THEME_BASE_PATH.'js/'.$key.'.js"></script>';
		}
		return $js;
	}
	
	public function css($file)
	{
		$css = '';
		if(is_array($file))
		{
			foreach($file as $key)
			{
				$css .= '<link href="'.THEME_BASE_PATH.'css/'.$key.'.css" rel="stylesheet" type="text/css" media="screen" />';	
			}
		}
		else
		{
			$css .= '<link href="'.THEME_BASE_PATH.'css/'.$key.'.css" rel="stylesheet" type="text/css" media="screen" />';
		}
	return $css;
	}
	
		
	public function meta_tag($name,$content)
	{
		$meta = '<meta name="'.$name.'" content="'.$content.'" />';
		return $meta;
	}
		
	public function no_auth()
	{
		if($this->sess_userID==0){$this->redirect($this->site_link('login'));}else{return false;}		
	}
	
	public function redirect($location)
	{
		header("Location: " . $location);
		exit;
	}
	
	public function site_link($page='')
	{
		$link='';
		switch($page)
		{
			case '': $link = SITE_URL; break;
			case 'login' : $link =  SITE_URL; break;//BASE_URL . '/user/login';  break;
			case 'logout': $link = SITE_URL . '/logout/index.htm'; break;
		}
		return $link;
	}
	public function get_header($header)
	{
		include_once(THEME_DOC_PATH . '/view/header.php');
	}
	
	public function get_footer($footer)
	{
		include_once(THEME_DOC_PATH . '/view/footer.php');
	}
	
	public function get_form($file)
	{
		include_once(THEME_DOC_PATH.'/forms/'.$file.'.php');	
	}
	
	public function get_nav($nav)
	{
		include_once(THEME_DOC_PATH.'/view/nav.php');	
	}
	
	public function get_page($name)
	{
		$page = $name . '.php';
		include_once(THEME_DOC_PATH . '/view/' . $page);
	}
	
	
}
?>