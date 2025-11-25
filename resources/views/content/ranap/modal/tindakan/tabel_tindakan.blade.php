<div class="row gy-2">
    {{--                                    <div class="col-lg-4 col-sm-12 col-md-12">--}}
    {{--                                        <x-input-group class="input-group-sm">--}}
    {{--                                            <x-input name="tgl_pertama" id="tgl_pertama" type="date"--}}
    {{--                                                     value="{{date('Y-m-d')}}"></x-input>--}}
    {{--                                            <x-input-group-text>s.d</x-input-group-text>--}}
    {{--                                            <x-input name="tgl_kedua" id="tgl_kedua" type="date"--}}
    {{--                                                     value="{{date('Y-m-d')}}"></x-input>--}}
    {{--                                            <button class="btn btn-primary btn-sm" type="button"--}}
    {{--                                                    id="btnFilterTindakanDokterRanap">--}}
    {{--                                                <i class="bi bi-search"></i>--}}
    {{--                                            </button>--}}
    {{--                                        </x-input-group>--}}
    {{--                                    </div>--}}
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <div class="card-title m-0">Tindakan/Pemeriksaan Dokter</div>
            </div>
            <div class="card-body overflow-auto" style="max-height: 15vh">
                <table class="table table-sm table-bordered table-striped"
                       id="tbTindakanDilakukanDokterRanap">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Tgl. Tindakan</th>
                        <th>Jam</th>
                        <th>Tindakan</th>
                        <th>Oleh</th>
                        <th>Biaya</th>
                    </tr>
                    </thead>
                    <tbody></tbody>
                </table>

            </div>
            <div class="card-footer">
                <button type="button" class="btn btn-danger btn-sm"
                        id="btnHapusTindakanDokterRanap"
                        onclick="deleteTindakanDokterRanap()">
                    <i class="bi bi-trash"></i> Hapus
                </button>
            </div>
        </div>

    </div>
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <div class="card-title m-0">Tindakan/Pemeriksaan Perawat</div>
            </div>
            <div class="card-body overflow-auto" style="max-height: 15vh">
                <table class="table table-sm table-bordered table-striped"
                       id="tbTindakanPerawatRanap">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Tgl. Tindakan</th>
                        <th>Jam</th>
                        <th>Tindakan</th>
                        <th>Oleh</th>
                        <th>Biaya</th>
                    </tr>
                    </thead>
                    <tbody></tbody>
                </table>

            </div>
            <div class="card-footer">
                <button type="button" class="btn btn-danger btn-sm"
                        id="btnHapusTindakanPerawatRanap"
                        onclick="deleteTindakanPerawatRanap()">
                    <i class="bi bi-trash"></i> Hapus
                </button>
            </div>
        </div>
    </div>
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <div class="card-title m-0">Tindakan/Pemeriksaan Perawat & Dokter</div>
            </div>
            <div class="card-body overflow-auto" style="max-height: 30vh">
                <table class="table table-sm table-bordered table-striped"
                       id="tbTindakanDokterPerawatRanap">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Tgl. Tindakan</th>
                        <th>Jam</th>
                        <th>Tindakan</th>
                        <th>Oleh</th>
                        <th>Biaya</th>
                    </tr>
                    </thead>
                    <tbody></tbody>
                </table>

            </div>
            <div class="card-footer">
                <button type="button" class="btn btn-danger btn-sm"
                        id="btnHapusTindakanDokterPerawatRanap"
                        onclick="deleteTindakanDokterPerawatRanap()">
                    <i class="bi bi-trash"></i> Hapus
                </button>
            </div>
        </div>
    </div>
</div>

