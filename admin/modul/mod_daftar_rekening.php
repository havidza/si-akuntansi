<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="pb-3">
                <button type="button" class="btn btn-primary pull-right" onClick="tambahData()" style="margin-left: 5px;">Tambah</button>
                <!-- <button type="button" class="btn btn-success pull-right" onClick="ubahData()" style="margin-left: 5px;">Ubah</button>
                <button type="button" class="btn btn-alert pull-right" onClick="hapusData()" style="margin-left: 5px;">Hapus</button> -->
            </div>
            <div class="table-responsive">
                <table id="pendataan" class="table table-striped table-hover" style="width: 100%;">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Deskripsi</th>
                            <th>Jenis</th>
                            <th style="width: 80px;" class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal_tambah" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="title_tambah">Tambah Rekening</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="fm" name="fm" method="POST">
                <div class="modal-body">
                    <input type="hidden" class="form-control" id="no_rek" name="no_rek">
                    <div class="form-group">
                        <label class="col-form-label">Nama</label>
                        <span class="help"></span>
                        <input type="text" class="form-control" id="nama_rek" name="nama_rek" required="true">
                    </div>
                    <div class="form-group">
                        <label class="col-form-label">Deskripsi</label>
                        <span class="help"></span>
                        <input type="text" class="form-control" id="deskripsi_rek" name="deskripsi_rek" required="true">
                    </div>
                    <div class="form-group">
                        <label class="col-form-label">Jenis</label>
                        <select class="select2 form-control" name="jenis_rek" id="jenis_rek" required="true">
                            <option value="">Pilih Jenis Rekening</option>
                            <option value="1">Debit</option>
                            <option value="2">Kredit</option>
                        </select>
                    </div>
                </div>
            </form>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" onClick="simpanData()">Simpan</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal_hapus" tabindex="-1" role="dialog" aria-labelledby="hapusModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document" style="width: 50%;">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="hapusModalLabel"></h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">Apakah Anda yakin akan menghapus data ini?</div>
            <div class="modal-footer">
                <a class="btn btn-danger" onclick="deleteData()">Hapus</a>
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>

<script>
    var url;
    var oper;
    $(function() {
        var table = $('#pendataan').DataTable({
            "ajax": {
                "url": "admin/model/data_rekening.php",
                "method": "POST",
                "data" : {},
                "dataSrc": 'result'
            },
            "responsive": true,
            "columns": [{
                "data": "no_rek"
            },{
                "data": "nama_rek"
            },{
                "data": "deskripsi_rek"
            },{
                "data": "jenis"
            },{
                "data": "aksi_rek"
            }]
        });
    })

    function tambahData(){
        $('#title_tambah').html("Tambah Rekening");
        url = "admin/aksi/aksi_rekening.php?oper=add";
        // $("./file-return").html("");
        $('#fm').trigger("reset");
        $("#modal_tambah").modal("show");
    }

    function ubahData(id){
        $('#title_tambah').html("Ubah Rekening");
        url = "admin/aksi/aksi_rekening.php?oper=edit&no_rek="+id;
        $.getJSON('admin/model/data_rekening.php?no_rek='+id, function(data) {
            var data = data.result[0];
            $("#modal_tambah").modal("show");
            $("#nama_rek").val(data.nama_rek);
            $("#deskripsi_rek").val(data.deskripsi_rek);
            $("#jenis_rek").val(data.jenis_rek).trigger('change');
        });
    }

    function hapusData(id) {
        $("#no_rek").val(id);
        $("#modal_hapus").modal("show");
    }

    function deleteData(){
        var id = $('#no_rek').val();
        $.ajax({
            type: "POST",
            url: "admin/aksi/aksi_rekening.php?oper=del",
            data: { no_rek:id },
            success: function(data) {
                var data = eval('('+data+')');
                $("#modal_hapus").modal("hide");
                toastr.success(data.pesan, 'Sukses');
                $('#pendataan').DataTable().ajax.reload();
            },
            error: function(data) {
                toastr.error(data.pesan, "Error");
            }
        });
    }

    function simpanData(){
        var a = $('#nama_rek').val();
        var b = $('#deskripsi_rek').val();
        var c = $('#jenis_rek').val();

        if(a, b, c == ""){
            toastr.error("Mohon lengkapi data !", 'Error');
        }

        var formData = new FormData();
		$('#fm').find('[name]').each(function() {
			formData[this.name] = this.value;
			formData.append(this.name, this.value);
		})
        $.ajax({
            url: url,
            data: formData,
            type: 'POST',
            enctype: 'multipart/form-data',
            cache: false,
            contentType: false,
            processData: false,
            success: function(result) {
                var result = eval('('+result+')');
                $("#pendataan").DataTable().ajax.reload(),
                $("#modal_tambah").modal("hide");
                toastr.success(result.pesan, 'Sukses');
            },
            error: function(e) {
                toastr.error(result.pesan, 'Error');
            }
        });
    }
</script>