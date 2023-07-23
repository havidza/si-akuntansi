<?php
if (isset($_GET['modul'])) {
	switch ($_GET['modul']) {
		case 'dashboard':
			include "admin/modul/home.php";
			break;
			
		case "users":
			include "admin/modul/mod_users.php";
			break;

		case "entri_pendataan":
			include "admin/modul/mod_entri_pendataan.php";
			break;

		case "daftar_pendataan":
			include "admin/modul/mod_daftar_pendataan.php";
			break;

		case "daftar_rekening":
			include "admin/modul/mod_daftar_rekening.php";
			break;

		case "laporan_jurnal":
			include "admin/modul/mod_cetak_laporan_jurnal.php";
			break;

		case "buku_besar":
			include "admin/modul/mod_cetak_buku_besar.php";
			break;

		case "neraca_saldo":
			include "admin/modul/mod_cetak_neraca_saldo.php";
			break;
	}
} else {
	include "office/modul/404.html";
}
