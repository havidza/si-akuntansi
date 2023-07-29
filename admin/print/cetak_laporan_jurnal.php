<?php
error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);

if(PHP_SAPI == 'cli') die('This example should only be run from a web browser');

require_once "../../assets/phpexcel/PHPExcel.php";
require_once "../../config/db.koneksi_pdo.php";
require_once "../../config/library.php";

$awal   = isset($_REQUEST['awal']) ? $_REQUEST['awal'] : '';
$akhir  = isset($_REQUEST['akhir']) ? $_REQUEST['akhir'] : '';
$thn    = date('Y');
$filter = "";

if($awal != ''){
    $awal_bl = balikTanggal($awal);
}
if($akhir != ''){
    $akhir_bl = balikTanggal($akhir);
}
if($awal != '' && $akhir != ''){
    $filter .= " AND t1.tgl_kasus >= '$awal_bl' AND t1.tgl_kasus <= '$akhir_bl' ";
    $per = "Periode $awal s/d $akhir";
}else{
    $thn_awal   = $thn."-01-01";
    $thn_akhir  = $thn."-12-31";
    $filter .= " AND t1.tgl_kasus >= '$thn_awal' AND t1.tgl_kasus <= '$thn_akhir' ";
    $per = "Periode tahun $thn";
}

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

$objPHPExcel = PHPExcel_IOFactory::load('../template/template_laporan_jurnal.xlsx');

$clause = "SELECT t1.*, t2.nama_rek AS nm_rekening, t2.jenis_rek AS jns_rekening FROM tb_pendataan t1
                LEFT JOIN tb_rekening t2 ON t1.jenis = t2.no_rek
                    WHERE t1.id_pendataan IS NOT NULL $filter";
$rs = $DBcon->prepare($clause);
$rs->execute();

$objPHPExcel->setActiveSheetIndex(0)->setCellValue('A3', $per);

$baris = 6; $no = 1; $debit = 0; $kredit = 0;
while($row = $rs->fetch(PDO::FETCH_ASSOC)){
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A'.$baris, date("d F", strtotime($row['tgl_kasus'])))
                                        ->setCellValue('B'.$baris, $row['judul'])
                                        ->setCellValue('C'.$baris, $row['nm_rekening']);
    if($row['jns_rekening']==1){
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('D'.$baris, number_format($row['nominal'], 2, ',', '.'));
        $debit += $row['nominal'];
    }elseif($row['jns_rekening']==2){
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('E'.$baris, number_format($row['nominal'], 2, ',', '.'));
        $kredit += $row['nominal'];
    }
    $baris++;$no++;
}
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('A'.$baris, "JUMLAH")
                                    ->mergeCells("A$baris:C$baris")
                                    ->setCellValue('D'.$baris, number_format($debit, 2, ',', '.'))
                                    ->setCellValue('E'.$baris, number_format($kredit, 2, ',', '.'));

$objPHPExcel->getActiveSheet()->getStyle("A5:E$baris")->applyFromArray($style1);

$tgl = date("YmdHis");

foreach(glob("../xls/Laporan_jurnal_umum_*.*") as $filename){
    if(strpos($filename, $tgl)===false){
        unlink($filename);
    }
}

$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
$objWriter->save("../xls/Laporan_jurnal_umum_".$tgl.".xlsx");

echo $tgl;
exit;

?>