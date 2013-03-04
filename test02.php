<?php 


	class Ognale
	{
		var $name = '';

		function html_out()
		{
			return "Ognale Software";	
		}
		
		function print_name($name)
		{
			$render = "My office Name is : ".$name;
			//$render .= "My name :: ".$this->name1;
			return $render;
		}
		
		function my_name()
		{
			return "Prabhu";	
		}	
	}
	
	$out = new Ognale; // object convert
	
	 echo  $out->print_name('Ognale');
	
	
	
	