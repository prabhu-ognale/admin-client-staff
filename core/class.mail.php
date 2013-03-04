<?php
require_once(LIBS_DOC_PATH . '/class.phpmailer.php');
class PHPmail extends PHPMailer
{
	public $sendmail;
	
	function replace_body($body, $data)
	{
		foreach ($data as $key => $value)
		{
			$body = str_replace('#'.$key.'#', $value, $body);
		}
		return $body;
	}
	
	function smtp_mail($from=array(),$to=array(),$subject,$body,$replace=false,$attachment=false)
	{
		$response = array();
		$to_add    = $to['address'];
		$to_name   = $to['name'];
		$from_add  = $from['address'];
		$from_name = $from['name'];
		if($replace)
		{
			$body = $this->replace_body($body,$replace);
		}
		$this->sendmail = new PHPMailer(true);
		$this->sendmail->IsSMTP();
		try
		{
			 $this->sendmail->Host       = "ssl://smtp.gmail.com"; 
  			 $this->sendmail->SMTPDebug  = 1;                    
  			 $this->sendmail->SMTPAuth   = true;
			 $this->sendmail->SMTPSecure = "ssl"; 
  			 $this->sendmail->Port       = 465;                   
 			 $this->sendmail->Username   = "tamilofun@gmail.com"; 
  			 $this->sendmail->Password   = "bagavathi";       

  			 $this->sendmail->AddAddress($to_add, $to_name);
  			 $this->sendmail->SetFrom($from_add, $from_name);
 			 $this->sendmail->AddReplyTo($from_add, $from_name);
			 $this->sendmail->IsHTML(true);
  			 $this->sendmail->Subject = $subject;
  			 $this->sendmail->AltBody = 'To view the message, please use an HTML compatible email viewer!';
  			 $this->sendmail->MsgHTML($body);
  			 $this->sendmail->Send();
			 $response = array('ok'=> true, 
							   'msg'=>'success');
		}
		catch(phpmailerException $e)
		{
			$response = array('ok'=> false, 
							  'msg'=>$e->errorMessage());
		}
		catch(Exception $e)
		{
			$response = array('ok'=> false, 
							  'msg'=>$e->getMessage());
		}
		return $response;
	}
}
?>