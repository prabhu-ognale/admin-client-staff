<?php
class Functions
{
	function sanitize($var, $santype=1, $allowable_tags='')
	{
		if (get_magic_quotes_gpc()) 
		{
			$var = stripslashes($var);
		}
		
		if($santype==1)     {return trim(strip_tags($var, $allowable_tags = ''));}
    	elseif($santype==2) {return htmlentities(strip_tags($var, $allowable_tags),ENT_QUOTES,'UTF-8');}
		elseif($santype==3) {return trim(addslashes(strip_tags($var, $allowable_tags)));}
		elseif($santype==4) {return trim($var);}
		elseif($santype==5) {return preg_replace('/\son\w+\s*=/is','',$var);}
		elseif($santype==6) {return strtolower(ereg_replace('[^A-Za-z0-9]','',$var));}
		elseif($santype==7) {return trim(stripslashes(strip_tags($var, $allowable_tags)));}
		elseif($santype==8) {return mysql_escape_string(stripslashes(trim($var)));}
		elseif($santype==9) {return trim(stripslashes(strip_tags($var, $allowable_tags)));}
		elseif($santype==10){return trim(urldecode($var));}
		else{return $var;}
	}
	function cur_url() 
	{
		$pageURL = 'http';
 		if ($_SERVER["HTTPS"] == "on") {$pageURL .= "s";}
 		$pageURL .= "://";
		if ($_SERVER["SERVER_PORT"] != "80") 
		{
			$pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
		}
    	else 
		{
			$pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
		}
 		return $pageURL;
	}
	
	function routing_uri()
	{
		$requestURI = rtrim($_SERVER['REQUEST_URI'],'/');
		$requestURI = explode('/', $requestURI );
		$scriptName = explode('/', $_SERVER['SCRIPT_NAME']);
		for($i= 0;$i < sizeof($scriptName);$i++)
		{
			if ($requestURI[$i]== $scriptName[$i])
			{
				unset($requestURI[$i]);
			}
		}
		$command = array_values($requestURI);
		return $command;
	}
	
	function get($var)
	{
		$response=false;
		$string = end($this->routing_uri());
		$query  = explode('?',$string);
		if(count($query)<=1)
		{
			$response=false;
		}
		else
		{
			$q  = $query[1];
			$qq = explode('&',$q);
			foreach($qq as $v)
			{
				$cc=explode('=',$v);
				if($var == '')
				{					
					$response[$cc[0]] = $cc[1];					
				}
				else
				{
					if($var==$cc[0])
					{
						$response = $cc[1];
					}
				}
			}
		}
		return $response;
	}
	
	function month_format($month)
	{
		$mon=array();
		$mon['01'] = 'January';
		$mon['02'] = 'February';
		$mon['03'] = 'March';
		$mon['04'] = 'April';
		$mon['05'] = 'May';
		$mon['06'] = 'June';
		$mon['07'] = 'July';
		$mon['08'] = 'August';
		$mon['09'] = 'September';
		$mon['10'] = 'October';
		$mon['11'] = 'November';
		$mon['12'] = 'December';
		$month = strtr($month,$mon);
		return $month;
	}
	
	function format_filesize($bytes, $precision = 2) 
	{
    	$units = array('B', 'KB', 'MB', 'GB', 'TB');
    	$bytes = max($bytes, 0);
    	$pow = floor(($bytes ? log($bytes) : 0) / log(1024));
    	$pow = min($pow, count($units) - 1);
    	$bytes /= pow(1024, $pow);  
    	return round($bytes, $precision) . ' ' . $units[$pow];
	}
	
	function csv2array($file,$delimiter,$key=array())
	{
		$handle = fopen($file, "r");
		if($handle !== FALSE) 
		{
			$i=0;
			while(($lineArray = fgetcsv($handle, 5000, $delimiter)) !== FALSE) 
			{
				for ($j=0; $j<count($lineArray); $j++)
				{
					$data2DArray[$i][$key[$j]] = $this->sanitize($lineArray[$j],8);
				}
				$i++;
			}
			fclose($handle);
		}
		 return $data2DArray;
	}
	
	function temp_password($length)
	{
		$alfa = "1234567890qwertyuiopasdfghjklzxcvbnmQWERTYUIOPASDFGHJKLZXCVBNM";
		$token = '';
		for($i=0; $i < $length; $i++)
		{
			$token .= $alfa[rand(0, strlen($alfa))];
		}
		return $token;
	}
	
	function truncate($str,$maxlength=30,$separator='.....')
	{
		$separatorlength = strlen($separator);
		$maxlength = $maxlength - $separatorlength;
		$start = ceil($maxlength / 2);
		$trunc =  strlen($str) - $maxlength;
		return substr_replace($str, $separator, $start, $trunc);
	}
	
	function mask($str, $start = 0, $length = null) 
	{
        $mask = preg_replace ( "/\S/", "*", $str );
        if(is_null($length))
		{
            $mask = substr ( $mask, $start );
            $str = substr_replace ( $str, $mask, $start );
        } 
		else 
		{
            $mask = substr ( $mask, $start, $length );
            $str = substr_replace ( $str, $mask, $start, $length );
        }
        return $str;
    }
	
