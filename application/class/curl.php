<?php
require_once(__DIR__."/../config/configuration_variable.php");
require_once(__DIR__."/log.php");
/** This class serves curl connection
*
* @author  Adiluck Chooprateep
* @since   4/10/2017
*/
class CURL
{
  private $PROTOCOL;
  private $DIR_NAME;
  private $URL;
  private $LOG;
  function __construct()
  {
    $this->PROTOCOL = isset($_SERVER['HTTPS']) ? "https:" : "http:";
  	$this->DIR_NAME = dirname(dirname((dirname($_SERVER['REQUEST_URI']))));
    $this->URL = $this->GET_SERVER_URL();
    $this->LOG = new Log();
  }

  //send request
  public function Request($data,$path)
  {
    $url = $this->URL."/".$path;
    $ch = curl_init();
    // set url
    curl_setopt($ch, CURLOPT_URL, $url);
    //return the transfer as a string
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
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

//get server url
  public function GET_SERVER_URL()
  {
    $PROTOCOL = isset($_SERVER['HTTPS']) ? "https:" : "http:";
    $DIR_NAME = dirname(dirname((dirname($_SERVER['REQUEST_URI']))));
    $URL    = $PROTOCOL."//".$_SERVER['HTTP_HOST'].$DIR_NAME;
    return $URL;
  }
}

 ?>
