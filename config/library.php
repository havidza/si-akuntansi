<?php

date_default_timezone_set('Asia/Jakarta');

function logPetaHunian($DBcon, $id, $user, $aksi)
{
	$clause = " INSERT INTO log_peta_hunian (id, aksi, jenis, nama, alamat, rt, rw, id_kecamatan, id_kelurahan, id_kawasan, jml_jiwa, status_tanah, luas_tanah, luas_bangunan, kondisi_rtamu, kondisi_rtidur, kondisi_dapur, kondisi_kmwc, status_sanitasi, saluran_drainase, kondisi_air_bersih, pembuangan_sampah, geometry, stat_ver, catatan, create_date, update_date, user)
	SELECT id, '$aksi', 1, nama, alamat, rt, rw, id_kecamatan, id_kelurahan, id_kawasan, jml_jiwa, status_tanah, luas_tanah, luas_bangunan, kondisi_rtamu, kondisi_rtidur, kondisi_dapur, kondisi_kmwc, status_sanitasi, saluran_drainase, kondisi_air_bersih, pembuangan_sampah, geometry, stat_ver, catatan, create_date, NOW(), '$user'
	FROM peta_hunian
	WHERE id = '$id' ";
	$rs = $DBcon->prepare($clause);
	$rs->execute();
}

function logPetaKawasan($DBcon, $id, $user, $aksi)
{
	$clause = " INSERT INTO log_peta_hunian (id, aksi, jenis, nama, alamat, rt, rw, id_kecamatan, id_kelurahan, id_kawasan, jml_jiwa, status_tanah, luas_tanah, luas_bangunan, kondisi_rtamu, kondisi_rtidur, kondisi_dapur, kondisi_kmwc, status_sanitasi, saluran_drainase, kondisi_air_bersih, pembuangan_sampah, geometry, stat_ver, catatan, create_date, update_date, user)
	SELECT id, '$aksi', 2, nama, alamat, rt, rw, id_kecamatan, id_kelurahan, id_kawasan, jml_jiwa, status_tanah, luas_tanah, luas_bangunan, kondisi_rtamu, kondisi_rtidur, kondisi_dapur, kondisi_kmwc, status_sanitasi, saluran_drainase, kondisi_air_bersih, pembuangan_sampah, geometry, stat_ver, catatan, create_date, NOW(), '$user'
	FROM peta_hunian
	WHERE id = '$id' ";
	$rs = $DBcon->prepare($clause);
	$rs->execute();
}

function logPetaKecamatan($DBcon, $id, $user, $aksi)
{
	$clause = " INSERT INTO log_peta_kecamatan (id, D_KD_KEC, D_NM_KEC, ID_PROP, NM_PROP, ID_KAB, NM_KAB, ID_KEC, geometry, aksi, timestamp, user)
	SELECT id, D_KD_KEC, D_NM_KEC, ID_PROP, NM_PROP, ID_KAB, NM_KAB, ID_KEC, geometry, '$aksi', NOW(), '$user'
	FROM peta_kecamatan
	WHERE id = '$id' ";
	$rs = $DBcon->prepare($clause);
	$rs->execute();
}

