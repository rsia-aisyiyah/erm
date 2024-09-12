 <div class="card position-relative mt-2">
     <div class="card-header" aria-controls="collapseHasilRadiologi" data-bs-toggle="collapse" data-bs-target="#collapseHasilRadiologi">
         <div class="card-text">
             <span>Hasil Radiologi</span>
         </div>

     </div>
     <div class="card-body card-text collapse show" id="collapseHasilRadiologi">

     </div>
 </div>
 @push('script')
     <script>
         function setRiwayatRadiologi(no_rawat) {
             const bodyRadiologi = document.getElementById('collapseHasilRadiologi')
             const cardRadiologi = document.getElementById('hasilRadiologi')
             $('#radiologi').hide();

             getPeriksaRadiologi(no_rawat).done((periksa) => {
                 let listHasilRadiologi = '';
                 if (periksa.length != 0) {
                     let hasilRadiologi = '';
                     let diagnosaKlinis = '';
                     let informasiTambahan = '';
                     periksa.map((radiologi) => {
                         listHasilRadiologi += `<div class="row">`;
                         let gambar = '';
                         radiologi.gambar_radiologi.map((img, index) => {
                             if (img.tgl_periksa == radiologi.tgl_periksa && img.jam == radiologi.jam) {
                                 gambar += `<a data-magnify="gallery" data-src=""  data-group="a" href="https://sim.rsiaaisyiyah.com/webapps/radiologi/${img.lokasi_gambar}">
                                    <img src="https://sim.rsiaaisyiyah.com/webapps/radiologi/${img.lokasi_gambar}" class="img-thumbnail position-relative" width="100%">
                                </a>`
                             }
                             listHasilRadiologi += `<div class="col-sm-12 col-md-6 col-lg-4">
                                            ${gambar}
                                        </div>`;
                         })

                         radiologi.permintaan.map((permintaan, index) => {
                             if (permintaan.tgl_hasil == radiologi.tgl_periksa && permintaan.jam_hasil == radiologi.jam) {
                                 diagnosaKlinis = permintaan.diagnosa_klinis;
                                 informasiTambahan = permintaan.informasi_tambahan;
                             }
                         })

                         radiologi.hasil_radiologi.map((hasil, index) => {
                             if (hasil.tgl_periksa == radiologi.tgl_periksa && hasil.jam == radiologi.jam) {
                                 hasilRadiologi = hasil.hasil
                             }
                             listHasilRadiologi += `<div class="col-sm-12 col-md-6 col-lg-8">
                                    <div class="card">
                                        <div class="card-body">
                                            <table class="table borderless table-responsive text-sm">
                                                <tr>
                                                    <th>Tanggal</th>    
                                                    <td>:</td>    
                                                    <td>${formatTanggal(hasil.tgl_periksa)} ${hasil.jam}</td>    
                                                </tr>    
                                                <tr>
                                                    <th>Dokter</th>    
                                                    <td>:</td>    
                                                    <td>${radiologi.dokter.nm_dokter}</td>    
                                                </tr>    
                                                <tr>
                                                    <th>Petugas</th>    
                                                    <td>:</td>    
                                                    <td>${radiologi.petugas.nama}</td>    
                                                </tr>    
                                                <tr>
                                                    <th>Pemeriksaan</th>    
                                                    <td>:</td>    
                                                    <td>${radiologi.jns_perawatan.nm_perawatan}</td>    
                                                </tr>    
                                                <tr>
                                                    <th>Diagnosa Klinis</th>    
                                                    <td>:</td>    
                                                    <td>${diagnosaKlinis}</td>    
                                                </tr>    
                                                <tr>
                                                    <th>Informasi Tambahan</th>    
                                                    <td>:</td>    
                                                    <td>${informasiTambahan}</td>    
                                                </tr>    
                                                <tr>
                                                    <th>Hasil</th>    
                                                    <td>:</td>    
                                                    <td>${stringPemeriksaan(hasilRadiologi)}</td>    
                                                </tr>    
                                            </table>
                                        </div>
                                    </div>
                                </div>`;
                         })
                         listHasilRadiologi += '</div>';
                     })
                     bodyRadiologi.innerHTML = listHasilRadiologi;
                     $('#hasilRadiologi').show().fadeIn();
                     $('#hasilRadiologi').removeClass('d-none');
                 } else {
                     $('#hasilRadiologi').addClass('d-none');
                 }
             })
         }
     </script>
 @endpush
