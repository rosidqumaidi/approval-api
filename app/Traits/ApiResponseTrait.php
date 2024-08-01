<?php

namespace App\Traits;

use Illuminate\Http\JsonResponse;

trait ApiResponseTrait
{
    /**
     * Menyusun respons JSON untuk sukses dengan data.
     *
     * @param mixed $data
     * @param int $status
     * @return JsonResponse
     */
    public function successResponse($data, $status = 200): JsonResponse
    {
        return response()->json(['data' => $data], $status);
    }

    /**
     * Menyusun respons JSON untuk error dengan pesan kesalahan.
     *
     * @param string $message
     * @param int $status
     * @return JsonResponse
     */
    public function errorResponse($message, $status = 400): JsonResponse
    {
        return response()->json(['error' => $message], $status);
    }
}