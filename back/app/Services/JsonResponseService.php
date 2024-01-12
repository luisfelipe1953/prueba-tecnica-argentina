<?php

namespace App\Services;

use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

class JsonResponseService
{
    // public function success(string $action): JsonResponse
    // {
    //     return response()->json(['msg' => "Se ha {$action} satisfactoriamente."], Response::HTTP_OK);
    // }

    public function catch(string $message): JsonResponse
    {
        Log::error('Ocurrió un error: ' . $message);

        return response()->json([
            'error' => 'Problema inesperado al procesar la solicitud.'
        ], Response::HTTP_INTERNAL_SERVER_ERROR);
    }
}