<div class="modal fade" id="modalLabRanap" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-body">
                <h5 class="text-center">HASIL PEMERIKSAAN LAB</h5>
                <table class="borderless">
                    <tr>
                        <td>Nomor Rawat</td>
                        <td>:</td>
                        <td id="no_rawat">

                        </td>
                    </tr>
                    <tr>
                        <td>Nama</td>
                        <td>:</td>
                        <td id="nama_pasien">

                        </td>
                    </tr>
                    <tr>
                        <td>Umur / JK</td>
                        <td>:</td>
                        <td id="umur">

                        </td>
                    </tr>
                </table>

                <table class="table table-bordered" width="100%">
                    <thead>
                        <tr>
                            <th>Pemeriksaan</th>
                            <th>Hasil</th>
                            <th>Nilai Rujukan</th>
                            <th>Keterangan</th>
                        </tr>
                    </thead>
                    <tbody id="tabel-lab">
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger btn-sm" data-bs-dismiss="modal"><i
                        class="bi bi-x-circle"></i> Keluar</button>
                <button type="button" class="btn btn-primary btn-sm" onclick="simpanSoap()"><i class="bi bi-save"></i>
                    Simpan</button>
            </div>
        </div>
    </div>
</div>
@push('script')
    <script>
        function modalLabRanap(no_rawat) {
            let hasil = '';
            let jenisPerawatan = '';
            let tglPeriksa = '';
            $.ajax({
                url: 'registrasi/ambil',
                data: {
                    'no_rawat': no_rawat,
                },
                success: function(response) {
                    $('#no_rawat').html(no_rawat);
                    umur = response.umurdaftar;
                    status_umur = response.sttsumur;
                    if (data.pasien) {
                        jk = res.reg_periksa.pasien.jk == 'L' ? 'Laki-laki' : 'Perempuan';
                        $('#nama_pasien').html(res.reg_periksa.pasien.nm_pasien + ' ( No. RM ' + res
                            .reg_periksa
                            .no_rkm_medis + ')');
                        $('#umur').html(umur + ' ' + status_umur +
                            ' / ' + jk)
                    } else {
                        pasien = response.no_rkm_medis.replace(/\s/g, '');
                        $.ajax({
                            url: 'pasien/cari',
                            data: {
                                'q': pasien,
                            },
                            success: function(response) {
                                $.map(response, function(data) {
                                    jk = data.jk == 'L' ?
                                        'Laki-laki' : 'Perempuan';
                                    $('#nama_pasien').html(data.nm_pasien + ' ( No. RM ' + data
                                        .no_rkm_medis + ')');
                                    $('#umur').html(umur + ' ' + status_umur +
                                        ' / ' + jk)
                                })
                            }
                        })
                    }
                }
            })

            $.ajax({
                url: 'lab/ambil',
                data: {
                    'no_rawat': no_rawat,
                },
                success: function(response) {
                    if (Object.keys(response).length > 0) {
                        response.forEach(function(res) {

                            if (jenisPerawatan != res.jns_perawatan_lab.kd_jenis_prw || tglPeriksa !=
                                res
                                .tgl_periksa) {
                                hasil +=
                                    '<tr class="borderless" style="background-color:#eee"><td colspan="3"><strong>' +
                                    res
                                    .jns_perawatan_lab
                                    .nm_perawatan + '</strong> <br/> ' + formatTanggal(res
                                        .tgl_periksa) +
                                    ' ' +
                                    res.jam + '</td><td>' + res.periksa_lab.petugas.nama + '</td></tr>';
                            }

                            if (res.keterangan == 'L') {
                                warna = 'style="color:#fff;background-color:#0d6efd;font-weight:bold"';
                            } else if (res.keterangan == 'H' || res.keterangan == '*') {
                                warna = 'style="color:#fff;background-color:#dc3545;font-weight:bold"';
                            } else {
                                warna = '';
                            }

                            hasil += '<tr ' + warna + '>';
                            hasil += '<td>' + res.template.Pemeriksaan + '</td>';
                            hasil += '<td>' + res.nilai + ' ' + res.template.satuan +
                                '</td>';
                            hasil += '<td>' + res.nilai_rujukan + '</td>';
                            hasil += '<td>' + res.keterangan + '</td>';
                            hasil += '</tr>';

                            jenisPerawatan = res.jns_perawatan_lab.kd_jenis_prw;
                            tglPeriksa = res.tgl_periksa;


                            // console.log(res.reg_periksa)



                        })
                        $('#tabel-lab').append(hasil)
                        $('#modalLabRanap').modal('show')
                    } else {
                        Swal.fire(
                            'Kosong!', 'Belum ada pemeriksaan laborat', 'error'
                        );
                    }

                }
            });

        }

        $('#modalLabRanap').on('hidden.bs.modal', function() {
            $('#tabel-lab').empty()
        })
    </script>
@endpush
