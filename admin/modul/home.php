<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="row justify-content-center">
            <div class="col-sm-12 text-center">
                <h3>Pendataan Sampai Tanggal <?php echo date("d-m-Y") ?></h3>
                <hr>
                <table class="table" style="margin: auto; width: 50%;">
                    <tr>
                        <th style="border: 1px solid #858796; padding: 5px;">No</th>
                        <th style="border: 1px solid #858796; padding: 5px 10px;">Jenis Rekening</th>
                        <th style="border: 1px solid #858796; padding: 5px 10px;">Total Pendataan</th>
                    </tr>
                    <?php
                        $th1 = date("Y")."-01-01";
                        $now = date("Y-m-d")." 23:59:59";
                        $no = 1;
                        $jns = $DBcon->query("SELECT no_rek, nama_rek FROM tb_rekening");
                        while($jenis = $jns->fetch(PDO::FETCH_ASSOC)){
                            $q = $DBcon->query("SELECT SUM(nominal) as jml FROM tb_pendataan
                                                            WHERE jenis = '$jenis[no_rek]' AND tgl_entri >= '$th1' AND tgl_entri <= '$now' AND nominal IS NOT NULL");
                            $data = $q->fetch(PDO::FETCH_ASSOC);?>
                            <tr>
                                <td style="border: 1px solid #858796; padding: 5px;"><?php echo $no; ?>. </td>
                                <td style="border: 1px solid #858796; padding: 5px; text-align: left;"><?php echo $jenis['nama_rek']; ?> </td>
                                <td style="border: 1px solid #858796; text-align: right;"><?php echo number_format($data['jml'],0,",","."); ?></td>
                            </tr>
                        <?php 
                            $no++;
                        }
                    ?>
                </table><br>
            </div>
        </div>      
        <div class="row justify-content-center">
            <div class="col-sm-12 text-center">
                <h3></h3>
                <hr>
                <div id="grafik1">

                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(function(){
        $.ajax({
            type: "POST",
            url: './admin/model/grafik_column.php',
            success: function(data){
                Highcharts.chart('grafik1', {
                    chart: {
                        type: 'column'
                    },
                    title: {
                        text: 'Realisasi Anggaran Per '+tahun
                    },
                    subtitle: {
                        text: 'Sumber : BPPKAD KABUPATEN SRAGEN'
                    },
                    xAxis: {
                        categories: data[0].data,
                        crosshair: true,
                        title: { text: 'Kode Rekening' }
                    },
                    yAxis: {
                        min: 0,
                        title: {
                            text: 'Jumlah Anggaran/Pendapatan (Rp)'
                        },
                        labels :{
                        formatter: function() {
                            var ret,
                                numericSymbols = [' rb', ' jt', ' milyar', ' tril', 'P', 'E'],
                                i = numericSymbols.length;
                            if(this.value >=1000) {
                                while (i-- && ret === undefined) {
                                    multi = Math.pow(1000, i + 1);
                                    if (this.value >= multi && numericSymbols[i] !== null) {
                                        ret = (this.value / multi) + numericSymbols[i];
                                    }
                                }
                            }
                            return (ret ? ret : this.value);
                        }
                        }
                    },
                    tooltip: {
                        headerFormat: '<center><span style="font-size:10px;font-weight:bold">{point.key}</span></center><hr><table>',
                        pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                            '<td style="padding:0;color:{series.color}"><b>Rp </b></td>' +
                            '<td style="padding:0;color:{series.color};text-align:right"><b>{point.y:,.0f}</b></td></tr>',
                        footerFormat: '</table>',
                        shared: true,
                        useHTML: true
                    },
                    plotOptions: {
                        column: {
                            pointPadding: 0.2,
                            borderWidth: 0
                        }
                    },
                    series: [data[1],data[2],data[3],data[4]]
                });
            }
        });	
    //     $.ajax({
    //         url: "admin/model/home.php",
    //         method: "POST",
    //         success: function(result){
    //             console.log(result);
    //         }
    //     });
    })
</script>