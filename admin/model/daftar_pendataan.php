<?php
    require_once "../../config/db.koneksi_pdo.php";
    require_once "../../config/db.function_pdo.php";
    require_once "../../config/library.php";

    $clause = "SELECT * FROM tb_pendataan WHERE tgl_entri IS NOT NULL";
    $result = array();

    $rs = $DBcon->prepare($clause);
    $rs->execute();
    $r = $rs->rowCount();
    $items = array();
    $no = 1;
    while($row = $rs->fetch(PDO::FETCH_ASSOC)){
        $row['no'] = $no;
        $row['tgl_kasus'] = balikTanggalIndo($row['tgl_kasus']);
        $row['tgl_entri'] = balikTanggalJamIndo($row['tgl_entri']);

        if($row['jenis'] == 1){
            $row['jenis'] = "Pemasukan";
        }elseif($row['jenis'] == 2){
            $row['jenis'] = "Pengeluaran";
        }elseif($row['jenis'] == 3){
            $row['jenis'] = "Asset";
        }else{
            $row['jenis'] = "";
        }

        $no++;
        array_push($items, $row);
    }
    $result['result'] = $items;

    echo json_encode($result);
?>