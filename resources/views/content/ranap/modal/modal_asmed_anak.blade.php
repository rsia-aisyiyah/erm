<div class="modal fade" id="modalAsmedRanapAnak" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-fullscreen">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title fs-5" id="exampleModalLabel">ASESMEN MEDIS ANAK</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                @include('content.ranap.form.form_asemd_anak')
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger btn-sm" data-bs-dismiss="modal" style="font-size: 12px"><i class="bi bi-x-circle"></i> Keluar</button>
                <button type="button" class="btn btn-primary btn-sm btn-asmed-anak" onclick="" name="simpan" style="font-size: 12px"><i class="bi bi-save"></i> Simpan</button>
            </div>
        </div>
    </div>
</div>
@push('script')
    <script>
        $('.anak_dokter').on('keyup', (e) => {
            dokter = $('.anak_dokter').val();
            if (dokter.length >= 3) {
                getDokter(dokter).done((response) => {
                    html =
                        '<ul class="dropdown-menu" style="width:auto;display:block;position:absolute;font-size:12px">';
                    $.map(response, function(data) {
                        html += '<li>'
                        html += '<a data-id="' + data.kd_dokter + '" data-nama="' + data.nm_dokter + '" class="dropdown-item" onclick="setDokterAsmed(this, \'#anak_kd_dokter\', \'#anak_dokter\')">' + data.nm_dokter + '</a>'
                        html += '</li>'
                    })
                    html += '</ul>';
                    $('.list-dokter').fadeIn();
                    $('.list-dokter').html(html);
                })
            }
        });

        function setDokterAsmed(param, id, dokter) {
            kd_dokter = $(param).data('id')
            nm_dokter = $(param).data('nama')

            $(id).val(kd_dokter)
            $(dokter).val(nm_dokter)
            $('.list-dokter').fadeOut();
        }

        $('#modalAsmedRanapAnak').on('hidden.bs.modal', () => {
            document.getElementById('formAsmedRanapAnak').reset()
        });

        function replaceAsmedRanapAnak(no_rawat) {
            const element = ['input', 'textarea', 'select']
            const except = ['nm_dokter', 'pasien', 'tgl_lahir']
            let data = getDataForm('#formAsmedRanapAnak', element, except);
            data['no_rawat_2'] = no_rawat;
            updateAsmedRanapAnak(data).done((response) => {
                alertSuccessAjax('Berhasil mengubah asesmen medis').then(() => {
                    const tableRanap = $('#tb_ranap');
                    if (tableRanap) {
                        $('#tb_ranap').DataTable().destroy()
                        tb_ranap();
                    }
                })
            }).fail((request) => {
                alertErrorAjax(request)
            })
        }
    </script>
@endpush
