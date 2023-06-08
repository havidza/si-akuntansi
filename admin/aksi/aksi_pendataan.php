<?php
    include_once "../../config/db.koneksi_pdo.php";
    include_once "../../config/db.function_pdo.php";
    include_once "../../config/library.php";

    error_reporting(E_ALL); ini_set('display_errors', 'OFF');

    session_start();

    if(isset($_REQUEST['oper'])) $oper = $_REQUEST['oper']; else $oper = "";
    if(isset($_REQUEST['tgl_entri'])) $tgl_entri = $_REQUEST['tgl_entri']; else $tgl_entri = "";
    if(isset($_REQUEST['judul'])) $judul = $_REQUEST['judul']; else $judul = "";
    if(isset($_REQUEST['jenis'])) $jenis = $_REQUEST['jenis']; else $jenis = "";
    if(isset($_REQUEST['nominal'])) $nominal = $_REQUEST['nominal']; else $nominal = "";
    if(isset($_REQUEST['tgl_kasus'])) $tgl_kasus = $_REQUEST['tgl_kasus']; else $tgl_kasus = "";
    if(isset($_REQUEST['deskripsi'])) $deskripsi = $_REQUEST['deskripsi']; else $deskripsi = "";

    if($tgl_kasus!=""){
        $tgl_kasus = date("Y-m-d", strtotime($tgl_kasus));
    } else $tgl_kasus = NULL;
    
    $datetime = date("Y-m-d H:i:s");
    $date = date("Y-m-d");

    switch($oper) {
        case 'entry':
            try {
                $DBcon->beginTransaction();

                if(!empty($_FILES['lampiran']['name'])){
                    $filetype = pathinfo($_FILES['lampiran']['name'], PATHINFO_EXTENSION);
                    if($filetype!='') $file = 'file_'.$date.'.'.$filetype;
                    else $file = '';

                    $allowedExts = array("pdf","PDF","jpg","png","jpeg","JPG","PNG","xls","xlsx","doc","docx","txt", "mp4");
                    $extension = substr(strrchr($_FILES['lampiran']['name'], '.'), 1);

                    if ((($_FILES['lampiran']['type'] == "image/jpg")
						||($_FILES['lampiran']['type'] == "image/JPG")
						||($_FILES['lampiran']['type'] == "image/jpeg")
						||($_FILES['lampiran']['type'] == "application/PDF")
						||($_FILES['lampiran']['type'] == "application/pdf")
						||($_FILES['lampiran']['type'] == "application/vnd.ms-excel")
						||($_FILES['lampiran']['type'] == "application/vnd.ms-word")
						||($_FILES['lampiran']['type'] == "application/msword")
						||($_FILES['lampiran']['type'] == "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet")
						||($_FILES['lampiran']['type'] == "application/vnd.openxmlformats-officedocument.wordprocessingml.document")
						||($_FILES['lampiran']['type'] == "image/png")
						||($_FILES['lampiran']['type'] == "image/PNG")
						||($_FILES['lampiran']['type'] == "video/mp4")
						||($_FILES['lampiran']['type'] == "text/plain"))
						&& ($_FILES['lampiran']['size'] < 60000000)
						&& in_array($extension, $allowedExts))
					{
						move_uploaded_file($_FILES['lampiran']['tmp_name'], "../file/".$file);
					}else{
						echo json_encode(array('success'=>false, 'pesan'=>"File lampiran tidak sesuai format !"));
						break;
					}
                }

                if($file=='') $file = NULL;

                $ins = $DBcon->prepare("INSERT INTO tb_pendataan (judul, jenis, tgl_kasus, nominal, deskripsi, lampiran, tgl_entri)
                                VALUES (?, ?, ?, ?, ?, NOW())");
                $ins->execute(array($judul, $jenis, $tgl_kasus, $nominal, $deskripsi, $file));

                $DBcon->commit();
                echo json_encode(array('success' => true, 'pesan' => "Berhasil simpan entri pendataan !"));
            } catch (PDOException $e) {
                $DBcon->rollBack();
                echo json_encode(array('success' => false, 'pesan' => "Gagal simpan entri pendataan !", 'error' => $e->getMessage()));
            }
        break;
    }
?>