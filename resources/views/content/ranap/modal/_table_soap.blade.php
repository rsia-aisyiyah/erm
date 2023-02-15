<div class="row">
    <div class="col">
        <div class="input-group input-group-sm mb-3">
            <input type="text" class="form-control tanggal tgl_pertama_soap"
                style="font-size:12px;min-height:12px;border-radius:0;">
            <span class="input-group-text"><i class="bi bi-calendar3"></i></span>
        </div>
    </div>
    <div class="col">
        <div class="input-group input-group-sm mb-3">
            <input type="text" class="form-control tanggal tgl_kedua_soap"
                style="font-size:12px;min-height:12px;border-radius:0;">
            <span class="input-group-text"><i class="bi bi-calendar3"></i></span>
        </div>
    </div>
    <div class="col">
        <div class="d-grid gap-2">
            <button type="button" class="btn btn-success btn-sm" style="border-radius:0px" id="cari"
                onclick="cariSoap()">
                <i class="bi bi-search"></i>
            </button>
        </div>
    </div>
</div>
<div>
    <table class="table table-bordered table-striped" id="tbSoap">
        <thead>
            <tr>
                <td>Ubah</td>
                <td>TTV & Fisik</td>
                <td>S.O.A.P</td>
            </tr>
        </thead>
    </table>
</div>

@push('script')
    <script></script>
@endpush
