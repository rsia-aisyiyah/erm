<input type="hidden" class="no_resep form-control form-control-sm" />
<ul class="nav nav-tabs mt-4" id="myTab">
    <li class="nav-item">
        <a href="#umum" class="nav-link active" data-bs-toggle="tab">NON RACIKAN</a>
    </li>
    <li class="nav-item">
        <a href="#racikan" class="nav-link" data-bs-toggle="tab">RACIKAN</a>
    </li>
    <li class="nav-item">
        <a href="#riwayat" class="nav-link" data-bs-toggle="tab">RIWAYAT RESEP</a>
    </li>
</ul>
<div class="tab-content">
    <div class="tab-pane fade show active" id="umum">
        <table class="table table-stripped table-responsive table-sm" id="tb-resep" width="100%">
            <thead>
                <tr>
                    <th width="18%">No. Resep</th>
                    <th>Nama Obat</th>
                    <th width="10%">Jumlah</th>
                    <th>Aturan Pakai</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody id="body_umum">

            </tbody>
        </table>
        <button class="btn btn-primary btn-sm tambah_umum" type="button" onclick="tambahUmum()">Tambah
            Obat</button>
        <button class="btn btn-success btn-sm btn_simpan_resep" type="button" style="visibility: hidden">Simpan
            Resep</button>
    </div>
    <div class="tab-pane fade" id="racikan">
        <table class="table table-responsive" id="tb-resep-racikan" width="100%">
            <thead>
                <tr>
                    <th width="10%">No Racik</th>
                    <th>No Resep</th>
                    <th>Nama Racikan</th>
                    <th>Metode Racikan</th>
                    <th width="10%">Jumlah</th>
                    <th>Aturan Pakai</th>

                    <th></th>
                </tr>
            </thead>
            <tbody id="body_racikan">

            </tbody>
        </table>
        <button class="btn btn-primary btn-sm tambah_racik" type="button" onclick="tambahRacikan()">Tambah
            Racikan</button>
    </div>
    <div class="tab-pane fade" id="riwayat">
        <table class="table table-responsive" id="tb-resep-riwayat" width="100%">
            <thead>
                <tr>
                    <th>Tanggal</th>
                    <th width="65%">Obat/Racikan</th>
                    <th></th>
                </tr>
            </thead>
            <tbody id="body_riwayat" class="align-top">

            </tbody>
        </table>
    </div>
</div>

@push('script')
    <script>
        // function tambahUmum() {
        //     // no_resep = $('.no_resep_umum').val();
        //     // no_rawat = $('#nomor_rawat').val();
        //     // cekResep(no_rawat).done(function(response) {
        //     //     resep = Object.keys(response).length
        //     //     if (resep == 0) {
        //     //         simpanResepObat().done(function(res) {
        //     //             $('.no_resep_umum ').val(res.no_resep)
        //     //         });
        //     //     } else {
        //     //         $.map(response, function(res) {
        //     //             $('.no_resep_umum ').val(res.no_resep)
        //     //         })
        //     //     }
        //     // });

        //     // html = '<tr>';
        //     // html += '<td><input type="hidden" class="kode_obat_umum"/>';
        //     // html +=
        //     //     '<input type="text" class="no_resep_umum form-control form-control-sm form-underline" readonly/>';
        //     // html += '</td>';
        //     // html += '<td>';
        //     // html +=
        //     //     '<input type="search" onkeyup="cariObat(this)" autocomplete="off" class="form-control form-control-sm nama_obat_umum form-underline" name="nama_obat_umum" /><div class="list_obat"></div>';
        //     // html += '</td>';
        //     // html += '<td>';
        //     // html +=
        //     //     '<input type="search" class="jml_umum form-control form-control-sm form-underline"/>';
        //     // html += '</td>';
        //     // html += '<td>';
        //     // html +=
        //     //     '<input type="search" onkeyup="cariAturan(this)" autocomplete="off" class="form-control form-control-sm aturan_pakai form-underline" name="aturan_pakai" /><div class="list_aturan"></div>';
        //     // html += '</td>';
        //     // html += '<td>';
        //     // html +=
        //     //     '<div class="status"><button type="button" class="btn btn-primary btn-sm" onclick="simpanObat()" style="font-size:12px"><i class="bi bi-plus-circle"></i></button><button type="button" class="btn btn-danger btn-sm hapus-baris" style="font-size:12px"><i class="bi bi-trash"></i></button></div>';
        //     // html += '</td>';
        //     // html += '</tr>';
        //     // $('#tb-resep tbody').append(html)
        //     // riwayatResep($('#no_rm').val())
        //     cekResep()
        // }
    </script>
@endpush
