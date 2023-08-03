<?php
    error_reporting(E_ALL);
    ini_set('display_errors', TRUE);
    ini_set('display_startup_errors', TRUE);
    ini_set('max_execution_time', 6000);
    ini_set('memory_limit', '-1');

    if(PHP_SAPI == 'cli') die('This example should only be run from a web browser');

    require_once "../../assets/phpexcel/PHPExcel.php";
    require_once "../../config/db.koneksi_pdo.php";
    require_once "../../config/library.php";

    $awal   = isset($_REQUEST['awal']) ? $_REQUEST['awal'] : '';
    $akhir  = isset($_REQUEST['akhir']) ? $_REQUEST['akhir'] : '';
    $thn    = date("Y");
    $filter = "";

    if($awal != ''){
        $awal_bl = balikTanggal($awal);
    }
    if($akhir != ''){
        $akhir_bl = balikTanggal($akhir);
    }
    if($awal != '' && $akhir != ''){
        $filter .= " AND tgl_kasus >= '$awal_bl' AND tgl_kasus <= '$akhir_bl' ";
        $per = "Periode $awal s/d $akhir";
    }else{
        $thn_awal = $thn."-01-01";
        $thn_akhir = $thn."-12-31";
        $filter .= " AND tgl_kasus >= '$thn_awal' AND tgl_kasus <= '$thn_akhir' ";
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

    $objPHPExcel = PHPExcel_IOFactory::load('../template/template_buku_besar.xlsx');

    $clause = "SELECT * FROM tb_rekening";
    $rs = $DBcon->prepare($clause);
    $rs->execute();

    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A3', $per);

    $baris = 6; $no = 1; $debit = 0; $kredit = 0; $saldo = 0;
    while($rek = $rs->fetch(PDO::FETCH_ASSOC)){
        $dt = $DBcon->prepare("SELECT * FROM tb_pendataan WHERE jenis = '$rek[no_rek]' $filter");
        $rs->execute();
        $r = $rs->rowCount();
        if($r>0){
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A'.$baris, "Rek ".$rek['no_rek'])
                                                ->setCellValue('B'.$baris, $rek['nama_rek']);
            $objPHPExcel->getActiveSheet()->getStyle("A$baris:B$baris")->getFont()->setBold(true);
            $baris++;
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A'.$baris, "Tanggal")
                                                ->setCellValue('B'.$baris, "Keterangan")
                                                ->setCellValue('C'.$baris, "Debit")
                                                ->setCellValue('D'.$baris, "Kredit")
                                                ->setCellValue('E'.$baris, "Saldo");
            $objPHPExcel->getActiveSheet()->getStyle("A$baris:E$baris")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
            $objPHPExcel->getActiveSheet()->getStyle("A$baris:E$baris")->getFont()->setBold(true);
            $baris++;
            while($data = $dt->fetch(PDO::FETCH_ASSOC)){
                $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A'.$baris, $data['tgl_kasus'])
                                                    ->setCellValue('B'.$baris, $data['judul']);
                if($rek['jenis_rek']==1){
                    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('C'.$baris, number_format($data['nominal'], 2, ',', '.'));
                    $saldo += $data['nominal'];
                }elseif($rek['jenis_rek']==2){
                    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('D'.$baris, number_format($data['nominal'], 2, ',', '.'));
                    $saldo -= $data['nominal'];
                }
                $objPHPExcel->setActiveSheetIndex(0)->setCellValue('E'.$baris, number_format($saldo, 2, ',', '.'));
                $baris++;
            }
            $baris++;
        }
    }
    $baris--;

    $objPHPExcel->getActiveSheet()->getStyle("A5:E$baris")->applyFromArray($style1);

    $tgl = date("YmdHis");

    foreach(glob("../xls/Laporan_buku_besar_*.*") as $filename){
        if(strpos($filename, $tgl)===false){
            unlink($filename);
        }
    }

    $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
    $objWriter->save("../xls/Laporan_buku_besar_".$tgl.".xlsx");

    echo $tgl;
    exit;
?>