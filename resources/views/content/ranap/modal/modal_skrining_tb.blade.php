<div class="modal fade" id="modalSkoringTb" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title fs-5" id="exampleModalLabel">Skoring & Skrining TB</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="" id="formPasienSkoringTb">
                    <div class="row gy-2">
                        <div class="col-lg-4">
                            <div class="input-group">
                                <label for="no_rawat" class="form-label">No. Rawat</label>
                                <input type="text" class="form-control br-full" id="no_rawat" name="no_rawat" readonly>
                            </div>
                        </div>
                        <div class="col-lg-5">
                            <div class="input-group">
                                <label for="nm_pasien">Pasien</label>
                                <input type="text" class="form-control br-full" id="nm_pasien" name="nm_pasien" readonly>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="input-group">
                                <label for="keluarga">Keluarga</label>
                                <input type="text" class="form-control br-full" id="keluarga" name="keluarga" readonly>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="input-group">
                                <label for="kamar">Kamar</label>
                                <input type="text" class="form-control br-full" id="kamar" name="kamar" readonly>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="input-group">
                                <label for="diagnosa">Diagnosa Awal</label>
                                <input type="text" class="form-control br-full" id="diagnosa" name="diagnosa" readonly>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="input-group">
                                <label for="dokter">DPJP</label>
                                <input type="text" class="form-control br-full" id="dokter" name="dokter" readonly>
                                <input type="hidden" id="kd_dokter" name="kd_dokter" readonly>
                            </div>
                        </div>

                    </div>
                </form>

                <ul class="nav nav-tabs mt-3" id="tabsSkoringTb" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="formSkoringTb-tab" data-bs-toggle="tab" data-bs-target="#tabSkoringTb" type="button" role="tab" aria-controls="tabSkoringTb" aria-selected="true">Form Skoring</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="SkoringTb-tab" data-bs-toggle="tab" data-bs-target="#SkoringTb" type="button" role="tab" aria-controls="SkoringTb" aria-selected="true">Hasil Skoring</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="formSkriningTb-tab" data-bs-toggle="tab" data-bs-target="#tabSkriningTb" type="button" role="tab" aria-controls="tabSkiringTb" aria-selected="true">Form Skrining</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="skriningTb-tab" data-bs-toggle="tab" data-bs-target="#skriningTb" type="button" role="tab" aria-controls="skriningTb" aria-selected="true">Hasil Skrining</button>
                    </li>
                </ul>
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active p-3" id="tabSkoringTb" role="tabpanel" aria-labelledby="formSkoringTb-tab">
                        @include('content.ranap.modal.skriningTb._formSkoringTb')
                    </div>
                    <div class="tab-pane fade p-3" id="SkoringTb" role="tabpanel" aria-labelledby="SkoringTb-tab">
                        <table class="table nowrap" id="tbSkoringTb" width="100%"></table>
                    </div>
                    <div class="tab-pane fade p-3" id="tabSkriningTb" role="tabpanel" aria-labelledby="formSkriningTb-tab">
                        @include('content.ranap.modal.skriningTb._formSkriningTb')
                    </div>
                    <div class="tab-pane fade p-3" id="skriningTb" role="tabpanel" aria-labelledby="skriningTb-tab">
                        <table class="table nowrap" id="tbSkriningTb" width="100%"></table>
                    </div>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger btn-sm" data-bs-dismiss="modal" style="font-size: 12px">
                    <i class="bi bi-x-circle">
                    </i> Keluar
                </button>
            </div>
        </div>
    </div>
</div>
</div>
@push('script')
    <script>
        const modalSkoringTb = $('#modalSkoringTb');

        // var formTab = '';
        // var tableTab = '';
        // var instanceFormTab = '';
        // var instanceTableTab = '';

        // modalSkoringTb.on('shown.bs.modal', () => {
        //     formTab = document.getElementById('formSkoringTb-tab')
        //     tableTab = document.getElementById('SkoringTb-tab')
        //     instanceFormTab = bootstrap.Tab.getInstance(formTab);
        //     instanceTableTab = new bootstrap.Tab(tableTab);
        // })

        modalSkoringTb.on('hidden.bs.modal', () => {
            formSkoringTb.trigger('reset')
            formSkriningTb.trigger('reset')
        })
    </script>
@endpush
