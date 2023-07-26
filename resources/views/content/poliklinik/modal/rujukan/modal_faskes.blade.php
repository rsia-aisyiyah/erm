<div class="modal fade" id="modalFaskes" tabindex="-1" aria-labelledby="modalPoli" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-md">
        <div class="modal-content" style="border-radius:0px">
            <div class="modal-header">
                <h6 class="modal-title">Referensi Faskes</h6>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <table class="table table-stripped table-faskes text-sm">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Kode Fakses</th>
                            <th>Nama Faskes</th>
                        </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@push('script')
    <script>
        $('#modalFaskes').on('hidden.bs.modal', function() {
            $('.table-faskes tbody').empty()
        })
        $('#modalFaskes').on('shown.bs.modal', function() {
            $(this).css('background-color', 'rgba(0,0,0,.25)')
        })
    </script>
@endpush
