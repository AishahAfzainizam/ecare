<?php
 
$host = "lrgs.ftsm.ukm.my";
$dbuser = "a188754";
$dbpass = "hugegreengoat";
$db = "a188754";

$conn = new PDO("mysql:host=$host;dbname=$db", $dbuser, $dbpass);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
 
$mysqli=new mysqli($host,$dbuser, $dbpass, $db);
?>