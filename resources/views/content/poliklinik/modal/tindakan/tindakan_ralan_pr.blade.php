<div id="tindakanPerawatRajal">
	<form action="" id="formTindakanPerawat">
		<div class="row">
			<div class="col-lg-6 col-md-12 col-lg-12">
				<label for="nip">Petugas</label>
				<select name="nip" id="nip" class="select2 w-100" data-dropdown-parent="#formTindakanPerawat"></select>
			</div>
			<div class="col-md-12 mt-2">
				<div class="table-responsive">
					<table class="table table-sm table-bordered table-striped" id="tabelJenisTindakanPerawat">

					</table>
				</div>

				<button type="button" class="btn btn-sm btn-primary" id="btnCreateTindakanPerawat"
						onclick="createTindakanPerawat()"><i class="bi bi-floppy"></i> Buat
				</button>
			</div>
		</div>
	</form>
</div>

@push('script')

	<script>
		$('#btnTabTindakanPerawat').on('shown.tab.bs', ()=>{

			const formTindakanPerawat = $('#formTindakanPerawat')
			const formInfoTindakan = $('.formInfoTindakan')

			const no_rawat = formInfoTindakan.find('#no_rawat').val();


			const user = new Option("{{session()->get('pegawai')->nama}}", "{{session()->get('pegawai')->nik}}", true, true)
			formTindakanPerawat.find('#nip').append(user).trigger('change')



			formTindakanPerawat.find('#nip').select2({
				delay: 0,
				scrollAfterSelect: false,
				initSelection: function(element, callback) {},
				ajax: {
					url: '/erm/petugas/cari',
					dataType: 'json',
					data: (params) => {
						const query = {
							q: params.term
						}
						return query
					},
					processResults: function(data) {
						return {
							results: $.map(data, function(item) {
								return {
									text: item.nama,
									id: item.nip
								}
							})
						};
					},
					cache: false
				}
			});


			tableJenisTindakanPerawat()

		})

		// global
		let selectedRowsPr = [];
		let selectedDataCachePr = {};
		let lastRequestStartPr = 0;

		$('#tabelJenisTindakanDokterPerawat').off('click', 'tbody tr').on('click', 'tbody tr', function (e) {
			if ($(e.target).is('input[type="checkbox"]') || $(this).hasClass('child')) return;

			const $checkbox = $(this).find('.tindakan-check');
			if ($checkbox.length) {
				$checkbox.prop('checked', !$checkbox.prop('checked')).trigger('change');
			}
		});
		function tableJenisTindakanPerawat() {
			// simpan referensi table ke variable supaya bisa dipakai di event handler
			const table = new DataTable('#tabelJenisTindakanPerawat', {
				responsive: true,
				serverSide: true,
				processing: true,
				destroy: true,
				autoWidth: false,
				lengthChange: false,
				info:false,

				ajax: {
					url: '/erm/jenis-tindakan/datatable/pr',
					type: 'GET',
					// tangkap request params sebelum dikirim
					data: function (d) {
						lastRequestStartPr = d.start || 0;
						return d;
					},
					// intercept response dari server
					dataSrc: function (json) {
						// update cache untuk selected ids yang mungkin ada di response ini
						json.data.forEach(d => {
							if (selectedRowsPr.includes(d.kd_jenis_prw)) {
								selectedDataCachePr[d.kd_jenis_prw] = d;
							}
						});

						// jika request halaman pertama (start === 0) => gabungkan selected rows di depan
						if (lastRequestStartPr === 0) {
							// buat array checkedData berdasarkan urutan selectedRowsPr
							const checkedData = selectedRowsPr.map(id => selectedDataCachePr[id]).filter(Boolean);

							// hindari duplikat: kumpulkan id yang sudah ada di checkedData
							const checkedIds = new Set(checkedData.map(d => d.kd_jenis_prw));

							// sisanya dari response yang bukan selected
							const otherData = json.data.filter(d => !checkedIds.has(d.kd_jenis_prw));

							// gabungkan: selected dulu, lalu data lainnya
							return [...checkedData, ...otherData];
						} else {
							// bukan halaman pertama => jangan tampilkan item yg sudah dipindah ke halaman 1
							return json.data.filter(d => !selectedRowsPr.includes(d.kd_jenis_prw));
						}
					},
					complete: function () {
						// $('#tabelJenisTindakanPerawat tbody').width(w - 5); // -- - THIS IS THE FIX
						// $('#tabelJenisTindakanPerawat').width(w + 5);
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
						const checked = selectedRowsPr.includes(data) ? 'checked' : '';
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
						data: 'total_byrpr',
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
			$('#tabelJenisTindakanPerawat').off('change', '.tindakan-check').on('change', '.tindakan-check', function () {
				const id = $(this).data('id');
				const $tr = $(this).closest('tr');
				const rowApi = table.row($tr);
				const rowData = rowApi.data(); // ambil data baris sekarang (penting untuk cache)

				if (this.checked) {
					if (!selectedRowsPr.includes(id)) {
						selectedRowsPr.push(id);
					}
					// simpan ke cache segera supaya saat kita draw halaman 1, data tersedia
					if (rowData) selectedDataCachePr[id] = rowData;
				} else {
					// uncheck -> hapus dari selected + cache
					selectedRowsPr = selectedRowsPr.filter(x => x !== id);
					delete selectedDataCachePr[id];
				}

				// pindah ke halaman pertama, lalu redraw (false supaya tidak kehilangan state paging)
				table.page(0).draw(false);
			});


			return table;
		}

		function createTindakanPerawat() {
			const formInfoTindakan = $('.formInfoTindakan')
			const formTindakanPerawat=  $('#formTindakanPerawat')

			const no_rawat = formInfoTindakan.find('#no_rawat').val();
			const nip = formTindakanPerawat.find('#nip').val();
			const nm_pasien = formInfoTindakan.find('#nm_pasien').val();
			const no_rkm_medis = formInfoTindakan.find('#no_rkm_medis').val();

			let selectedData = selectedRowsPr
					.map(id => {
						const data = selectedDataCachePr[id];
						if (!data) return null;

						return data;
					})
					.filter(Boolean);

			$.post('/erm/tindakan/perawat', {
				no_rawat,
				nip,
				nm_pasien,
				no_rkm_medis,
				tindakan: selectedData
			}).done((response) => {
				$('.tindakan-check').prop('checked', false);
				selectedData = []
				selectedRowsPr = []
				selectedDataCachePr = {}
				getTindakanDilakukanPr(no_rawat)
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


		function getTindakanDilakukanPr(no_rawat) {
			$.get(`/erm/tindakan/perawat/get`, {
				no_rawat: no_rawat
			}).done((response) => {
				const tbody = $('#tabelTindakanDilakukanPr tbody');
				tbody.empty();

				response.forEach((item, index) => {
					const row = `<tr>
                        <td><input type="checkbox" class="form-check-input tindakan-hasil" name="kode_tindakan[]" id="tindakan${index}" value="${item.kd_jenis_prw}" data-tgl="${item.tgl_perawatan}" data-jam="${item.jam_rawat}" data-rawat="${item.no_rawat}"  data-nip="${item.nip}"/></td>
                        <td>${splitTanggal(item.tgl_perawatan)}</td>
                        <td>${item.jam_rawat}</td>
                        <td>${item.tindakan.nm_perawatan}</td>
                        <td>${item.petugas.nama}</td>
                        <td class="text-end">${formatCurrency(item.biaya_rawat)}</td>
                    </tr>`;
					tbody.append(row);
				});
			})
		}


		function deleteTindakanPerawat() {
			const formInfoTindakan = $('.formInfoTindakan')
			const formTindakanPerawat=  $('#formTindakanPerawat')

			const no_rawat = formInfoTindakan.find('#no_rawat').val();
			const nip = formTindakanPerawat.find('#nip').val();
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
					const checkedTindakan = $('#tabelTindakanDilakukanPr tbody').find('.tindakan-hasil:checked').map(function() {
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
						url: `/erm/tindakan/perawat/delete`,
						method: 'DELETE',
						data: {
							no_rawat: no_rawat,
							nm_pasien: nm_pasien,
							no_rkm_medis: no_rkm_medis,
							tindakan: checkedTindakan

						}
					}).done((response) => {
						getTindakanDilakukanPr(no_rawat)
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