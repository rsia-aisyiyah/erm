<div class="modal fade" id="modalRiwayatIcare" tabindex="-1" aria-labelledby="modalRiwayatIcareLabel" aria-hidden="true">
    <div class="modal-dialog modal-fullscreen">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="modalRiwayatIcareLabel">RIWAYAT PASIEN</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

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
        function riwayatIcare(noka, dokter) {

            let riwayat = $.ajax({
                url: '/erm/bridging/riwayat/icare',
                data: {
                    _token: "{{ csrf_token() }}",
                    param: noka,
                    kodedokter: dokter,
                },
                beforeSend: function() {
                    swal.fire({
                        title: 'Sedang mengirim data',
                        text: 'Mohon Tunggu',
                        showConfirmButton: false,
                        didOpen: () => {
                            swal.showLoading();
                        }
                    })
                },
                crossDomain: true,
                method: 'POST',
                dataType: 'JSON',
            }).done(function(response) {
                if (response.metaData.code == 200) {
                    if (response.response != null) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Sukses !',
                            text: 'Data Berhasil Diproses',
                            showConfirmButton: false,
                            timer: 1500
                        })
                        window.open(response.response.url, 'Riwayat Perawatan Icare', "width=" + screen.availWidth + ",height=" + screen.availHeight)
                    } else {
                        riwayatIcare(noka, dokter)
                    }
                } else {
                    Swal.fire(
                        'Peringatan',
                        response.metaData.message,
                        'warning'
                    )
                }
            }).fail((request) => {
                alertErrorAjax();
            })
        }
    </script>
@endpush
