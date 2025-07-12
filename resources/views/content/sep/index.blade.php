@extends('index')

@section('contents')
    <div class="container-fluid">
        <div class="card">
            <div class="card-header">SEP</div>
            <div class="card-body">
                <div class="row mb-3">
                    <div class="col-md-3">
                        <x-input-group class="input-group-sm">
                            <x-input class="form-control" id="start_date" name="start_date" value="{{ date('Y-m-d') }}" type="date"></x-input>
                            <x-input-group-text for="no_sep" label="s/d"></x-input-group-text>
                            <x-input class="form-control" id="end_date" name="end_date" value="{{ date('Y-m-d') }}" type="date"></x-input>
                        </x-input-group>
                    </div>
                    <div class="col-md-3">
                        <button id="filter" class="btn btn-primary btn-sm"><i class="bi bi-filter"></i> Filter</button>
                    </div>
                </div>

                <div class="table-responsive">
                    <table class="table table-striped table-sm" id="tableSep"></table>
                </div>
            </div>
        </div>
    </div>
    @include('content.poliklinik.modal.modal_icare')
@endsection


@push('script')
    <script>
        const start = $('#start_date');
        const end = $('#end_date');
        const filter = $('#filter');

        // $(document).ready(function() {


        const tableSep = $('#tableSep').DataTable({
            processing: true,
            serverSide: true,
            lengthChange: true,
            ordering: true,
            processing: true,
            searching: true,
            scrollY: '50vh',
            ajax: {
                url: "{{ route('sep.datatable') }}",
                data: function(d) {
                    d.start_date = start.val();
                    d.end_date = end.val();
                }
            },
            columns: [{
                data: 'kddpjp',
                // name: 'action',

                title: '',
                render: (data, type, row, meta) => {
                    return `<button class="btn btn-sm btn-success" onclick="riwayatIcare('${row.no_kartu}', '${data}')"><i class="bi bi-file-earmark-text"></i> Icare</button>`
                }
            }, {
                data: 'tglsep',
                name: 'tglsep',
                title: 'Tgl. SEP'
            }, {
                data: 'no_sep',
                name: 'no_sep',
                title: 'No. Sep'
            }, {
                data: 'no_rawat',
                name: 'no_rawat',
                title: 'No. Rawat'
            }, {
                data: 'nomr',
                name: 'nomr',
                title: 'No. RM'
            }, {
                data: 'nama_pasien',
                render: (data, type, row, meta) => {
                    return `${data} (${row.jkel})`
                },
                name: 'nama_pasien',
                title: 'Nama'

            }, {
                data: 'reg_periksa.umurdaftar',
                name: 'reg_periksa.umurdaftar',
                render: (data, type, row, meta) => {
                    return `${data} ${row.reg_periksa.sttsumur}`
                },
                title: 'Umur'
            }, {
                data: 'reg_periksa.poliklinik.nm_poli',
                name: 'reg_periksa.poliklinik.nm_poli',
                title: 'Poli'
            }, {
                data: 'jnspelayanan',
                name: 'jnspelayanan',
                render: (data, type, row, meta) => {
                    return `${row.jnspelayanan =='2' ? 'Rawat Jalan' : 'Rawat Inap'}`
                },
                title: 'Jenis Pelayanan'
            }]
        })
        // })

        filter.on('click', function() {
            tableSep.ajax.reload(null, true);
        })
    </script>
@endpush
