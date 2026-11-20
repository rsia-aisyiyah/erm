@extends('index')

@section('contents')
    <div class="container-fluid px-3 py-2">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <div>
                <h4 class="mb-0 fw-bold text-dark"><i class="bi bi-sliders me-2 text-primary"></i>Manajemen Menu & Hak Akses</h4>
                <p class="text-muted small mb-0">Kelola master menu navigasi sidebar, hak akses per departemen/dokter, dan pengecualian per pegawai secara dinamis.</p>
            </div>
            <div>
                <button type="button" class="btn btn-primary btn-sm px-3 shadow-sm rounded-pill" onclick="bukaModalMenu()">
                    <i class="bi bi-plus-lg me-1"></i> Tambah Menu Baru
                </button>
            </div>
        </div>

        {{-- Nav Tabs --}}
        <ul class="nav nav-pills mb-3 bg-light p-1 rounded border" id="pills-tab" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active rounded-pill px-3 py-1 fw-semibold" id="pills-master-tab" data-bs-toggle="pill" data-bs-target="#pills-master" type="button" role="tab">
                    <i class="bi bi-list-check me-1"></i> 1. Master Menu
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link rounded-pill px-3 py-1 fw-semibold" id="pills-matrix-tab" data-bs-toggle="pill" data-bs-target="#pills-matrix" type="button" role="tab">
                    <i class="bi bi-grid-3x3-gap me-1"></i> 2. Matriks Hak Akses (Unit / Profesi)
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link rounded-pill px-3 py-1 fw-semibold" id="pills-user-tab" data-bs-toggle="pill" data-bs-target="#pills-user" type="button" role="tab">
                    <i class="bi bi-person-gear me-1"></i> 3. Akses Khusus Pegawai (Override)
                </button>
            </li>
        </ul>

        {{-- Tab Contents --}}
        <div class="tab-content" id="pills-tabContent">
            
            {{-- TAB 1: MASTER MENU --}}
            <div class="tab-pane fade show active" id="pills-master" role="tabpanel">
                <div class="card border-0 shadow-sm rounded-3">
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-hover align-middle mb-0" style="font-size: 13px;">
                                <thead class="table-light text-muted small text-uppercase">
                                    <tr>
                                        <th style="width: 50px;" class="text-center">No</th>
                                        <th style="width: 60px;" class="text-center">Ikon</th>
                                        <th>Nama Menu</th>
                                        <th>URL Endpoint</th>
                                        <th>Kategori</th>
                                        <th style="width: 80px;" class="text-center">Urutan</th>
                                        <th style="width: 100px;" class="text-center">Status</th>
                                        <th style="width: 120px;" class="text-center">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($menus as $m)
                                        <tr>
                                            <td class="text-center text-muted fw-bold">{{ $loop->iteration }}</td>
                                            <td class="text-center">
                                                <span class="erm-icon-box {{ $m->icon_bg }} mx-auto">
                                                    <i class="bi {{ $m->icon }}"></i>
                                                </span>
                                            </td>
                                            <td>
                                                <div class="fw-bold text-dark">{{ $m->nama_menu }}</div>
                                                <div class="text-muted small">{{ $m->title }}</div>
                                            </td>
                                            <td>
                                                <code>{{ $m->url }}</code>
                                                @if($m->target === '_blank')
                                                    <span class="badge bg-secondary ms-1" style="font-size: 10px;">Tab Baru</span>
                                                @endif
                                            </td>
                                            <td>
                                                <span class="badge bg-light text-dark border px-2 py-1">{{ $m->kategori }}</span>
                                            </td>
                                            <td class="text-center fw-semibold text-secondary">
                                                {{ $m->urutan }}
                                            </td>
                                            <td class="text-center">
                                                <div class="form-check form-switch d-inline-block">
                                                    <input class="form-check-input" type="checkbox" role="switch" 
                                                           onchange="toggleMenuStatus({{ $m->id }})" {{ $m->is_active ? 'checked' : '' }}>
                                                </div>
                                            </td>
                                            <td class="text-center">
                                                <button class="btn btn-sm btn-outline-secondary py-0 px-2 rounded" 
                                                        onclick='editMenu(@json($m))' title="Edit Menu">
                                                    <i class="bi bi-pencil-square"></i>
                                                </button>
                                                <button class="btn btn-sm btn-outline-danger py-0 px-2 rounded ms-1" 
                                                        onclick="hapusMenu({{ $m->id }}, '{{ $m->nama_menu }}')" title="Hapus Menu">
                                                    <i class="bi bi-trash"></i>
                                                </button>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="8" class="text-center py-4 text-muted">Belum ada menu yang terdaftar.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            {{-- TAB 2: MATRIKS HAK AKSES UNIT / PROFESI --}}
            <div class="tab-pane fade" id="pills-matrix" role="tabpanel">
                <div class="card border-0 shadow-sm rounded-3">
                    <div class="card-header bg-white py-2 d-flex justify-content-between align-items-center">
                        <span class="small text-muted"><i class="bi bi-info-circle me-1"></i>Centang untuk memberikan hak akses menu ke departemen atau profesi dokter. Perubahan tersimpan secara realtime.</span>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive" style="max-height: 65vh;">
                            <table class="table table-bordered table-hover align-middle mb-0" style="font-size: 12px;">
                                <thead class="table-light sticky-top text-center text-muted text-uppercase" style="z-index: 5;">
                                    <tr>
                                        <th style="min-width: 180px; position: sticky; left: 0; background: #f8fafc; z-index: 6;">Nama Menu</th>
                                        <th style="min-width: 80px;" class="bg-primary text-white">Semua User</th>
                                        <th style="min-width: 80px;" class="bg-info text-white">Dokter</th>
                                        @foreach($departemens as $dep)
                                            <th style="min-width: 100px;" title="{{ $dep->nama }} ({{ $dep->dep_id }})">
                                                {{ $dep->dep_id }}
                                                <div style="font-size: 9px; font-weight: normal; text-transform: none;" class="text-truncate">{{ $dep->nama }}</div>
                                            </th>
                                        @endforeach
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($menus as $m)
                                        @php
                                            $isAll = $m->akses->contains('tipe_akses', 'all');
                                            $isDokter = $m->akses->contains('tipe_akses', 'dokter');
                                            $depsAkses = $m->akses->where('tipe_akses', 'dep')->pluck('target_id')->toArray();
                                        @endphp
                                        <tr>
                                            <td style="position: sticky; left: 0; background: #ffffff; font-weight: 600; z-index: 4;">
                                                <div class="d-flex align-items-center gap-2">
                                                    <span class="erm-icon-box {{ $m->icon_bg }}" style="width: 22px; height: 22px; font-size: 11px;">
                                                        <i class="bi {{ $m->icon }}"></i>
                                                    </span>
                                                    <span>{{ $m->nama_menu }}</span>
                                                </div>
                                            </td>
                                            {{-- Kolom All Users --}}
                                            <td class="text-center bg-light">
                                                <input type="checkbox" class="form-check-input" 
                                                       onchange="updateMatrixAkses({{ $m->id }}, 'all', null, this.checked)"
                                                       {{ $isAll ? 'checked' : '' }}>
                                            </td>
                                            {{-- Kolom Dokter --}}
                                            <td class="text-center">
                                                <input type="checkbox" class="form-check-input" 
                                                       onchange="updateMatrixAkses({{ $m->id }}, 'dokter', 'dokter', this.checked)"
                                                       {{ $isDokter ? 'checked' : '' }}>
                                            </td>
                                            {{-- Kolom Per Departemen --}}
                                            @foreach($departemens as $dep)
                                                <td class="text-center">
                                                    <input type="checkbox" class="form-check-input" 
                                                           onchange="updateMatrixAkses({{ $m->id }}, 'dep', '{{ $dep->dep_id }}', this.checked)"
                                                           {{ in_array($dep->dep_id, $depsAkses) ? 'checked' : '' }}>
                                                </td>
                                            @endforeach
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            {{-- TAB 3: USER OVERRIDE (PENGECUALIAN PER NIK) --}}
            <div class="tab-pane fade" id="pills-user" role="tabpanel">
                <div class="row">
                    <div class="col-md-4">
                        <div class="card border-0 shadow-sm rounded-3">
                            <div class="card-header bg-white fw-bold py-3">
                                <i class="bi bi-person-plus me-1 text-primary"></i> Tambah Hak Akses Khusus
                            </div>
                            <div class="card-body">
                                <form id="formUserOverride" onsubmit="simpanUserOverride(event)">
                                    <div class="mb-3">
                                        <label class="form-label small fw-semibold">Pilih Menu</label>
                                        <select class="form-select form-select-sm" name="menu_id" required>
                                            <option value="">-- Pilih Menu --</option>
                                            @foreach($menus as $m)
                                                <option value="{{ $m->id }}">{{ $m->nama_menu }} ({{ $m->kategori }})</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label small fw-semibold">Cari NIK / Nama Pegawai</label>
                                        <input type="text" class="form-control form-control-sm" id="inputCariPegawai" 
                                               placeholder="Ketik NIK atau nama..." onkeyup="delaySearchPegawai(this.value)">
                                        <div id="hasilCariPegawai" class="list-group mt-1 shadow-sm d-none" style="max-height: 150px; overflow-y: auto; font-size: 12px;"></div>
                                        <input type="hidden" name="nik" id="selectedNik" required>
                                        <div id="selectedPegawaiInfo" class="mt-1 small text-success fw-semibold"></div>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label small fw-semibold">Status Hak Akses</label>
                                        <select class="form-select form-select-sm" name="is_allowed">
                                            <option value="1">Diizinkan (Granted)</option>
                                            <option value="0">Dilarang / Dicabut (Revoked)</option>
                                        </select>
                                    </div>
                                    <button type="submit" class="btn btn-primary btn-sm w-100 rounded-pill">
                                        <i class="bi bi-save me-1"></i> Simpan Akses Khusus
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="card border-0 shadow-sm rounded-3">
                            <div class="card-header bg-white fw-bold py-3">
                                <i class="bi bi-people me-1 text-secondary"></i> Daftar Pengecualian Akses Pegawai
                            </div>
                            <div class="card-body p-0">
                                <div class="table-responsive">
                                    <table class="table table-hover align-middle mb-0" style="font-size: 12.5px;">
                                        <thead class="table-light text-muted small text-uppercase">
                                            <tr>
                                                <th>Pegawai</th>
                                                <th>Departemen</th>
                                                <th>Menu</th>
                                                <th class="text-center">Status</th>
                                                <th class="text-center">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php
                                                $allOverrides = [];
                                                foreach($menus as $m) {
                                                    foreach($m->userOverrides as $ov) {
                                                        $allOverrides[] = [
                                                            'menu_id' => $m->id,
                                                            'menu_name' => $m->nama_menu,
                                                            'nik' => $ov->nik,
                                                            'nama' => $ov->pegawai->nama ?? $ov->nik,
                                                            'dept' => $ov->pegawai->departemen ?? '-',
                                                            'is_allowed' => $ov->is_allowed,
                                                        ];
                                                    }
                                                }
                                            @endphp
                                            @forelse($allOverrides as $item)
                                                <tr>
                                                    <td>
                                                        <div class="fw-semibold text-dark">{{ $item['nama'] }}</div>
                                                        <div class="text-muted small">NIK: {{ $item['nik'] }}</div>
                                                    </td>
                                                    <td><span class="badge bg-light text-dark border">{{ $item['dept'] }}</span></td>
                                                    <td class="fw-semibold">{{ $item['menu_name'] }}</td>
                                                    <td class="text-center">
                                                        @if($item['is_allowed'])
                                                            <span class="badge bg-success-subtle text-success border border-success-subtle px-2 py-1">Diizinkan</span>
                                                        @else
                                                            <span class="badge bg-danger-subtle text-danger border border-danger-subtle px-2 py-1">Dilarang</span>
                                                        @endif
                                                    </td>
                                                    <td class="text-center">
                                                        <button class="btn btn-sm btn-outline-danger py-0 px-2 rounded" 
                                                                onclick="hapusUserOverride({{ $item['menu_id'] }}, '{{ $item['nik'] }}')" title="Hapus Akses">
                                                            <i class="bi bi-trash"></i>
                                                        </button>
                                                    </td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="5" class="text-center py-4 text-muted">Belum ada pengecualian hak akses per pegawai.</td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

    {{-- MODAL TAMBAH / EDIT MENU --}}
    <div class="modal fade" id="modalMenuForm" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 shadow">
                <div class="modal-header bg-light py-2">
                    <h6 class="modal-title fw-bold" id="modalMenuTitle">Tambah Menu Baru</h6>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <form id="formMenuMaster" onsubmit="simpanMenuMaster(event)">
                    <div class="modal-body">
                        <input type="hidden" name="id" id="menuId">

                        <div class="mb-2">
                            <label class="form-label small fw-semibold">Nama Menu</label>
                            <input type="text" class="form-control form-control-sm" name="nama_menu" id="menuNama" required placeholder="Contoh: Kamar Operasi">
                        </div>

                        <div class="mb-2">
                            <label class="form-label small fw-semibold">URL Endpoint</label>
                            <input type="text" class="form-control form-control-sm" name="url" id="menuUrl" required placeholder="Contoh: /erm/operasi">
                            <div class="text-muted" style="font-size: 11px;">Gunakan format URL relatif (misal: <code>/erm/operasi</code>)</div>
                        </div>

                        <div class="row g-2 mb-2">
                            <div class="col-md-6">
                                <label class="form-label small fw-semibold">Bootstrap Icon</label>
                                <input type="text" class="form-control form-control-sm" name="icon" id="menuIcon" placeholder="bi-heart-pulse-fill">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label small fw-semibold">Warna Icon Badge</label>
                                <select class="form-select form-select-sm" name="icon_bg" id="menuIconBg">
                                    <option value="icon-poli">Teal (Poli)</option>
                                    <option value="icon-ranap">Indigo (Ranap)</option>
                                    <option value="icon-ugd">Amber (UGD)</option>
                                    <option value="icon-ok">Rose (Operasi)</option>
                                    <option value="icon-lab">Violet (Laborat)</option>
                                    <option value="icon-rad">Sky Blue (Radiologi)</option>
                                    <option value="icon-resep">Blue (Resep)</option>
                                    <option value="icon-obat">Slate (Obat)</option>
                                    <option value="icon-racik">Yellow (Racik)</option>
                                    <option value="icon-pasien">Dark Slate (Pasien)</option>
                                    <option value="icon-daftar">Gray (Daftar)</option>
                                    <option value="icon-sep">Emerald (SEP)</option>
                                    <option value="icon-kyc">Warm Amber (KYC)</option>
                                    <option value="icon-log">Cool Gray (Log)</option>
                                </select>
                            </div>
                        </div>

                        <div class="row g-2 mb-2">
                            <div class="col-md-6">
                                <label class="form-label small fw-semibold">Kategori</label>
                                <select class="form-select form-select-sm" name="kategori" id="menuKategori" required>
                                    @foreach($kategoriList as $kat)
                                        <option value="{{ $kat }}">{{ $kat }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-3">
                                <label class="form-label small fw-semibold">Urutan</label>
                                <input type="number" class="form-control form-control-sm" name="urutan" id="menuUrutan" value="1" min="1">
                            </div>
                            <div class="col-md-3">
                                <label class="form-label small fw-semibold">Target</label>
                                <select class="form-select form-select-sm" name="target" id="menuTarget">
                                    <option value="_self">Sama</option>
                                    <option value="_blank">Tab Baru</option>
                                </select>
                            </div>
                        </div>

                        <div class="mb-2">
                            <label class="form-label small fw-semibold">Tooltip / Keterangan</label>
                            <input type="text" class="form-control form-control-sm" name="title" id="menuTooltip" placeholder="Tooltip saat hover...">
                        </div>
                    </div>
                    <div class="modal-footer py-2 bg-light">
                        <button type="button" class="btn btn-secondary btn-sm rounded-pill" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary btn-sm rounded-pill px-3">Simpan Menu</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('script')
<script>
    let timerCariPegawai = null;

    function bukaModalMenu() {
        $('#formMenuMaster')[0].reset();
        $('#menuId').val('');
        $('#modalMenuTitle').text('Tambah Menu Baru');
        $('#modalMenuForm').modal('show');
    }

    function editMenu(menu) {
        $('#formMenuMaster')[0].reset();
        $('#menuId').val(menu.id);
        $('#menuNama').val(menu.nama_menu);
        $('#menuUrl').val(menu.url);
        $('#menuIcon').val(menu.icon);
        $('#menuIconBg').val(menu.icon_bg);
        $('#menuKategori').val(menu.kategori);
        $('#menuUrutan').val(menu.urutan);
        $('#menuTarget').val(menu.target);
        $('#menuTooltip').val(menu.title);
        $('#modalMenuTitle').text('Edit Menu: ' + menu.nama_menu);
        $('#modalMenuForm').modal('show');
    }

    function simpanMenuMaster(e) {
        e.preventDefault();
        const data = $('#formMenuMaster').serialize();

        $.ajax({
            url: '/erm/pengaturan/menu/simpan',
            type: 'POST',
            data: data,
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
            success: function(res) {
                if (res.success) {
                    alert(res.message);
                    location.reload();
                } else {
                    alert('Gagal: ' + res.message);
                }
            },
            error: function(err) {
                alert('Terjadi kesalahan sistem.');
            }
        });
    }

    function toggleMenuStatus(id) {
        $.ajax({
            url: '/erm/pengaturan/menu/toggle-status',
            type: 'POST',
            data: { id: id },
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
            success: function(res) {
                console.log(res.message);
            },
            error: function() {
                alert('Gagal mengubah status menu');
            }
        });
    }

    function hapusMenu(id, nama) {
        if (!confirm('Yakin ingin menghapus menu "' + nama + '"? Semua hak akses terkait juga akan dihapus.')) return;

        $.ajax({
            url: '/erm/pengaturan/menu/' + id,
            type: 'DELETE',
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
            success: function(res) {
                if (res.success) {
                    alert(res.message);
                    location.reload();
                }
            },
            error: function() {
                alert('Gagal menghapus menu.');
            }
        });
    }

    function updateMatrixAkses(menuId, tipe, targetId, isChecked) {
        $.ajax({
            url: '/erm/pengaturan/menu/update-akses',
            type: 'POST',
            data: {
                menu_id: menuId,
                tipe_akses: tipe,
                target_id: targetId,
                is_checked: isChecked ? 1 : 0
            },
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
            success: function(res) {
                // Berhasil
            },
            error: function() {
                alert('Gagal menyimpan perubahan hak akses.');
            }
        });
    }

    function delaySearchPegawai(val) {
        clearTimeout(timerCariPegawai);
        if (val.length < 2) {
            $('#hasilCariPegawai').addClass('d-none').empty();
            return;
        }
        timerCariPegawai = setTimeout(() => {
            $.get('/erm/pengaturan/menu/cari-pegawai', { q: val }, function(res) {
                let html = '';
                res.forEach(p => {
                    html += `<a href="javascript:void(0)" class="list-group-item list-group-item-action py-1 px-2" 
                                onclick="pilihPegawai('${p.nik}', '${p.nama}', '${p.departemen}')">
                                <strong>${p.nama}</strong> (${p.nik}) - <span class="text-muted">${p.departemen}</span>
                             </a>`;
                });
                if (res.length === 0) {
                    html = '<div class="list-group-item py-1 px-2 text-muted">Tidak ditemukan.</div>';
                }
                $('#hasilCariPegawai').html(html).removeClass('d-none');
            });
        }, 300);
    }

    function pilihPegawai(nik, nama, dept) {
        $('#selectedNik').val(nik);
        $('#selectedPegawaiInfo').text(`Dipilih: ${nama} (${nik}) - ${dept}`);
        $('#hasilCariPegawai').addClass('d-none');
    }

    function simpanUserOverride(e) {
        e.preventDefault();
        const data = $('#formUserOverride').serialize();
        $.ajax({
            url: '/erm/pengaturan/menu/user-override',
            type: 'POST',
            data: data,
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
            success: function(res) {
                if (res.success) {
                    alert(res.message);
                    location.reload();
                }
            },
            error: function() {
                alert('Gagal menyimpan akses khusus.');
            }
        });
    }

    function hapusUserOverride(menuId, nik) {
        if (!confirm('Hapus akses khusus untuk NIK ' + nik + '?')) return;
        $.ajax({
            url: '/erm/pengaturan/menu/user-override',
            type: 'DELETE',
            data: { menu_id: menuId, nik: nik },
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
            success: function(res) {
                if (res.success) {
                    alert(res.message);
                    location.reload();
                }
            },
            error: function() {
                alert('Gagal menghapus akses khusus.');
            }
        });
    }
</script>
@endpush
