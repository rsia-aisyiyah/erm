<div class="modal fade" id="modalPenunjangRanap" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-fullscreen">
        <div class="modal-content">
            <div class="modal-body">
                <h5 class="text-center">BERKAS PEMERIKSAAN PENUNJANG</h5>
                <div id="berkas">
                    @include('content.upload.inforegistrasi')
                    @include('content.upload.resume')
                </div>
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
        function modalPenunjangRanap(no_rawat) {
            detailPeriksa(no_rawat, 'Ranap');
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
