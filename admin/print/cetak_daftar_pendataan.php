<?php
error_reporting(E_ALL);
ini_set('display_errors', FALSE);
ini_set('display_startup_errors', FALSE);

if(PHP_SAPI == 'cli') die('This example should only be run from a web browser');

require_once "../../assets/phpexcel/PHPExcel.php";
require_once "../../config/db.koneksi_pdo.php";
require_once "../../config/library.php";

$filter = "";

$style1 = array(
    'borders' => array(
        'allborders' => array(
            'style' => PHPExcel_Style_Border::BORDER_THIN
        )
    )
);

$style2 = array(
    'borders' => array(
        'bottom' => array(
        'style' => PHPExcel_Style_Border::BORDER_MEDIUM
        )
    )
);

$style3 = array(
    'borders' => array(
        'vertical' => array(
            'style' => PHPExcel_Style_Border::BORDER_THIN
        ),
        'outline' => array(
            'style' => PHPExcel_Style_Border::BORDER_THIN
        )
    )
);

$style4 = array(
    'borders' => array(
        'outline' => array(
            'style' => PHPExcel_Style_Border::BORDER_THIN
        )
    )
); 

$objPHPExcel = PHPExcel_IOFactory::load('../template/template_daftar_pendataan.xlsx');

$clause = "SELECT t1.*, t2.nama_rek AS nm_rekening FROM tb_pendataan t1
                LEFT JOIN tb_rekening t2 ON t1.jenis = t2.no_rek
                    WHERE t1.id_pendataan IS NOT NULL $filter";

$rs = $DBcon->prepare($clause);
$rs->execute();

$baris = 5; $no = 1;
while($row = $rs->fetch(PDO::FETCH_ASSOC)){
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A'.$baris, $no)
                                        ->setCellValue('B'.$baris, $row['judul'])
                                        ->setCellValue('C'.$baris, $row['nm_rekening'])
                                        ->setCellValue('D'.$baris, balikTanggalIndo($row['tgl_kasus']))
                                        ->setCellValue('E'.$baris, balikTanggalJamIndo($row['tgl_entri']))
                                        ->setCellValue('F'.$baris, $row['deskripsi'])
                                        ->setCellValue('G'.$baris, number_format($row['nominal'], 2, ',', '.'));

    $baris++;
    $no++;    
}
$baris--;
$objPHPExcel->getActiveSheet()->getStyle("A4:G$baris")->applyFromArray($style1);

$tgl = date("YmdHis");

foreach(glob("../xls/Laporan_daftar_pendataan_*.*") as $filename){
    if(strpos($filename, $tgl)===false){
        unlink($filename);
    }
}

$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
$objWriter->save("../xls/Laporan_daftar_pendataan_".$tgl.".xlsx");

echo $tgl;
exit;
?>