<?php
class Html 
{
	
	function error500()
	{
		$content .= '<div id="xxx" align="center"><img alt="404" src="'.THEME_BASE_PATH.'/img/x.png"></div>';
		$content .= '<div id="errorcode">ERROR 500 - Internal Server Error</div>';
		$content .= '<div align="center" style="padding:20px; line-height:22px;">The server encountered an internal error or misconfiguration and was unable to complete your request...  Please contact the server administrator.</div>';
		$content .= '<div id="getstarted"><a href="'.SITE_URL.'/contact/index.html">CONTACT US</a></div>';
		return $content;
	}
	
	function html_li($datas,$opt=false)
	{
		if($datas==='close')
		{
			$li = '</li>';
		}
		else
		{
			if(!is_array($datas)){$datas = array('value'=> $datas);}
			$li = '<li';
			foreach ($datas as $k => $v)
			{
				if($k != 'value')
				{
					$li .= " $k=\"$v\" ";
				}
			}		
			if($opt==='open')
			{
				$li .= '>'; $li .= $datas['value'];
			}
			else
			{			
				$li .= '>'; $li .= $datas['value'];	$li .= '</li>';
			}
		}
		return $li;
	}
	
	private function html_img($src = '', $index_page = FALSE)
	{
		if (! is_array($src)){$src = array('src' => $src);}
		$img = '<img';
		foreach ($src as $k=>$v)
		{
			/*if($k == 'src' AND strpos($v, '://') === FALSE)
			{
				if ($index_page === TRUE)
				{$img .= ' src="'.site_url.$v.'" ';}
				else
				{$img .= ' src="'.base_url.$v.'" ';}
			}
			else
			{$img .= " $k=\"$v\" ";}*/
			$img .= " $k=\"$v\" ";
		}
		$img .= '/>';
		return $img;
	}
	
	private function html_em($datas='',$opt=false)
	{
		if($datas==='close')
		{
			$em = '</em>';
		}
		else
		{
			if(!is_array($datas)){$datas = array('value'=> $datas);}
			$em = '<em';
			foreach ($datas as $k => $v)
			{
				if($k != 'value')
				{
					$em .= " $k=\"$v\" ";
				}
			}		
			if($opt==='open')
			{
				$em .= '>'; $em .= $datas['value'];
			}
			else
			{			
				$em .= '>'; $em .= $datas['value'];	$em .= '</em>';
			}
		}
		return $em;
	}
	
	private function html_div($datas='',$opt=false)
	{
		if($datas==='close')
		{
			$div = '</div>';
		}
		else
		{
			if(!is_array($datas)){$datas = array('value'=> $datas);}
			$div = '<div';
			foreach ($datas as $k => $v)
			{
				if($k != 'value')
				{
					$div .= " $k=\"$v\" ";
				}
			}		
			if($opt==='open')
			{
				$div .= '>'; $div .= $datas['value'];
			}
			else
			{			
				$div .= '>'; $div .= $datas['value'];	$div .= '</div>';
			}
		}
		return $div;
	}
	
	function html_tag($tag,$datas,$opt=false)
	{
		switch($tag)
		{
			case 'img':	$html = $this->html_img($datas,$opt);
			break;
			case 'em':  $html = $this->html_em($datas,$opt);
			break;
			case 'div':  $html = $this->html_div($datas,$opt);
			break;
			case 'li':  $html = $this->html_li($datas,$opt);
			break;	
		}		
		return $html;
	}
	
	
	
	function pagination_form1($data)
	{		
		$content = '';
		if(is_array($data))
		{
			$content  = '<form method="post" action="javascript:void(0)" id="pagination_form">';
			foreach ($data as $key => $inp)
			{
				$content .= '<input type="hidden" name="'.$key.'" id="'.$key.'" value="'.$inp.'" />';
			}
			$content .= '</form>';
		}
		return $content;
	}
	
	function pagination_form($data)
	{		
		$content = '';
		if(is_array($data))
		{
			//$content  = '<form method="post" action="javascript:void(0)" id="pagination_form">';
			foreach ($data as $key => $inp)
			{
				$content .= "<a href='?p=".$inp."'>".$inp."</a>";
				//$content .= '<input type="hidden" name="'.$key.'" id="'.$key.'" value="'.$inp.'" />';
			}
			//$content .= '</form>';
		}
		return $content;
	}
}
$html = new Html;
?>