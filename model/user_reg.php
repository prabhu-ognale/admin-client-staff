<?php 

	class User_Reg extends Control
	{
		public function User_Reg()
		{
			parent::Control();
		}
		
		public function user_form($id=false)
		{
			$val['firstname'] = '';
			$val['lastname'] = '';
			$val['email'] = '';
			$val['username']  = '';
			$val['user_type'] = '';
			if($id <> 0)
			{
					
			}
		}
		
		public function add_edit_user($data)
		{
			$response = array();
			if($this->sess_userTYPE === 'admin')
			{
				if(self::check_user_name($data['user_name']) === false)
				{
					$user_details['user_name'] =$data['user_name'];
					$user_details['mail_id'] = $data['email'];
					$user_details['password'] = md5($data['password']);
					$user_details['user_type'] = $data['user_type'];
					$user_details['user_level'] = 1;
					$user_details['active_by'] = $this->sess_userNAME;
					
					
					$user_detail_insert = $this->db->insert(USER,$user_details,true) or die($this->error());
					
					if($user_detail_insert)
					{
						$user_profile['user_id'] = $this->db->insert_id();
						$user_profile['first_name'] = $data['firstname'];
						$user_profile['last_name'] = $data['lastname'];
						$user_profile['user_name'] = $data['user_name'];
						$user_profile['mail_id'] = $data['email'];
						$user_profile['join_date'] = date('d-m-Y');
						
						$user_profile_insert = $this->db->insert(PROFILE,$user_profile,true);
						
						$response['ok'] = true;
						$response['code'] = 'success';
						$response['msg'] = 'User Add Success Fully..!';
						$response['location'] = SITE_URL.'/admin/user/list.php';
					}
					else
					{
						$response['ok'] = false;
						$response['code'] = 'faild';
						$response['msg'] = $this->db->error(); //'User Add Success Fully..!';
						//$response['location'] = SITE_URL.'/admin/user/addnew.php';
					}
				}
				else
				{
					$response['ok'] = false;
					$response['code'] = 'faild';
					$response['msg'] = 'User Name already exists..!'.self::check_user_name($username);
				}
			}
			return json_encode($response);
		}
		
		public function check_user_name($username=false)
		{
			$sql = " SELECT `user_name` FROM ".USER. " WHERE `user_name` = '".$username."' ";
			$res = $this->db->query($sql);
			$num_rows = $this->db->num_rows($res);
			$data = $this->db->fetch_array($res);
			if($num_rows <> 0)
			{
				if($data['user_name'] == $username)
				{
					return true;	
				}
				else
				{
					return false;	
				}	
			}
			else
			{
				return false;	
			}
		}
		
		public function get_type_list($selected=false) // Get Parent Category
		{
				$sql = "SELECT * FROM ". USER_LEVEL ;
				$res = $this->db->query($sql); //   or die('Error'.$this->db->error());
				$rows = $this->db->num_rows($res);
				if($rows <> 0)
				{
					$ans = "<select name='user_type' id='user_type' class='span6' style='width: 200px;'>";
					$ans .= "<option value='0'>select</option>";
					while($datas = $this->db->fetch_array($res))
					{
						$sel = '';
						if($selected == $datas['id'])
						{
							$sel = 'selected="selected"';
						}
						$ans .= "<option value='".$datas['cat_id']."' ".$sel." >".$datas['level']."</option>";
					}
					$ans .= "</select>";
				}
				else
				{
					$ans .= 'No - Data';	
				}	
				return $ans;
		}
		
		public function list_user()
		{
			$sql = "SELECT * FROM ".USER. " ORDER BY `user_id`  DESC";
			$res = $this->db->query($sql);
			$row = $this->num_rows($res);
			
			$i = 1;
			while($data = $this->db->fetch_array($res))
			{
				$val['i'] = $i;
				$val['user_name'] = $data['user_name'];
				$val['mail_id'] = $data['mail_id'];
				$val['user_type'] = $data['user_type'];
				$out .= self::list_user_html($val);	
				$i= $i+1;
			}
			return $out;
		}
		
		public function list_user_html($data)
		{
			$out = '<tr>
					  <td>'.$data['i'].'</td>
					  <td>'.$data['user_name'].'</td>
					  <td>'.$data['mail_id'].'</td>
					  <td>'.$data['user_type'].'</td>
					  <td>
						  <a href="user.html"><i class="icon-pencil"></i></a>
						  <a href="user.html"><i class="icon-eye-close"></i></a>
						  <a href="#myModal" role="button" data-toggle="modal"><i class="icon-remove"></i></a>
					  </td>
					</tr>';	
			return $out;
		}
	}

?>