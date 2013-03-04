<?php
class db_mysql
{
	protected $conn_id;
	var $recent_link = null;
	var $sql = '';
	var $query_count = 0;
	var $error = '';
	var $errno = '';
	var $is_locked = false;
	var $show_errors = false;
	
	var $db_host = 'localhost';
	var $db_user = 'prabhu';
	var $db_pass = 'prabhu';
	var $db_name = 'ognale';


	function db_mysql()
	{
		$this->conn_id = @mysql_pconnect($this->db_host, $this->db_user, $this->db_pass,true);

		if ($this->conn_id)
		{
			mysql_set_charset("UTF8", $this->conn_id );
			if (@mysql_select_db($this->db_name, $this->conn_id))
			{
				$this->recent_link =& $this->conn_id;
				return $this->conn_id;
			}
			
			mysql_query("SET NAMES 'utf8'");
		}
		$this->raise_error("Could not select and/or connect to database: $db_name".mysql_error());
	}

	function query($sql, $only_first = false)
	{
		$this->recent_link =& $this->conn_id;
		$this->sql =& $sql;
		$result = @mysql_query($sql, $this->conn_id);

		$this->query_count++;

		if ($only_first)
		{
			$return = $this->fetch_assoc($result);
			$this->free_result($result);
			return $return;
		}
		return $result;
	}

	/**
	* Fetches a row from a query result and returns the values from that row as an array.
	*
	* @param  string  The query result we are dealing with.
	* @return array
	*/
	function fetch_array($result)
	{
		return @mysql_fetch_array($result);
	}
	
	function fetch_assoc($result)
	{
		return @mysql_fetch_assoc($result);
	}
	
	/**
	* Returns the number of rows in a result set.
	*
	* @param  string  The query result we are dealing with.
	* @return integer
	*/
	function num_rows($result)
	{
		return @mysql_num_rows($result);
	}

	/**
	* Retuns the number of rows affected by the most recent query
	*
	* @return integer
	*/
	function affected_rows()
	{
		return @mysql_affected_rows($this->recent_link);
	}

	/**
	* Returns the number of queries executed.
	*
	* @param  none
	* @return integer
	*/
	function num_queries()
	{
		return $this->query_count;
	}

	/**
	* Lock database tables
	*
	* @param   array  Array of table => lock type
	* @return  void
	*/
	function lock($tables)
	{
		if (is_array($tables) AND count($tables))
		{
			$sql = '';

			foreach ($tables AS $name => $type)
			{
				$sql .= (!empty($sql) ? ', ' : '') . "$name $type";
			}

			$this->query("LOCK TABLES $sql");
			$this->is_locked = true;
		}
	}

	/**
	* Unlock tables
	*/
	function unlock()
	{
		if ($this->is_locked)
		{
			$this->query("UNLOCK TABLES");
			$this->is_locked = false; 
		}
	}

	/**
	* Returns the ID of the most recently inserted item in an auto_increment field
	*
	* @return  integer
	*/
	function insert_id()
	{
		return @mysql_insert_id($this->conn_id);
	}

	/**
	* Escapes a value to make it safe for using in queries.
	*
	* @param  string  Value to be escaped
	* @param  bool    Do we need to escape this string for a LIKE statement?
	* @return string
	*/
	function prepare($value, $do_like = false)
	{
		$value = stripslashes($value);

		if ($do_like)
		{
			$value = str_replace(array('%', '_'), array('\%', '\_'), $value);
		}

		if(function_exists('mysql_real_escape_string'))
		{
			return mysql_real_escape_string($value, $this->conn_id);
		}
		else
		{
			return mysql_escape_string($value);
		}
	}

	/**
	* Frees memory associated with a query result.
	*
	* @param  string   The query result we are dealing with.
	* @return boolean
	*/
	function free_result($result)
	{
		return @mysql_free_result($result);
	}
	
	function fetch_row($result)
	{
		return @mysql_fetch_row($result);
	}

	/**
	* Turns database error reporting on
	*/
	function show_errors()
	{
		$this->show_errors = true;
	}

	/**
	* Turns database error reporting off
	*/
	function hide_errors()
	{
		$this->show_errors = false;
	}

	/**
	* Closes our connection to MySQL.
	*
	* @param  none
	* @return boolean
	*/
	function close()
	{
		$this->sql = '';
		return @mysql_close($this->conn_id);
	}

	/**
	* Returns the MySQL error message.
	*
	* @param  none
	* @return string
	*/
	function error()
	{
		$this->error = (is_null($this->recent_link)) ? '' : mysql_error($this->recent_link);
		return $this->error;
	}

	/**
	* Returns the MySQL error number.
	*
	* @param  none
	* @return string
	*/
	function errno()
	{
		$this->errno = (is_null($this->recent_link)) ? 0 : mysql_errno($this->recent_link);
		return $this->errno;
	}

	/**
	* Gets the url/path of where we are when a MySQL error occurs.
	*
	* @access private
	* @param  none
	* @return string
	*/
	function _get_error_path()
	{
		if ($_SERVER['REQUEST_URI'])
		{
			$errorpath = $_SERVER['REQUEST_URI'];
		}
		else
		{
			if ($_SERVER['PATH_INFO'])
			{
				$errorpath = $_SERVER['PATH_INFO'];
			}
			else
			{
				$errorpath = $_SERVER['PHP_SELF'];
			}

			if ($_SERVER['QUERY_STRING'])
			{
				$errorpath .= '?' . $_SERVER['QUERY_STRING'];
			}
		}

		if (($pos = strpos($errorpath, '?')) !== false)
		{
			$errorpath = urldecode(substr($errorpath, 0, $pos)) . substr($errorpath, $pos);
		}
		else
		{
			$errorpath = urldecode($errorpath);
		}
		return $_SERVER['HTTP_HOST'] . $errorpath;
	}

	/**
	* If there is a database error, the script will be stopped and an error message displayed.
	*
	* @param  string  The error message. If empty, one will be built with $this->sql.
	* @return string
	*/
	function raise_error($error_message = '')
	{
		if ($this->recent_link)
		{
			$this->error = $this->error($this->recent_link);
			$this->errno = $this->errno($this->recent_link);
		}

		if ($error_message == '')
		{
			$this->sql = "Error in SQL query:\n\n" . rtrim($this->sql) . ';';
			$error_message =& $this->sql;
		}
		else
		{
			$error_message = $error_message . ($this->sql != '' ? "\n\nSQL:" . rtrim($this->sql) . ';' : '');
		}

		$message = "<textarea rows=\"10\" cols=\"80\">MySQL Error:\n\n\n$error_message\n\nError: {$this->error}\nError #: {$this->errno}\nFilename: " . $this->_get_error_path() . "\n</textarea>";

		if (!$this->show_errors)
		{
			$message = "<!--\n\n$message\n\n-->";
		}
		die("There seems to have been a slight problem with our database, please try again later.<br /><br />\n$message");
	}
}


?>