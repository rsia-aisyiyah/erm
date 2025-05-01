<form action="" class="" id="formSbarRanap">
    <input type="hidden" id="_token" name="_token" value="{{ csrf_token() }}">
    <div class="row gy-2">
        <div class="col-lg-12 col-md-12 col-sm-12">
            <div class="row">
                <div class="col-lg-2 col-md-12">
                    <label for="tgl_pemeriksaan">Tgl & Jam Pemeriksaan</label>
                    <x-input-group class="input-group-sm">
                        <x-input-group-text>
                            <i class="bi bi-calendar3"></i>
                        </x-input-group-text>
                        <x-input id="tgl_perawatan" name="tgl_perawatan" class="datetimepicker" />
                    </x-input-group>
                </div>
            </div>
        </div>
        <div class="col-lg-6 col-md-12 col-sm-12">
            <div class="row">
                <div class="col-lg-6 col-md-12">
                    <label for="petugas">Petugas</label>
                    <x-input-group class="input-group-sm">
                        <x-input-group-text>
                            <i class="bi bi-person-fill"></i>
                        </x-input-group-text>
                        <x-input name="petugas" id="petugas" readonly />
                        <x-input name="nm_petugas" id="nm_petugas" class="w-25" readonly />
                    </x-input-group>
                </div>
                <div class="col-lg-6 col-md-12">
                    <label for="dokter">Dokter</label>
                    <select class="search form-select" placeholder="Dokter" name="kd_dokter" id="kd_dokter" style="width: 100%"></select>
                </div>
            </div>
        </div>
        <div class="row gy-2">

            <div class="col-lg-6 col-md-12 col-sm-12">
                <label for="subjek">Situation</label>
                <x-textarea cols="30" rows="8" name="keluhan" id="keluhan">-</x-textarea>
            </div>
            <div class="col-lg-6 col-md-12 col-sm-12">
                <label for="penilaian">Assesment</label>
                <x-textarea cols="30" rows="8" name="penilaian" id="penilaian">-</x-textarea>
            </div>
            <div class="col-lg-6 col-md-12 col-sm-12">
                <label for="background">Background</label>
                <x-textarea cols="30" rows="8" name="pemeriksaan" id="pemeriksaan">-</x-textarea>
            </div>
            <div class="col-lg-6 col-md-12 col-sm-12">
                <label for="rtl">Recomendation</label>
                <x-textarea cols="30" rows="8" name="rtl" id="rtl">-</x-textarea>
            </div>
        </div>

        <div class="row justify-content-end my-2">
            <div class="col-6">
                <button type="button" class="btn btn-sm btn-primary" id="btnSimpanSbar"><i class="bi bi-save me-1"></i> Simpan</button>
                <button type="button" class="btn btn-sm btn-warning d-none" id="btnUbahSbar"><i class="bi bi-pencil me-1"></i> Ubah</button>
                <button type="button" class="btn btn-sm btn-danger d-none" id="btnBatalSbar"><i class="bi bi-x me-1"></i> Batal</button>
                <x-input type="hidden" name="tgl_perawatan_awal" id="tgl_perawatan_awal" value="" />
                <x-input type="hidden" name="jam_rawat_awal" id="jam_rawat_awal" value="" />
            </div>
        </div>
    </div>
</form>
