<?php
if (isset($_GET['modul'])) {
	switch ($_GET['modul']) {
		case "entri_pendataan":
			echo "<b>ENTRI PENDATAAN</b>";
			break;
		case "users":
			echo "<b>DATA USERS</b>";
			break;
		case "daftar_pendataan":
			echo "<b>DAFTAR PENDATAAN</b>";
			break;

		default:
			// include "modul/assesment.php";
			break;
	}
} else {
	echo "<b>HOME</b>";
	// include "modul/404.html";
}
