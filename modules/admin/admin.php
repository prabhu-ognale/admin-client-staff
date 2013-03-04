<?php 

include_once(MODEL_DOC_PATH .'profile.php');
include_once(MODEL_DOC_PATH .'user_reg.php');
include_once(MODEL_DOC_PATH .'message.php');



	class Admin extends Control
	{
		var $id;
		public function Admin()
		{
			parent::Control();
			$this->no_auth();
			$this->action = $this->fn->req('action');
			$this->method = $this->fn->req('method');
			$this->message = new Message;
			$this->profile = new Profile;
			$this->user_reg = new User_Reg();
			$this->id = $this->fn->get('id');
		}
		
		public function load_js()
		{
			$js = array('jquery','jquery-ui-min','bootstrap.min','all_plugins','user_reg','addproject','message');
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
			Control::get_page('admin/sidebar');
			if($this->action =='home')
			{
				Control::get_page('admin/content');
			}
			elseif($this->action == 'user')
			{
				if($this->method == 'addnew')
				{
					Control::get_page('user/signup');
				}
				elseif($this->method == 'list')
				{
					Control::get_page('user/list');
				}
			}
			elseif($this->action == 'project')
			{
				if($this->method == 'addnew')
				{
					Control::get_page('project/addnew');
				}
				elseif($this->method == 'list')
				{
					Control::get_page('project/list');
				}
			}
			elseif($this->action == 'client')
			{
				if($this->method == 'addnew')
				{
					Control::get_page('clients/addclients');
				}
				elseif($this->method == 'list')
				{
					Control::get_page('clients/list');
				}
			}
			elseif($this->action == 'message')
			{
				if($this->method == 'send')
				{
					Control::get_page('message/addmessage');
				}
				elseif($this->method == 'list')
				{
					Control::get_page('message/list');
				}
				elseif($this->method == 'view')
				{
					Control::get_page('message/view');
				}
			}
			Control::get_footer($footer);	
		}
		
	}
$admin = new Admin;
?>