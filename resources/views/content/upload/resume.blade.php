<div class="col-sm-12" id="form-upload">
    <div>
        <div class="d-flex align-items-start">
            <div class="btn-group-vertical" id="button-form">
            </div>
            <div class="nav flex-column nav-pills mx-3">
                <div id="image" class="row"></div>
                <div id="upload-image" style="visibility: hidden">
                    <label>Anda dapat mengupload lebih dari satu gambar</label>
                    <div class="mb-2 text-center">
                        <div class="row" id="preview">
                        </div>
                    </div>
                    <form action="upload" method="post" enctype="multipart/form-data" id="formUploadPenunjang">
                        @csrf
                        <div class="d-grid gap-2">
                            <label for="no_rkm_medis"></label>
                            <input type="hidden" id="no_rkm_medis" name="no_rkm_medis" value="">
                            <input type="hidden" id="no_rawat" name="no_rawat" value="">
                            <input type="hidden" id="tgl_masuk" name="tgl_masuk" value="">
                            <input type="hidden" id="username" name="username"
                                value="{{ session()->get('pegawai')->nik }}">
                        </div>
                        <div class="mb-3">
                            <input class="form-control" type="file" id="file" name="file" multiple
                                onchange="previewImage(this)" style="display: none" accept="image/png, image/jpeg, application/pdf">
                        </div>
                        <div class="d-grid gap-2">
                            <label type="button" class="btn btn-success" width="100%" for="file" style="font-size:12px">Tambah</label>
                            <button type="button" class="btn btn-primary btn-sm" id="submit"
                                onclick="uploadBerkas()">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
