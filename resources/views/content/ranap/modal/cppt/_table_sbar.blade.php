 <div class="table-responsive">
     <table id="sbar-table" class="table table-striped table-bordered" width="100%">

     </table>
 </div>

 @push('script')
     <script>
         const btnTableSbar = $('#tableSbar')

         btnTableSbar.on('click', () => {
             $('#sbar-table').DataTable({
                 processing: true,
                 serverSide: true,
                 destroy: true,
                 ajax: `${url}/sbar`,
                 columns: [{
                         data: 'no_rawat',
                         name: 'no_rawat',
                         title: 'No. Rawat'
                     },
                     {
                         data: 'tgl_perawatan',
                         name: 'tgl_perawatan',
                         title: 'Tgl Perawatan'
                     },
                     {
                         data: 'keluhan',
                         name: 'keluhan',
                         title: 'Situation'
                     },
                     {
                         data: 'penilaian',
                         name: 'penilaian',
                         title: 'Background'

                     },
                     {
                         data: 'pemeriksaan',
                         name: 'pemeriksaan',
                         title: 'Assessment'
                     },
                     {
                         data: 'rtl',
                         name: 'rtl',
                         title: 'Recommendation'
                     },
                     {
                         data: 'petugas.nama',
                         name: 'nm_petugas',
                         title: 'Petugas'
                     },
                     {
                         data: 'sbar.dokter_konsul.dokter_sbar.nm_dokter',
                         name: 'nm_dokter',
                         title: 'Dokter'
                     },
                     {
                         data: 'verifikasi',
                         name: 'verifikasi',
                         title: 'Verifikasi'
                     },


                 ]
             });
         });
     </script>
 @endpush
