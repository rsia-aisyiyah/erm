<h5 class="text-center" style="margin-bottom:0px">EARLY WARNING SYSTEM (EWS)</h5>
<h5 style="" class="kategori mb-3 text-center"></h5>
<table class="table table-sm table-bordered table-responsive" id="table-ews" width="100%">
    <thead>
        <tr class="tr-tanggal">
            <th width="15%" colspan="2">Tanggal</th>
        </tr>
        <tr class="tr-jam">
            <th colspan="2">Jam</th>
        </tr>
    </thead>
    <tbody>

    </tbody>

</table>
<div class="hasil-ews">

</div>

<button class="btn btn-primary btn-sm" type="button" onclick="showFormEws()"><i class="bi bi-plus"></i> Tambah EWS</button>

@push('script')
    <script>
        const tabEws = $('#tab-ews');

        tabEws.on('click', () => {
            const no_rawat = formInfoPasien.find('input[name="no_rawat"]').val();
            const spesialis = formInfoPasien.find('input[name="kd_sps_dokter"]').val();
            const stts = 'ranap';
            setEws(no_rawat, stts, spesialis)

        })

        function showFormEws() {
            const formEwsRanap = $('#formEwsRanap')

            // Ambil waktu lokal dari browser
            const now = new Date()

            // Format YYYY-MM-DD
            const tgl = now.toISOString().slice(0, 10)

            // Format HH:MM:SS dengan leading-zero
            const jam = now.toLocaleTimeString('en-GB', { hour12: false })

            formEwsRanap.find('input[name=tgl_perawatan]').val(tgl)
            formEwsRanap.find('input[name=jam_rawat]').val(jam)
            formEwsRanap.find('input[name=jam_rawat]').val(jam)

            const kdSps = formInfoPasien.find('input[name="kd_sps_dokter"]').val()
            if(kdSps==='S0001'){
                formEwsRanap.find('#maternal').removeClass('d-none')
                formEwsRanap.find('select[name=keluaran_urin]').val('-').change()
                formEwsRanap.find('select[name=proteinuria]').val('-').change()
                formEwsRanap.find('select[name=air_ketuban]').val('-').change()
                formEwsRanap.find('select[name=skala_nyeri]').val('-').change()
                formEwsRanap.find('select[name=lochia]').val('-').change()
                formEwsRanap.find('select[name=terlihat_tidak_sehat]').val('-').change()
                formEwsRanap.find('select[name=kesadaran_maternal]').val('-').change()
            }else{
                formEwsRanap.find('#maternal').addClass('d-none')
                formEwsRanap.find('select[name=keluaran_urin]').val('').change()
                formEwsRanap.find('select[name=proteinuria]').val('').change()
                formEwsRanap.find('select[name=air_ketuban]').val('').change()
                formEwsRanap.find('select[name=skala_nyeri]').val('').change()
                formEwsRanap.find('select[name=lochia]').val('').change()
                formEwsRanap.find('select[name=terlihat_tidak_sehat]').val('-').change()
                formEwsRanap.find('select[name=kesadaran_maternal]').val('-').change()
            }
            $('#modalEwsRanap').modal('show')

        }

        function createEwsRanap(){
            const data = getDataForm('#formEwsRanap', ['input', 'select'])
            data['no_rawat'] = formInfoPasien.find('input[name="no_rawat"]').val()
            data['sumber'] = 'EWS'
            delete data['nm_pegawai'];

            $.post('/erm/soap/grafik/store', data).done((response)=>{
                console.log('RESPONSE ===', response)
            })
            console.log('DATA ===', data)
        }
    </script>
@endpush
