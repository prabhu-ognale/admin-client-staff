<?php 

	class Profile extends Control
	{
		var $username;
		var $first_name;
		var $last_name;
		var $user_picture;
		
		public function Profile()
		{
			parent::Control();
			//$this->no_auth();
			if(self::get_user_type() != $this->sess_userTYPE) { Control::redirect(SITE_URL); }
			$sql = "SELECT `user_name`,`first_name`,`last_name`,`user_picture` FROM ".PROFILE. " WHERE `user_id` = '".$this->sess_userID."'"; 
			$res = $this->db->query($sql);
			$data = $this->db->fetch_array($res);
			$this->user_name = $data['user_name'];
			$this->first_name = $data['firt_name'];
			$this->last_name = $data['last_name'];
			$this->user_picture = $data['user_picture'];
		}
		
		public function get_user_type()
		{
			$sql = "SELECT `user_type` FROM " .USER ." WHERE `user_id` = '".$this->sess_userID."'"; 
			$res = $this->db->query($sql);
			$data = $this->db->fetch_array($res);
			return trim($data['user_type']);
		}
		
		public function user_name()
		{
			return $this->user_name;
		}
		
		public function first_name()
		{
			return $this->first_name;
		}
		
		public function last_name()
		{
			return $this->last_name;
		}
		
		public function user_picture()
		{
			return $this->user_picture;
		}
		
		public function view_user_profile($id=false)
		{
			$sql = "SELECT * FROM ".PROFILE. " WHERE `user_id` = '".$id."'"; 
			$res = $this->db->query($sql);
			$data = $this->db->fetch_array($res);
			return $data;
		}
	}

?>