<?php 

	class Login extends Control
	{
		public function Login()
		{
			parent::Control();
			$this->table = USER;
		}
		
		function login_auth($username,$pwd)
		{
			$response=array();
			$sql = "SELECT `user_id`,`user_name`,`password`,`user_level`,`user_type` FROM " . $this->table . " WHERE `user_name` = '$username'";
			$datas = $this->db->query($sql,true);
			if($datas)
			{
				if($datas['password']!==$pwd)
				{
					$response['ok']  = false;
					$response['code'] = 'invalid-password';
					$response['msg'] = 'Invalid Password. Please try again...'.$datas['password'].$pwd;
				}
				elseif($datas['user_level']===0)
				{
					$response['ok']  = false;
					$response['code'] = 'account-suspended';
					$response['msg'] = 'This account suspended by Admin. Please contact';
				}
				else
				{
					$_SESSION['sess_userID']   = $datas['user_id'];
					$_SESSION['sess_userTYPE'] = $datas['user_type'];
					$_SESSION['sess_userNAME'] = $datas['user_name'];
					//$upt=array('is_online'=>'1');
					//$update = $this->db->update($this->table ,$upt,"user_id=" . $datas['user_id']);
					$response['ok'] =true;
					$response['code'] = 'success';
					$response['msg']  = 'Successfully logged. Please wait...';
					$response['location'] = SITE_URL.'/'.$datas['user_type'].'/home/index.php';
				}
			}
			else
			{
				$response['ok']  = false;
				$response['code'] = 'invalid-username';
				$response['msg']  = 'Invalid username [or] Password. Please try again...';
			}
			return json_encode($response);
		}
		
		function ajax_logout()
		{
			$response=array();
			//if($this->sess_userID <>0)
			//{
				//$upt=array('is_online'=>'0');
				//$update = $this->db->update(ADM,$upt,"adm_id=" . $this->sess_admid);			
				session_destroy();
				$response['ok'] = true;
				$response['code'] = 'success';
				$response['location'] = SITE_URL;
			//}
			return json_encode($response);
		}
	}

?>