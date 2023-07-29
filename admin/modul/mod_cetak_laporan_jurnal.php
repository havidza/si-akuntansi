<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-title"> &nbsp;<h3> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Cetak Laporan Jurnal Umum</h3></div>
        <div class="card-body col-md-4">
            <div class="form-group row">
                <label for="tgl_awal" class="col-sm-4 col-form-label">Tanggal Awal</label>
                <div class="col-sm-8">
                    <input type="date" name="tgl_awal" id="tgl_awal" class="form-control">
                </div>
            </div>
            <div class="form-group row">
                <label for="tgl_akhir" class="col-sm-4 col-form-label">Tanggal Akhir</label>
                <div class="col-sm-8">
                    <input type="date" name="tgl_akhir" id="tgl_akhir" class="form-control">
                </div>
            </div>
            <div class="form-group row">
                <div class="col-sm-12 text-right">
                    <button type="button" class="btn btn-primary" id="save" onClick="cetakData()">Cetak</button>
                </div>
            </div>
        </div>
        <div id="preload" style="display: none;">
            <div class="d-flex align-items-center mb-2">
                <strong>Loading...</strong>
                <div class="spinner-border ml-auto" role="status" aria-hidden="false"></div>
            </div>
        </div>
    </div>
</div>

<script>
    function cetakData(){
        var awal = $('#tgl_awal').val();
        var akhir = $('#tgl_akhir').val();

        if(awal = ""){
            toastr.error("Tanggal awal tidak boleh kosong !", 'Error');
            return;
        }
        $('#preload').show();

        $.ajax({
            url: 'admin/print/cetak_laporan_jurnal.php',
            data: {awal:awal, akhir:akhir},
            type: 'POST',
            contentType: false,
            processData: false,
            success: function(result){
                if(result === 'not_found'){
                    toastr.error("Gagal cetak !", 'Error');
                } else {
                    window.open('admin/xls/Laporan_jurnal_umum_'+result+'.xlsx', '_blink');
                }
            }
        })
    }
</script>