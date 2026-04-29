<?php

namespace App\Traits;

use Illuminate\Support\Facades\Log;
use Throwable;

trait ResponseTrait
{
    /**
     * Mendapatkan channel log secara dinamis.
     * Jika di Controller didefinisikan protected string $logChannel, maka itu yang dipakai.
     * Jika tidak, default ke 'responseLogs'.
     */
    protected function getLogChannel(): string
    {
        return $this->logChannel ?? 'responseLogs';
    }

    /**
     * Kirim response sukses (opsional).
     */
    protected function successResponse($data, string $message = 'Success', int $code = 200)
    {
        // Ambil data pegawai dari session
        $pegawai = session()->get('pegawai');

        // Catat log dengan konteks yang lebih detail
        Log::channel($this->getLogChannel())->info($message, [
            'user' => [
                'nik' => $pegawai?->nik ?? 'System',
                'nama' => $pegawai?->nama ?? 'System',
            ],
            'payload_response' => $data, // Data yang dikembalikan (seperti no_resep)
            'url' => request()->fullUrl(),
            'method' => request()->method(),
            'ip' => request()->ip(),
        ]);

        return response()->json([
            'success' => true,
            'message' => $message,
            'data' => $data,
        ], $code);
    }

    /**
     * Response error dengan opsi logging.
     *
     * @param Throwable|string $error  Error/exception
     * @param string $message         Pesan untuk client
     * @param int $code               HTTP status code
     * @param bool $withLog           Apakah error disimpan ke log?
     */
    protected function errorResponse(Throwable|string $error, string $message = 'Terjadi kesalahan', int $code = 500, bool $withLog = true)
    {
        if ($withLog) {
            if ($error instanceof Throwable) {
                Log::channel($this->getLogChannel())->error(
                    $error->getMessage().' in '.$error->getFile().':'.$error->getLine()
                );
            } else {
                Log::channel($this->getLogChannel())->error($error);
            }
        }

        return response()->json([
            'success' => false,
            'message' => $message,
        ], $code);
    }

}
