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
    <script>
        function ambilSoap(no_rawat, tgl, jam) {
            getDetailPemeriksaanRanap(no_rawat, tgl, jam).done((response) => {
                formSoapRanap.find('#cekJam').prop('checked', true)
                checkJam()
                formSoapRanap.find('input[name=tgl_perawatan_ubah]').val(splitTanggal(response.tgl_perawatan));
                formSoapRanap.find('input[name=jam_rawat_ubah]').val(response.jam_rawat);
                formSoapRanap.find('input[name=tgl_perawatan]').val(response.tgl_perawatan);
                formSoapRanap.find('input[name=jam_rawat]').val(response.jam_rawat);
                $('#suhu').val(response.suhu_tubuh);
                $('#tinggi').val(response.tinggi);
                $('#berat').val(response.berat);
                $('#tensi').val(response.tensi);
                $('#respirasi').val(response.respirasi);
                $('#nadi').val(response.nadi);
                $('#spo2').val(response.spo2);
                $('#gcs').val(response.gcs);

                $.map(response.grafik_harian, function(grafik) {
                    if (response.tgl_perawatan == grafik.tgl_perawatan && response.jam_rawat == grafik.jam_rawat) {
                        $('#o2').val(grafik.o2);
                    }
                })

                $('#kesadaran select').val(response.kesadaran);
                $('#alergi').val(response.alergi);
                $('#asesmen').val(response.penilaian);
                $('#plan').val(response.rtl);
                $('#instruksi').val(response.instruksi);
                $('#evaluasi').val(response.evaluasi);
                $('#subjek').val(response.keluhan);
                $('#objek').val(response.pemeriksaan);
                $('#reset_soap').append('')

                $('#btn-reset').css('display', 'inline');
                if (response.petugas.nip == "{{ session()->get('pegawai')->nik }}" || response.reg_periksa.kd_dokter == "{{ session()->get('pegawai')->nik }}" || "{{ session()->get('pegawai')->departemen }}" == "CSM" || "{{ session()->get('pegawai')->nik }}" == "direksi") {
                    $('#btn-ubah').css('display', 'inline');
                } else {
                    $('#btn-ubah').css('display', 'none');
                    $('.btn-simpan').css('display', 'inline');
                }
                if (response.petugas.dokter) {
                    if (response.petugas.dokter.kd_sps == 'S0007') {
                        $('#btn-ubah').css('display', 'inline');
                    }
                }
                bootstrap.Tab.getInstance(tabSoapRanap).show()
            })
        }



        function hapusSoap(no, tgl, jam) {
            Swal.fire({
                title: 'Yakin ?',
                text: "Data yang dihapus tidak dapat dikembalikan",
                icon: 'warning',
                showCancelButton: true,
                showConfirmButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, Hapus saja!',

            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: 'soap/hapus',
                        data: {
                            '_token': '{{ csrf_token() }}',
                            'no_rawat': no,
                            'tgl_perawatan': tgl,
                            'jam_rawat': jam,
                        },
                        method: 'DELETE',
                        success: function(response) {
                            if (response) {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'BERHASIL !',
                                    text: 'Data Berhasil dihapus',
                                    showConfirmButton: false,
                                    timer: 1500
                                });
                                $('#tbSoap').DataTable().destroy();
                                tbSoapRanap(no, tgl_pertama, tgl_kedua);
                                grafikPemeriksaan.destroy();
                                buildGrafik(no)
                                setEws(no, 'ranap', formSoapRanap.find('input[name=spesialis]').val())
                            }
                        }
                    })

                }
            })

        }

        function cariSoap() {
            const tgl_pertama = splitTanggal($('.tgl_pertama_soap').val());
            const tgl_kedua = splitTanggal($('.tgl_kedua_soap').val());
            petugas = $('#petugas option:selected').val();
            $('#tbSoap').DataTable().destroy();
            tbSoapRanap(no_rawat_soap, tgl_pertama, tgl_kedua, petugas);
        }

        function verifikasiSoap(no_rawat, tgl, jam) {
            swal.fire({
                title: 'Konfirmasi',
                text: "Hasil pemeriksaan akan diverifikasi ?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#0d6efd',
                cancelButtonColor: '#dc3545',
                confirmButtonText: 'Ya, Verifikasi',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: '/erm/soap/verifikasi',
                        data: {
                            _token: "{{ csrf_token() }}",
                            no_rawat: no_rawat,
                            tgl_perawatan: tgl,
                            jam_rawat: jam,
                        },
                        method: 'POST',
                        dataType: 'JSON',
                    }).done(() => {
                        swal.fire({
                            title: 'Berhasil',
                            text: 'Hasil pemeriksaan telah diverivikasi',
                            icon: 'success',
                            timer: 1500,
                        });
                        $('#tbSoap').DataTable().destroy();
                        tbSoapRanap(no_rawat);
                    })
                }
            });
        }
    </script>
@endpush
