<div id="tindakanDokterRanap">
	<form action="" id="formTindakanDokterRanap">
		<div class="row">
			<div class="col-lg-6 col-md-12 col-sm-12">
				<label for="kd_dokter">Dokter</label>
				<select name="kd_dokter" id="kd_dokter" class="select2 w-100" data-dropdown-parent="#formTindakanDokterRanap"></select>

			</div>
			<div class="col-md-12 mt-2">
				<div class="table-responsive">
					<table class="table table-sm table-bordered table-striped" id="tabelJenisTindakanDokterRanap">

					</table>
				</div>

				<button type="button" class="btn btn-sm btn-primary" id="btnCreateTindakanDokterRanap" onclick="createTindakanDokterRanap()"><i class="bi bi-floppy"></i> Buat</button>
			</div>
		</div>
	</form>
</div>

@push('script')

	<script>
		$('#btnTabTindakanDokterRanap').on('shown.tab.bs', ()=>{
			const formInfoPasien = $('#formInfoPasien')
			const formTindakanDokterRanap =$('#formTindakanDokterRanap')

			const nm_dokter = formInfoPasien.find('input[name="dokter_dpjp"]').val()
			const kd_dokter = formInfoPasien.find('input[name=kd_dokter_dpjp').val()
			const no_rawat= formInfoPasien.find('#no_rawat').val()

			formTindakanDokterRanap.find('select[name=kd_dokter]').select2({
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

			const optDokter = new Option(nm_dokter, kd_dokter, true, true)
			formTindakanDokterRanap.find('select[name=kd_dokter]').append(optDokter).trigger('change');

			tableJenisTindakanDokterRanap()

		})




		// global
		let selectedRowsRanapDr = [];
		let selectedDataCacheRanapDr = {};
		let lastRequestStartRanapDr = 0;


		$('#tabelJenisTindakanDokterRanap').off('click', 'tbody tr').on('click', 'tbody tr', function (e) {
			if ($(e.target).is('input[type="checkbox"]') || $(this).hasClass('child')) return;

			const $checkbox = $(this).find('.tindakan-check');
			if ($checkbox.length) {
				$checkbox.prop('checked', !$checkbox.prop('checked')).trigger('change');
			}
		});


		function tableJenisTindakanDokterRanap() {
			// simpan referensi table ke variable supaya bisa dipakai di event handler
			const table = new DataTable('#tabelJenisTindakanDokterRanap', {
				responsive: true,
				serverSide: true,
				processing: true,
				destroy: true,
				autoWidth: false,
				lengthChange: false,
				info:false,

				ajax: {
					url: '/erm/jenis-tindakan/ranap/datatable/dr',
					type: 'GET',
					// tangkap request params sebelum dikirim
					data: function (d) {
						lastRequestStartRanapDr = d.start || 0;
						return d;
					},
					// intercept response dari server
					dataSrc: function (json) {
						// update cache untuk selected ids yang mungkin ada di response ini
						json.data.forEach(d => {
							if (selectedRowsRanapDr.includes(d.kd_jenis_prw)) {
								selectedDataCacheRanapDr[d.kd_jenis_prw] = d;
							}
						});

						// jika request halaman pertama (start === 0) => gabungkan selected rows di depan
						if (lastRequestStartRanapDr === 0) {
							// buat array checkedData berdasarkan urutan selectedRowsRanapDr
							const checkedData = selectedRowsRanapDr.map(id => selectedDataCacheRanapDr[id]).filter(Boolean);

							// hindari duplikat: kumpulkan id yang sudah ada di checkedData
							const checkedIds = new Set(checkedData.map(d => d.kd_jenis_prw));

							// sisanya dari response yang bukan selected
							const otherData = json.data.filter(d => !checkedIds.has(d.kd_jenis_prw));

							// gabungkan: selected dulu, lalu data lainnya
							return [...checkedData, ...otherData];
						} else {
							// bukan halaman pertama => jangan tampilkan item yg sudah dipindah ke halaman 1
							return json.data.filter(d => !selectedRowsRanapDr.includes(d.kd_jenis_prw));
						}
					},
					complete: function () {
						// $('#tabelJenisTindakanDokterRanap tbody').width(w - 5); // -- - THIS IS THE FIX
						// $('#tabelJenisTindakanDokterRanap').width(w + 5);
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
						const checked = selectedRowsRanapDr.includes(data) ? 'checked' : '';
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
			$('#tabelJenisTindakanDokterRanap').off('change', '.tindakan-check').on('change', '.tindakan-check', function () {
				const id = $(this).data('id');
				const $tr = $(this).closest('tr');
				const rowApi = table.row($tr);
				const rowData = rowApi.data(); // ambil data baris sekarang (penting untuk cache)

				if (this.checked) {
					if (!selectedRowsRanapDr.includes(id)) {
						selectedRowsRanapDr.push(id);
					}
					// simpan ke cache segera supaya saat kita draw halaman 1, data tersedia
					if (rowData) selectedDataCacheRanapDr[id] = rowData;
				} else {
					// uncheck -> hapus dari selected + cache
					selectedRowsRanapDr = selectedRowsRanapDr.filter(x => x !== id);
					delete selectedDataCacheRanapDr[id];
				}

				// pindah ke halaman pertama, lalu redraw (false supaya tidak kehilangan state paging)
				table.page(0).draw(false);
			});


			return table;
		}

		function createTindakanDokterRanap() {
			const formInfoPasien = $('#formInfoPasien')
			const formTindakanDokterRanap=  $('#formTindakanDokterRanap')

			const no_rawat = formInfoPasien.find('input[name=no_rawat]').val();
			const kd_dokter = formTindakanDokterRanap.find('select[name=kd_dokter]').val();
			const nm_pasien = formInfoPasien.find('input[name=pasien]').val();
			const no_rkm_medis = formInfoPasien.find('input[name=no_rkm_medis]').val();

			let selectedData = selectedRowsRanapDr
					.map(id => {
						const data = selectedDataCacheRanapDr[id];
						if (!data) return null;

						return data;
					})
					.filter(Boolean);


			$.post('/erm/tindakan-ranap/dokter', {
				no_rawat,
				kd_dokter,
				nm_pasien,
				no_rkm_medis,
				tindakan: selectedData
			}).done((response) => {
				$('.tindakan-check').prop('checked', false);
				selectedData = []
				selectedRowsRanapDr = []
				selectedDataCacheRanapDr = {}
				getTindakanDokterRanap()
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





		function deleteTindakanDokterRanap() {
			const formInfoPasien = $('#formInfoPasien')
			const no_rawat = formInfoPasien.find('input[name=no_rawat]').val();
			const nm_pasien = formInfoPasien.find('input[name=pasien]').val();
			const no_rkm_medis = formInfoPasien.find('input[name=no_rkm_medis]').val();

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
					const checkedTindakan = $('#tbTindakanDilakukanDokterRanap tbody').find('.check-tindakan-dokter:checked').map(function() {
						const $this = $(this);
						return {
							kd_jenis_prw: $this.val(),
							no_rawat: $this.data('rawat'),
							jam_rawat: $this.data('jam'),
							kd_dokter: $this.data('dokter'),
							tgl_perawatan: $this.data('tgl'),
						};
					}).get();

					$.ajax({
						url: `/erm/tindakan-ranap/dokter/delete`,
						method: 'DELETE',
						data: {
							no_rawat: no_rawat,
							nm_pasien: nm_pasien,
							no_rkm_medis: no_rkm_medis,
							tindakan: checkedTindakan

						}
					}).done((response) => {
						getTindakanDokterRanap()
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