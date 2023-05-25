<?php
if (isset($_GET['modul'])) {
	switch ($_GET['modul']) {
		case "dokumentasi":
			echo "<b>DATA DOKUMENTASI</b>";
			break;
		case "users":
			echo "<b>DATA USERS</b>";
			break;
		case "petaznjoppernop":
			echo "<b>PETA NJOP PER NOP </b>";
			break;
		case "petareklame":
			echo "<b>PETA REKLAME </b>";
			break;
		case "bphtb":
			echo "<b>PETA BPHTB </b>";
			break;
		case "objek_baru":
			echo "<b>PETA OBJEK BARU </b>";
			break;
		case "update_nop":
			echo "<b>UPDATE PETA BIDANG/NOP </b>";
			break;

		case "pbb":
			echo "<b>DATA PBB</b>";
			break;

		case "petazntkota":
			echo "<b>PETA ZNT KOTA</b>";
			break;

		case "petaznt":
			echo "<b>PETA ZNT</b>";
			break;

		case "petazntsismiop":
			echo "<b>PETA ZNT SISMIOP</b>";
			break;

		case "petapbb":
			echo "<b>PETA PBB</b>";
			break;

		case "petataatpbb":
			echo "<b>PETA KETAATAN PBB</b>";
			break;

		case "petazonanjop":
			echo "<b>PETA ZONA NJOP</b>";
			break;

		case "petazonanilaitanah":
			echo "<b>PETA ZONA NILAI TANAH</b>";
			break;

		case "daf_kodeznt":
			echo "<b>DAFTAR PERUBAHAN KODE ZNT</b>";
			break;

		case "daf_petaznt":
			echo "<b>DAFTAR PEMBENTUKAN PETA ZNT</b>";
			break;

		case "daf_log_kodeznt":
			echo "<b>DAFTAR LOG PERUBAHAN KODE ZNT</b>";
			break;

		case "daf_log_petaznt":
			echo "<b>DAFTAR LOG PEMBENTUKAN PETA ZNT</b>";
			break;
		case "daf_log_perubahan_peta_znt":
			echo "<b>DAFTAR LOG PERUBAHAN PETA ZNT</b>";
			break;

		case "import":
			echo "<b>IMPORT GEOJSON</b>";
			break;

		case "import_bpn":
			echo "<b>IMPORT GEOJSON BPN</b>";
			break;

		case "gen_peta_njop":
			echo "<b>GENERATE PETA NJOP</b>";
			break;

		case "update_kecamatan":
			echo "<b>UPDATE PETA KECAMATAN</b>";
			break;

		case "update_kelurahan":
			echo "<b>UPDATE PETA KELURAHAN</b>";
			break;

		case "update_blok":
			echo "<b>UPDATE PETA BLOK</b>";
			break;

		default:
			// include "modul/assesment.php";
			break;
	}
} else {
	echo "<b>HOME</b>";
	// include "modul/404.html";
}
