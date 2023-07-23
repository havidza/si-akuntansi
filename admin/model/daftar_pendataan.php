<?php
    require_once "../../config/db.koneksi_pdo.php";
    require_once "../../config/db.function_pdo.php";
    require_once "../../config/library.php";

    $id_data = isset($_GET['id_data']) ? $_GET['id_data'] : "";

    $filter = "";
    if($id_data != ""){
        $filter .= " AND t1.id_pendataan = '$id_data' ";
    } else {
        $filter .= "";
    }

    $clause = "SELECT t1.*, t2.nama_rek AS nm_jenis FROM tb_pendataan t1 
                LEFT JOIN tb_rekening t2 ON t1.jenis = t2.no_rek 
                WHERE t1.tgl_entri IS NOT NULL $filter";
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
        $row['aksi'] = '
        <span onClick="hapusData('."'".$row["id_pendataan"]."'".')" style="cursor:pointer" class="btndel tip" data-toggle="tooltip" title="Hapus">&nbsp;<i class="fa fa-trash"></i>;</span>
        &nbsp;
        <span onClick="ubahData('."'".$row["id_pendataan"]."'".')" style="cursor:pointer" class="btnedit tip" data-toggle="tooltip" title="Edit">&nbsp;<i class="fa fa-pen"></i>&nbsp;</span>';

        if($row['lampiran'] != NULL){
            $row['file'] = "<a href='./admin/file/$row[lampiran]' target='_blank'>File Lampiran</a>";
        }else{
            $row['file'] = "Tidak Ada";
        }
        $no++;
        array_push($items, $row);
    }
    $result['result'] = $items;

    echo json_encode($result);
?>