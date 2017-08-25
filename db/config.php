<?php

$dbUser = "root";
$dbPass = "qwe123";
$dbHost = "localhost";
$dbName = "webscraping_instant";


try
{
	$db = new PDO('mysql:host='.$dbHost.';dbname='.$dbName.';charset=utf8mb4', $dbUser, $dbPass);

}catch(PDOException $e)
{
	echo 'Error: '.$e->getMessage();
}