<?php
require_once(__DIR__."/../config/configuration_variable.php");
/**
* 
*/
class Log
{
	function __construct()
	{
		global $LOG_PATH;
		$this->year = date("Y");
		$this->month = date("m");
		$this->day = date("d");
		$this->log_path = $LOG_PATH;
	}

	public function Write($txt)
	{
		$this->Check_folder();
		$filename = date("Y-m-d").".log";
		$file_path = $this->log_path."/".$this->year."/".$this->month;
		$file = fopen($file_path."/".$filename,"a");
		if(is_writable($file_path."/".$filename))
		{
			$date = date("h:i:s a");
			$text = $date." | ".$txt.PHP_EOL;
			fwrite($file, $text);
			fclose($file);
			return true;
		}
		else
		{
			return false;
		}
	}

	private function Check_folder()
	{
		$year = date("Y");
		$month = date("m");
		if(!file_exists($this->log_path))
		{
			mkdir($this->log_path);
		}
		if(!file_exists($this->log_path."/".$year))
		{
			mkdir($this->log_path."/".$year);
		}
		if(!file_exists($this->log_path."/".$year."/".$month))
		{
			mkdir($this->log_path."/".$year."/".$month);
		}	

			
	}
}


?>