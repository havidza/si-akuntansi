<?php 
include_once "../../config/db.koneksi_pdo.php";
include_once "../../config/db.function_pdo.php";
include_once "../../config/library.php";

if(isset($_REQUEST['module']))$module = $_REQUEST['module']; else $module = "";
if(isset($_REQUEST['oper']))$oper = $_REQUEST['oper']; else $oper = "";
if(isset($_REQUEST['id_user']))$id_userz = $_REQUEST['id_user']; else $id_userz = "";

$time = date("H:i:s");
$datetime = date("Y-m-d H:i:s");

$no_rek = isset($_REQUEST['no_rek']) ? $_REQUEST['no_rek'] : "";
$nama_rek = isset($_REQUEST['nama_rek']) ? $_REQUEST['nama_rek'] : "";
$deskripsi_rek = isset($_REQUEST['deskripsi_rek']) ? $_REQUEST['deskripsi_rek'] : "";
$jenis_rek = isset($_REQUEST['jenis_rek']) ? $_REQUEST['jenis_rek'] : "";

switch($oper){
    case 'add':
        try {
            $DBcon->beginTransaction();

            $ins = $DBcon->prepare("INSERT INTO tb_rekening (nama_rek, deskripsi_rek, jenis_rek)
                                        VALUES (?, ?, ?)");
            $ins->execute(array($nama_rek, $deskripsi_rek, $jenis_rek));

            $DBcon->commit();
            echo json_encode(array('success' => true, 'pesan' => "Berhasil Menambah Rekening !"));
        } catch (PDOException $e) {
            $DBcon->rollBack();
            echo json_encode(array('success' => false, 'pesan' => "Gagal Menambah Rekening !", 'error' => $e->getMessage()));
        }
    break;

    case 'edit':
        try{
            $DBcon->beginTransaction();

            $upd = $DBcon->prepare("UPDATE tb_rekening SET nama_rek = '$nama_rek',
                                                            deskripsi_rek = '$deskripsi_rek',
                                                            jenis_rek = '$jenis_rek'
                                            WHERE no_rek = '$no_rek'");
            $upd->execute();

            $DBcon->commit();
            echo json_encode(array('success' => true, 'pesan' => "Data Berhasil Diubah !"));
        } catch (PDOException $e) {
            $DBcon->rollBack();
            echo json_encode(array('success' => false, 'pesan' => "Gagal Mengubah Data !", 'error' => $e->getMessage()));
        }
    break;

    case 'del':
        $no_rek = isset($_REQUEST['no_rek']) ? $_REQUEST['no_rek'] : "";
        try {
            $DBcon->beginTransaction();

            $del = $DBcon->prepare("DELETE FROM tb_rekening WHERE no_rek = '$no_rek'");
            $del->execute();

            $DBcon->commit();
            echo json_encode(array('success' => true, 'pesan' => "Data Berhasil Dihapus !"));
        } catch (PDOException $e) {
            $DBcon->rollBack();
            echo json_encode(array('success' => false, 'pesan' => "Gagal Menghapus Data !", 'error' => $e->getMessage()));
        }
    break;
}

?>