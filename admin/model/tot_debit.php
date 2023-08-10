<?php
    require_once "../../config/db.koneksi_pdo.php";
    require_once "../../config/library.php";

    $tot_debit = 0;
    $rek = $DBcon->query("SELECT no_rek FROM tb_rekening WHERE jenis_rek = '1'");
    while($row = $rek->fetch(PDO::FETCH_ASSOC)){
        $data = $DBcon->query("SELECT SUM(nominal) AS jml FROM tb_pendataan WHERE jenis = '$row[no_rek]'");
        $data = $data->fetch(PDO::FETCH_ASSOC);
        $tot_debit += $data['jml'];
    }
    echo "Rp.".number_format($tot_debit, 2, ',', '.');
?>