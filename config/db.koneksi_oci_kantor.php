<?php
error_reporting(E_ALL ^ E_DEPRECATED); ini_set('display_errors', 'on'); 
 $username="PBB";
 $password="PBB";
 $dbname="175.106.18.210:15211/SISMIOP";
 $cs=oci_connect($username, $password, $dbname);

 if (!$cs) {
	 echo "Koneksi ke server database gagal dilakukan";
	 exit();
 }