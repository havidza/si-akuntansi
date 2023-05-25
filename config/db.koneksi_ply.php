<?php
error_reporting(E_ALL ^ E_DEPRECATED);
ini_set('display_errors', 'on');
$DBhost = "mgl-ply-database";
$DBuser = "root";
$DBpass = '$ql-ply#mgl';
$DBname = "pelayanan_pbb";

try {
	$DBconPLY = new PDO("mysql:host=$DBhost;dbname=$DBname", $DBuser, $DBpass);
	$DBconPLY->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $ex) {
	die($ex->getMessage());
}
