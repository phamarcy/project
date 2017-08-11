<?php
require_once(__DIR__."/../config/configuration_variable.php");
require_once(__DIR__."/Log.php");
/**
 *
 */
class CURL
{
  private $PROTOCOL;
  private $DIR_NAME;
  private $URL;
  private $LOG;
  function __construct($path)
  {
    $this->PROTOCOL = isset($_SERVER['HTTPS']) ? "https:" : "http:";
  	$this->DIR_NAME = dirname(dirname((dirname($_SERVER['REQUEST_URI']))));
  	$this->URL    = $this->PROTOCOL."//".$_SERVER['HTTP_HOST'].$this->DIR_NAME."/".$path;
    $this->LOG = new Log();
  }
  function Request($data)
  {
    $ch = curl_init();
    // set url
    curl_setopt($ch, CURLOPT_URL, $this->URL);
    //return the transfer as a string
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    //set post data
  	curl_setopt($ch, CURLOPT_POSTFIELDS,http_build_query($data));
    // $output contains the output string
    $output = curl_exec($ch);
  	if($output=== false)
  	{
        $this->LOG->Write('Curl error: ' . curl_error($ch));
        return false;
  	}
  	else
  	{
  			return $output;
  	}
    // close curl resource to free up system resources
  	curl_close($ch);
  }
}

 ?>
