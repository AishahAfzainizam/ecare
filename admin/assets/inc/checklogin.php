<?php
function check_login()
{
if(strlen($_SESSION['ad_email'])==0)
	{
		$host = $_SERVER['HTTP_HOST'];
		$uri  = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
		$extra="../index.html";
		$_SESSION["ad_email"]="";
		header("Location: http://$host$uri/$extra");
	}
}
?>
