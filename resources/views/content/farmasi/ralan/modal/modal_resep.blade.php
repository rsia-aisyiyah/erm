<div class="modal fade" id="modalResepObat" tabindex="-1" aria-labelledby="modalResepObat" aria-hidden="true">
    <div class="modal-dialog  modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">RESEP OBAT</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="d-flex gap-2 text-success" style="font-size:12px">
                    <div>No. Resep : <span id="infoNoResep" style="font-weight: bold"></span></div>
                    <div>Tgl. Resep : <span id="infoTglResep" style="font-weight: bold; "></span></div>
                </div>
                <label for="">Resep By Plan :</label>
                <x-textarea class="notif" id="notifResep" name="notifResep" rows="15" readonly />
            </div>
        </div>
    </div>
</div>
@push('script')
    <script></script>
@endpush
