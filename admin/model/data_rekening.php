<?php
    require_once "../../config/db.koneksi_pdo.php";
    require_once "../../config/db.function_pdo.php";
    require_once "../../config/library.php";

    $no_rek = isset($_GET['no_rek']) ? $_GET['no_rek'] : "";
    $urut = isset($_GET['urut']) ? $_GET['urut'] : "";
    $limit = isset($_GET['limit']) ? $_GET['limit'] : "";

    $filter = "";
    if($no_rek != ""){
        $filter .= " AND no_rek = '$no_rek' ";
    } else {
        $filter .= "";
    }

    $clause = "SELECT * FROM tb_rekening WHERE no_rek IS NOT NULL $filter";
    $result = array();

    $rs = $DBcon->prepare($clause);
    $rs->execute();
    $r = $rs->rowCount();
    $items = array();
    $no = 1;

    while($row = $rs->fetch(PDO::FETCH_ASSOC)){
        $row["aksi_rek"] = '
        <span onClick="hapusData('."'".$row["no_rek"]."'".')" style="cursor:pointer" class="btndel tip" data-toggle="tooltip" title="Hapus">&nbsp;<i class="fa fa-trash"></i>&nbsp;</span>
        &nbsp;
        <span onClick="ubahData('."'".$row["no_rek"]."'".')" style="cursor:pointer" class="btnedit tip" data-toggle="tooltip" title="Edit">&nbsp;<i class="fa fa-pen"></i>&nbsp;</span>';

        if($row['jenis_rek']==1){
            $row['jenis'] = "Debit";
        }elseif($row['jenis_rek']==2){
            $row['jenis'] = "Kredit";
        }

        $no++;
        array_push($items, $row);
    }

    $result['result'] = $items;

    echo json_encode($result);
?>