//insert to oracle from file smap
function insert_oracle_coy($c, $DBcon, $data, $module, $user_id)
{
	if ($module == "kecamatan") {
		//echo "hehe";
		// echo $module;
		// var_dump($data);
		foreach ($data["features"] as $data) {
			if (isset($data["properties"]["D_KD_KEC"]) == false) {
				$data["properties"]["D_KD_KEC"] = $data["properties"]["d_kd_kec"];
				$data["properties"]["D_NM_KEC"] = $data["properties"]["d_nm_kec"];
			}
			$hehe = $data["properties"]["D_KD_KEC"];
			$nm = $data["properties"]["D_NM_KEC"];
			//echo $nm;
			$geometry = json_encode($data['geometry']);
			// echo "UPDATE peta_kecamatan SET D_KD_KEC='$hehe', D_NM_KEC='$nm', geometry=ST_GeomFromGeoJSON('$geometry'), tgl_import=NOW(), petugas_import='1' WHERE D_KD_KEC='$hehe'" . "<br>";

			// /* masuk mysql */
			$stmt1 = $DBcon->prepare("SELECT COUNT(*) FROM peta_kecamatan WHERE D_KD_KEC=?");
			$stmt1->execute([$data["properties"]["D_KD_KEC"]]);
			$data_exists1 = ($stmt1->fetchColumn() > 0) ? true : false;

			if ($data_exists1) {
				// update
				$ins = $DBcon->prepare("UPDATE peta_kecamatan SET D_KD_KEC=?, D_NM_KEC=?, geometry=ST_GeomFromGeoJSON('$geometry'), tgl_import=NOW(), petugas_import=? WHERE D_KD_KEC=?");
				$ins->execute(array($data["properties"]["D_KD_KEC"], $data["properties"]["D_NM_KEC"], $_SESSION["idu"], $data["properties"]["D_KD_KEC"]));
			} else {
				// insert
				$ins = $DBcon->prepare("INSERT INTO peta_kecamatan(D_KD_KEC, D_NM_KEC, geometry, tgl_import, petugas_import) VALUES(?,?,ST_GeomFromGeoJSON(?), NOW(), ?)");
				$ins->execute(array($data["properties"]["D_KD_KEC"], $data["properties"]["D_NM_KEC"], $geometry, $_SESSION["idu"]));
			}
			// /* endmasuk mysql */

			$kd_kec = $data["properties"]["D_KD_KEC"];
			$nm_kec = $data["properties"]["D_NM_KEC"];
			// $geometry = json_encode($data["geometry"]["coordinates"]);
			$polygon = geoPHP::load($geometry, 'json');
			$polygons = $polygon->asArray();
			//print_r($polygons);
			// die();
			$stmt = "SELECT COUNT(*) AS J FROM ESIG_CAMAT WHERE D_KD_KEC='$kd_kec'";
			//echo $stmt;
			$parse = oci_parse($c, $stmt);
			oci_execute($parse);
			$cek = oci_fetch_array($parse, OCI_ASSOC);
			$data_exists = ($cek['J'] > 0) ? true : false;

			/* aksi entrys to oracle */
			if (count($polygons) == 1) {
				$poly = $polygons[0];
				$ordinat = "";
				foreach ($poly as $key => $po) {
					if ($key == 0) {
						$ordinat .= "$po[0], $po[1],";
					} elseif (fmod($key, 4) == 0) {
						$ordinat = substr($ordinat, 0, -1);
						if ($key == 4) {
							if ($data_exists == true) {
								$stet = "UPDATE ESIG_CAMAT U SET U.GEOM.SDO_ORDINATES = SDO_ORDINATE_ARRAY($ordinat) WHERE U.D_KD_KEC = '$kd_kec'";
							} else {
								$stet = "INSERT INTO ESIG_CAMAT (D_KD_KEC, D_NM_KEC, GEOM) VALUES ('$kd_kec', '$nm_kec', SDO_GEOMETRY(2003, 4236, NULL, SDO_ELEM_INFO_ARRAY(1,1003,1),SDO_ORDINATE_ARRAY($ordinat)))";
							}
						} else {
							$ordinat = substr($ordinat, 0, -1);
							$stet = "UPDATE ESIG_CAMAT U SET U.GEOM = SDO_UTIL.APPEND((SELECT S.GEOM FROM ESIG_CAMAT S WHERE S.D_KD_KEC = U.D_KD_KEC),SDO_GEOMETRY(2003, 4236, NULL, SDO_ELEM_INFO_ARRAY(1,1003,1),SDO_ORDINATE_ARRAY($ordinat))) WHERE U.D_KD_KEC = '$kd_kec'";
						}
						$ordinat = "$po[0], $po[1],";
						$pars = oci_parse($c, $stet);
						oci_execute($pars);
					} else {
						$ordinat .= "$po[0], $po[1],";
					}
				}

				$ordinat = substr($ordinat, 0, -1);
				$stet = "UPDATE ESIG_CAMAT U SET U.GEOM = SDO_UTIL.APPEND((SELECT S.GEOM FROM ESIG_CAMAT S WHERE S.D_KD_KEC = U.D_KD_KEC),SDO_GEOMETRY(2003, 4236, NULL, SDO_ELEM_INFO_ARRAY(1,1003,1),SDO_ORDINATE_ARRAY($ordinat))) WHERE U.D_KD_KEC = '$kd_kec'";
				$pars = oci_parse($c, $stet);
				oci_execute($pars);

				$stet = "UPDATE ESIG_CAMAT U SET U.GEOM.SDO_ELEM_INFO = SDO_ELEM_INFO_ARRAY(1,1003,1) WHERE U.D_KD_KEC = '$kd_kec'";
				$pars = oci_parse($c, $stet);
				oci_execute($pars);
				echo json_encode(array('success' => true, 'pesan' => "Data Berhasil Disimpan ociii !"));
			} else {
				echo json_encode(array('success' => false, 'pesan' => "Tidak Dapat Menambahkan Data !"));
			}
			/* end entrys oracle */
		}
	} else if ($module == "kelurahan") {
		foreach ($data["features"] as $data) {
			if (isset($data["properties"]["D_KD_KEL"]) == false) {
				$data["properties"]["D_KD_KEL"] = $data["properties"]["d_kd_kel"];
				$data["properties"]["D_NM_KEL"] = $data["properties"]["d_nm_kel"];
			}
			$geometry = json_encode($data['geometry']);
			/* insert mysql */
			$stmt = $DBcon->prepare("SELECT COUNT(*) FROM peta_kelurahan WHERE D_KD_KEL=?");
			$stmt->execute([$data["properties"]["D_KD_KEL"]]);
			$data_exists = ($stmt->fetchColumn() > 0) ? true : false;

			if ($data_exists) {
				// update
				$ins = $DBcon->prepare("UPDATE peta_kelurahan SET D_KD_KEL=?, D_NM_KEL=?, geometry=ST_GeomFromGeoJSON(?), tgl_import=NOW(), petugas_import=? WHERE D_KD_KEL=?");
				$ins->execute(array($data["properties"]["D_KD_KEL"], $data["properties"]["D_NM_KEL"], $geometry, $_SESSION["idu"], $data["properties"]["D_KD_KEL"]));
			} else {
				// insert
				$ins = $DBcon->prepare("INSERT INTO peta_kelurahan(D_KD_KEL, D_NM_KEL, geometry, tgl_import, petugas_import) VALUES(?,?,ST_GeomFromGeoJSON(?), NOW(), ?)");
				$ins->execute(array($data["properties"]["D_KD_KEL"], $data["properties"]["D_NM_KEL"], $geometry, $_SESSION["idu"]));
			}
			/* end */
			$kd_kel = $data["properties"]["D_KD_KEL"];
			$nm_kel = $data["properties"]["D_NM_KEL"];
			// $geometry = json_encode($data["geometry"]["coordinates"]);
			$polygon = geoPHP::load($geometry, 'json');
			$polygons = $polygon->asArray();
			//print_r($polygons);
			// die();
			$stmt = "SELECT COUNT(*) AS J FROM ESIG_LURAH WHERE D_KD_KEL='$kd_kel'";
			//echo $stmt;
			$parse = oci_parse($c, $stmt);
			oci_execute($parse);
			$cek = oci_fetch_array($parse, OCI_ASSOC);
			$data_exists = ($cek['J'] > 0) ? true : false;
			// $geometry = json_encode($data["geometry"]["coordinates"]);
			// Note by MDS
			// -----------
			// Cek data peta_kelurahan jika sudah ada maka update, jika data belum ada maka insert
			// Agar tidak terjadi duplikat data
			//var_dump($polygons);
			if (count($polygons) == 1) {
				$poly = $polygons[0];
				$ordinat = "";
				foreach ($poly as $key => $po) {
					if ($key == 0) {
						$ordinat .= "$po[0], $po[1],";
					} elseif (fmod($key, 4) == 0) {
						$ordinat = substr($ordinat, 0, -1);
						if ($key == 4) {
							if ($data_exists == true) {
								$stet = "UPDATE ESIG_LURAH U SET U.GEOM.SDO_ORDINATES = SDO_ORDINATE_ARRAY($ordinat) WHERE U.D_KD_KEL = '$kd_kel'";
							} else {
								$stet = "INSERT INTO ESIG_LURAH (D_KD_KEL, D_NM_KEL, GEOM) VALUES ('$kd_kel', '$nm_kel', SDO_GEOMETRY(2003, 4236, NULL, SDO_ELEM_INFO_ARRAY(1,1003,1),SDO_ORDINATE_ARRAY($ordinat)))";
							}
						} else {
							$ordinat = substr($ordinat, 0, -1);
							$stet = "UPDATE ESIG_LURAH U SET U.GEOM = SDO_UTIL.APPEND((SELECT S.GEOM FROM ESIG_LURAH S WHERE S.D_KD_KEL = U.D_KD_KEL),SDO_GEOMETRY(2003, 4236, NULL, SDO_ELEM_INFO_ARRAY(1,1003,1),SDO_ORDINATE_ARRAY($ordinat))) WHERE U.D_KD_KEL = '$kd_kel'";
						}
						$ordinat = "$po[0], $po[1],";
						$pars = oci_parse($c, $stet);
						oci_execute($pars);
					} else {
						$ordinat .= "$po[0], $po[1],";
					}
				}

				$ordinat = substr($ordinat, 0, -1);
				$stet = "UPDATE ESIG_LURAH U SET U.GEOM = SDO_UTIL.APPEND((SELECT S.GEOM FROM ESIG_LURAH S WHERE S.D_KD_KEL = U.D_KD_KEL),SDO_GEOMETRY(2003, 4236, NULL, SDO_ELEM_INFO_ARRAY(1,1003,1),SDO_ORDINATE_ARRAY($ordinat))) WHERE U.D_KD_KEL = '$kd_kel'";
				$pars = oci_parse($c, $stet);
				oci_execute($pars);

				$stet = "UPDATE ESIG_LURAH U SET U.GEOM.SDO_ELEM_INFO = SDO_ELEM_INFO_ARRAY(1,1003,1) WHERE U.D_KD_KEL = '$kd_kel'";
				$pars = oci_parse($c, $stet);
				oci_execute($pars);
				echo json_encode(array('success' => true, 'pesan' => "Data Berhasil Disimpan ociii !"));
			} else {
				echo json_encode(array('success' => false, 'pesan' => "Tidak Dapat Menambahkan Data !"));
			}
		}
		//logimport($DBcon, "Import Peta Kelurahan", "Sukses");
		echo json_encode(array('success' => true, 'pesan' => "Data Berhasil Ditambahkan !"));
	} else if ($module == 'nop') {
		$list_nop = array();
		foreach ($data["features"] as $data) {
			if (isset($data["properties"]["d_nop"]) == false) {
				$data["properties"]["d_nop"] = $data["properties"]["D_NOP"];
			}
			//array_push($list_nop, $data["properties"]["d_nop"]);
			// $geometry = json_encode($data["geometry"]["coordinates"]);
			if ($data['geometry'] != null) {
				$geometry = json_encode($data['geometry']);
				/* insert mysql */
				$stmt = $DBcon->prepare("SELECT COUNT(*) FROM peta_nop WHERE D_NOP=?");
				$stmt->execute([$data["properties"]["d_nop"]]);
				$data_exists = ($stmt->fetchColumn() > 0) ? true : false;

				if ($data_exists) {
					// update
					$ins = $DBcon->prepare("UPDATE peta_nop SET D_NOP=?, geometry=ST_GeomFromGeoJSON(?), tgl_import=NOW(), petugas_import=? WHERE D_NOP=?");
					$ins->execute(array($data["properties"]["d_nop"], $geometry, $_SESSION["idu"], $data["properties"]["d_nop"]));
				} else {
					// insert
					$ins = $DBcon->prepare("INSERT INTO peta_nop(D_NOP, geometry, tgl_import, petugas_import) VALUES(?,ST_GeomFromGeoJSON(?), NOW(), ?)");
					$ins->execute(array($data["properties"]["d_nop"], $geometry, $_SESSION["idu"]));
				}
				/* end insert mysql */
				$kd_nop = $data["properties"]["d_nop"];
				$polygon = geoPHP::load($geometry, 'json');
				$polygons = $polygon->out('wkt');
				//echo "SELECT COUNT(ID_NOP) AS J FROM ESIG_NOP WHERE D_NOP='$kd_nop'";
				//print_r($polygons);
				// die();
				$stmt = "SELECT COUNT(ID_NOP) AS J FROM ESIG_NOP WHERE D_NOP='$kd_nop'";
				$parse = oci_parse($c, $stmt);
				oci_execute($parse);
				$cek = oci_fetch_array($parse, OCI_ASSOC);
				//var_dump($cek);
				$data_exists = ($cek['J'] > 0) ? true : false;
				//die();
				if ($data_exists == true) {
					$stmt2 = "SELECT ID_NOP FROM ESIG_NOP WHERE D_NOP='$kd_nop'";
					$parse2 = oci_parse($c, $stmt2);
					oci_execute($parse2);
					$cek2 = oci_fetch_array($parse2, OCI_ASSOC);
					$ins_ora = oci_parse($c, "UPDATE ESIG_NOP SET GEOM=SDO_UTIL.FROM_WKTGEOMETRY('$polygons'),D_NOP='$kd_nop'
					   WHERE ID_NOP='$cek2[ID_NOP]'");
					oci_execute($ins_ora);
				} else {
					$stmt1 = "SELECT NVL(MAX(ID_NOP),0) AS M FROM ESIG_NOP";
					$parse1 = oci_parse($c, $stmt1);
					oci_execute($parse1);
					$cek1 = oci_fetch_array($parse1, OCI_ASSOC);
					$id_mak = intval($cek1['M']);
					//array_push($list_nop, $id_mak);
					$v_maks = $id_mak + 1;
					$ins_ora = oci_parse($c, "INSERT INTO ESIG_NOP (D_NOP,GEOM,ID_NOP)
					   VALUES ('$kd_nop',SDO_UTIL.FROM_WKTGEOMETRY('$polygons'),'$v_maks')");
					oci_execute($ins_ora);
				}
			}
		}
		//logimport($DBcon, "Import Peta NOP", "Sukses");
		echo json_encode(array('success' => true, 'pesan' => "Data Berhasil Ditambahkan !", 'list_nop' => $list_nop));
	} else if ($module == 'blok') {
		foreach ($data["features"] as $data) {
			if (isset($data["properties"]["D_BLOK"]) == false) {
				$data["properties"]["D_BLOK"] = $data["properties"]["d_blok"];
			}
			$geometry = json_encode($data['geometry']);
			/* insert mysql */
			$stmt = $DBcon->prepare("SELECT COUNT(*) FROM peta_blok WHERE D_BLOK=?");
			$stmt->execute([$data["properties"]["D_BLOK"]]);
			$data_exists = ($stmt->fetchColumn() > 0) ? true : false;

			if ($data_exists) {
				// update
				$ins = $DBcon->prepare("UPDATE peta_blok SET D_BLOK=?, geometry=ST_GeomFromGeoJSON(?), tgl_import=NOW(), petugas_import=? WHERE D_BLOK=?");
				$ins->execute(array($data["properties"]["D_BLOK"], $geometry, $_SESSION["idu"], $data["properties"]["D_BLOK"]));
			} else {
				// insert
				$ins = $DBcon->prepare("INSERT INTO peta_blok(D_BLOK, geometry, tgl_import, petugas_import) VALUES(?,ST_GeomFromGeoJSON(?), NOW(), ?)");
				$ins->execute(array($data["properties"]["D_BLOK"], $geometry, $_SESSION["idu"]));
			}
			/* end insert mysql */
			$kd_blok = $data["properties"]["D_BLOK"];
			$polygon = geoPHP::load($geometry, 'json');
			$polygons = $polygon->asArray();
			//print_r($polygons);
			// die();
			$stmt = "SELECT COUNT(*) AS J FROM ESIG_BLOK WHERE D_BLOK='$kd_blok'";
			//echo $stmt;
			$parse = oci_parse($c, $stmt);
			oci_execute($parse);
			$cek = oci_fetch_array($parse, OCI_ASSOC);
			$data_exists = ($cek['J'] > 0) ? true : false;

			if (count($polygons) == 1) {
				$poly = $polygons[0];
				$ordinat = "";
				foreach ($poly as $key => $po) {
					if ($key == 0) {
						$ordinat .= "$po[0], $po[1],";
					} elseif (fmod($key, 4) == 0) {
						$ordinat = substr($ordinat, 0, -1);
						if ($key == 4) {
							if ($data_exists == true) {
								$stet = "UPDATE ESIG_BLOK U SET U.GEOM.SDO_ORDINATES = SDO_ORDINATE_ARRAY($ordinat) WHERE U.D_BLOK = '$kd_blok'";
							} else {
								$stet = "INSERT INTO ESIG_BLOK (D_BLOK, GEOM) VALUES ('$kd_blok', SDO_GEOMETRY(2003, 4236, NULL, SDO_ELEM_INFO_ARRAY(1,1003,1),SDO_ORDINATE_ARRAY($ordinat)))";
							}
						} else {
							$ordinat = substr($ordinat, 0, -1);
							$stet = "UPDATE ESIG_BLOK U SET U.GEOM = SDO_UTIL.APPEND((SELECT S.GEOM FROM ESIG_BLOK S WHERE S.D_BLOK = U.D_BLOK),SDO_GEOMETRY(2003, 4236, NULL, SDO_ELEM_INFO_ARRAY(1,1003,1),SDO_ORDINATE_ARRAY($ordinat))) WHERE U.D_BLOK = '$kd_blok'";
						}
						$ordinat = "$po[0], $po[1],";
						$pars = oci_parse($c, $stet);
						oci_execute($pars);
					} else {
						$ordinat .= "$po[0], $po[1],";
					}
				}

				$ordinat = substr($ordinat, 0, -1);
				$stet = "UPDATE ESIG_BLOK U SET U.GEOM = SDO_UTIL.APPEND((SELECT S.GEOM FROM ESIG_BLOK S WHERE S.D_BLOK = U.D_BLOK),SDO_GEOMETRY(2003, 4236, NULL, SDO_ELEM_INFO_ARRAY(1,1003,1),SDO_ORDINATE_ARRAY($ordinat))) WHERE U.D_BLOK = '$kd_blok'";
				$pars = oci_parse($c, $stet);
				oci_execute($pars);

				$stet = "UPDATE ESIG_BLOK U SET U.GEOM.SDO_ELEM_INFO = SDO_ELEM_INFO_ARRAY(1,1003,1) WHERE U.D_BLOK = '$kd_blok'";
				$pars = oci_parse($c, $stet);
				oci_execute($pars);
				echo json_encode(array('success' => true, 'pesan' => "Data Berhasil Disimpan ociii !"));
			} else {
				echo json_encode(array('success' => false, 'pesan' => "Tidak Dapat Menambahkan Data !"));
			}
		}
		echo json_encode(array('success' => true, 'pesan' => "Data Berhasil Ditambahkan !"));
	} else {
		//logimport($DBcon, "Import Peta NOP", "Error");
		echo json_encode(array('success' => false, 'pesan' => "Terjadi kesalahan saat upload file !"));
	}
}


// format angka rupiah jurnal
function formatAngka($angka)
{
	$jadi = number_format(abs($angka), 0, ',', '.');
	if ($angka < 0) $jadi = "(" . $jadi . ")";

	return $jadi;
}

function buatZip($kode)
{
	$error = "";

	$file_folder = "../peta/" . $kode . "/"; // folder untuk load file

	if (extension_loaded('zip')) {   //memeriksa ekstensi zip

		$zip = new ZipArchive(); // Load zip library  

		$zip_name = $file_folder . $kode . ".zip";  // nama Zip  
		if (file_exists($zip_name)) {
			unlink($zip_name);
		}
		if ($zip->open($zip_name, ZIPARCHIVE::CREATE) !== TRUE) {   //Membuka file zip untuk memuat file

			$error .= "* Maaf Download ZIP gagal";
		}
		if (file_exists($zip_name)) {  // Unduh Zip 

			header('Content-type: application/zip');

			header('Content-Disposition: attachment; filename="' . $zip_name . '"');

			//readfile($zip_name);


			$zip->addFile($file_folder . $kode . '.id', $kode . '.id'); // Menambahkan files ke zip 
			$zip->addFile($file_folder . $kode . '.dat', $kode . '.dat'); // Menambahkan files ke zip 
			$zip->addFile($file_folder . $kode . '.map', $kode . '.map'); // Menambahkan files ke zip 
			$zip->addFile($file_folder . $kode . '.tab', $kode . '.tab'); // Menambahkan files ke zip 

			$zip->close();
		} else {
			$zip->addFile($file_folder . $kode . '.id', $kode . '.id'); // Menambahkan files ke zip 
			$zip->addFile($file_folder . $kode . '.dat', $kode . '.dat'); // Menambahkan files ke zip 
			$zip->addFile($file_folder . $kode . '.map', $kode . '.map'); // Menambahkan files ke zip 
			$zip->addFile($file_folder . $kode . '.tab', $kode . '.tab'); // Menambahkan files ke zip 

			$zip->close();
		}
		echo json_encode(['success' => true, 'url' => 'peta/' . $kode . '/' . $kode . '.zip']);
	} else {

		$error .= "* Zip ekstensi tidak ada";
	}
}

function geoJSON2KMZ($i_geo, $o_kmz){
	if (!file_exists($i_geo)) {
		return array('success' => false, 'msg' => "File GeoJSON not exists!");
	}	

	if( strtolower(pathinfo($i_geo, PATHINFO_EXTENSION)) != 'geojson'){
		return array('success' => false, 'msg' => "File GeoJSON not valid!");
	}

	if (!file_exists(dirname($o_kmz))) {
		return array('success' => false, 'msg' => "KMZ location not exists!");
	}		

	if( strtolower(pathinfo($o_kmz, PATHINFO_EXTENSION)) != 'kmz'){
		return array('success' => false, 'msg' => "File GeoJSON not valid!");
	}

	$fkml = str_replace("kmz", "kml", $o_kmz);
	$fzip = str_replace("kmz", "zip", $o_kmz);

	exec("ogr2ogr -f 'KML' -a_srs 'EPSG:4326' " . $fkml . " " . $i_geo, $output, $retval);
	if (!file_exists(dirname($fkml))) {
		return array('success' => false, 'msg' => "Proses konversi KML gagal!");
	}		

	$zip = new ZipArchive(); // Load zip library
 
	if (file_exists($fzip)) {
		unlink($fzip);
	}
	if ($zip->open($fzip, ZIPARCHIVE::CREATE) !== TRUE) {   //Membuka file zip untuk memuat file
		return array('success' => false, 'msg' => "Proses ZIP gagal!");
	}

	$zip->addFile($fkml, basename($fkml));
	$zip->close();

	rename($fzip, $o_kmz);

	return array('success' => true, 'msg' => "Proses konversi geojson ke KMZ berhasil !");
}

// cek waktu antara
function cekWaktuAntara($waktu_mulai, $waktu_selesai, $waktu)
{

	$start_timestamp = strtotime($waktu_mulai);
	$end_timestamp = strtotime($waktu_selesai);
	$today_timestamp = strtotime($waktu);

	return (($today_timestamp >= $start_timestamp) && ($today_timestamp <= $end_timestamp));
}

//tentukan ROLE
function roles($string)
{
	switch ($string) {
		case 'mnj':
			$a = "Manajer";
			break;
		case 'sup':
			$a = "Supervisor";
			break;
		case 'opr':
			$a = "Operator";
			break;
	}
	return $a;
}

/* simpan log */
function log_perubahan_peta($DBcon, $kd_bidang, $nm_bidang, $datenow, $id_user, $status, $aksi)
{
	$log = $DBcon->prepare("INSERT INTO log_perubahan_peta (kd_bidang,nm_bidang,tgl_update,user,status,aksi) VALUES(?,?,?,?,?,?)");
	$log->execute([$kd_bidang, $nm_bidang, $datenow, $id_user, $status, $aksi]);
}


//MEMBALIK FORMAT TANGGAL
function balikTanggal($string)
{
	if (!empty($string)) {
		$tanggal = date("Y-m-d", strtotime($string));
	} else {
		$tanggal = "0000-00-00";
	}
	return $tanggal;
}
function balikTanggalJam($string)
{
	if (!empty($string)) {
		$tanggal = date("Y-m-d H:i:s", strtotime($string));
	} else {
		$tanggal = "0000-00-00 00:00:00";
	}
	return $tanggal;
}
//MEMBALIK FORMAT TANGGAL INDO
function balikTanggalIndo($string)
{
	if (!empty($string)) {
		$tanggal = date("d-m-Y", strtotime($string));
	} else {
		$tanggal = "";
	}
	return $tanggal;
}
function balikTanggalJamIndo($string)
{
	if (!empty($string)) {
		$tanggal = date("d-m-Y H:i:s", strtotime($string));
	} else {
		$tanggal = "";
	}
	return $tanggal;
}
function tgl_indo($tgl)
{
	$tanggal = substr($tgl, 8, 2);
	$bulan = getBulan(substr($tgl, 5, 2));
	$tahun = substr($tgl, 0, 4);
	return $tanggal . ' ' . $bulan . ' ' . $tahun;
}

function nama_hari($tgl)
{
	$dt = date(strtotime($tgl));
	$hari = getdate($dt);
	return getHari($hari['wday']);
}

function jam($tgl)
{
	$jam = date("H:i:s", strtotime($tgl));
	return $jam;
}

function tgl($tgl)
{
	$tanggal = date("d", strtotime($tgl));
	return $tanggal;
}

function detkeJam($time)
{
	$j = $time / 3600;
	$t = $time % 3600;
	$hari = $j / 24;
	$jam = $j % 24;
	$m = $t / 60;
	$d = $t % 60;
	$time = floor($hari) . "d " . floor($jam) . ":" . floor($m) . ":" . $d;
	return $time;
}
//nama bulan
function getBulan($bln)
{
	switch ($bln) {
		case 1:
			return "Januari";
			break;
		case 2:
			return "Februari";
			break;
		case 3:
			return "Maret";
			break;
		case 4:
			return "April";
			break;
		case 5:
			return "Mei";
			break;
		case 6:
			return "Juni";
			break;
		case 7:
			return "Juli";
			break;
		case 8:
			return "Agustus";
			break;
		case 9:
			return "September";
			break;
		case 10:
			return "Oktober";
			break;
		case 11:
			return "November";
			break;
		case 12:
			return "Desember";
			break;
	}
}
//nama hari
function getHari($hari)
{
	switch ($hari) {
		case 1:
			return "Senin";
			break;
		case 2:
			return "Selasa";
			break;
		case 3:
			return "Rabu";
			break;
		case 4:
			return "Kamis";
			break;
		case 5:
			return "Jumat";
			break;
		case 6:
			return "Sabtu";
			break;
		case 0:
			return "Minggu";
			break;
	}
}


// validasi tanggal
function validTanggal($tgl)
{

	$tanggal1 = date("Y", strtotime($tgl));
	$bulan1 = date("m", strtotime($tgl));
	$tahun1 = date("d", strtotime($tgl));
	$jam = date("H:i:s", strtotime($tgl));

	if ($tgl != '0000-00-00') {
		$output = $tanggal1 . "-" . $bulan1 . "-" . $tahun1;
	} else {
		$output = "-";
	}

	return $output;
}

//rupiah
function rp($nominal)
{
	$rp = number_format($nominal, 0, '', '.');
	return "Rp " . $rp . ",-";
}
function desim($nomi)
{
	$nom = number_format($nomi, 0, '', '.');
	return $nom;
}

// PESAN POP UP
function pesan($module, $str)
{
	echo "<script>alert('$str');location.href='media.php?module=$module'</script>";
}
//MEMBALIK FORMAT TANGGAL
function aksibalikTanggal($string)
{
	if (!empty($string)) {
		$tanggal = date("Y-m-d", strtotime($string));
	} else {
		$tanggal = "0000-00-00";
	}
	return $tanggal;
}
function cekAdaData($table, $field, $id)
{
	$totalRows = mysql_num_rows(mysql_query("SELECT * FROM $table WHERE $field ='$id'"));
	return $totalRows;
}
function cekSesi($nama, $level)
{
	$peg = mysql_fetch_assoc(mysql_query("SELECT * FROM pegawai WHERE username ='$nama'"));
	if (md5($peg['role']) == $level)
		return 1;
	else
		return 0;
}
function cekLevel($level)
{
	switch ($level) {
		case 1:
			$a = "Admin";
			break;
		case 2:
			$a = "Kasir";
			break;
		case 3:
			$a = "Koki";
			break;
		case 4:
			$a = "Keuangan";
			break;
	}
	return $a;
}

###For Single Searching###

//array to translate the search type
$ops = array(
	'eq' => '=', //equal
	'ne' => '<>', //not equal
	'lt' => '<', //less than
	'le' => '<=', //less than or equal
	'gt' => '>', //greater than
	'ge' => '>=', //greater than or equal
	'bw' => 'LIKE', //begins with
	'bn' => 'NOT LIKE', //doesn't begin with
	'in' => 'LIKE', //is in
	'ni' => 'NOT LIKE', //is not in
	'ew' => 'LIKE', //ends with
	'en' => 'NOT LIKE', //doesn't end with
	'cn' => 'LIKE', // contains
	'nc' => 'NOT LIKE'  //doesn't contain
);
function getWhereClause($col, $oper, $val)
{
	global $ops;
	if ($oper == 'bw' || $oper == 'bn') $val .= '%';
	if ($oper == 'ew' || $oper == 'en') $val = '%' . $val;
	if ($oper == 'cn' || $oper == 'nc' || $oper == 'in' || $oper == 'ni') $val = '%' . $val . '%';
	return " WHERE $col {$ops[$oper]} '$val' ";
}
