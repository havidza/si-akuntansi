<style>
    #fm_save_data > div:nth-child(7) > div > div > span > label{
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
        <div class="card-body col-md-12">
            <form class="form" id="fm_save_data" name="fm_save_data" method="post">
                <div class="form-group row">
                    <label for="tgl_entri" class="col-sm-2 col-form-label">Tanggal Entri</label>
                    <div class="col-sm-2">
                        <input type="date" class="form-control" id='tgl_entri' name='tgl_entri' disabled>
                    </div>
                </div>
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
                    <div class="col-sm-6" style="color: red; position: relative;">
                        <span style="position: absolute;bottom: 8px;">Format file bisa PDF, JPG, PNG, word, excel, atau mp4 dan maksimal ukuran file 60Mb </span>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-12 text-center">
                        <button type="button" class="btn btn-primary" id="save" onClick="saveData()">Simpan</button>
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

<script>
    $(function(){
        $('#datepick').datetimepicker({
            format: 'DD-MM-YYYY',
            defaultDate: today()
        });
        $('#tgl_entri').val(today());
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

    function saveData(){
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

        $('#fm_save_data').find('[name]').each(function() {
            formData[this.name] = this.value;
            formData.append(this.name, this.value);
        })

        $.ajax({
            url: "admin/aksi/aksi_pendataan.php?oper=entry",
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

    function today() {
		var today = new Date();
		var dd = today.getDate();
		var mm = today.getMonth() + 1; //January is 0!

		var yyyy = today.getFullYear();
		if (dd < 10) {
			dd = '0' + dd
		}
		if (mm < 10) {
			mm = '0' + mm
		}
		var today = yyyy + '-' + mm + '-' + dd;
		return today;
	}
</script>