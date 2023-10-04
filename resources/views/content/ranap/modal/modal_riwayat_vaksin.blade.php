<div class="modal fade" id="modalRiwayatImunisasi" tabindex="-1" aria-labelledby="modalRiwayatImunisasi" aria-hidden="true" style="background-color: #00000085;">
    <div class="modal-dialog modal-dialog-centered modal-md">
        <div class="modal-content">
            <div class="modal-header" style="border-radius:0px;background-color: #ffd900;color:#000000">
                <h5 class="modal-title" style="font-size: 1em">Riwayat Imunisasi</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="" id="formRiwayatImunisasi">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-12">
                            <label for="" style="font-size: 12px">Vaksin : </label>
                            <input type="hidden" name="kode_imunisasi" class="kode_imunisasi">
                            <input type="search" class="form-control form-control-sm nama_imunisasi" name="nama_imunisasi" autocomplete="off">
                            <div class="list-vaksin"></div>
                        </div>
                        <div class="col-sm-12 col-md-6 col-lg-6">
                            <label for="" style="font-size: 12px">Vaksin Ke : </label>
                            <select class="form-select no_imunisasi" name="no_imunisasi">
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                                <option value="6">6</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary btn-sm" data-bs-dismiss="modal" name="tambah-imunisasi"><i class="bi bi-save"></i> Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

@push('script')
    <script>
        function getMasterImunisasi(namaImunisasi) {
            const imunisasi = $.ajax({
                url: '/erm/imunisasi/master',
                data: {
                    nama: namaImunisasi
                },
            })

            return imunisasi;
        }
        $('.nama_imunisasi').keyup((e) => {
            nama = $('.nama_imunisasi').val()
            getMasterImunisasi(nama).done((nm) => {
                if (nm) {
                    html =
                        `<ul class="dropdown-menu" style="width:auto;display:block;position:absolute;font-size:12px">`;
                    $.map(nm, function(data) {
                        html += `<li data-nama="${data.nama_imunisasi}" data-id="${data.kode_imunisasi}" onclick="setVaksin(this)"><a class="dropdown-item" href="#" style="overflow:hidden">${data.nama_imunisasi}</a></li>`
                    })
                    html += '</ul>';
                    $('.list-vaksin').fadeIn();
                    $('.list-vaksin').html(html);
                }
            })
        })

        function setVaksin(p) {
            const nama = $(p).data('nama')
            const kode = $(p).data('id')
            $('.kode_imunisasi').val(kode)
            $('.nama_imunisasi').val(nama)
            $('.list-vaksin').fadeOut();
        }

        function insertRiwayatImunisasi(no_rkm_medis) {
            kode = $('.kode_imunisasi').val()
            nomor = $('.no_imunisasi').val()

            $.ajax({
                url: '/erm/imunisasi/riwayat/insert',
                data: {
                    _token: "{{ csrf_token() }}",
                    no_rkm_medis: no_rkm_medis,
                    kode_imunisasi: kode,
                    no_imunisasi: nomor,
                },
                method: 'POST',
            }).done((response) => {
                console.log('BERHASIL');
                setRiwayatImunisasi(no_rkm_medis)
            })
        }
    </script>
@endpush
