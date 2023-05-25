<?php
include_once "db.koneksi_pdo.php";
include_once "library.php"; 
session_start(); 


if (session_status() == PHP_SESSION_NONE) session_start();

if(isset($_SESSION['username'])) $uname = $_SESSION['username'];
else $uname = "XXX";
$stmt = $DBcon->prepare("SELECT * FROM tb_user WHERE username_user = '$uname'");
$stmt->execute();
$data = $stmt->fetch(PDO::FETCH_ASSOC);
//$ketemu=mysql_num_rows($login);
if(isset($_SESSION['idpengguna'])) $idpengguna = $_SESSION['idpengguna'];
else $idpengguna = "XXX";
if(md5($data['id_user'])!=$idpengguna){
		echo "<script type=\"text/javascript\">
		alert(\"Maaf anda tidak diijinkan masuk ke situs ini, silahkan login dengan benar! \");
		window.location.href=('../index.php');
		</script>";
}


function cekUser(PDO $DBcon){
	if (session_status() == PHP_SESSION_NONE) session_start();
	
	if(isset($_SESSION['username'])) $uname = $_SESSION['username'];
	// if(isset($_SESSION['namauser'])) $namauser = $_SESSION['namauser'];
	else $uname = "XXX";
	// $stmt = $DBcon->prepare("SELECT * FROM tb_user WHERE nama_user = '$namauser'");
	$stmt = $DBcon->prepare("SELECT * FROM tb_user WHERE username_user = '$uname'");
	$stmt->execute();
	$data = $stmt->fetch(PDO::FETCH_ASSOC);
	//$ketemu=mysql_num_rows($login);
	if(isset($_SESSION['idpengguna'])) $idpengguna = $_SESSION['idpengguna'];
	else $idpengguna = "XXX";
	if(md5($data['id_user'])!=$idpengguna){
			echo "<script type=\"text/javascript\">
			alert(\"Maaf anda tidak diijinkan masuk ke situs ini, silahkan login dengan benar! \");
			window.location.href=('../index.php');
			</script>";
	}
	/* if($ketemu==0){
		echo "<script type=\"text/javascript\">
		alert(\"Anda belum login, silahkan login!\");
		window.location.href=('../index.php');
		</script>";
	} */
	return array('user' => $data['id_user'], 'level' => md5($data['group_user']) );
}
function cekUser2(PDO $DBcon){
	if (session_status() == PHP_SESSION_NONE) session_start();
	
	if(isset($_SESSION['username'])) $uname = $_SESSION['username'];
	else $uname = "XXX";
	$stmt = $DBcon->prepare("SELECT * FROM tb_user WHERE username_user = '$uname'");
	$stmt->execute();
	$data = $stmt->fetch(PDO::FETCH_ASSOC);
	//$ketemu=mysql_num_rows($login);
	if(isset($_SESSION['idpengguna'])) $idpengguna = $_SESSION['idpengguna'];
	else $idpengguna = "XXX";
	if(md5($data['id_user'])!=$idpengguna){
			echo "<script type=\"text/javascript\">
			alert(\"Maaf anda tidak diijinkan masuk ke situs ini, silahkan login dengan benar! \");
			window.location.href=('../index.php');
			</script>";
	}
	/* if($ketemu==0){
		echo "<script type=\"text/javascript\">
		alert(\"Anda belum login, silahkan login!\");
		window.location.href=('../index.php');
		</script>";
	} */
	return array('user' => $data['id_user'], 'level' => md5($data['group_user']) );
}

function salt($kata){
	$kata = addslashes($kata);
	$res = preg_replace("/[^*;\"=<>]/", "", $kata);
	if(strlen($res)>0){
			echo "<script type=\"text/javascript\">
			alert(\"I told you .... Be Angel...!\");
			window.location.href=('../index.php');
			</script>";
			$kata = "";
			return $kata;
	}else{
			return $kata;
	}
}

?>