<?php
error_reporting(E_ALL ^ E_DEPRECATED);
ini_set('display_errors', 'on');
$DBhost = "mgl-znt-database";
$DBuser = "root";
$DBpass = "sql-mgl-2021";
$DBname = "dbpetaznt";
// $DBname = "petaznt";

try {
	$DBcon = new PDO("mysql:host=$DBhost;dbname=$DBname", $DBuser, $DBpass);
	$DBcon->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$urlzzz = "http://192.168.1.245:7394/admin/";
} catch (PDOException $ex) {
	die($ex->getMessage());
}
