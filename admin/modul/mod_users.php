<!-- Begin Page Content -->
<div class="container-fluid">

	<div class="card shadow mb-4">
		<div class="card-body">
			<div class="pb-3">
				<button type="button" class="btn btn-primary pull-right" onClick="addData()" style="margin-right: 5px;">Tambah User</button>
			</div>
			<div class="table-responsive">
				<table id="example" class="table table-striped table-hover" style="width:100%">
					<thead>
						<tr>
							<th>No</th>
							<th>Nama User</th>
							<th>Alamat</th>
							<th>No HP</th>
							<th>Username</th>
							<th>Hak Akses</th>
							<th style="width:80px" class="text-center">Aksi</th>
						</tr>
					</thead>
					<tbody>

					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="add_modal" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Tambah User</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form id="fm" name="fm" method="POST">
				<div class="modal-body">
					<input type="hidden" class="form-control" id="id" name="id">
					<div class="form-group">
						<label class="col-form-label">Nama*</label>
						<span class="help"></span>
						<input type="text" class="form-control" id="nama_user" name="nama_user" required="true">
					</div>
					<div class="form-group">
						<label class="col-form-label">Alamat</label>
						<span class="help"></span>
						<input type="text" class="form-control" id="alamat_user" name="alamat_user">
					</div>
					<div class="form-group">
						<label class="col-form-label">No HP</label>
						<span class="help"></span>
						<input type="text" class="form-control" id="phone_user" name="phone_user">
					</div>
					<div class="form-group">
						<label class="col-form-label">Username*</label>
						<span class="help"></span>
						<input type="text" class="form-control" id="username_user" name="username_user" required="true">
					</div>
					<div class="form-group">
						<label class="col-form-label">Hak Akses*</label>
						<select class="select2 form-control" name="group_user" id="group_user" required="true">
							<option value="">Pilih Role</option>
							<option value="100">Admin</option>
							<option value="101">Direktur</option>
						</select>
					</div>
					<div class="form-group">
						<label class="col-form-label">Password*</label>
						<span class="help"></span>
						<input type="password" class="form-control" id="password_user" name="password_user" required="true">
					</div>
					<div class="form-group">
						<label class="col-form-label">Ulangi Password*</label>
						<span class="help"></span>
						<input type="password" class="form-control" id="re_password" name="re_password" required="true">
					</div>
				</div>
			</form>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
				<button type="button" class="btn btn-primary" id="save" onClick="saveDataWithValidate()">Simpan</button>
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="del_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document" style="width: 50%;">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Hapus User</h5>
				<button class="close" type="button" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">×</span>
				</button>
			</div>
			<div class="modal-body">Apakah anda yakin akan menghapus data ini ?</div>
			<div class="modal-footer">
				<button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
				<a class="btn btn-danger" onclick="deleteDataOK()">Hapus</a>
			</div>
		</div>
	</div>
</div>

<script>
	var url;
	$(function() {
		var table = $('#example').DataTable({
			"ajax": {
				"url": "admin/model/data_users.php",
				"method": "POST",
				"data": {},
				"dataSrc": 'result'
			},
			"responsive": true,
			"columns": [{
					"data": "no"
				}, {
					"data": "nama_user"
				}, {
					"data": "alamat_user"
				}, {
					"data": "phone_user"
				}, {
					"data": "username_user"
				},
				{
					"data": "group_user"
				}, {
					"data": "aksi"
				}
			]
		});
	})

	function addData() {
		url = "admin/aksi/aksi_users.php?oper=add";
		$(".file-return").html("");
		$('#fm').trigger("reset");
		$("#add_modal").modal("show");
	}

	function editData(id) {
		url = "admin/aksi/aksi_users.php?oper=edit&id_user=" + id;
		$.getJSON('admin/model/data_users.php?id_user=' + id, function(data) {
			var data = data.result[0];
			console.log(data)
			$("#add_modal").modal("show");
			$('#nama_user').val(data.nama_user);
			$('#alamat_user').val(data.alamat_user);
			$('#phone_user').val(data.phone_user);
			$('#username_user').val(data.username_user);
			$('#group_user').val(data.hak_akses).trigger('change');
			$('#password_user').val(data.password_user);
			$('#re_password').val(data.password_user);
		});
	}

	function deleteData(id) {
		$("#id").val(id);
		$("#del_modal").modal("show");
	}

	function deleteDataOK() {
		var id = $("#id").val();
		$.ajax({
			type: "POST",
			url: "admin/aksi/aksi_users.php?oper=del",
			data: {
				id_user: id
			},
			success: function(data) {
				var data = eval('(' + data + ')');
				$("#del_modal").modal("hide");
				toastr.success(data.pesan, 'Sukses');
				$("#example").DataTable().ajax.reload();
			},
			error: function(data) {
				toastr.error(data.pesan, 'Error');
			}
		});
	}

	function saveDataWithValidate() {
		var a = $('#nama_user').val();
		var b = $('#username_user').val();
		var c = $('#group_user').val();
		var d = $('#password_user').val();
		var e = $('#re_password').val();

		if (a, b, c, d, e == "") {
			toastr.error("Mohon lengkapi data yang kosong !", 'Error');
		} else if (d != e) {
			toastr.error("Konfirmasi password tidak sesuai !", 'Error');
		} else {
			saveData();
		}

	}

	function saveData() {
		var a = $('#password_user').val();
		var n = a.length;
		var a2 = a.substring(0, 1);
		var a3 = a2.charCodeAt();
		var a4 = a3 + 2;
		var a5 = String.fromCharCode(a4);
		var u1 = a.substring(1, 3);
		var u2 = a.substring(3, n);
		var _passfix = $.MD5(u2 + a5 + u1 + a4 + './');

		var password_user = _passfix;
		$('#password_user').val(_passfix);
		$('#re_password').val(_passfix);

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
				var result = eval('(' + result + ')');
				$("#example").DataTable().ajax.reload();
				$("#add_modal").modal("hide");
				toastr.success(result.pesan, 'Sukses');
			},
			error: function(e) {
				toastr.error(result.pesan, 'Error');
			}
		});
	}
</script>