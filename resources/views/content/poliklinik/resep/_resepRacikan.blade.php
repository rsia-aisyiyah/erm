<table class="table table-striped table-responsive table-sm d-none" id="tbResepRacikan" width="100%">
    <thead>
        <tr>
            <th width="10%">No</th>
            <th>Nama Racikan</th>
            <th>Metode Racikan</th>
            <th width="10%" class="text-center">Jumlah</th>
            <th>Aturan Pakai</th>

            <th></th>
        </tr>
    </thead>
    <tbody id="body_racikan">

    </tbody>
</table>
<button class="btn btn-primary btn-sm d-none" id="btnTambahResepRacik" type="button" onclick="tambahRacikan()">Tambah Racikan</button>

@push('script')
    <script>
        const tbResepRacikan = $('#tbResepRacikan').find('tbody')
        const btnTambahResepRacik = $('#btnTambahResepRacik')

        function tambahRacikan() {
            const rowCount = tbResepDokter.find('tbody').find('tr').length;
            const addRow = `<tr id="row${rowCount}">
                <td><select class="form-select2" data-dropdown-parent="#modalSoap" name="nm_obat[]" id="kdObat${rowCount}" data-id="${rowCount}" style="width:100%">
                    </select></td>
                <td>
                    <input type="hidden" name="rowNext" id="rowNext" value="${rowCount+1}"/>
                    <input type="hidden" name="kode_brng[]" id="kdObat${rowCount}Val"/>
                    <input type="number" class="form-control" name="jumlah[]" id="jmlObat${rowCount}"/>
                </td>
                <td><select class="" name="aturan_pakai[]" id="aturan${rowCount}" data-id="${rowCount}" data-dropdown-parent="#modalSoap" style="width:100%"></select></td>
                <td>
                    <button type="button" class="btn btn-sm btn-success " data-id="row${rowCount}" onclick="createBarisResepDokter('${rowCount}')"><i class="bi bi-check"></i></button>    
                    <button type="button" class="btn btn-sm btn-danger btn-delete" data-id="row${rowCount}" onclick="hapusBarisObat('${rowCount}')"><i class="bi bi-x"></i></button>    
                </td>
            </tr>`;
        }
    </script>
@endpush
