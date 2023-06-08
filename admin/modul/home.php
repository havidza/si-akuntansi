<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="row justify-content-center">
            <div class="col-sm-12 text-center">
                <h3>Pendataan Sampai Tanggal <?php echo date("d-m-Y") ?></h3>
                <hr>
                <table class="table" style="margin: auto; width: 50%;">
                    <tr>
                        <th style="border: 1px solid #858796; padding: 5px;">No</th>
                        <th style="border: 1px solid #858796; padding: 5px 10px;">Jenis Pendataan</th>
                        <th style="border: 1px solid #858796; padding: 5px 10px;">Total Pendataan</th>
                    </tr>
                    <?php
                        $th1 = date("Y")."-01-01";
                        $now = date("Y-m-d")." 23:59:59";
                        $q = $DBcon->prepare("SELECT SUM(nominal) as p FROM tb_pendataan 
                                                        WHERE jenis = ? AND tgl_entri >= ? AND tgl_entri <= ? AND nominal IS NOT NULL");
                        $q->execute(array('1', $th1, $now));
                        $p1 = $q->fetch(PDO::FETCH_ASSOC);
                        $q->execute(array('2', $th1, $now));
                        $p2 = $q->fetch(PDO::FETCH_ASSOC);
                        $q->execute(array('3', $th1, $now));
                        $p3 = $q->fetch(PDO::FETCH_ASSOC);
                    ?>
                    <script>
                        
                    </script>
                    <tr>
                        <td style="border: 1px solid #858796; padding: 5px;">1. </td>
                        <td style="border: 1px solid #858796; padding: 5px; text-align: left;">Pemasukan </td>
                        <td style="border: 1px solid #858796; text-align: right;"><?php echo number_format($p1['p'],0,",","."); ?></td>
                    </tr>
                    <tr>
                        <td style="border: 1px solid #858796; padding: 5px;">2. </td>
                        <td style="border: 1px solid #858796; padding: 5px; text-align: left;">Pengeluaran </td>
                        <td style="border: 1px solid #858796; text-align: right;"><?php echo number_format($p2['p'],0,",","."); ?></td>
                    </tr>
                    <tr>
                        <td style="border: 1px solid #858796; padding: 5px;">3. </td>
                        <td style="border: 1px solid #858796; padding: 5px; text-align: left;">Asset</td>
                        <td style="border: 1px solid #858796; text-align: right;"><?php echo number_format($p3['p'],0,",","."); ?></td>
                    </tr>
                </table><br>
            </div>
        </div>      
    </div>
</div>
<script>
    // $(function(){
    //     $.ajax({
    //         url: "admin/model/home.php",
    //         method: "POST",
    //         success: function(result){
    //             console.log(result);
    //         }
    //     });
    // })
</script>