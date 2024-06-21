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
            <div class="tab-pane fade show active" id="umum" style="overflow-y: auto;max-height: 30vh">
                @include('content.poliklinik.resep._resepUmum')
            </div>
            <div class="tab-pane fade" id="racikan">
                @include('content.poliklinik.resep._resepRacikan')
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
        const btnTambahResepUmum = $('#btnTambahResepUmum')
        const btnSimpanResepUmum = $('#btnSimpanResepUmum')
        const tbResepDokter = $('#tbResepDokter')



        function getResepObat(no_rawat) {
            $.get(`${url}/resep/get`, {
                no_rawat: no_rawat
            }).done((response) => {
                const hasData = !!response.data
                if (response.data) {
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

        function setResepRacikan(data) {
            console.log('DATA RACIK ===', data);
            if (data) {
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
                                <button class="btn btn-sm btn-warning" type="button" ><i class="bi bi-pencil"></i></button>    
                                <button class="btn btn-sm btn-danger" type="button" ><i class="bi bi-x"></i></button>    
                            </td>
                        </tr>${rowDetail}`
                    console.log('DETAIL ===', item.detail_racikan);
                })
                tbResepRacikan.find('tbody').empty().append(row)
                return true;
            }

        }

        function createResep() {
            const formSoapPoli = $('#formSoapPoli');
            const no_rawat = formSoapPoli.find('input[name="no_rawat"]').val();
            const dokter = formSoapPoli.find('select[name="dokter"]').val();

            console.log(role);

            if (role === 'dokter') {
                $.post(`${url}/resep/create`, {
                    '_token': "{{ csrf_token() }}",
                    'no_rawat': no_rawat,
                    'kd_dokter': dokter
                }).done((response) => {
                    toastReload(response.message, 2000)
                    btnDeleteResep.attr('onclick', `deleteResep(${response.data.no_resep})`)
                    toggleElementResep()
                    formSoapPoli.find('input[name=no_resep]').val(response.data.no_resep);
                }).fail((response) => {
                    alertErrorAjax(response);
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
            $.ajax({
                url: `${url}/resep/delete/${no_resep}`,
                method: 'DELETE',
                data: {
                    '_token': "{{ csrf_token() }}"
                }
            }).done((response) => {
                toastReload(response.message, 2000)
                toggleElementResep(false)
                tbResepDokter.find('tbody').empty()
                tbResepRacikan.find('tbody').empty()
            })
        }


        function selectDataBarang(element) {
            element.select2({
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
                                    text: `<span class="${ketStok}">${item.nama_brng}</span> <br/> Stok : ${stok}  <span class="text-muted">Rp.${toRupiah(item.ralan)}</span>`,
                                    name: `${item.nama_brng}`,
                                }
                                return items;

                            })
                        }
                    }

                },
                templateSelection: (item) => {
                    return item.name
                },
                escapeMarkup: (markup) => {
                    return markup;
                },
                cache: true

            }).on('select2:select', (e) => {
                const selectedId = e.params.data.id;
                isDuplicateObat(tbResepDokter.find('tbody'), selectedId, element)
            });
        }

        function isDuplicateObat(element, kode_brng, target) {
            element.find('tr').each((index, item) => {
                const id = $(item).data('id');
                const selectVal = $(item).find('select').val();

                if (id === kode_brng) {

                    Swal.fire({
                        title: 'Peringatan',
                        html: 'Barang sudah ada di resep',
                        icon: 'warning'
                    }).then(() => {
                        target.val('').trigger('change');
                    });

                    return false
                }
            });
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

                return false
            }
        }

        function selectAturanPakai(element) {
            return element.select2({
                tags: true,
                ajax: {
                    url: `${url}/aturan/get`,
                    dataType: 'JSON',

                    data: (params) => {
                        const query = {
                            aturan: params.term
                        }
                        return query
                    },
                    processResults: (result) => {
                        return {
                            results: result.map((item) => {
                                const items = {
                                    id: item.aturan,
                                    text: item.aturan,
                                    name: item.aturan,
                                }
                                return items;
                            })
                        }
                    }

                },
            }).on('select2:select', (e) => {
                const aturan = e.currentTarget.value;
                $.post(`${url}/aturan/create`, {
                    '_token': "{{ csrf_token() }}",
                    'aturan': aturan
                }).done((response) => {
                    if (response.status === 'success') {
                        toastReload(response.message, 2000)
                        const optAturan = new Option(aturan, aturan, true, true);
                        element.append(optAturan).trigger('change');
                    }
                })
            });
        }

        function getStokBarang(item) {
            return item.gudang_barang.filter((itemGudang) => {
                return itemGudang.kd_bangsal === 'RM7'
            }).map((filteredItem) => {
                return filteredItem.stok
            }).join('');
        }
    </script>
@endpush
