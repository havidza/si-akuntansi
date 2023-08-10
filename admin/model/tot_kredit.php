<?php
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
    ini_set('display_starup_errors', 1);

    require_once "../../config/db.koneksi_pdo.php";
    require_once "../../config/library.php";

    $tot_kredit = 0;
    $rek = $DBcon->prepare("SELECT no_rek FROM tb_rekening WHERE jenis_rek = '2'");
    if($rek->execute()){
        while($row = $rek->fetch(PDO::FETCH_ASSOC)){
            $data = $DBcon->query("SELECT SUM(nominal) AS jml FROM tb_pendataan WHERE jenis = '$row[no_rek]'");
            $data = $data->fetch(PDO::FETCH_ASSOC);
            $tot_kredit += $data['jml'];
        }
    }
    echo "Rp.".number_format($tot_kredit, 2, ',', '.');
?>