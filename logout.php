<?php
	session_start();
	if(isset($_SESSION['login'])) $login = $_SESSION['login']; else $login = "index.php";
	unset($_SESSION['username']);
	unset($_SESSION['namauser']);
	unset($_SESSION['idu']);
	unset($_SESSION['bearer_id']);
	unset($_SESSION['idpengguna']);
	unset($_SESSION['peran']);
	unset($_SESSION['namaperan']);
	unset($_SESSION['sesi']);
	session_destroy();
	header("location:$login")
?>
