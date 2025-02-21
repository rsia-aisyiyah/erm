<h5 style="margin-bottom:0px">EARLY WARNING SYSTEM (EWS)</h5>
<h5 style="" class="kategori mb-3"></h5>
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

@push('script')
    <script>
        const tabEws = $('#tab-ews');

        tabEws.on('click', () => {
            const no_rawat = formInfoPasien.find('input[name="no_rawat"]').val();
            const spesialis = formInfoPasien.find('input[name="kd_sps_dokter"]').val();
            const stts = 'ranap';
            setEws(no_rawat, stts, spesialis)

        })
    </script>
@endpush
