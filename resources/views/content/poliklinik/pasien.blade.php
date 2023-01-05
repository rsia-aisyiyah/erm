@extends('index')

@section('contents')
    <div class="row gy-2">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title text-center">PASIEN HARI INI</h5>
                    <p style="background-color: #0067dd;color:white;padding:5px">Poli : <strong>{{ $poli->nm_poli }}</strong>
                    </p>
                    <p style="">Dokter : <strong>{{ $dokter->nm_dokter }}</strong></p>
                    <table>
                        <tr>
                            <td>Jumlah Pasien</td>
                            <td>:</td>
                            <td> <strong>{{ $jumlah }}</strong></td>
                        </tr>
                        <tr>
                            <td>Terupload</td>
                            <td>:</td>
                            <td><strong id="count-uploaded" class="text-success"></strong></td>
                        </tr>
                    </table>

                    <table class="table table-striped table-responsive text-sm table-sm" id="tb_pasien" width="100%">
                        <thead>
                            <tr role="row">
                                <th style="width: 5%">Riwayat</th>
                                <th>Aksi</th>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Upload</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>

                </div>
            </div>

        </div>
        @include('content.upload.inforegistrasi')
        @include('content.upload.resume')
    </div>
@endsection

@push('script')
    <script type="text/javascript">
        $(document).ready(function() {
            tb_pasien();
            countUploaded();
        })

        function countUploaded() {
            $.ajax({
                url: 'count/{{ $poli->kd_poli }}?dokter={{ $dokter->kd_dokter }}',
                method: 'GET',
                dataType: 'JSON',
                success: function(data) {
                    $('#count-uploaded').text(data)
                }
            })
        }

        function tb_pasien() {
            var table = $('#tb_pasien').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: "table/{{ Request::segment(2) }}?dokter={{ Request::get('dokter') }}",
                },
                columns: [{
                        className: 'dt-control',
                        orderable: false,
                        data: null,
                        defaultContent: '',
                    },
                    {
                        data: 'aksi',
                        name: 'aksi'
                    },
                    {
                        data: 'no_reg',
                        name: 'no_reg'
                    },
                    {
                        data: 'nm_pasien',
                        name: 'nm_pasien'

                    },
                    {
                        data: 'upload',
                        name: 'upload',
                    }

                ],
                order: [
                    [1, 'asc']
                ],
            });
            $('#tb_pasien tbody').on('click', 'td.dt-control', function() {
                var tr = $(this).closest('tr');
                var row = table.row(tr);
                var dataPeriksa = [];

                if (row.child.isShown()) {
                    // This row is already open - close it
                    row.child.hide();
                    tr.removeClass('shown');
                } else {
                    // Open this row
                    $.ajax({
                        url: '/erm/test/' + row.data().no_rkm_medis,
                        method: 'GET',
                        dataType: 'JSON',
                        success: function(data) {
                            data.forEach(function(response) {
                                // console.log(dataPeriksa)
                                row.child(resume(response)).show();
                                tr.addClass('shown');
                                tr.removeClass('shown');
                            })
                        }
                    })


                }
            });
        }
    </script>
@endpush
