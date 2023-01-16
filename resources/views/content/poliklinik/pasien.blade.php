@extends('index')

@section('contents')
    <div class="row gy-2">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title text-center">PASIEN HARI INI</h5>
                    <p style="background-color: #0067dd;color:white;padding:5px">Poli :
                        <strong>{{ $poli->nm_poli }}</strong>
                    </p>
                    <p style="">Dokter : <strong>{{ $dokter->nm_dokter }}</strong></p>
                    <table>
                        <tr>
                            <td>Jumlah Pasien</td>
                            <td>:</td>
                            <td> <strong id="count-pasien">{{ $jumlah }}</strong></td>

                        </tr>
                        <tr>
                            <td>Selesai</td>
                            <td>:</td>
                            <td><strong id="count-selesai" class="text-success"></strong></td>
                        </tr>
                        <tr>
                            <td>Terupload</td>
                            <td>:</td>
                            <td><strong id="count-uploaded" class="text-success"></strong></td>
                        </tr>
                    </table>

                    <input type="hidden" class="hitung-panggil" value="">

                    <table class="table table-striped table-responsive text-sm table-sm" id="tb_pasien" width="100%">
                        <thead>
                            <tr role="row">
                                {{-- <th style="width: 5%"></th> --}}
                                <th style="width: 10%">Aksi</th>
                                <th>Nama</th>
                                <th>Tools</th>
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
    @include('content.poliklinik.modal.modal_soap')
    @include('content.poliklinik.modal.modal_riwayat')
@endsection

@push('script')
    <script type="text/javascript">
        var id = '';
        var isModalSoapShow = false;

        $(document).ready(function() {
            var kd_poli = '{{ $poli->kd_poli }}';
            var kd_dokter = '{{ $dokter->kd_dokter }}';
            tb_pasien();
            hitungUpload();
            hitungSelesai();
            hitungPasien();

            setInterval(function() {
                $('#tb_pasien').DataTable().destroy();
                tb_pasien();
                hitungUpload();
                hitungSelesai();
                hitungPasien();

                if (isModalSoapShow == false) {
                    Swal.fire({
                        title: 'Memuat ulang data register!',
                        position: 'top-end',
                        toast: true,
                        icon: 'success',
                        timerProgressBar: true,
                        showConfirmButton: false,
                        timer: 1500
                    })
                }

            }, 25000);
        })

        function hitungPasien() {
            $.ajax({
                url: '/erm/pemeriksaan/jumlah',
                data: {
                    'kd_poli': kd_poli,
                    'kd_dokter': kd_dokter
                },
                method: 'GET',
                success: function(response) {
                    $('#count-pasien').text(response);
                }
            })
        }

        function hitungSelesai() {

            $.ajax({
                url: '/erm/registrasi/selesai',
                method: 'GET',
                data: {
                    'kd_poli': kd_poli,
                    'kd_dokter': kd_dokter,
                },
                dataType: 'JSON',
                success: function(response) {
                    $('#count-selesai').text(response)
                }
            });
        }

        function hitungUpload() {
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
                scrollX: true,
                serverSide: true,
                stateSave: true,
                ajax: {
                    url: "table/{{ Request::segment(2) }}?dokter={{ Request::get('dokter') }}",
                },
                columns: [{
                        data: 'aksi',
                        name: 'aksi'
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
                // order: [
                //     [1, 'asc']
                // ],
            });

            // $('#tb_pasien tbody').on('click', 'td.dt-control', function() {
            //     var tr = $(this).closest('tr');
            //     var row = table.row(tr);
            //     var dataPeriksa = [];

            //     console.log(row);

            //     if (row.child.isShown()) {
            //         row.child.hide();
            //         tr.removeClass('shown');
            //     } else {
            //         $.ajax({
            //             url: '/erm/test/' + row.data().no_rkm_medis,
            //             method: 'GET',
            //             dataType: 'JSON',
            //             success: function(data) {
            //                 data.forEach(function(response) {
            //                     row.child(resume(response)).show();
            //                     tr.addClass('shown');
            //                     tr.removeClass('shown');
            //                 })
            //             }
            //         })
            //     }
            // });
        }
    </script>
@endpush
