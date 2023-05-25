<?php
if (isset($_GET['modul'])) {
	switch ($_GET['modul']) {
		case "users":
			include "admin/modul/mod_users.php";
		break;

		case "entri_pendatan":
			include "admin/modul/mod_entri_pendataan.php";
		break;
	}
} else {
	include "office/modul/404.html";
}