	function hash_value($data,$key)
	{
		$hash = hash_hmac('sha512',$data,$key);
		return md5($hash);
	}
	
	function force_download($file)
	{
		set_time_limit(0);
		if(file_exists($file))
		{
			$size = intval(sprintf("%u", filesize($file)));
			header("Content-Description: File Transfer");
			header("Content-type: application/force-download");
    		header("Content-Type: application/octet-stream");
    		header("Content-Disposition: attachment; filename=".basename($file));
    		header("Content-Transfer-Encoding: binary");
    		header('Expires: 0');
    		header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
    		header('Pragma: public');
    		header('Content-Length: ' . $size);
			ob_clean();
    		flush();
			@readfile($file);
    		exit;
		}
		else
		{
			return false;
		}
	}
	
	function generate_code($var,$length,$ext=false)
	{
		$use_chars = "AE5UYB3DGH4Y1JL8MKNPQ6FRS2TVW7XZ9";
		$trackID = $use_chars{mt_rand(0,34)};
		$rand = rand(1,$length);
		for($i=1; $i <= $length; $i++)
		{
			if($rand==$i){$trackID .= $var;}
			$trackID .= $use_chars{mt_rand(0,29)};
		}
		return $trackID;
	}
	
	function pagination($page,$limit,$total,$link,$adjacents=2)
	{
		$response = false;
		$prev = $page - 1;
		$next = $page + 1;
		$lastpage = ceil($total/$limit);
		$lpm1 = $lastpage - 1;
		if($lastpage > 1)
		{
			$response .= '<ul class="pagination-clean">';
			if($page > 1)
			{
				$response .= '<li class="previous"><a href="'.str_replace('*page*',$prev,$link).'">&laquo;Prev</a></li>';
			}
			else
			{
				$response .= '<li class="previous-off">&laquo;Prev</li>';
			}
			
			if($lastpage < 7 + ($adjacents * 2))
			{
				for($i=1; $i <= $lastpage; $i++)
				{
					if($i == $page)
					{
						$response .= '<li class="active">'.$i.'</li>';
					}
					else
					{
						$response .= '<li><a href="'.str_replace('*page*',$i,$link).'">'.$i.'</a></li>';
					}
				}
			}
			elseif($lastpage > 5 + ($adjacents * 2))
			{
				if($page < 1 + ($adjacents * 2))
				{
					for ($i=1; $i < 4 + ($adjacents * 2); $i++)
					{
						if($i == $page)
						{
							$response .= '<li class="active">'.$i.'</li>';
						}
						else
						{
							$response .= '<li><a href="'.str_replace('*page*',$i,$link).'">'.$i.'</a></li>';
						}
					}
					$response .= '<li class="active">...</li>';
					$response .= '<li><a href="'.str_replace('*page*',$lpm1,$link).'">'.$lpm1.'</a></li>';
					$response .= '<li><a href="'.str_replace('*page*',$lastpage,$link).'">'.$lastpage.'</a></li>';
				}
				elseif($lastpage - ($adjacents * 2) > $page && $page > ($adjacents * 2))
				{
					$response.= '<li><a href="'.str_replace('*page*','1',$link).'">1</a></li>';
					$response.= '<li><a href="'.str_replace('*page*','2',$link).'">2</a></li>';
					$response.= '<li class="active">...</li>';
					for ($i = $page - $adjacents; $i <= $page + $adjacents; $i++)
					{
						if($i == $page)
						{
							$response .= '<li class="active">'.$i.'</li>';
						}
						else
						{
							$response .= '<li><a href="'.str_replace('*page*',$i,$link).'">'.$i.'</a></li>';
						}
					}
					$response .= '<li class="active">...</li>';
					$response .= '<li><a href="'.str_replace('*page*',$lpml,$link).'">'.$lpm1.'</a></li>';
					$response .= '<li><a href="'.str_replace('*page*',$lastpage,$link).'">'.$lastpage.'</a></li>';
				}
				else
				{
					$response .= '<li><a href="'.str_replace('*page*','1',$link).'">1</a></li>';
					$response .= '<li><a href="'.str_replace('*page*','2',$link).'">2</a></li>';
					$response .= '<li class="active">...</li>';
					for ($i = $lastpage - (2 + ($adjacents * 2)); $i <= $lastpage; $i++)
					{
						if($i==$page)
						{
							$response .= '<li class="active">'.$i.'</li>';
						}
						else
						{
							$response .= '<li><a href="'.str_replace('*page*',$i,$link).'">'.$i.'</a></li>';
						}
					}
				}
			}
			
			if($page < $i-1)
			{
				$response .= '<li class="next"><a href="'.str_replace('*page*',$next,$link).'">Next &raquo;</a></li>';
			}
			else
			{
				$response .= '<li class="next-off">Next &raquo;</li>';
			}
			$response .= '</ul><span></span>';
		}
		return $response;
	}
	
