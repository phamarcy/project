<?php
session_start();
if(isset($_SESSION))
{
	var_dump($_SESSION);
}
else
{
	echo "login failed";
}