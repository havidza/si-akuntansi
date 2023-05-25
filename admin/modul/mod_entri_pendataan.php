<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-body col-md-6">
            <form class="form" id="fm_save_data" name="fm_save_data" method="post">
                <div class="form-group row">
                    <label for="inputPassword" class="col-sm-4 col-form-label">Password Lama</label>
                    <div class="col-sm-8">
                        <input type="password" class="form-control" id="pw_lama" name="pw_lama" placeholder="Password Lama">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="inputPassword" class="col-sm-4 col-form-label">Password Baru</label>
                    <div class="col-sm-8">
                        <input type="password" class="form-control" id="pw_baru" name="pw_baru" placeholder="Password Baru">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="inputPassword" class="col-sm-4 col-form-label">Ulangi Password</label>
                    <div class="col-sm-8">
                        <input type="password" class="form-control" id="pw_baru2" name="pw_baru2" placeholder="Ulangi Password">
                    </div>
                </div>
                <div class="form-group row">
                    <button type="button" class="btn btn-primary" id="save" onClick="validateSave()">Simpan</button>
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