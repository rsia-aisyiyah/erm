<?php

namespace App\Traits;

trait JsonResponseTrait
{
    /**
     * Send a success response.
     *
     * @param mixed $data
     * @param string $message
     * @param int $code
     * @return \Illuminate\Http\JsonResponse
     */
    protected function successResponse($data, $message = 'Success', $code = 200)
    {
        return response()->json([
            'status' => 'success',
            'message' => $message,
            'data' => $data
        ], $code);
    }

    /**
     * Send an error response.
     *
     * @param string $message
     * @param int $code
     * @param mixed $errors
     * @return \Illuminate\Http\JsonResponse
     */
    protected function errorResponse($message = 'Error', $code = 400, $errors = null)
    {
        return response()->json([
            'status' => 'error',
            'message' => $message,
            'errors' => $errors
        ], $code);
    }
}
