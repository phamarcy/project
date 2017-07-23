<?php 
require_once(__DIR__."/../config/configuration_variable.php");
require_once(__DIR__."/Log.php");
/**
* 
*/
class Database 
{
	private $connection;
	private $log;
	function __construct() 
	{
		global $DATABASE;
		$log = new Log();
        $this->connection  = new mysqli($DATABASE['HOST'], $DATABASE['USERNAME'], $DATABASE['PASSWORD'],$DATABASE['NAME']);
	    if ($this->connection->connect_error)
	    {
	    	$this->log->Write("Connection to database failed: " . $this->connection->connect_error);
	    	die("Connection failed: " . $this->connection->connect_error);
		} 
       
    }

    public function Query($sql)
    {
    	$data = array();
    	$result = $this->connection->query($sql);

    	if (!$this->connection->connect_error)
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
			echo $this->connection->connect_error;
			$this->log->Write("Query error : " . $this->connection->connect_error);
	    	return false;
		}
		
    }

    public function Insert_Update_Delete($sql)
    {
		if ($this->connection->connect_error->query($sql) === TRUE) 
    	{    
		    return true;
		} 
		else 
		{
			$this->log->Write("Query error : " . $this->connection->connect_error);
			return false;
		    
		}    	
    }

    public function Close_connection()
    {
    	$this->connection->close();
    }
}
 ?>