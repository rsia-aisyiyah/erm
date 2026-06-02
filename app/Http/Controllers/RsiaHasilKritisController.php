<?php

namespace App\Http\Controllers;

use App\Http\Requests\HasilKritisRequest;
use App\Models\Dokter;
use App\Models\Petugas;
use App\Models\RsiaHasilKritis;
use App\Models\User;
use App\Services\AuthVerificationService;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PhpParser\Node\Stmt\TryCatch;
use Yajra\DataTables\DataTables;

class RsiaHasilKritisController extends Controller
{
    protected $track;
    protected $authVerifyService;
    public function __construct(AuthVerificationService $authVerifyService)
    {
        $this->authVerifyService = $authVerifyService;
        $this->track = new TrackerSqlController();
    }
    function get($id)
    {
        $hasil = RsiaHasilKritis::where('id', $id)->with([
            'petugas' => function ($q) {
                return $q->select(['nip', 'nama']);
            },
            'petugasRuang' => function ($q) {
                return $q->select(['nip', 'nama']);
            },
            'dokter' => function ($q) {
                return $q->select(['kd_dokter', 'nm_dokter']);
            },
            'regPeriksa'
        ])->first();
        return response()->json($hasil);
    }
    function getHasil(Request $request)
    {
        $hasil = RsiaHasilKritis::where('no_rawat', $request->no_rawat)->with([
            'petugas' => function ($q) {
                return $q->select(['nip', 'nama']);
            },
            'petugasRuang' => function ($q) {
                return $q->select(['nip', 'nama']);
            },
            'dokter' => function ($q) {
                return $q->select(['kd_dokter', 'nm_dokter']);
            },
            'regPeriksa'
        ]);

        return DataTables::of($hasil)->make(true);
    }


    function getPetugas(Request $request)
    {
        // 1. Validasi input NIP agar tidak kosong
        if (!$request->has('nip') || empty($request->nip)) {
            return response()->json(['error' => 'NIP/NIK tidak boleh kosong'], 400);
        }

        $nipUser = $request->nip;
        $isDokter = Dokter::where('kd_dokter', $nipUser)->exists();

        // 3. Inisialisasi query basic dengan Eager Loading (with)
        $query = RsiaHasilKritis::with([
            'petugas' => function ($q) {
                $q->select(['nip', 'nama']);
            },
            'petugasRuang' => function ($q) {
                $q->select(['nip', 'nama']);
            },
            'dokter' => function ($q) {
                $q->select(['kd_dokter', 'nm_dokter']);
            },
            'regPeriksa.pasien' => function ($q) {
                $q->select(['no_rkm_medis', 'nm_pasien', 'jk']);
            }
        ]);

        // 4. Kondisional Filter berdasarkan Role User yang terdeteksi
        if ($isDokter) {
            // Jika Dokter: Ambil data hasil kritis yang ditujukan ke Dokter ini
            $query->where('dokter', $nipUser);
        } else {
            // Jika Perawat/Bidan/Petugas Ruang: Ambil berdasarkan kolom petugas_ruang
            $query->where('petugas_ruang', $nipUser);
        }

        // 5. Urutkan berdasarkan data terbaru dan parsing ke DataTables
        $hasil = $query->orderBy('tgl', 'desc');

        return DataTables::of($hasil)->make(true);
    }
    function create(HasilKritisRequest $request)
    {

        $data = $request->validated();

        if ($request->id) {
            $isAvailable = RsiaHasilKritis::where('id', $request->id)->first();
            if ($isAvailable) {
                $this->update($request);
                return true;
            }
        }

        try {
            $hasil = RsiaHasilKritis::create($data);
            if ($hasil) {
                $this->track->insertSql(new RsiaHasilKritis(), $data);
            }
            return response()->json('SUKSES', 201);
        } catch (QueryException $e) {
            return response()->json($e->errorInfo, 500);
        }
    }
    function delete($id, Request $request)
    {
        try {
            $hasil = RsiaHasilKritis::where('id', $id)->delete();
            if ($hasil) {
                $this->track->deleteSql(new RsiaHasilKritis(), ['id' => $id]);
            }
            return response()->json($hasil);
        } catch (QueryException $e) {
            return response()->json($e->errorInfo, 500);
        }
    }
    public function verifikasi($id, Request $request)
    {
        $request->validate([
            'password' => 'required',
            'role' => 'required'
        ]);

        $petugas = $this->authVerifyService->verifyUser();

        if (!$petugas) {
            return response()->json([
                'message' => 'User tidak ditemukan'
            ], 404);
        }

        $isValidPassword = $this->authVerifyService->verifyPassword($request->password);
        if (!$isValidPassword) {
            return response()->json([
                'message' => 'Password salah'
            ], 422);
        }
        $hasil = RsiaHasilKritis::findOrFail($id);
        switch ($request->role) {
            case 'petugas_ruang':
                if ($hasil->petugas_ruang != $petugas->nip) {
                    return response()->json([
                        'message' => 'Anda bukan petugas ruangan'
                    ], 403);
                }
                $hasil->update([
                    'tgl_ruang' => now()
                ]);
                break;
            case 'dokter':
                if ($hasil->dokter != $petugas->nip) {
                    return response()->json([
                        'message' => 'Anda bukan dokter terkait'
                    ], 403);
                }
                $hasil->update([
                    'tgl_dokter' => now()
                ]);
                break;
            default:
                return response()->json([
                    'message' => 'Role tidak valid'
                ], 422);
        }
        return response()->json([
            'message' => 'Verifikasi berhasil'
        ]);
    }

}
