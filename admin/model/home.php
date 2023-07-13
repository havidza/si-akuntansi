<?php
    include_once "../../config/db.koneksi_pdo.php";
    include_once "../../config/db.function_pdo.php";
    include_once "../../config/library.php";

    error_reporting(E_ALL); ini_set('display_errors', 'ON');
    
    // $th1 = date("Y")."-01-01";
    // $now = date("Y-m-d");
    // $q = $DBcon->prepare("SELECT SUM(nominal) as p FROM tb_pendataan 
    //                                 WHERE jenis = ? AND tgl_entri >= ? AND tgl_entri <= ? AND nominal IS NOT NULL");
    // $q->execute(array('1', $th1, $now));
    // $p1 = $q->fetch(PDO::FETCH_ASSOC);
    // $q->execute(array('2', $th1, $now));
    // $p2 = $q->fetch(PDO::FETCH_ASSOC);
    // $q->execute(array('3', $th1, $now));
    // $p3 = $q->fetch(PDO::FETCH_ASSOC);

    // print_r($p1);

    $th1 = date("Y")."-01-01";
                            $saiki = date("Y-m-d")." 23:59:59";
                            $q = $DBcon->prepare("SELECT SUM(nominal) as p
                                                FROM 
                                                    tb_pendataan 
                                                WHERE
                                                    jenis = ? AND
                                                    tgl_entri >= ? AND
                                                    tgl_entri <= ? AND
                                                    nominal IS NOT NULL");
                                                            
                            $q->execute(array('1', $th1, $saiki));
                            $p1	= $q->fetch(PDO::FETCH_ASSOC);
                            $q->execute(array('2', $th1, $saiki));
                            $p2	= $q->fetch(PDO::FETCH_ASSOC);
                            $q->execute(array('3', $th1, $saiki));
                            $p3	= $q->fetch(PDO::FETCH_ASSOC);

                            print_r($p1);
?>