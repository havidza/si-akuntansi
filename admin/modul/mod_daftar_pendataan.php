<div class="container-fluid">
	<div class="card shadow mb-4">
		<div class="card-body">
			<div class="pb-3">
				<!-- <button type="button" class="btn btn-primary pull-right" onClick="addData()" style="margin-right: 5px;">Tambah User</button> -->
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
                "data": "jenis"
            }, {
                "data": "tgl_kasus"
            }, {
                "data": "nominal"
            }, {
                "data": "tgl_entri"
            }]
        });
    })
</script>