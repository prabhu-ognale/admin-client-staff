<?php 

	class Client extends Control
	{
		public function Client()
		{
			parent::Control();
		}
		
		public function client_form($id=false)
		{
			$val['id'] = 0;
			$val['company_name'] = '';
			$val['contact_person'] = '';
			$val['mail_id'] = '';
			$val['mobile_no'] = '';
			$val['webaddress'] = ''
			$val['status'] = '0'
			if($id)
			{
				$sql = "SELECT * FROM ".CLIENT. " WHERE `id`='".$id."' ";
				$data = $this->db->fetch_array($sql);
				$val['id'] = 0;
				$val['company_name'] = $data['id'];
				$val['contact_person'] = '';
				$val['mail_id'] = '';
				$val['mobile_no'] = '';
				$val['webaddress'] = ''
				$val['status'] = '0'
			}
		}
		
		public function add_edit_client($data)
		{
			$response = array();
			$response['ok'] = true;
			$response['msg'] = "Client Add Success Fully";
			return json_encode($response);
		}
		
		public function list_clients()
		{
		
		}
		
		public function view_client($id=false)
		{
		
		}
		
	}

?>