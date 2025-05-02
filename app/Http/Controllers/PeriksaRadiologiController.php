<?php

namespace App\Http\Controllers;

use App\Models\PeriksaRadiologi;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class PeriksaRadiologiController extends Controller
{
    protected $track;
    protected $pemeriksaan;
    protected $carbon;
    public function __construct()
    {
        $this->track = new TrackerSqlController;
        $this->pemeriksaan = new PeriksaRadiologi();
        $this->carbon = new Carbon();
    }

    public function view()
    {
        return view('content.radiologi.radiologi');
    }

    public function getByNoRawat(Request $request)
    {
        $periksa = $this->pemeriksaan->with([
            'gambarRadiologi',
            'petugas',
            'dokter',
            'dokterRujuk',
            'hasilRadiologi',
            'jnsPerawatan',
            'regPeriksa.pasien',
            'regPeriksa.penjab',
            'regPeriksa.kamarInap' => function ($query) {
                return $query->where('stts_pulang', '!=', 'Pindah Kamar')->with(['kamar.bangsal']);
            },
            'regPeriksa.poliklinik',
            'permintaan.permintaanPemeriksaan',
        ]);
        if ($request->tgl_periksa) {
            $jam = explode(':', $request->jam); //split jam,
            return $periksa->where([
                'no_rawat' => $request->no_rawat,
                'tgl_periksa' => $request->tgl_periksa,
            ])->where('jam', 'like', '%' . "{$jam[0]}:$jam[1]" . '%')->first(); // hanya ambil jam dan menit saja
        } else {
            return $periksa->where('no_rawat', $request->no_rawat)->get();
        }
    }
    public function index()
    {
        $pemeriksaan = $this->pemeriksaan->where([
            'tgl_periksa' => date('Y-m-d'),
        ])->with(['regPeriksa.pasien', 'dokterRujuk', 'jnsPerawatan', 'hasilRadiologi', 'permintaan.permintaanPemeriksaan'])->get();

        return $pemeriksaan;
    }
    public function updateDateTime($clause = [], $data = [])
    {
        $update = $this->pemeriksaan->where($clause)->update($data);
        if ($update) {
            $this->track->updateSql($this->pemeriksaan, $data, $clause);
        }
    }
    public function getParameter(Request $request)
    {
        $pemeriksaan = $this->pemeriksaan;
        if ($request->tgl_awal) {
            $pemeriksaan = $pemeriksaan->whereBetween('tgl_periksa', [$request->tgl_awal, $request->tgl_akhir]);
        }
        if ($request->spesialis) {
            $pemeriksaan = $pemeriksaan->whereHas('dokterRujuk.spesialis', function ($query) use ($request) {
                $query->where('kd_sps', $request->spesialis);
            });
        }
        if ($request->status) {
            $pemeriksaan = $pemeriksaan->where('status', $request->status);
        }
        return $pemeriksaan->with(['regPeriksa.pasien', 'dokterRujuk', 'jnsPerawatan', 'hasilRadiologi', 'permintaan.permintaanPemeriksaan'])->get();
    }
    public function getTableIndex(Request $request)
    {
        if ($request->tgl_awal || $request->spesialis || $request->status) {
            $pemeriksaan = $this->getParameter($request);
        } else {
            $pemeriksaan = $this->index();
        }
        return DataTables::of($pemeriksaan)->make(true);
    }
    public function update(Request $request)
    {
        $clause = [
            'no_rawat' => $request->no_rawat,
            'tgl_periksa' => $request->tgl_periksa,
            'jam' => $request->jam,
        ];

        $data = [
            'proyeksi' => $request->proyeksi,
            'kV' => $request->kv,
            'inak' => $request->inak,
            'jml_penyinaran' => $request->jml_penyinaran,
            'dosis' => $request->dosis,
        ];
        $pemeriksaan = $this->pemeriksaan->where($clause)->update($data);

        if ($pemeriksaan) {
            $this->track->updateSql($this->pemeriksaan, $data, $clause);
        }
    }
    public function print(Request $request)
    {
        $data = [];
        $hasil = $this->getByNoRawat($request);
        $data = [
            'no_rkm_medis' => $hasil->regPeriksa->no_rkm_medis,
            'nama' => $hasil->regPeriksa->pasien->nm_pasien,
            'tgl_lahir' => $this->carbon->parse($hasil->regPeriksa->pasien->tgl_lahir)->translatedFormat('d F Y'),
            'umur' => $hasil->regPeriksa->pasien->umur,
            'jk' => $hasil->regPeriksa->pasien->jk == 'L' ? 'Laki-laki' : 'Perempuan',
            'alamat' => $hasil->regPeriksa->pasien->alamatpj . ', ' . $hasil->regPeriksa->pasien->kelurahanpj . ', ' . $hasil->regPeriksa->pasien->kecamatanpj . ', ',
            'no_rawat' => $hasil->no_rawat,
            'jns_pemeriksaan' => $hasil->jnsPerawatan->nm_perawatan,
            'dokter' => $hasil->dokter->nm_dokter,
            'id_dokter' => $hasil->dokter->kd_dokter,
            'dpjp' => $hasil->dokterRujuk->nm_dokter,
            'tgl_pemeriksaan' => $this->carbon->parse($hasil->tgl_periksa)->translatedFormat('d F Y'),
            'jam' => $hasil->jam,
            'petugas' => $hasil->petugas->nama,
            'id_petugas' => $hasil->petugas->nip,
            'ttd_dokter' => $this->setFingerOutput($hasil->dokter->nm_dokter, bcrypt($hasil->dokter->kd_dokter), $hasil->tgl_periksa),
            'poli' => $hasil->regPeriksa->poliklinik->nm_poli,
            'kamar' => '-',
            // 'ttd_petugas' => $this->setFingerOutput($hasil->petugas->nama, bcrypt($hasil->petugas->nip), $hasil->tgl_periksa),
        ];

        $domain = $request->getHost();
        if ($domain !== 'sim.rsiaaisyiyah.com') {
            $domain = "http://192.168.100.33";
        } else {
            $domain = "https://{$domain}";
        }
        foreach ($hasil->permintaan as $item => $permintaan) {
            $data['tgl_sampling'] = $permintaan->tgl_sampel;
            $data['jam_sampling'] = $permintaan->jam_sampel;
            $data['ttd_petugas'] = $this->setFingerOutput($hasil->petugas->nama, bcrypt($hasil->petugas->nip), $permintaan->tgl_sampel);
        }
        foreach ($hasil->gambarRadiologi as $item => $gbr) {
            $data['gambar'][] = "{$domain}/webapps/radiologi/" . $gbr->lokasi_gambar;
        }
        if ($hasil->regPeriksa->kamarInap) {
            foreach ($hasil->regPeriksa->kamarInap as $item => $inap) {
                $data['kamar'] = $inap ? $inap->kamar->bangsal->nm_bangsal : '-';
            }
        }
        foreach ($hasil->hasilRadiologi as $item => $hsl) {
            $data['hasil'] = $hsl->hasil;
        }

        $file = Pdf::loadView('content.print.hasil_radiologi', ['data' => $data])
            ->setOption(['defaultFont' => 'serif', 'isRemoteEnabled' => true])
            ->setPaper(array(0, 0, 595, 935));

        if ($request->openWith == 'stream') {
            return $file->stream($data['nama'] . '.pdf');
        } else {
            return $file->download($data['nama'] . '.pdf');
        }
    }
    public function setFingerOutput($dokter, $id, $tanggal)
    {
        $strId = sha1($id);
        return $str = "Ditandatangani di RSIA Aisiyiyah Pekajangan Kab. Pekalongan, Ditandatangani Elektronik Oleh $dokter, ID $strId, $tanggal";
    }
}