	function pagination2($page,$limit,$total,$adjacents=2)
	{
		$response = "";
		$prev = $page - 1;
		$next = $page + 1;
		$lastpage = ceil($total/$limit);
		$lpm1 = $lastpage - 1;
		if($lastpage > 1)
		{
			$response .= '<div id="tnt_pagination">';
			$response .= '<span id="loading-bottom"></span>';
			if($page > 1)
			{
				$response .= '<a id="?p='.$prev.'">Prev</a>';
			}
			else
			{
				$response .= '<span class="disabled_tnt_pagination">Prev</span>';
			}
			
			if($lastpage < 7 + ($adjacents * 2))
			{
				for($i=1; $i <= $lastpage; $i++)
				{
					if($i == $page)
					{
						$response .= '<span class="active_tnt_link">'.$i.'</span>';
					}
					else
					{
						$response .= '<a href="?p='.$i.'">'.$i.'</a>';
					}
				}
			}
			elseif($lastpage > 5 + ($adjacents * 2))
			{
				if($page < 1 + ($adjacents * 2))
				{
					for ($i=1; $i < 4 + ($adjacents * 2); $i++)
					{
						if($i == $page)
						{
							$response .= '<span class="active_tnt_link">'.$i.'</span>';
						}
						else
						{
							$response .= '<a href="?p='.$i.'">'.$i.'</a>';
						}
					}
					$response .= '<span class="active_tnt_link">...</span>';
					$response .= '<a href="?p='.$lpm1.'">'.$lpm1.'</a></li>';
					$response .= '<a href="?p='.$lastpage.'">'.$lastpage.'</a>';
				}
				elseif($lastpage - ($adjacents * 2) > $page && $page > ($adjacents * 2))
				{
					$response.= '<a href="?p=1">1</a>';
					$response.= '<a href="?p=2">2</a>';
					$response.= '<span class="active_tnt_link">...</span>';
					for ($i = $page - $adjacents; $i <= $page + $adjacents; $i++)
					{
						if($i == $page)
						{
							$response .= '<span class="active_tnt_link">'.$i.'</span>';
						}
						else
						{
							$response .= '<a href="?p='.$i.'">'.$i.'</a>';
						}
					}
					$response .= '<span class="active_tnt_link">...</span>';
					$response .= '<a href="?p='.$lpm1.'">'.$lpm1.'</a>';
					$response .= '<a href="?p='.$lastpage.'">'.$lastpage.'</a>';
				}
				else
				{
					$response .= '<a href="?p=1">1</a>';
					$response .= '<a href="?p=2">2</a>';
					$response .= '<span class="active_tnt_link">...</span>';
					for ($i = $lastpage - (2 + ($adjacents * 2)); $i <= $lastpage; $i++)
					{
						if($i==$page)
						{
							$response .= '<span class="active_tnt_link">'.$i.'</span>';
						}
						else
						{
							$response .= '<a href="?p='.$i.'">'.$i.'</a>';
						}
					}
				}
			}
			
			if($page < $i-1)
			{
				$response .= '<a href="?p='.$next.'">Next</a>';
			}
			else
			{
				$response .= '<span class="disabled_tnt_pagination">Next</span>';
			}
			$response .= '</div>';
		}
		return $response;
	}
	
	
	
	function makeday($int,$unit='day',$format=false)
	{
		$units=array("year"=>29030400,"month"=>2419200,"week"=>604800,"day"=>86400,"hour"=>3600,"minute" => 60, "second"=>1);
		$response = time() + ($int * $units[$unit]);
		if($format)
		{
			switch($format)
			{
				case'sql':
				$response = date("YmdHis",$response);
				break;
			}
		}
		return $response;
	}
	
	function req($var,$type='')
	{
		return $_GET[$var];
	}
	
	function json_array($json)
	{
		$a = json_decode(get_magic_quotes_gpc()? stripslashes($json): $json,true);
		return $a;
	}
	function create_dir($path)
	{
		$sPath = $path;
		if(!file_exists($sPath))
		{
			@mkdir($sPath, 0777, true);
			@chmod($sPath, 0777);
			return $sPath;
		}
		else
		{
			return $sPath;
		}
	}
	
	function convertcash($num, $currency)
	{
		if(strlen($num)>3)
		{
            $lastthree = substr($num, strlen($num)-3, strlen($num));
            $restunits = substr($num, 0, strlen($num)-3); 
            $restunits = (strlen($restunits)%2 == 1)?"0".$restunits:$restunits;
            $expunit = str_split($restunits, 2);
            for($i=0; $i<sizeof($expunit); $i++)
			{
                $explrestunits .= (int)$expunit[$i].",";
            }
            $thecash = $explrestunits.$lastthree;
    	} 
		else 
		{
           $thecash = $num;
    	}   
   		return $currency.$thecash;
	}
	
	function rrmdir($dir)
	{
		if (is_dir($dir)) 
		{
			$objects = scandir($dir);
			foreach ($objects as $object) 
			{
				if ($object != "." && $object != "..") 
				{
					if (filetype($dir."/".$object) == "dir") $this->rrmdir($dir."/".$object); else unlink($dir."/".$object);
       			}
     		}
     		reset($objects);
     		rmdir($dir);
   		}
 	} 
}