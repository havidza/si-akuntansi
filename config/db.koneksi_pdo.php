<?php
error_reporting(E_ALL ^ E_DEPRECATED);
ini_set('display_errors', 'on');
$DBhost = "localhost";
$DBuser = "root";
$DBpass = "";
$DBname = "akuntansi";
// $DBname = "petaznt";

try {
	$DBcon = new PDO("mysql:host=$DBhost;dbname=$DBname", $DBuser, $DBpass);
	$DBcon->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $ex) {
	die($ex->getMessage());
}
