<?php
error_reporting(E_ALL ^ E_DEPRECATED); ini_set('display_errors', 'on'); 
/*$DBhost = "localhost";
$DBuser = "root";
$DBpass = "Sup3r.Sql2018";
$DBname = "dev_wa";

try{  
	$DBcon = new PDO("mysql:host=$DBhost;dbname=$DBname",$DBuser,$DBpass);
	$DBcon->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}catch(PDOException $ex){
	die($ex->getMessage());
}*/


 $username="PBB";
 $password="PBB";
 $dbname="192.168.1.246/SISMIOP";
 $c=oci_connect($username, $password, $dbname);

 if (!$c) {
	 echo "Koneksi ke server database gagal dilakukan";
	 exit();
 }

/* 
$DBhost2 = "localhost";
$DBuser2 = "root";
$DBpass2 = "Sup3r.Sql2018";
$DBname2 = "dev_wa";

try{  
	$DBcon2 = new PDO("mysql:host=$DBhost2;dbname=$DBname2",$DBuser2,$DBpass2);
	$DBcon2->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}catch(PDOException $ex){
	die($ex->getMessage());
}
 */
