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
	private $connection_current;
	private $connection_main;
	private $connection_person;
	private $log;
	public $connected;
	public $connected_person;
	function __construct()
	{
		global $DATABASE,$PERSON_DATABASE;
		$this->log = new Log();

		$this->connection_person  = new mysqli($PERSON_DATABASE['HOST'], $PERSON_DATABASE['USERNAME'], $PERSON_DATABASE['PASSWORD'],$PERSON_DATABASE['NAME']);
			if ($this->connection_person->connect_error)
			{
				$this->log->Write("Connection to database failed: " . $this->connection_person->connect_error);
				die("Connection failed: " . $this->connection_person->connect_error);
			}
			else
			{
				$this->connected_person = true;
			}

    $this->connection_main  = new mysqli($DATABASE['HOST'], $DATABASE['USERNAME'], $DATABASE['PASSWORD'],$DATABASE['NAME']);
	    if ($this->connection_main->connect_error)
	    {
	    	$this->log->Write("Connection to database failed: " . $this->connection_main->connect_error);
	    	die("Connection failed: " . $this->connection_main->connect_error);
			}
			else
			{
				$this->connected_main = true;
			}
			mysqli_set_charset($this->connection_main,"utf8");
			mysqli_set_charset($this->connection_person,"utf8");
			$this->connection_current = $this->connection_main;
    }

//change database
		public function Change_DB($DB_NAME)
		{
			global $DATABASE,$PERSON_DATABASE;
			if($DB_NAME == $DATABASE['NAME'])
			{
				$this->connection_current = $this->connection_main;
			}
			else if($DB_NAME == $PERSON_DATABASE['NAME'])
			{
				$this->connection_current = $this->connection_person;
			}
			$result = mysqli_select_db($this->connection_current, $DB_NAME);
			if($result == true)
			{
				return true;
			}
			else
			{
				$this->log->Write("Database error : " . mysqli_error($this->connection_current));
				return false;
			}
		}
		// select data in database using sql command **( SELECT only )**
    public function Query($sql)
    {
    	$data = array();
    	$result = $this->connection_current->query($sql);
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
			// echo $this->connection_current->connect_error;
			$this->log->Write("sql error : " . $sql);
			$this->log->Write("Query error : " . mysqli_error($this->connection_current));

	    return false;
		}

    }
//query data using sql command ***(INSERT,UPDATE,DELETE,TRUNCATE,ETC except SELECT )***
    public function Insert_Update_Delete($sql)
    {
			if ($this->connection_current->query($sql) === TRUE)
	    	{
			    return true;
			}
			else
			{
				$this->log->Write("sql error : " . $sql);
				$this->log->Write("Query error : " . mysqli_error($this->connection_current));
				return false;
			}
    }
//close database connection
    public function Close_connection()
    {
			if ($this->connected_person)
			{
				$this->connection_person->close();
	      $this->connected_person = false;
    	}
			if ($this->connected_main)
			{
	      $this->connection_main->close();
	      $this->connected_main = false;
    	}
    }
}
 ?>
