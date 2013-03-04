<?php 

	class Message extends Control
	{
		public function Message()
		{
			parent::Control();
		}
		
		public function message_form($id=false)
		{
			$val['id'] = 0;
			$val['sender_type_id'] = '';
			$val['reciver_type_id'] = '';
			$val['sender_id'] = '';
			$val['reciver_id'] = '';
			$val['content'] = '';
			$val['status'] = 0;
			
			return $val;
		}
		
		public function send_msg($data)
		{
			$response = array();
			$val['sender_type_id'] = $this->sess_userTYPE;
			$val['receiver_type_id'] = 'admin';
			$val['sender_id'] = $this->sess_userID ;
			$val['receiver_id'] = 1009;
			$val['content'] = $data['description'];
			$val['status'] = 0;
			
			$insert = $this->db->insert(MESSAGE,$val,true);
			if($insert)
			{
				$response['ok'] = true;
				$response['msg'] = "Success";
			}
			else
			{
				$response['ok'] = false;
				$response['msg'] = $this->db->error();	
			}
			
			return json_encode($response);
		}
		
		public function list_message()
		{
			$sql = "SELECT * FROM ".MESSAGE." ORDER BY `id` DESC";
			$res = $this->db->query($sql);
			$row = $this->db->num_rows($res);
			$i = 1;
			if($row <> 0)
			{
				while($data = $this->db->fetch_array($res))
				{
					$val['id'] = $data['id'];
					$val['i'] = $i;
					$val['sender'] = $data['sender_type_id'];
					$val['receiver'] = $data['receiver_type_id'];
					$val['sender_id'] = $data['sender_id'];
					$val['recevier_id'] = $data['recevier_id'];
					$val['content'] = $data['content'];
					$val['receive_time'] = $data['receive_time'];
					$val['status'] = $data['status'];	
					$out .= self::list_msg_html($val);
					$i = $i+1;		
				}
			}
			return $out;
		}
		
		public function list_msg_html($data)
		{
			$out = ' <tr>
					  <td>'.$data['i'].'</td>
					  <td>'.$data['sender'].'</td>
					  <td><a href="'.SITE_URL.'/'.$this->sess_userTYPE.'/message/view.php?id='.$data['id'].'">'.$data['content'].'</a></td>
					  <td>'.$data['receive_time'].'</td>
					  <td>
						  <a href="#"> <i class="icon-eye-close"></i> </a>
						  <a href="#"><i class="icon-remove"></i></a>
					  </td>
					</tr>';
			return $out;
		}
		
		public function view_msg($id=false)
		{
			$val = array();
			$sql = "SELECT 
						t1.sender_type_id,
						t1.receiver_type_id,
						t1.sender_id,
						t1.content,
						t1.receive_time,
						t2.user_name AS name
					FROM ".MESSAGE. " t1
					LEFT JOIN ".USER." t2 ON t1.sender_id = t2.user_id 
					WHERE t1.id='$id'";
					
			$res = $this->db->query($sql) or die($this->db->error());
			$data = $this->db->fetch_array($res); // or die($this->db->error());
			if($this->sess_userTYPE == $data['receiver_type_id'] )
			{
				$val['id'] = $data['id'];
				$val['sender_name'] = $data['name'];
				$val['sender_type_id'] = $data['sender_type_id'];
				$val['receiver_type_id'] = $data['receiver_type_id'];
				$val['sender_id'] = $data['sender_id'];
				$val['content'] = $data['content'];
				$val['receive_time'] = $data['receive_time'];
				
				$upt = array('open_ttime'=>date('Y-m-d H:i:s'),'status'=>1);
				$update = $this->db->update(MESSAGE,$upt, '`id`='.$id);
			}
			else
			{
				$val['content'] = "Please Login Again .. (or) Message Cann't Be Display ";	
			}
			
			return $val;	
		}
		
	}

?>