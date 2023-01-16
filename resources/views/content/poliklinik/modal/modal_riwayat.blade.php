<div class="modal fade" id="modalRiwayat" tabindex="-1" aria-labelledby="modalRiwayat" aria-hidden="true">
    <div class="modal-dialog modal-fullscreen">
        <div class="modal-content" style="background-color: #e7e7e7;">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">RIWAYAT PASIEN</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <table id="tb_riwayat" class="table table-bordered table-responsive" cellpadding="5" cellspacing="0"
                    style="padding-left:50px;"></table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger btn-sm" data-bs-dismiss="modal"><i
                        class="bi bi-x-circle"></i> Keluar</button>
                {{-- <button type="button" class="btn btn-primary btn-sm" onclick="simpanSoap()"><i class="bi bi-save"></i>
                    Simpan</button> --}}
            </div>
        </div>
    </div>
</div>
@push('script')
    <script>
        var no_rm = '';
        $('#modalRiwayat').on('shown.bs.modal', function() {
            isModalSoapShow = true;
            modalRiwayat(no_rm);
        });

        $('#modalRiwayat').on('hidden.bs.modal', function() {
            $('#tb_riwayat').empty();
            detail = '';
            isModalSoapShow = false;
        });

        function ambilNoRm(no_rkm_medis) {
            no_rm = no_rkm_medis;
        }


        function modalRiwayat(no_rm) {
            $.ajax({
                url: '/erm/registrasi/riwayat',
                data: {
                    'no_rkm_medis': no_rm,
                },
                dataType: 'JSON',
                method: 'GET',
                success: function(response) {
                    if (Object.keys(response.reg_periksa).length == 0) {
                        Swal.fire(
                            'Kosong!', 'Belum ada riwayat perawatan', 'error'
                        );
                        $('#modalRiwayat').modal('hide');
                    } else {
                        resume(response);
                    }
                }

            });
        }

        var detail = '';
        var pemeriksaan = '';
        var diagnosa = '';

        function resume(d) {
            d.reg_periksa.forEach(function(i) {
                if (i.status_lanjut == 'Ranap') {
                    status_lanjut = 'RAWAT INAP';
                    class_status = 'background:rgb(152, 0, 175);color:white';
                } else {
                    status_lanjut = 'RAWAT JALAN';
                    class_status = 'background:rgb(255 193 7);color:black';
                }
                i.pemeriksaan_ralan.forEach(function(x) {
                    pemeriksaan += '<tr><th>Pemeriksaan</th><td>' +
                        '<div class="row">' +
                        '<div class="col-sm-4">' +
                        '<table class="table table-sm text-sm borderless table-success mb-2">' +
                        '<tr><td style="width=12%">Tanggal Rawat</td><td>: ' + formatTanggal(x
                            .tgl_perawatan) + ' ' + x
                        .jam_rawat + '</td></tr>' +
                        '<tr><td>Tinggi</td><td>: ' + isKosong(x.tinggi, ' cm') + '</td><tr>' +
                        '<tr><td>Berat Badan</td><td>: ' + isKosong(x.berat, ' Kg') + '</td><tr>' +
                        '<tr><td>Suhu</td><td>: ' + isKosong(x.suhu_tubuh, ' <sup>o</sup>C') +
                        '</td><tr>' +
                        '<tr><td>Tensi</td><td>: ' + isKosong(x.tensi) + '</td><tr>' +
                        '<tr><td>Kesadaran</td><td>: ' + isKosong(x.kesadaran) + '</td><tr>' +
                        '<tr><td>Respirasi</td><td>: ' + isKosong(x.respirasi) +
                        '<tr><td>GCS(E,V,M)</td><td>: ' + isKosong(x.gcs) +
                        '<tr><td>Alergi</td><td>: ' + isKosong(x.alergi) +
                        '<tr><td>Imunisasi</td><td>: ' + isKosong(x.imun_ke) +
                        '</td><tr>' +
                        '</tr>' +
                        '</table>' +
                        '</div>' +
                        '<div class="col-sm-8">' +
                        '<table class="table table-sm text-sm borderless table-success">' +
                        '<tr>' +
                        '<tr><td style="width:10%">Subject</td><td>: ' + isKosong(x.keluhan) +
                        '</td><tr>' +
                        '<tr><td>Object</td><td>: ' + isKosong(x.pemeriksaan) + '</td><tr>' +
                        '<tr><td>Assesment</td><td>: ' + isKosong(x.penilaian) + '</td><tr>' +
                        '<tr><td>Plan</td><td>: ' + isKosong(x.rtl) + '</td><tr>' +
                        '</table>' +
                        '</div>' +
                        '</td></tr>';
                })

                detail +=
                    '<tr>' +
                    '<th colspan="2" align="center" style="' + class_status + '"><h6>' + status_lanjut +
                    '</h6></th>' +
                    '</tr>' +
                    '<tr><th style="width:15%">Tanggal Daftar</th><td>: ' + formatTanggal(i.tgl_registrasi) +
                    ' ' +
                    i.jam_reg +
                    '<tr><th>Nama (Nomor RM)</th><td>: ' + d.nm_pasien + ' (' + i.no_rkm_medis + ')</td></tr>' +
                    '<tr><th>Nomor Rawat</th><td>: ' + i.no_rawat + '</td></tr>' +
                    '</td></tr>' +
                    '<tr><th>Unit/Poliklinik</th><td>: ' + i.poliklinik.nm_poli + '</td></tr>' +
                    '<tr><th>Dokter</th><td>: ' + i.dokter.nm_dokter + '</td></tr>' +
                    '<tr><th>Cara Bayar</th><td>: ' + i.penjab.png_jawab + '</td></tr>' +
                    diagnosaPasien(i.diagnosa_pasien) + pemeriksaan +
                    pemberianObat(i.detail_pemberian_obat) +
                    // diagnosaPasien(i.diagnosa_pasien) + pemeriksaan + pemberianObat(i.detail_pemberian_obat) +
                    pemeriksaanLab(i.detail_pemeriksaan_lab, i.umurdaftar, d.jk) +
                    '</tr>';

                pemeriksaan = '';

            });
            // return (
            //     '<table class="table table-bordered table-responsive" cellpadding="5" cellspacing="0" border="0" style="padding-left:50px;">' +
            //     detail + '</table>'
            // );
            $('#tb_riwayat').append(detail);
        }
    </script>
@endpush
