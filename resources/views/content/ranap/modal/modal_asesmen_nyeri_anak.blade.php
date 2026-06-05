<div class="modal fade" id="modalAsesmenNyeriAnak" tabindex="-1" aria-labelledby="modalAsesmenNyeriAnak"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title fs-5" id=""><i>ASESMEN NYERI ANAK > 7 TAHUN (NUMERIC RATING SCALE)</i></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                @include('content.ranap.form.form_nyeri_anak')
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary btn-sm" style="font-size: 13px"
                    id="btnCreateAsesmenNyeriAnak">
                    <i class="bi bi-save me-1">
                    </i> Simpan
                </button>
                <button type="button" class="btn btn-danger btn-sm" data-bs-dismiss="modal" style="font-size: 13px">
                    <i class="bi bi-x-circle me-1">
                    </i> Keluar
                </button>
            </div>
        </div>
    </div>
</div>

@push('script')
    <script>
        const modalAsesmenNyeriAnak = $('#modalAsesmenNyeriAnak');

        function showModalAsesmenNyeriAnak(no_rawat) {
            btnCreateAsesmenNyeriAnak = $('#btnCreateAsesmenNyeriAnak');
            resetFormAsesmenNyeriAnak(no_rawat)
            renderAsesmenNyeriAnak(no_rawat)
            modalAsesmenNyeriAnak.modal('show')
            btnCreateAsesmenNyeriAnak.attr('onclick', 'createAsesmenNyeriAnak() ')
        }

        modalAsesmenNyeriAnak.on('hidden.bs.modal', function () {
           $('#btnCreateAsesmenNyeriAnak').removeAttr('onclick');
        })


    </script>
@endpush