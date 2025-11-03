<form action="" class="formInfoTindakan mb-2">
    <div class="row">
        <div class="col-lg-2 col-md-6 col-sm-12">
            <label for="no_rawat">No. Rawat</label>
            <x-input name="no_rawat" id="no_rawat" readonly/>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-12">
            <label for="pasien">Pasien</label>
            <x-input-group class="input-group-sm">
                <x-input name="no_rkm_medis" id="no_rkm_medis" readonly/>
                <x-input name="nm_pasien" id="nm_pasien" class="w-50" readonly/>
            </x-input-group>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-12">
            <label for="tgl_lahir"> Tgl. Lahir / Umur</label>
            <x-input name="tgl_lahir" id="tgl_lahir" readonly/>
        </div>
        <div class="col-lg-2 col-md-6 col-sm-12">
            <label for="pembiayaan">Pembiayaan</label>
            <x-input name="pembiayaan" id="pembiayaan" readonly/>
        </div>
        <div class="col-lg-2 col-md-6 col-sm-12">
            <label for="keluarga">Keluarga</label>
            <x-input name="keluarga" id="keluarga" readonly/>
            <x-input name="dokter" id="dokter" readonly type="hidden"/>
            <x-input name="nm_dokter" id="nm_dokter" readonly type="hidden"/>
        </div>
    </div>
</form>
<ul class="nav nav-tabs nav-tabs-expand" id="groupTindakan" role="tablist">
    <li class="nav-item" role="presentation" id="tabTindakanDokter">
        <button class="nav-link" id="btnTabTindakanDokter" data-bs-toggle="tab"
                data-bs-target="#targetTindakanDokter"
                type="button" role="tab" aria-controls="targetTindakanDokter" aria-selected="false">Tindakan
            Dokter
        </button>
    </li>
    <li class="nav-item" role="presentation" id="tabTindakanPerawat">
        <button class="nav-link" id="btnTabTindakanPerawat" data-bs-toggle="tab"
                data-bs-target="#targetTindakanPerawat"
                type="button" role="tab" aria-controls="targetTindakanPerawat" aria-selected="false">Tindakan
            Perawat
        </button>
    </li>
    <li class="nav-item" role="presentation" id="tabTindakanDokterPerawat">
        <button class="nav-link" id="btnTabTindakanDokterPerawat" data-bs-toggle="tab"
                data-bs-target="#targetTindakanDokterPerawat"
                type="button" role="tab" aria-controls="targetTindakanDokterPerawat" aria-selected="false">Tindakan
            Dokter & Perawat
        </button>
    </li>
</ul>
<div class="row">
    <div class="col-lg-5 col-xl-6 col-md-12 col-sm-12">
        <div class="tab-content" id="contentTabTindakan">
            <div class="tab-pane fade p-2" id="targetTindakanDokter" role="tabpanel"
                 aria-labelledby="tabTindakanDokter" tabindex="0">
                @include('content.poliklinik.modal.tindakan.tindakan_ralan_dr')
            </div>
            <div class="tab-pane fade p-2" id="targetTindakanPerawat" role="tabpanel"
                 aria-labelledby="tabTindakanDokter" tabindex="0">
                @include('content.poliklinik.modal.tindakan.tindakan_ralan_pr')
            </div>
            <div class="tab-pane fade p-2" id="targetTindakanDokterPerawat" role="tabpanel"
                 aria-labelledby="tabTindakanDokter" tabindex="0">
                @include('content.poliklinik.modal.tindakan.tindakan_ralan_drpr')
            </div>
        </div>
    </div>
    <div class="col-xl-6 col-lg-7 col-md-12 col-sm-12 p-2">

        <div class="d-flex flex-column gap-2">
            <div class="card">
                <div class="card-header text-white bg-primary ">
                    Tindakan Dokter
                </div>
                <div class="card-body">
                    <table class="table table-bordered" id="tabelTindakanDilakukan">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Tgl.</th>
                            <th>Jam</th>
                            <th>Perawatan</th>
                            <th>Dokter</th>
                            <th>Biaya</th>
                        </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                    <button type="button" class="btn btn-sm btn-danger" onclick="deleteTindakanDokter()">
                        <i class="ti ti-trash"></i>Hapus
                    </button>
                </div>
            </div>
            <div class="card">
                <div class="card-header text-white bg-primary ">
                    Tindakan Perawat
                </div>
                <div class="card-body">
                    <table class="table table-bordered" id="tabelTindakanDilakukanPr">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Tgl.</th>
                            <th>Jam</th>
                            <th>Tindakan</th>
                            <th>Petugas</th>
                            <th>Biaya</th>
                        </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                    <button type="button" class="btn btn-sm btn-danger" onclick="deleteTindakanPerawat()">
                        <i class="ti ti-trash"></i>Hapus
                    </button>
                </div>
            </div>
            <div class="card">
                <div class="card-header text-white bg-primary ">
                    Tindakan Dokter & Perawat
                </div>
                <div class="card-body">
                    <table class="table table-bordered" id="tabelTindakanDilakukanDrPr">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Tgl.</th>
                            <th>Jam</th>
                            <th>Tindakan</th>
                            <th>Dokter & Perawat</th>
                            <th>Biaya</th>
                        </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                    <button type="button" class="btn btn-sm btn-danger" onclick="deleteTindakanDokterPerawat()">
                        <i class="ti ti-trash"></i>Hapus
                    </button>
                </div>
            </div>
        </div>

    </div>
</div>


@push('script')
    <script>
        $('#tabTindakan').on('shown.bs.tab', function () {
            const no_rawat = $('#no_rawat').val();
            const formInfoTindakan = $('.formInfoTindakan')
            $.get(`/erm/periksa/detail`, {
                no_rawat: no_rawat
            }).done((response) => {
                const {pasien, penjab, dokter} = response

                formInfoTindakan.find('#no_rawat').val(no_rawat)
                formInfoTindakan.find('#no_rkm_medis').val(response.no_rkm_medis)
                formInfoTindakan.find('#nm_pasien').val(`${pasien.nm_pasien} (${pasien.jk})`)
                formInfoTindakan.find('#tgl_lahir').val(`${formatTanggal(pasien.tgl_lahir)} / ${hitungUmur(pasien.tgl_lahir)}`)
                formInfoTindakan.find('#pembiayaan').val(penjab.png_jawab)
                formInfoTindakan.find('#keluarga').val(`${response.p_jawab} / ${response.hubunganpj}`)
                formInfoTindakan.find('#nm_dokter').val(dokter.nm_dokter)
                formInfoTindakan.find('#dokter').val(dokter.kd_dokter)
                $('#btnTabTindakanDokter').trigger('click')
            })

            $('.btn-asmed-ranap').addClass('d-none')
            $('.btn-asmed').addClass('d-none')
            $('.btn-soap').addClass('d-none')

            getTindakanDilakukanDr(no_rawat)
            getTindakanDilakukanPr(no_rawat)
            getTindakanDilakukanDrPr(no_rawat)

        })


    </script>
@endpush