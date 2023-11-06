@extends('index')

@section('contents')
    <div class="input-group mb-3">
        <select class="search form-control" name="keyword"></select>
    </div>


    <div class="row gy-2">
        <div class="col-sm-6">
            <div class="card">
                <div class="card-header text-bg-warning">
                    Histori Kunjungan Rawat Jalan
                </div>
                <div class="card-body">
                    <table id="ralan" class="table table-responsive text-sm table-sm">
                        <thead>
                            <tr>
                                <th>No. Rawat</th>
                                <th>Tanggal</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="card">
                <div class="card-header text-bg-danger">
                    Histori Kunjungan Rawat Inap
                </div>
                <div class="card-body">
                    <table id="ranap" class="table table-responsive text-sm table-sm">
                        <thead>
                            <tr>
                                <th>No. Rawat</th>
                                <th>Tanggal</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-sm-12">
            @include('content.upload.inforegistrasi')
        </div>
        <div class="col-sm-12">
            @include('content.upload.resume')
            @include('content.poliklinik.modal.modal_riwayat')
        </div>
    </div>
@endsection

@push('script')
    <script>
        var btnName;
        $('.search').select2({
            placeholder: 'Cari pasien',
            allowClear: true,
            ajax: {
                url: 'pasien/cari',
                dataType: 'json',
                processResults: function(data) {
                    return {
                        results: $.map(data, function(item) {
                            return {
                                text: item.no_rkm_medis + ' - ' + item.nm_pasien,
                                id: item.no_rkm_medis
                            }
                        })
                    };
                },
                cache: true
            }
        });
        $(".search").on("select2:unselecting", function(e) {
            $('#button-form label').detach()
            $('#button-form input').detach()
        });

        $('.search').change(function() {
            $('#infoReg').css('visibility', 'hidden')
            $('#form-upload').css('visibility', 'hidden')
            showHistory();
        });


        $(document).ready(function() {
            if ($('.pip').length == 0) {
                $('#submit').hide()
            }
        })
    </script>
@endpush
