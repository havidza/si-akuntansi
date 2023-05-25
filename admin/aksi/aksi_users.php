<?php
include_once "../../config/db.koneksi_pdo.php";
include_once "../../config/db.function_pdo.php";
include_once "../../config/library.php";

if (isset($_REQUEST['module'])) $module = $_REQUEST['module'];
else $module = "";
if (isset($_REQUEST['oper'])) $act = $_REQUEST['oper'];
else $act = "";
if (isset($_REQUEST['id_user'])) $id_userz = $_REQUEST['id_user'];
else $id_userz = "";

$time = date("H:i:s");
$date = strtotime(date("Y-m-d H:i:s"));

if (isset($_REQUEST['id_user'])) $id_user = $_REQUEST['id_user'];
if (isset($_REQUEST['nama_user'])) $nama_user = $_REQUEST['nama_user'];
if (isset($_REQUEST['alamat_user'])) $alamat_user = $_REQUEST['alamat_user'];
if (isset($_REQUEST['phone_user'])) $phone_user = $_REQUEST['phone_user'];
if (isset($_REQUEST['username_user'])) $username_user = $_REQUEST['username_user'];
if (isset($_REQUEST['group_user'])) $group_user = $_REQUEST['group_user'];
if (isset($_REQUEST['password_user'])) $password_user = $_REQUEST['password_user'];
if (isset($_REQUEST['re_password'])) $re_password = $_REQUEST['re_password'];
if (isset($_REQUEST['kd_kel'])) $kd_kel = $_REQUEST['kd_kel'];

switch ($act) {
    case 'add':
        try {
            $DBcon->beginTransaction();

            $ins = $DBcon->prepare("INSERT INTO tb_user (nama_user, alamat_user, phone_user, username_user, group_user, password_user) VALUES
				(?, ?, ?, ?, ?, ?)");
            $ins->execute(array($nama_user, $alamat_user, $phone_user, $username_user, $group_user, $password_user));

            $DBcon->commit();
            echo json_encode(array('success' => true, 'pesan' => "Berhasil Menambah User !"));
        } catch (PDOException $e) {
            $DBcon->rollback();
            echo json_encode(array('success' => false, 'pesan' => "Tidak Berhasil Menambah User !", 'error' => $e->getMessage()));
        }
        break;

    case 'edit':
        try {
            $DBcon->beginTransaction();

            $ins = $DBcon->prepare("UPDATE tb_user SET nama_user ='$nama_user', alamat_user = '$alamat_user', phone_user = '$phone_user', username_user = '$username_user', group_user = '$group_user', password_user = '$password_user'  WHERE id_user = '$id_user'");
            $ins->execute();

            $DBcon->commit();
            echo json_encode(array('success' => true, 'pesan' => " Data Berhasil Diubah !"));
        } catch (PDOException $e) {
            $DBcon->rollback();
            echo json_encode(array('success' => false, 'pesan' => "Tidak Dapat Mengubah Data !", 'error' => $e->getMessage()));
        }
        break;

    case 'del':
        if (isset($_REQUEST['id_user'])) $id_user = $_REQUEST['id_user'];
        try {
            $DBcon->beginTransaction();

            $ins = $DBcon->prepare("DELETE FROM tb_user
							WHERE id_user = '$id_user'");
            $ins->execute();

            $DBcon->commit();
            echo json_encode(array('success' => true, 'pesan' => " Data Berhasil Dihapus !"));
        } catch (PDOException $e) {
            $DBcon->rollback();
            echo json_encode(array('success' => false, 'pesan' => "Tidak Dapat Mengahapus data !", 'error' => $e->getMessage()));
        }
        break;
}
