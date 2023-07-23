<?php
error_reporting(E_ALL);
ini_set('display_errors', FALSE);
ini_set('display_startup_errors', FALSE);

if(PHP_SAPI == 'cli') die('This example should only be run from a web browser');

require_once "../../assets/phpexcel/PHPExcel.php";
require_once "../../config/db.koneksi_pdo.php";
require_once "../../config/library.php";

$awal   = isset($_REQUEST['awal']) ? $_REQUEST['awal'] : '';
$akhir  = isset($_REQUEST['akhir']) ? $_REQUEST['akhir'] : '';
$filter = "";

if($awal != ''){
    $awal = balikTanggal($awal);
    $a = " AND ";
}
if($akhir != ''){
    $akhir = balikTanggal($akhir);
}
if($awal != '' && $akhir != ''){

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


?>