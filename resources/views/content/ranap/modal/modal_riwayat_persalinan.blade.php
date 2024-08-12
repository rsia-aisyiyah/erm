<div class="modal fade" id="modalRiwayatPersalinan" tabindex="-1" aria-labelledby="modalRiwayatPersalinan" aria-hidden="true" style="background-color: #00000085;">
    <div class="modal-dialog modal-dialog-centered modal-md">
        <div class="modal-content">
            <div class="modal-header" style="border-radius:0px;background-color: #ffd900;color:#000000">
                <h5 class="modal-title" style="font-size: 1em">Riwayat Persalinan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="" id="formRiwayatPersalinan">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-12 col-md-6 col-sm-12">
                            <div class="input-group">
                                <input type="text" class="form-control form-control-sm" id="no_rkm_medis" name="no_rkm_medis" value="" readonly style="max-width:25%">
                                <input type="text" class="form-control form-control-sm" id="nm_pasien" name="nm_pasien" value="" readonly>
                            </div>
                        </div>
                        <div class="col-lg-8 col-md-6 col-sm-12">
                            <label for="">Tempat Persalinan : </label>
                            <input type="text" class="form-control form-control-sm br-full" id="tempat_persalinan" name="tempat_persalinan" value="">
                        </div>
                        <div class="col-lg-4 col-md-6 col-sm-12">
                            <label for="">Tanggal Persalinan</label>
                            <input type="text" class="form-control form-control-sm br-full" id="tgl_thn" name="tgl_thn" value="{{ date('d-m-Y') }}">
                        </div>
                        <div class="col-lg-8 col-md-6 col-sm-12">
                            <label for="">Jenis Persalinan : </label>
                            <input type="text" class="form-control form-control-sm br-full" id="jenis_persalinan" name="jenis_persalinan" value="">
                        </div>
                        <div class="col-lg-4 col-md-6 col-sm-12">
                            <label for="">Usia Kehamilan</label>
                            <input type="text" class="form-control form-control-sm br-full" id="usia_hamil" name="usia_hamil" value="">
                        </div>
                        <div class="col-lg-8 col-md-6 col-sm-12">
                            <label for="">Penolong : </label>
                            <input type="text" class="form-control form-control-sm br-full" id="penolong" name="penolong" value="">
                        </div>
                        <div class="col-lg-4 col-md-6 col-sm-12">
                            <label for="">Jenis Kelamin</label>
                            <select name="jk" id="jk" class="form-select">
                                <option value="P">Perempuan</option>
                                <option value="L">Laki-laki</option>
                            </select>
                        </div>
                        <div class="col-lg-8 col-md-6 col-sm-12">
                            <label for="">Penyulit : </label>
                            <input type="text" class="form-control form-control-sm br-full" id="penyulit" name="penyulit" value="">
                        </div>
                        <div class="col-lg-4 col-md-6 col-sm-12">
                            <label for="">BB/PB</label>
                            <input type="text" class="form-control form-control-sm br-full" id="bbpb" name="bbpb" value="">
                        </div>
                        <div class="col-lg-8 col-md-6 col-sm-12">
                            <label for="">Keadaan : </label>
                            <input type="text" class="form-control form-control-sm br-full" id="keadaan" name="keadaan" value="">
                            <input type="hidden" id="" name="_token" value="{{ csrf_token() }}">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary btn-sm" data-bs-dismiss="modal" name="" onclick="insertRiwayatPersalinan()"><i class="bi bi-save"></i> Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

@push('script')
    <script>
        $('#modalRiwayatPersalinan').on('hidden.bs.modal', () => {
            $('#formRiwayatPersalinan input[name=tempat_persalinan]').val('')
            $('#formRiwayatPersalinan input[name=tgl_thn]').val("{{ date('d-m-Y') }}")
            $('#formRiwayatPersalinan input[name=jenis_persalinan]').val('')
            $('#formRiwayatPersalinan input[name=usia_hamil]').val('')
            $('#formRiwayatPersalinan input[name=penolong]').val('')
            $('#formRiwayatPersalinan select[name=jk]').val('P')
            $('#formRiwayatPersalinan input[name=penyulit]').val('')
            $('#formRiwayatPersalinan input[name=bbpb]').val('')
            $('#formRiwayatPersalinan input[name=keadaan]').val('')
        })

        function insertRiwayatPersalinan() {
            let data = getDataForm('#formRiwayatPersalinan', ['input', 'select'], ['nm_pasien']);
            data.tgl_thn = splitTanggal(data.tgl_thn);
            $.ajax({
                url: '/erm/riwayat/persalinan/insert',
                data: data,
                method: 'POST',
            }).done((response) => {
                setRiwayatPersalinan(data.no_rkm_medis)
            }).fail((request, status, error, x) => {
                Swal.fire(
                    'Gagal',
                    'Terjadi kesalahan <br/> Error Code : ' + request.status + ', ' + request.statusText + '<br/> <p style="padding:0 15px 0 15px;font-size:13px;color:red">' + request.responseJSON.message.split('(')[0] + '</p>',
                    'error'
                );
            })
        }

        function deleteRiwayatPersalinan(no_rkm_medis, tgl_thn) {
            Swal.fire({
                title: 'Yakin ?',
                text: "Hapus nomor imunisasi",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, hapus saja!',
                cancelButtonText: 'Jangan',
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: '/erm/riwayat/persalinan/delete',
                        data: {
                            no_rkm_medis: no_rkm_medis,
                            tgl_thn: tgl_thn,
                            _token: "{{ csrf_token() }}",
                        },
                        method: 'DELETE',
                    }).done((response) => {
                        setRiwayatPersalinan(no_rkm_medis)
                    })
                }
            })

        }
    </script>
@endpush
