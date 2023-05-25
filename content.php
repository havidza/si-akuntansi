<?php
if (isset($_GET['modul'])) {
	switch ($_GET['modul']) {
		case "dokumentasi":
			include "office/modul/mod_dokumentasi.php";
			break;
		case "users":
			include "admin/modul/mod_users.php";
			break;

		case "pbb":
			include "office/modul/mod_pbb.php";
			break;

		case "petazntkota":
			include "office/modul/mod_petazntkota.php";
			break;

		case "petaznt":
			include "office/modul/mod_petaznt.php";
			break;

		case "petazntsismiop":
			include "office/modul/mod_petazntsismiop.php";
			break;

		case "petapbb":
			include "office/modul/mod_petapbb.php";
			break;

		case "petataatpbb":
			include "office/modul/mod_petataatpbb.php";
			break;

		case "petazonanjop":
			include "office/modul/mod_petazonanjop.php";
			break;

		case "petazonanilaitanah":
			include "office/modul/mod_petazonanilaitanah.php";
			break;

		case "daf_kodeznt":
			include "office/modul/mod_daf_kodeznt.php";
			break;

		case "daf_petaznt":
			include "office/modul/mod_daf_petaznt.php";
			break;

		case "daf_log_kodeznt":
			include "office/modul/mod_daf_log_kodeznt.php";
			break;

		case "daf_log_petaznt":
			include "office/modul/mod_daf_log_petaznt.php";
			break;

		case "daf_log_perubahan_peta_znt":
			include "office/modul/mod_daf_log_perubahan_peta_znt.php";
			break;

		case "import":
			include "office/modul/mod_import.php";
			break;

		case "import_bpn":
			include "office/modul/mod_import_bpn.php";
			break;

		case "gen_peta_njop":
			include "office/modul/mod_gen_peta_njop.php";
			break;

		case "update_kecamatan":
			include "office/modul/mod_update_kecamatan.php";
			break;

		case "update_kelurahan":
			include "office/modul/mod_update_kelurahan.php";
			break;

		case "update_blok":
			include "office/modul/mod_update_blok.php";
			break;

		case "update_nop":
			include "office/modul/mod_update_nop.php";
			break;
		case "objek_baru":
			include "office/modul/mod_objek_baru.php";
			break;
		case "bphtb":
			include "office/modul/mod_bphtb.php";
			break;
		case "petaznjoppernop":
			include "office/modul/mod_peta_njop_per_nop.php";
			break;

		case "peta_znt":
			include "office/modul/mod_peta_znt.php";
			break;

		case "petareklame":
			include "office/modul/mod_peta_reklame.php";
			break;

		default:
			include "office/modul/assesment.php";
			break;
	}
} else {
	include "office/modul/404.html";
}
