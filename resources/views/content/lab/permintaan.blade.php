@extends('index')

@section('contents')
    <div class="card">
        <div class="card-body">
            <div class="row gy-2">
                <div class="col-lg-3 col-md-12 col-md-12">
                    <label class="form-label">Tgl. Pemeriksaan</label>
                    <x-input-group class="input-group-sm">
                        <x-input id="tgl_pertama" name="tgl_pertama" class="filterTanggal" />
                        <x-input-group-text>s.d.</x-input-group-text>
                        <x-input id="tgl_kedua" name="tgl_kedua" class="filterTanggal" />
                        <button class="btn btn-primary" id="btnFilterTglLab">
                            <i class="bi bi-search"></i>
                        </button>
                    </x-input-group>
                </div>
            </div>
            <table class="table table-striped table-sm table-hover" id="tablePermintaanLab">

            </table>
        </div>
    </div>
@endsection

@push('script')
    <script>
        const tablePermintaanLab = $('#tablePermintaanLab')
        const btnFilterTglLab = $('#btnFilterTglLab')

        $(document).ready(() => {
            renderTablePermintaanLab();
        })



        $('.filterTanggal').datepicker({
            format: 'dd-mm-yyyy',
            autoclose: true,
            orientation: 'bottom',
            todayHighlight: true,
        })
        $('.filterTanggal').datepicker('setDate', `{{ date('d-m-Y') }}`);

        function renderTablePermintaanLab() {
            tablePermintaanLab.dataTable({
                processing: true,
                destroy: true,
                serverSide: true,
                ajax: {
                    url: '/erm/lab/ambil/table',
                    data: function(d) {
                        d.tgl_pertama = $('#tgl_pertama').val();
                        d.tgl_kedua = $('#tgl_kedua').val();
                    }
                },
                columns: [{
                        title: 'No. Rawat',
                        data: 'no_rawat',
                        name: 'no_rawat',
                    }

                ],
            })
        }

        btnFilterTglLab.on('click', () => {
            renderTablePermintaanLab();
        })
    </script>
@endpush
