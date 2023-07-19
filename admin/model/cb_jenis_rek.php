<?php 
    include_once "../../config/db.koneksi_pdo.php";

    $clause = "SELECT * FROM tb_rekening";

    $rs = $DBcon->prepare($clause);
    $rs->execute();
    if($rs){
        echo "<option value=''>--Pilih Jenis Rekening--</option>";
        while($row = $rs->fetch(PDO::FETCH_ASSOC)){
            echo "<option value='".$row['no_rek']."'>".$row['nama_rek']."</option>";
        }
    }
?>