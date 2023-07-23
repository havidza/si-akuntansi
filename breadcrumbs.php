<?php
if (isset($_GET['modul'])) {
	switch ($_GET['modul']) {
		case 'dashboard':
			echo "<b>DASHBOARD</b>";
			break;
		case "entri_pendataan":
			echo "<b>ENTRI PENDATAAN</b>";
			break;
		case "users":
			echo "<b>DATA USERS</b>";
			break;
		case "daftar_pendataan":
			echo "<b>DAFTAR PENDATAAN</b>";
			break;
		case "daftar_rekening":
			echo "<b>DAFTAR REKENING</b>";
			break;
		case "laporan_jurnal":
			echo "<b>JURNAL UMUM</b>";
			break;
		case "buku_besar":
			echo "<b>BUKU BESAR</b>";
			break;
		case "neraca_saldo":
			echo "<b>NERACA SALDO</b>";
			break;

		default:
			// include "modul/assesment.php";
			break;
	}
} else {
	echo "<b>HOME</b>";
	// include "modul/404.html";
}