@push('script')
    <script>
        function getTindakanDokterRanap() {
            const no_rawat = formInfoPasien.find('input[name=no_rawat]');
            const tbTindakanDilakukanDokterRanap = $("#tbTindakanDilakukanDokterRanap").find('tbody')
            tbTindakanDilakukanDokterRanap.empty()
            $.get(`/erm/tindakan-ranap/dokter/get`, no_rawat).done((response) => {
                if (response.length === 0) {
                    return false;
                }

                const tindakan = response.map((item, index) => {
                    return `<tr>
                        <td><input type="checkbox" class="form-check-input check-tindakan-dokter" name="kode_tindakan[]" id="tindakanDokter${index}" value="${item.kd_jenis_prw}" data-tgl="${item.tgl_perawatan}" data-jam="${item.jam_rawat}"
                                data-rawat="${item.no_rawat}"  data-nip="${item.nip}"
                                data-dokter="${item.kd_dokter}"/></td>
                        <td>${formatTanggal(item.tgl_perawatan)}</td>
                        <td>${item.jam_rawat}</td>
                        <td>${item.tindakan.nm_perawatan}</td>
                        <td>${item.dokter.nm_dokter}</td>
                        <td class="text-end"> Rp. ${toRupiah(item.biaya_rawat)}</td>

                    </tr>`
                })

                tbTindakanDilakukanDokterRanap.html(tindakan)
            })

        }

        function getTindakanPerawatRanap() {
            const no_rawat = formInfoPasien.find('input[name=no_rawat]');
            const tbTindakanPerawatRanap = $("#tbTindakanPerawatRanap").find('tbody')
            tbTindakanPerawatRanap.empty()
            $.get(`/erm/tindakan-ranap/perawat/get`, no_rawat).done((response) => {
                if (response.length === 0) {
                    return false;
                }

                const tindakan = response.map((item, index) => {
                    return `<tr>
                        <td><input type="checkbox" class="form-check-input check-tindakan-perawat" name="kode_tindakan[]" id="tindakanPerawat${index}" value="${item.kd_jenis_prw}" data-tgl="${item.tgl_perawatan}" data-jam="${item.jam_rawat}"
                                data-rawat="${item.no_rawat}"  data-nip="${item.nip}"
                                data-dokter="${item.kd_dokter}"/></td>
                        <td>${formatTanggal(item.tgl_perawatan)}</td>
                        <td>${item.jam_rawat}</td>
                        <td>${item.tindakan.nm_perawatan}</td>
                        <td>${item.petugas.nama}</td>
                        <td class="text-end"> Rp. ${toRupiah(item.biaya_rawat)}</td>

                    </tr>`
                })

                tbTindakanPerawatRanap.html(tindakan)
            })

        }

        function getTindakanDokterPerawatRanap() {
            const no_rawat = formInfoPasien.find('input[name=no_rawat]');
            const tbTindakanDokterPerawatRanap = $("#tbTindakanDokterPerawatRanap").find('tbody')
            tbTindakanDokterPerawatRanap.empty();
            $.get(`/erm/tindakan-ranap/dokter-perawat/get`, no_rawat).done((response) => {
                if (response.length === 0) {
                    return false;
                }
                const tindakan = response.map((item, index) => {
                    return `<tr>
                        <td><input type="checkbox" class="form-check-input check-tindakan-drpr" name="kode_tindakan[]" id="tindakanDokterPerawat${index}" value="${item.kd_jenis_prw}" data-tgl="${item.tgl_perawatan}" data-jam="${item.jam_rawat}"
                                data-rawat="${item.no_rawat}"  data-nip="${item.nip}"
                                data-dokter="${item.kd_dokter}"/></td>
                        <td>${formatTanggal(item.tgl_perawatan)}</td>
                        <td>${item.jam_rawat}</td>
                        <td>${item.tindakan.nm_perawatan}</td>
                        <td>
<ul class="m-0">
<li>${item.dokter.nm_dokter}</li>
<li>${item.petugas.nama}</li>
</ul>
</td>
                        <td class="text-end"> Rp. ${toRupiah(item.biaya_rawat)}</td>

                    </tr>`
                })

                tbTindakanDokterPerawatRanap.html(tindakan)
            })

        }

    </script>
@endpush