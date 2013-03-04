<?php 


	class User extends Control
	{
		public function User()
		{
			parent::Control();
			$this->action = $this->fn->req('action');
			$this->method = $this->fn->req('fn');
		}
		
		public function load_js()
		{
			$js = array('jquery','bootstrap.min','all_plugins','graphDemo');
			return Control::js($js);	
		}

		public function load_css()
		{
			$css = array('bootstrap','elements','myelements','theme');
			return Control::css($css);	
		}	
		
		public function load_meta()
		{
			return '';
		}

		public function load_header()
		{
			$header = array();
			$header['title'] = SITE_NAME;
			$header['js'] = self::load_js();
			$header['css'] = self::load_css();
			$header['keywords'] = Control::meta_tag('keyword','');
			$header['description'] = Control::meta_tag('description','');
 			return $header;
		}

		public function load_footer()
		{
			$footer = array();
			$footer['ip'] = $_SERVER['REMOTE_ADDR'];
			return $footer;	
		}
		
		public function render()
		{
			$header = self::load_header();
			$footer = self::load_footer();
			Control::get_header($header);
			if($this->method == 'login')
			{
				Control::get_page('user/login');
			}
			elseif($this->method == 'signup')
			{
				Control::get_page('user/signup');
			}
			elseif($this->method == 'forget')
			{
				Control::get_page('user/forget');
			}
			else
			{
				Control::get_page('404page');
			}
			Control::get_footer($footer);	
		}
		
	}
$user = new User;
?>