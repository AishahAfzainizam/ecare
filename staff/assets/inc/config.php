<?php
 
$host = "yourhostname";
$dbuser = "yourdbusername";
$dbpass = "yourpassword";
$db = "dbname";

$conn = new PDO("mysql:host=$host;dbname=$db", $dbuser, $dbpass);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
 
$mysqli=new mysqli($host,$dbuser, $dbpass, $db);
?>