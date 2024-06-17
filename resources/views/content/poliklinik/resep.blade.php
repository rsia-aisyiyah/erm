<div class="card">
    <div class="card-body" style="height:40vh">
        <input type="hidden" class="no_resep form-control form-control-sm" />
        <ul class="nav nav-tabs" id="myTab">
            <li class="nav-item">
                <a href="#umum" class="nav-link active" data-bs-toggle="tab">NON RACIKAN</a>
            </li>
            <li class="nav-item">
                <a href="#racikan" class="nav-link" data-bs-toggle="tab">RACIKAN</a>
            </li>
            <li class="nav-item">
                <a href="#riwayat" class="nav-link" data-bs-toggle="tab">RIWAYAT RESEP</a>
            </li>
        </ul>
        <div class="tab-content">
            <div class="tab-pane fade show active" id="umum">
                <table class="table table-stripped table-responsive table-sm" id="tbResepDokter" width="100%">
                    <thead>
                        <tr>
                            <th width="35%">Nama Obat</th>
                            <th>Jumlah</th>
                            <th width="35%">Aturan Pakai</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody id="body_umum">

                    </tbody>
                </table>
                <button class="btn btn-primary btn-sm tambah_umum" type="button" onclick="tambahUmum()">Tambah
                    Obat</button>
                <button class="btn btn-success btn-sm btn_simpan_resep" type="button" style="visibility: hidden">Simpan
                    Resep</button>
            </div>
            <div class="tab-pane fade" id="racikan">
                <table class="table table-responsive" id="tbResepRacikan" width="100%">
                    <thead>
                        <tr>
                            <th width="10%">No</th>
                            <th>Nama Racikan</th>
                            <th>Metode Racikan</th>
                            <th width="10%">Jumlah</th>
                            <th>Aturan Pakai</th>

                            <th></th>
                        </tr>
                    </thead>
                    <tbody id="body_racikan">

                    </tbody>
                </table>
                <button class="btn btn-primary btn-sm tambah_racik" type="button" onclick="tambahRacikan()">Tambah Racikan</button>
            </div>
            <div class="tab-pane fade" id="riwayat" style="max-height: 250px; overflow-y: auto">
                <table class="table table-responsive" id="tb-resep-riwayat" width="100%">
                    <thead>
                        <tr>
                            <th>Tanggal</th>
                            <th>No. Resep</th>
                            <th width="65%">Obat/Racikan</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody id="body_riwayat" class="align-top">

                    </tbody>

                </table>
            </div>
        </div>

    </div>
    <div class="card-footer" id="actionResep">
        <button class="btn btn-primary btn-sm" id="btnCreateResep" type="button" onclick="createResep()"><i class="bi bi-plus-circle-fill me-1"></i>Buat Resep</button>
        <button class="btn btn-danger btn-sm d-none" id="btnDeleteResep" type="button"><i class="bi bi-trash me-1"></i>Hapus Resep</button>
    </div>
</div>

@push('script')
    <script>
        const actionResep = $('#actionResep');
        const btnCreateResep = actionResep.find('#btnCreateResep')
        const btnDeleteResep = actionResep.find('#btnDeleteResep')
        const tbResepDokter = $('#tbResepDokter')
        const tbResepRacikan = $('#tbResepRacikan')


        function getResepObat(no_rawat) {
            $.get(`${url}/resep/get`, {
                no_rawat: no_rawat
            }).done((response) => {
                console.log(response.data);
                getResepDokter(response.data.resep_dokter)
                getResepRacikan(response.data.resep_racikan)
                btnDeleteResep.attr('onclick', `deleteResep(${response.data.no_resep})`)
                btnDeleteResep.removeClass('d-none')
                btnCreateResep.addClass('d-none')
            })
        }

        function getResepDokter(data) {
            if (data) {
                const row = data.map((item, index) => {
                    return `<tr>
                            <td>${item.data_barang.nama_brng}</td>
                            <td class="text-center">${item.jml}</td>
                            <td>${item.aturan_pakai}</td>
                            <td>
                                <button class="btn btn-warning btn-sm"><i class="bi bi-pencil"></i></button>    
                                <button class="btn btn-danger btn-sm"><i class="bi bi-x"></i></button>    
                            </td>
                        </tr>`
                }).join('');
                tbResepDokter.find('tbody').empty().append(row);
                return true;
            }
            tbResepDokter.find('tbody').empty()
        }

        function getResepRacikan(data) {
            if (data) {
                console.log('RACIKAN ===', data);

                const row = data.map((item, index) => {
                    const detail = item.detail_racikan;
                    let rowDetail = '';
                    if (detail.length) {
                        const isiDetail = detail.map((item, index) => {
                            return `<span class="badge rounded-pill bg-warning text-dark" style="font-size:10px">${item.databarang.nama_brng} (${item.kandungan} mg)</span>`
                        }).join(' ')
                        rowDetail = `<tr><td></td><td colspan=5>${isiDetail}</td></tr>`;
                    }
                    return `<tr>
                            <td>${item.no_racik}</td>
                            <td>${item.nama_racik}</td>
                            <td>${item.metode.nm_racik}</td>
                            <td class="text-center">${item.jml_dr}</td>
                            <td>${item.aturan_pakai}</td>
                            <td>
                                <button class="btn btn-sm btn-warning"><i class="bi bi-pencil"></i></button>    
                                <button class="btn btn-sm btn-danger"><i class="bi bi-x"></i></button>    
                            </td>
                        </tr>${rowDetail}`
                    console.log('DETAIL ===', item.detail_racikan);
                })
                tbResepRacikan.find('tbody').empty().append(row)
                return true;
            }
            tbResepRacikan.find('tbody').empty()
        }

        function createResep() {
            const formSoapPoli = $('#formSoapPoli');
            const no_rawat = formSoapPoli.find('input[name="no_rawat"]').val();
            const dokter = formSoapPoli.find('select[name="dokter"]').val();

            $.post(`${url}/resep/create`, {
                '_token': "{{ csrf_token() }}",
                'no_rawat': no_rawat,
                'kd_dokter': dokter
            }).done((response) => {
                toastReload(response.message, 2000)
                btnDeleteResep.attr('onclick', `deleteResep(${response.data.no_resep})`)
                btnDeleteResep.removeClass('d-none')
                btnCreateResep.addClass('d-none')
                formSoapPoli.find('input[name=no_resep]').val(response.data.no_resep);
            }).fail((response) => {
                alertErrorAjax(response);
            });
        }

        function deleteResep(no_resep) {
            $.ajax({
                url: `${url}/resep/delete/${no_resep}`,
                method: 'DELETE',
                data: {
                    '_token': "{{ csrf_token() }}"
                }
            }).done((response) => {
                toastReload(response.message, 2000)
                btnDeleteResep.addClass('d-none')
                btnCreateResep.removeClass('d-none')
            })
        }

        function tambahObatUmum() {

        }
    </script>
@endpush
