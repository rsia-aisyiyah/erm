<div class="modal fade" id="modalEwsRanap" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-fullscreen">
        <div class="modal-content" style="border-radius:0px">
            <div class="modal-header">
                <table class="borderless">
                    <tr>
                        <td>Nomor Rawat</td>
                        <td>:</td>
                        <td id="no_rawat_ews">

                        </td>
                    </tr>
                    <tr>
                        <td>Nama</td>
                        <td>:</td>
                        <td id="nama_pasien_ews">

                        </td>
                    </tr>
                    <tr>
                        <td>Umur / JK</td>
                        <td>:</td>
                        <td id="umur_ews">

                        </td>
                    </tr>
                </table>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                {{-- <h5 style="margin-bottom:0px">EARLY WARNING SYSTEM (EWS)</h5>
                    <h5 style="" class="kategori mb-3"></h5> --}}
                {{-- <table class="table table-sm table-bordered table-responsive" id="table-ews" width="100%">
                    <thead>
                        <tr class="tr-tanggal">
                            <th width="15%" colspan="2">Tanggal</th>
                        </tr>
                        <tr class="tr-jam">
                            <th colspan="2">Jam</th>
                        </tr>
                    </thead>
                    <tbody>

                    </tbody>

                </table> --}}

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger btn-sm" data-bs-dismiss="modal" style="font-size: 12px"><i class="bi bi-x-circle"></i> Keluar</button>
            </div>
        </div>
    </div>
</div>
@push('script')
    <script>
        $('#modalEwsRanap').on('hidden.bs.modal', () => {
            $('#table-ews tbody').empty();
            $('.td-jam').remove();
            $('.td-tanggal').remove();
        })
    </script>
@endpush
