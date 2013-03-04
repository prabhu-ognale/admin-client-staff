<?php 

	class Project extends Control
	{
		public function Project()
		{
			parent::Control();
		}
		
		public function project_form($id=false)
		{
			$val['id'] = 0;
			$val['project_name'] = '';
			$val['client_id'] = '';
			$val['description'] = '';
			$val['domain_name'] = '';
			$val['domain_details'] = '';
		}
		
		public function add_edit_project($data)
		{
			$response = array();
			
			$val['id'] = $data['id'];
			$val['project_name'] = $data['project_name'];
			$val['client_id'] = $data['client_name'];
			$val['project_details'] = $data['description'];
			$val['domain_name'] = $data['domain_name'];
			$val['domain_details'] = $data['domain_details'];
			
			if($val['id'] == 0)
			{
				$insert = $this->db->insert(PROJECT_DETAILS,$val,true);
				if($insert)
				{
					$response['ok'] = true;
					$response['msg'] = "Project Post Success Fully";
					$response['location'] = SITE_URL.'/admin/project/addnew.php';
				}	
			}
			return json_encode($response);
		}
		
		public function list_project()
		{
			$sql = "SELECT * FROM ".PROJECT;
			if($this->sess_userTYPE == 'admin')
			{
				$sql .= " ORDER BY `id` DESC";
			}
			elseif($this->sess_userTYPE == 'client')
			{
				$sql .= " WHERE `client_id` = '".$this->sess_userID."' " ;
			}
			elseif($this->sess_userTYPE == 'staffs')
			{
				$sql .= " WHERE `status` = 1 ORDER BY `id` DESC";
			}
			
			$res = $this->db->query($sql);
			$rows = $this->db->num_rows($res);
			if($rows <> 0)
			{
				$data	
			}
		}
		
		public function view_project($id=false)
		{
		
		}
		
		public function assasign_project($id=false)
		{
		
		}
		
		public function project_report()
		{
			
		}
		
	}

?>