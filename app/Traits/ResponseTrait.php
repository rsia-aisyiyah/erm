<?php

namespace App\Traits;

use Illuminate\Support\Facades\Log;
use Throwable;

trait ResponseTrait
{
    protected string $logChannel = 'custom';

    /**
     * Kirim response sukses (opsional).
     */
    protected function successResponse($data, string $message = 'Success', int $code = 200)
    {
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
                Log::channel($this->logChannel)->error(
                    $error->getMessage() . ' in ' . $error->getFile() . ':' . $error->getLine()
                );
            } else {
                Log::channel($this->logChannel)->error($error);
            }
        }

        return response()->json([
            'success' => false,
            'message' => $message,
        ], $code);
    }

}
