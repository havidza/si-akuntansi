<div class="container-fluid">
	<div class="card shadow mb-4">
		<div class="card-body">
			<div class="pb-3">
				<!-- <button type="button" class="btn btn-primary pull-right" onClick="addData()" style="margin-right: 5px;">Tambah User</button> -->
                <button type="button" class="btn btn-primary pull-right" onClick="cetakData()" style="margin-left: 5px;">Cetak</button>
                <div id="preload" style="display: none;">
                    <div class="d-flex align-items-center mb-2">
                        <strong>Loading...</strong>
                        <div class="spinner-border ml-auto" role="status" aria-hidden="true"></div>
                    </div>
                </div>
			</div>
			<div class="table-responsive">
				<table id="example" class="table table-striped table-hover" style="width:100%">
					<thead>
						<tr>
							<th>No</th>
							<th>Judul Pendataan</th>
							<th>Jenis Pendataan</th>
							<th>Tanggal Kasus</th>
							<th>Nominal</th>
							<th>Tanggal Entri</th>
                            <th>Aksi</th>
						</tr>
					</thead>
					<tbody>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>

<script>
    $(function() {
        var table = $('#example').DataTable({
            "ajax": {
                "url": "admin/model/daftar_pendataan.php",
                "method": "POST",
                "data": {},
                "dataSrc": 'result'
            },
            "responsive": true,
            "columns": [{
                "data": "no"
            }, {
                "data": "judul"
            }, {
                "data": "nm_jenis"
            }, {
                "data": "tgl_kasus"
            }, {
                "data": "nominal"
            }, {
                "data": "tgl_entri"
            }, {
                "data": "aksi"
            }]
        });
    })

    function cetakData(){
        $.ajax({
            url: 'admin/print/cetak_daftar_pendataan.php',
            type: "POST",
            data: {},
            success: function(data){
                if(data === 'not_found'){
                    toastr.error("Tidak ada data!", 'Error');
                } else {
                    window.open('admin/xls/Laporan_daftar_pendataan_'+data+'.xlsx', '_blank');
                }
            }
        })
    }
</script>