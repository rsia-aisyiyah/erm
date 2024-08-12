<div class="row">
    <div class="col-md-12 col-lg-3 col-sm-12">
        <div class="input-group input-group-sm mb-3">
            <input type="text" class="form-control form-control-sm tanggal tgl_pertama_soap"
                style="font-size:12px;min-height:12px;border-radius:0;">
            <span class="input-group-text" style="font-size:12px"><i class="bi bi-calendar3"></i></span>
        </div>
    </div>
    <div class="col-md-12 col-lg-3 col-sm-12">
        <div class="input-group input-group-sm mb-3">
            <input type="text" class="form-control form-control-sm tanggal tgl_kedua_soap"
                style="font-size:12px;min-height:12px;border-radius:0;">
            <span class="input-group-text" style="font-size:12px"><i class="bi bi-calendar3"></i></span>
        </div>
    </div>
    <div class="col-md-12 col-lg-3 col-sm-12">
        <select name="petugas" id="petugas" class="form-select form-select-sm mb-3" style="font-size: 12px">
            <option value="" disabled selected>Pilih Petugas Medis</option>
            <option value="">Semua</option>
            <option value="1">Dokter</option>
            <option value="2">Petugas Medis Lain</option>
        </select>
    </div>
    <div class="col-md-12 col-lg-3 col-sm-12">
        <div class="d-grid gap-2">
            <button type="button" class="btn btn-success btn-sm mb-3" style="border-radius:0px;font-size:12px" id="cari"
                onclick="cariSoap()">
                <i class="bi bi-search"></i>
            </button>
        </div>
    </div>
</div>
<table class="table table-bordered table-striped" id="tbSoap" style="font-size: 12px" width="100%">
    <thead>
        <tr>
            <td width="5%">Aksi</td>
            <td width="20%">TTV & Fisik</td>
            <td>CPPT</td>
        </tr>
    </thead>
    <tbody>

    </tbody>
</table>

@push('script')
    <script></script>
@endpush
