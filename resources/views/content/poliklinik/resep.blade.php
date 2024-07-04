<div class="card">
    <div class="card-body" style="max-height:80vh;height:40vh">
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
            <div class="tab-pane fade show active" id="umum" style="overflow: auto;max-height: 30vh">
                @include('content.poliklinik.resep._resepUmum')
            </div>
            <div class="tab-pane fade" id="racikan" style="overflow: auto;max-height: 30vh">
                @include('content.poliklinik.resep._resepRacikan')
            </div>
            <div class="tab-pane fade" id="riwayat" style="overflow: auto;max-height: 30vh">
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
        const btnTambahResepUmum = $('#btnTambahResepUmum')
        const btnSimpanResepUmum = $('#btnSimpanResepUmum')
        const tbResepDokter = $('#tbResepDokter')



        function getResepObat(no_rawat) {
            $.get(`${url}/resep/get`, {
                no_rawat: no_rawat
            }).done((response) => {
                const hasData = !!response.data
                if (response.data) {
                    setResepToPlan(no_rawat)
                    formSoapPoli.find('#no_resep').val(response.data.no_resep)
                    setResepDokter(response.data.resep_dokter)
                    setResepRacikan(response.data.resep_racikan)
                    btnDeleteResep.attr('onclick', `deleteResep(${response.data.no_resep})`)
                } else {
                    btnDeleteResep.removeAttr('onclick')
                }
                toggleElementResep(hasData)

            })
        }

        function toggleElementResep(hasData = true) {
            const elements = [
                btnDeleteResep,
                tbResepDokter,
                tbResepRacikan,
                btnTambahResepRacik,
                btnCreateResepRacik,
                btnTambahResepUmum,
                btnSimpanResepUmum,
            ];
            const reserveElements = [btnCreateResep];

            elements.forEach(element => element.toggleClass('d-none', !hasData));
            reserveElements.forEach(element => element.toggleClass('d-none', hasData));
        }



        function createResep() {
            const formSoapPoli = $('#formSoapPoli');
            const no_rawat = formSoapPoli.find('input[name="no_rawat"]').val();
            const dokter = formSoapPoli.find('select[name="dokter"]').val();

            if (role === 'dokter') {
                cekPanggilanPoli(no_rawat).done((response) => {
                    if (!Object.keys(response).length) {
                        Swal.fire({
                            title: 'Gagal',
                            text: 'Pasien belum dipanggil, anda tidak diperbolehkan mebuat resep',
                            icon: 'error',
                            showCancelButton: false,
                        })
                        return false
                    }
                    $.post(`${url}/resep/create`, {
                        '_token': "{{ csrf_token() }}",
                        'no_rawat': no_rawat,
                        'kd_dokter': dokter,
                        'status': 'ralan',
                    }).done((response) => {
                        toastReload(response.message, 2000)
                        btnDeleteResep.attr('onclick', `deleteResep(${response.data.no_resep})`)
                        toggleElementResep()
                        formSoapPoli.find('input[name=no_resep]').val(response.data.no_resep);
                    }).fail((response) => {
                        alertErrorAjax(response);
                    });

                });

            } else {
                Swal.fire({
                    title: 'Gagal',
                    html: 'Anda tidak diperbolehkan membuat resep',
                    icon: 'error',
                })
            }
        }

        function deleteResep(no_resep) {
            const no_rawat = formSoapPoli.find('input[name="no_rawat"]').val();
            Swal.fire({
                title: 'Apakah anda yakin ?',
                text: "Anda tidak bisa mengembalikan lagi",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, hapus saja!',
                cancelButtonText: 'Jangan',
            }).then(() => {
                $.ajax({
                    url: `${url}/resep/delete/${no_resep}`,
                    method: 'DELETE',
                    data: {
                        '_token': "{{ csrf_token() }}"
                    }
                }).done((response) => {
                    toastReload(response.message, 2000)
                    toggleElementResep(false);
                    setResepToPlan(no_rawat)
                    tbResepDokter.find('tbody').empty()
                    tbResepRacikan.find('tbody').empty()
                })
            })

        }


        function selectDataBarang(element) {
            return element.select2({
                delay: 2,
                scrollAfterSelect: true,
                ajax: {
                    url: `${url}/obat/cari`,
                    dataType: 'JSON',

                    data: (params) => {
                        const query = {
                            nama: params.term
                        }
                        return query
                    },
                    processResults: (result) => {

                        return {
                            results: result.data.map((item) => {
                                const stok = getStokBarang(item);
                                const ketStok = stok > 0 ? '' : 'text-danger';
                                const items = {
                                    id: item.kode_brng,
                                    name: `<span class="${ketStok}">${item.nama_brng}</span> <br/> Stok : ${stok}  <span class="text-muted">Rp.${toRupiah(item.ralan)}</span>`,
                                    text: `${item.nama_brng}`,
                                    detail: {
                                        kapasitas: item.kapasitas,
                                        id: item.kode_brng,
                                        name: item.nama_brng,
                                    },
                                }
                                return items;

                            })
                        }
                    }

                },
                templateSelection: (item, element) => {
                    return item.text
                },
                templateResult: (item, option) => {
                    return item.name
                },
                escapeMarkup: (markup) => {
                    return markup;
                },
                cache: true

            })
        }

        function isDuplicateObat(element, kode_brng, target) {
            let isDuplicate = false;

            element.find('tr').each((index, item) => {
                const id = $(item).data('id');
                const selectVal = $(item).find('select').val();

                if (id === kode_brng) {

                    Swal.fire({
                        title: 'Peringatan',
                        html: 'Barang sudah ada di resep',
                        icon: 'warning',
                    }).then(() => {
                        target.val('').trigger('change');
                        target.select2('open');
                    });

                    isDuplicate = true;
                    return false; // Break the .each loop
                }
            });

            if (isDuplicate) {
                return true;
            }

            const obat = element.find('select[name="nm_obat[]"]').map((i, x) => x.value).get();
            const uniqueObat = [...new Set(obat)];
            if (uniqueObat.length !== obat.length) {
                Swal.fire({
                    title: 'Peringatan',
                    html: 'Barang sudah ada di resep',
                    icon: 'warning'
                }).then(() => {
                    target.val('').trigger('change');
                });

                return true;
            }

            return false;
        }

        function selectAturanPakai(element) {
            return element.select2({
                tags: true,
                ajax: {
                    url: `${url}/aturan/cari`,
                    dataType: 'JSON',

                    data: (params) => {
                        const query = {
                            aturan_pakai: params.term
                        }
                        return query
                    },
                    processResults: (result) => {
                        return {
                            results: result.map((item) => {
                                const items = {
                                    id: item.aturan_pakai,
                                    text: item.aturan_pakai,
                                }
                                return items;
                            })
                        }
                    }

                },
            })
        }

        function getStokBarang(item) {
            return item.gudang_barang.filter((itemGudang) => {
                return itemGudang.kd_bangsal === 'RM7'
            }).map((filteredItem) => {
                return filteredItem.stok
            }).join('');
        }

        function setResepToPlan(no_rawat) {
            return $.get(`${url}/resep/get`, {
                no_rawat: no_rawat
            }).done((response) => {
                const {
                    data
                } = response;
                let rd = '';
                let rr = '';
                if (data) {
                    if (data.resep_dokter) {
                        rd += data.resep_dokter.map((item, index) => {
                            return `${item.data_barang.nama_brng} @${item.jml}, S: ${item.aturan_pakai}`
                        }).join('\n');

                    }

                    if (data.resep_racikan) {
                        rr += data.resep_racikan.map((item, index) => {
                            const dataObat = item.detail.map((barang, index) => {
                                return `\t-${barang.databarang.nama_brng} @${barang.jml} (${barang.kandungan} mg)`
                            }).join('\n')
                            return `${item.metode.nm_racik} ${item.nama_racik} @${item.jml_dr}, S: ${item.aturan_pakai}` + '\n' + dataObat;
                        }).join('\n')
                    }
                }

                formSoapPoli.find('#rtl').val(`${rd} \n ${rr}`)

            })
        }
    </script>
@endpush
