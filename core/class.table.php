<?php
require_once('class.sql.php');
class myTable extends db_mysql
{
	public $table;
	public $fields;	
	public $lastRecord;
	public $datas;
	public $action;
	public $groupby;
	public $orderby;
	public $limit;

	function count_rows($table,$where='',$selector='')
	{
		if(empty($selector)) $selector='*';
		$q = $this->query("SELECT $selector FROM $table WHERE $where") or die($this->error());
		return $this->num_rows($q);
	}
	
	function insert($table, $datas, $lastID=false)
	{
		$str = "";
		$rep = "";
		if(is_array($datas))
		{
			foreach($datas as $field => $data)
			{
				$str .= "`" . $field . "`,";
				$rep .= "'" . $data . "',";
			}
			$str = rtrim($str,',');
			$rep = rtrim($rep,',');
			
			$this->lastResult = $this->query("INSERT INTO " . $table . " (".$str.") VALUES (".$rep.")") or die($this->error());
		}		
		if($this->lastResult)
		{
			if($lastID)
			{
				return $this->insert_id();
			}
			else
			{
				return true;
			}
		}
		else
		{
			return false;
		}
	}
	
	function update($table,$set,$where)
	{
		$str = "";
		if(is_array($set))
		{
			foreach($set as $field => $data)
			{
				$str .= "`$field`='$data',";
			}
			$str = rtrim($str,',');
			$sql = "UPDATE " .$table. " SET " . $str . " WHERE " . $where;
			$lastResult = $this->query($sql) or die($this->error());
			return $lastResult;
		}
		else
		{
			return false;
		}
	}
	
	function delete($table,$where)
	{
		$sql = "DELETE FROM " . $table . " WHERE " . $where;
		$lastResult = $this->query($sql) or die($this->error());
		return $lastResult;
	}
	
	function get_fieldval($table,$retfield,$where) 
	{
		$lastResult = $this->query("SELECT $retfield FROM $table WHERE $where");
		if($this->num_rows($lastResult) <> 0)
		{
			$row=$this->fetch_array($lastResult);
			return trim($row[0]);
		}
		else
		{
			return false;
		}
	}
}
?>