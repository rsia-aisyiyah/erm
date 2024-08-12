<div class="modal fade" id="modalPenunjangRanap" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">UPLOAD BERKAS PEMERIKSAAN PENUNJANG</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div id="berkas">
                    @include('content.upload.inforegistrasi')
                    @include('content.upload.resume')
                </div>
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
        function modalPenunjangRanap(no_rawat, status) {
            detailPeriksa(no_rawat, status);
            $.ajax({
                url: 'registrasi/foto',
                data: {
                    'no_rawat': no_rawat,
                },
                success: function(response) {
                    console.log(response)
                }
            })

            $('#modalPenunjangRanap').modal('show')

        }

        $('#modalPenunjangRanap').on('hidden.bs.modal', function() {
            // $('#tabel-lab').empty()
        })
    </script>
@endpush
