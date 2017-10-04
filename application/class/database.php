<?php
require_once(__DIR__."/../config/configuration_variable.php");
require_once(__DIR__."/log.php");
/** This class serves database connection
*
* @author  Adiluck Chooprateep
* @since   4/10/2017
*/
class Database
{
	private $connection;
	private $log;
	public $connected;
	function __construct()
	{
		global $DATABASE;
		$this->log = new Log();
    $this->connection  = new mysqli($DATABASE['HOST'], $DATABASE['USERNAME'], $DATABASE['PASSWORD'],$DATABASE['NAME']);
	    if ($this->connection->connect_error)
	    {
	    	$this->log->Write("Connection to database failed: " . $this->connection->connect_error);
	    	die("Connection failed: " . $this->connection->connect_error);
			}
			else
			{
				$this->connected = true;
			}
			mysqli_set_charset($this->connection,"utf8");
    }

//change database
		public function Change_DB($DB_NAME)
		{
			$result = mysqli_select_db($this->connection, $DB_NAME);
			if($result == true)
			{
				return true;
			}
			else
			{
				$this->log->Write("Database error : " . mysqli_error($this->connection));
				return false;
			}
		}
		// select data in database using sql command **( SELECT only )**
    public function Query($sql)
    {
    	$data = array();
    	$result = $this->connection->query($sql);
    	if ($result)
	    {
	    	if ($result->num_rows > 0)
				{
			    while($row = $result->fetch_assoc())
			    {
			    	array_push($data,$row);
			    }
			    return $data;
				}
			else
			{
			    return null;
			}

		}
		else
		{
			// echo $this->connection->connect_error;
			$this->log->Write("sql error : " . $sql);
			$this->log->Write("Query error : " . mysqli_error($this->connection));

	    return false;
		}

    }
//query data using sql command ***(INSERT,UPDATE,DELETE,TRUNCATE,ETC except SELECT )***
    public function Insert_Update_Delete($sql)
    {
			if ($this->connection->query($sql) === TRUE)
	    	{
			    return true;
			}
			else
			{
				$this->log->Write("sql error : " . $sql);
				$this->log->Write("Query error : " . mysqli_error($this->connection));
				return false;
			}
    }
//close database connection
    public function Close_connection()
    {
			if ($this->connected)
			{
      $this->connection->close();
      $this->connected = false;
    	}
    }
}
 ?>
