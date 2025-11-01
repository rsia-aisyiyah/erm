<div id="tindakanDokterRajal">
	<form action="" id="formTindakanDokter">
		<div class="row">
			<div class="col-md-6">
				<div class="row">
					<div class="col-lg-6 col-md-12 col-sm-12">
						<label for="kd_dokter">Dokter</label>
						<select name="kd_dokter" id="kd_dokter" class="select2 w-100" data-dropdown-parent="#formTindakanDokter"></select>

					</div>
					<div class="col-md-12 mt-2">
						<div class="table-responsive">
							<table class="table table-sm table-bordered table-striped" id="tabelJenisTindakanDokter">

							</table>
						</div>

						<button type="button" class="btn btn-primary" id="btnCreateTindakanDokter" onclick="createTindakanDokter()"><i class="bi bi-floppy"></i> Buat</button>
					</div>
				</div>
			</div>
			<div class="col-md-6">
				<div class="card">
					<div class="card-body">
						<h4 class="card-title h5">Tindakan Dilakukan</h4>
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
						<button type="button" class="btn btn-danger" onclick="deleteTindakanDokter()">
							<i class="ti ti-trash"></i>Hapus
						</button>
					</div>
				</div>
			</div>

		</div>
	</form>
</div>

@push('script')

	<script>
		$('#btnTabTindakanDokter').on('shown.tab.bs', ()=>{
			const formTindakanDokter =$('#formTindakanDokter')
			const formInfoTindakan = $('.formInfoTindakan');

			const dokter = formInfoTindakan.find('#dokter').val()
			const nm_dokter= formInfoTindakan.find('#nm_dokter').val()

			console.log(dokter, nm_dokter, formTindakanDokter.find('select[name=kd_dokter]') )

			const optDokter = new Option(nm_dokter, dokter, true, true)
			formTindakanDokter.find('select[name=kd_dokter]').append(optDokter).trigger('change');


			formTindakanDokter.find('select[name=kd_dokter]').select2({
				delay: 0,
				scrollAfterSelect: false,
				ajax: {
					url: `/erm/dokter/cari`,
					dataType: 'json',
					data: (params) => {
						const query = {
							nm_dokter: params.term
						}
						return query
					},
					processResults: function(data) {
						return {
							results: $.map(data, function(item) {
								return {
									text: item.nm_dokter,
									id: item.kd_dokter
								}
							})
						};
					},
					cache: false
				}
			});

			getTindakanDilakukanDr(no_rawat)
			tableJenisTindakanDokter()

		})



		// global
		let selectedRows = [];
		let selectedDataCache = {};
		let lastRequestStart = 0;
		let diskonValues = {
			persen: {},
			rupiah: {}
		};



		function tableJenisTindakanDokter() {
			// simpan referensi table ke variable supaya bisa dipakai di event handler
			const table = new DataTable('#tabelJenisTindakanDokter', {
				responsive: true,
				serverSide: true,
				processing: true,
				destroy: true,
				autoWidth: false,
				lengthChange: false,
				info:false,

				ajax: {
					url: '/erm/jenis-tindakan/datatable/dr',
					type: 'GET',
					// tangkap request params sebelum dikirim
					data: function (d) {
						lastRequestStart = d.start || 0;
						return d;
					},
					// intercept response dari server
					dataSrc: function (json) {
						// update cache untuk selected ids yang mungkin ada di response ini
						json.data.forEach(d => {
							if (selectedRows.includes(d.kd_jenis_prw)) {
								selectedDataCache[d.kd_jenis_prw] = d;
							}
						});

						// jika request halaman pertama (start === 0) => gabungkan selected rows di depan
						if (lastRequestStart === 0) {
							// buat array checkedData berdasarkan urutan selectedRows
							const checkedData = selectedRows.map(id => selectedDataCache[id]).filter(Boolean);

							// hindari duplikat: kumpulkan id yang sudah ada di checkedData
							const checkedIds = new Set(checkedData.map(d => d.kd_jenis_prw));

							// sisanya dari response yang bukan selected
							const otherData = json.data.filter(d => !checkedIds.has(d.kd_jenis_prw));

							// gabungkan: selected dulu, lalu data lainnya
							return [...checkedData, ...otherData];
						} else {
							// bukan halaman pertama => jangan tampilkan item yg sudah dipindah ke halaman 1
							return json.data.filter(d => !selectedRows.includes(d.kd_jenis_prw));
						}
					},
					complete: function () {
						// $('#tabelJenisTindakanDokter tbody').width(w - 5); // -- - THIS IS THE FIX
						// $('#tabelJenisTindakanDokter').width(w + 5);
					}
				},

				columnDefs: [{
					targets: [0],
					orderable: false
				},
					{
						targets: [4],
						className: 'text-end'
					}
				],

				columns: [{
					name: 'kd_jenis_prw',
					data: 'kd_jenis_prw',
					title: '',
					render: function (data, type, row, meta) {
						// jangan gunakan onchange inline (kita pakai delegated handler)
						const checked = selectedRows.includes(data) ? 'checked' : '';
						return `<input type="checkbox" class="form-check-input tindakan-check" data-id="${data}" ${checked}>`;
					}
				},
					{
						data: 'kd_jenis_prw',
						title: 'Kode',
					},
					{
						data: 'nm_perawatan',
						title: 'Nama Tindakan'
					},
					{
						data: 'kategori.nm_kategori',
						title: 'Kategori'
					},
					{
						data: 'total_byrdr',
						title: 'Biaya',
						render: function (data, type, row, meta) {
							return formatCurrency(data);
						}
					},
				],
				initComplete: function (setting, json) {
					const api = this.api();
					api.columns.adjust().draw();
				}
			});

			// delegated handler untuk checkbox (satu handler untuk seluruh table)
			$('#tabelJenisTindakanDokter').off('change', '.tindakan-check').on('change', '.tindakan-check', function () {
				const id = $(this).data('id');
				const $tr = $(this).closest('tr');
				const rowApi = table.row($tr);
				const rowData = rowApi.data(); // ambil data baris sekarang (penting untuk cache)

				if (this.checked) {
					if (!selectedRows.includes(id)) {
						selectedRows.push(id);
					}
					// simpan ke cache segera supaya saat kita draw halaman 1, data tersedia
					if (rowData) selectedDataCache[id] = rowData;
				} else {
					// uncheck -> hapus dari selected + cache
					selectedRows = selectedRows.filter(x => x !== id);
					delete selectedDataCache[id];
				}

				// pindah ke halaman pertama, lalu redraw (false supaya tidak kehilangan state paging)
				table.page(0).draw(false);
			});


			return table;
		}

		function createTindakanDokter() {
			const formInfoTindakan = $('.formInfoTindakan')
			const formTindakanDokter=  $('#formTindakanDokter')

			const no_rawat = formInfoTindakan.find('#no_rawat').val();
			const kd_dokter = formTindakanDokter.find('#kd_dokter').val();
			const nm_pasien = formInfoTindakan.find('#nm_pasien').val();
			const no_rkm_medis = formInfoTindakan.find('#no_rkm_medis').val();



			let selectedData = selectedRows
					.map(id => {
						const data = selectedDataCache[id];
						if (!data) return null;

						return data;
					})
					.filter(Boolean);

			$.post('/erm/tindakan/dokter', {
				no_rawat,
				kd_dokter,
				nm_pasien,
				no_rkm_medis,
				tindakan: selectedData
			}).done((response) => {
				$('.tindakan-check').prop('checked', false);
				selectedData = []
				selectedRows = []
				selectedDataCache = {}
				getTindakanDilakukanDr(no_rawat)
				swalToast('Berhasil Menambah Tindakan')
			}).fail((result)=>{
				Swal.fire({
					title: 'Gagal',
					html: result.responseJSON.message,
					icon: 'error',
					showCancelButton: false,
					confirmButtonColor: '#d33',
					confirmButtonText: 'Tutup',
				})
			});
		}


		function getTindakanDilakukanDr(no_rawat) {
			$.get(`/erm/tindakan/dokter/get`, {
				no_rawat: no_rawat
			}).done((response) => {
				const tbody = $('#tabelTindakanDilakukan tbody');
				tbody.empty();

				console.log('RESPONSE TINDAKAN DOKTER ===', response)
				response.forEach((item, index) => {
					const row = `<tr>
                        <td><input type="checkbox" class="form-check-input tindakan-hasil" name="kode_tindakan[]" id="tindakan${index}" value="${item.kd_jenis_prw}" data-tgl="${item.tgl_perawatan}" data-jam="${item.jam_rawat}" data-rawat="${item.no_rawat}" data-nip="${item.nip}"/></td>
                        <td>${splitTanggal(item.tgl_perawatan)}</td>
                        <td>${item.jam_rawat}</td>
                        <td>${item.tindakan.nm_perawatan}</td>
                        <td>${item.dokter.nm_dokter}</td>
                        <td class="text-end">${formatCurrency(item.biaya_rawat)}</td>
                    </tr>`;
					tbody.append(row);
				});
			})
		}


		function deleteTindakanDokter() {
			const formInfoTindakan = $('.formInfoTindakan')
			const formTindakanDokter=  $('#formTindakanDokter')

			const no_rawat = formInfoTindakan.find('#no_rawat').val();
			const kd_dokter = formTindakanDokter.find('#kd_dokter').val();
			const nm_pasien = formInfoTindakan.find('#nm_pasien').val();
			const no_rkm_medis = formInfoTindakan.find('#no_rkm_medis').val();


			Swal.fire({
				title: 'Yakin ?',
				html: `Anda akan menghapus data tindakan ini ?`,
				icon: 'warning',
				showCancelButton: true,
				cancelButtonColor: '#3085d6',
				confirmButtonColor: '#d33',
				confirmButtonText: 'Ya, Hapus!',
				cancelButtonText: 'Batal',

			}).then((result) => {
				if (result.isConfirmed) {
					const checkedTindakan = $('.tindakan-hasil:checked').map(function() {
						const $this = $(this);
						return {
							kd_jenis_prw: $this.val(),
							no_rawat: $this.data('rawat'),
							jam_rawat: $this.data('jam'),
							tgl_perawatan: $this.data('tgl'),
							nip : $this.data('nip')
						};
					}).get();

					$.ajax({
						url: `/erm/tindakan/dokter/delete`,
						method: 'DELETE',
						data: {
							no_rawat: no_rawat,
							kd_dokter: kd_dokter,
							nm_pasien: nm_pasien,
							no_rkm_medis: no_rkm_medis,
							tindakan: checkedTindakan

						}
					}).done((response) => {
						getTindakanDilakukanDr(no_rawat)
						swalToast('Berhasil Menghapus Tindakan')
					}).fail((result)=>{
						Swal.fire({
							title: 'Gagal',
							html: result.responseJSON.message,
							icon: 'error',
							showCancelButton: false,
							confirmButtonColor: '#d33',
							confirmButtonText: 'Tutup',
						})
					})
				}
			})


		}
	</script>
@endpush