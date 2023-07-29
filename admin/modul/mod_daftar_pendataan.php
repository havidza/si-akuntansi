<style>
    #fm_edit_data > div:nth-child(7) > div > div > span > label{
        border-color: #d1d3e2;
        border-left-style: none;
        border-radius: 0px 5px 5px 0px;
    }

    label {
        font-size: 16px !important;
    }
</style>

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
    <div class="modal fade" id="modal_edit" tabindex="-1" role="dialog" aria-labelledby="myModalEdit" aria-hidden="true">
        <div class="modal-dialog justify-content-center">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 id="myModalEdit" class="semi-bold">Edit Pendataan</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" style="background-color: #fff;">
                    <form class="form" id="fm_edit_data" name="fm_edit_data" method="post">
                        <input type="hidden" name="id_data" id="id_data">
                        <div class="form-group row">
                            <label for="judul" class="col-sm-2 col-form-label">Judul Pendataan</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" id="judul" name="judul" placeholder="Judul Pendataan">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="jenis" class="col-sm-2 col-form-label">Jenis Pendataan</label>
                            <div class="col-sm-4">
                                <select name="jenis" id="jenis" class="form-control">
                                    <option value=""></option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="tgl_kasus" class="col-sm-2 col-form-label">Tanggal Kasus</label>
                            <div class="col-sm-2">
                                <input type="date" name="tgl_kasus" id="tgl_kasus" class="form-control">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="nominal" class="col-sm-2 col-form-label">Nominal</label>
                            <div class="col-sm-3">
                                <input type="text" name="nominal" id="nominal" class="form-control" placeholder="Nominal">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputPassword" class="col-sm-2 col-form-label">Deskripsi Pendataan</label>
                            <div class="col-sm-10">
                                <textarea class="form-control" name="deskripsi" id="deskripsi" rows="5"></textarea>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="lampiran" class="col-sm-2 col-form-label">Lampiran</label>
                            <div class="col-sm-4">
                                <input type="file" class="filestyle" id="lampiran" name="lampiran" data-buttonText="Lampiran">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="lampiran" class="col-sm-2 col-form-label">Lampiran Lama</label>
                            <div class="col-sm-4">
                                <span id="file_lm" name="file_lm"></span>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-12 text-center">
                                <button type="button" class="btn btn-primary" id="save_edit" onClick="saveEdit()">Simpan</button>
                            </div>
                        </div>
                    </form>
                </div>
                <div id="preload" style="display: none;">
                    <div class="d-flex align-items-center mb-2">
                        <strong>Loading...</strong>
                        <div class="spinner-border ml-auto" role="status" aria-hidden="true"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="modal_hapus" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog justify-content-center" style="width: 50%;">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 id="myModalLabel" class="semi-bold">Hapus Pendataan</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" style="background:#fff">
                    Apakah anda yakin akan menghapus Pendataan ini ?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-danger" onClick="deleteData()" id="hapus">Hapus</button>
                </div>
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
                "data": "nominal_rp"
            }, {
                "data": "tgl_entri"
            }, {
                "data": "aksi"
            }]
        });
        selectJenis();
    })

    function selectJenis(){
        $.ajax({
            type: "POST",
            url: './admin/model/cb_jenis_rek.php',
            success: function(data){
                $("#jenis").html(data);
            }
        });
    }

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

    function ubahData(id){
        $.getJSON('admin/model/daftar_pendataan.php?id_data='+id, function(data){
            var data = data.result[0];
            $('#modal_edit').modal("show");
            $('#id_data').val(data.id_pendataan);
            $('#judul').val(data.judul);
            $('#jenis').val(data.jenis).trigger('change');
            // $('#tgl_kasus').val(data.tgl_kasus_e);
            document.querySelector('#tgl_kasus').value = data.tgl_kasus_e;
            $('#nominal').val(data.nominal);
            $('#deskripsi').val(data.deskripsi);
            $('#file_lm').html(data.file);
        })
    }

    function saveEdit(){
        var a = $('#judul').val();
        var b = $('#jenis').val();
        var c = $('#tgl_kasus').val();
        var d = $('#nominal').val();
        var e = $('#deskripsi').val();

        if(a == "" || b == "" || c == "" || d == "" || e == ""){
            toastr.error("Mohon lengkapi data !", 'Error');
            return;
        }
        $('#preload').show();

        var formData = new FormData();
        $.each($('input[type=file]'), function(i, v) {
            formData.append(v.name, v.files[0]);
        });

        $('#fm_edit_data').find('[name]').each(function() {
            formData[this.name] = this.value;
            formData.append(this.name, this.value);
        })

        $.ajax({
            url: "admin/aksi/aksi_pendataan.php?oper=edit",
            data: formData,
            type: 'POST',
            enctype: 'multipart/form-data',
            cache: false,
            contentType: false,
            processData: false,
            success: function(result){
                var result = eval('('+result+')');
                if(result.success==false){
                    toastr.error(result.pesan, 'Error');
                }else{
                    toastr.success(result.pesan, 'Sukses');
                    resetForm();
                    $('#modal_edit').modal("hide");
                    $('#example').DataTable().ajax.reload();
                }
                $('#preload').hide();
            }
        });
    }

    function resetForm(){
        $('#judul').val("");
        $('#jenis').val("");
        $('#tgl_kasus').val("");
        $('#nominal').val("");
        $('#deskripsi').val("");
        $('#lampiran').val("");
        $(":file").filestyle('clear');
    }

    function hapusData(id){
        $("#id_data").val(id);
        $("#modal_hapus").modal("show");
    }

    function deleteData(id){
        var id = $("#id_data").val();
        $.ajax({
            url: 'admin/aksi/aksi_pendataan.php?oper=del',
            type: "POST",
            data: { id_data:id },
            success: function(data){
                var data = eval('('+data+')');
                if(data.success==false){
                    toastr.error(data.pesan, 'Error');
                }else{
                    toastr.success(data.pesan, 'Sukses');
                    $('#modal_hapus').modal("hide");
                    $('#example').DataTable().ajax.reload();
                }
            }
        })
    }
</script>