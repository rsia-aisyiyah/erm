<?php

namespace App\Http\Controllers;

use App\Http\Requests\HasilKritisRequest;
use App\Models\Dokter;
use App\Models\Petugas;
use App\Models\RsiaHasilKritis;
use App\Models\User;
use App\Services\AuthVerificationService;
use App\Services\HasilKritis\HasilKritisFetchService;
use App\Services\HasilKritis\VerifikasiHasilKritis;
use Carbon\Carbon;
use Illuminate\Database\QueryException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PhpParser\Node\Stmt\TryCatch;
use Symfony\Component\HttpKernel\Exception\HttpException;
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


    public function getPetugas(HasilKritisFetchService $fetch, Request $request): JsonResponse
    {
        // 1. Validasi Input (Memastikan NIP tidak kosong/null)
        if (!$request->filled('nip')) {
            return response()->json([
                'status' => 'error',
                'message' => 'NIP/NIK tidak boleh kosong'
            ], 400);
        }

        // 2. Ambil data melalui Service dengan melemparkan parameter yang dibutuhkan
        $hasilKritis = $fetch->getByPetugas(
            nip: $request->input('nip'),
            status: $request->input('status'),
            bulanRaw: $request->input('bulan')
        );

        // 3. Kembalikan Response JSON hasil akhir
        return response()->json($hasilKritis);
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
    public function verifikasi(VerifikasiHasilKritis $service, $id, Request $request)
    {
        // Validasi input form dasar tetap di Controller (atau via FormRequest)
        $request->validate([
            'password' => 'required',
            'role' => 'required'
        ]);

        try {
            // Serahkan seluruh logika berat ke Service
            $service->verifyAndExecute(
                $id,
                $request->password,
                $request->role
            );
            $updateNotif = new \App\Services\NotificationService();
            return response()->json([
                'message' => 'Verifikasi berhasil',
                'new_count' => $updateNotif->getHasilKritisCount() // Contoh update count notifikasi setelah verifikasi
            ]);

        } catch (HttpException $e) {
            // Tangkap error kustom yang dilempar oleh Service beserta Status Code-nya
            return response()->json([
                'message' => $e->getMessage()
            ], $e->getStatusCode());
        }
    }
}
