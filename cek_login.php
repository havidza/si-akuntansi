<?php

require_once "config/db.koneksi_pdo.php";
require_once "config/db.function_pdo.php";

$ip = $_SERVER['REMOTE_ADDR'];

$username = isset($_POST['uname2']) ? $_POST['uname2'] : '';
$password = isset($_POST['password2']) ? $_POST['password2'] : '';

$query = "SELECT * FROM tb_user WHERE username_user = ? and password_user = ? ";
$param = array($username, $password);
$stmt = $DBcon->prepare($query);

if ($stmt->execute($param)) {
	$r = $stmt->fetch(PDO::FETCH_ASSOC);
	if ($r) {
		session_start();

		$_SESSION['username'] = $r['username_user'];
		$_SESSION['namauser'] = $r['nama_user'];
		// $_SESSION['email'] = $r['email_user'];
		// $_SESSION['hp'] = $r['phone_user'];
		// $_SESSION['nik'] = $r['nik'];
		// $_SESSION['alamat'] = $r['alamat_user'];
		$_SESSION['idu'] = $r['id_user'];
		$_SESSION['bearer_id'] = $r['bearer_id'];
		$_SESSION['idpengguna'] = md5($r['id_user']);
		$_SESSION['peran'] = md5($r['group_user']);

		if ($r['group_user'] == 100) {
			$_SESSION['namaperan'] = "Admin";
		} elseif ($r['group_user'] == 101) {
			$_SESSION['namaperan'] = "Direktur";
		}

		if ($r["group_user"] == 101) {
			header("location:media.php?modul=dashboard"); //Direktur
		} else {
			header("location:media.php?modul=dashboard");
		}
	} else {
		echo "<script>alert('Username atau Password salah !');location.href='index.php';</script>";
		// echo "<script>alert('Username $username atau Password $password salah !');</script>";
	}
}
