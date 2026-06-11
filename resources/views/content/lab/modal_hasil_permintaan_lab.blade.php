<div class="modal fade" id="modalHasilPermintaanLab" tabindex="-1" aria-labelledby="#modalHasilPermintaanLabLabel"
    aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog modal-dialog-scrollable modal-xl modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title fs-5" id="modalHasilPermintaanLabLabel">Hasil Permintaan Lab</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Debitis quas accusantium sint iure saepe alias
                esse doloribus ducimus sequi. Recusandae repudiandae illum id libero cumque consequatur illo vitae
                doloremque corporis.
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger btn-sm" data-bs-dismiss="modal"><i
                        class="bi bi-x-circle"></i> Keluar</button>
            </div>
        </div>
    </div>
</div>

@push('script')
    <script>
        function showHasilPermintaanLab() {
            $('#modalHasilPermintaanLab').modal('show');

            $.get("{{ route('lab.permintaan.hasil') }}").done((response) => {
                console.log('RESPONSE ===', response);

            })
        }
    </script>
@endpush