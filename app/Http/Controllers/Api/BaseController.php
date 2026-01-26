<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

class BaseController extends Controller
{
    protected function sendResponse($result, $message, $code = 200)
    {
        return response()->json([
            'success' => true,
            'data' => $result,
            'message' => $message,
        ], $code);
    }

    protected function sendError($error, $info = [], $code = 400)
    {
        $payload = [
            'success' => false,
            'message' => $error,
        ];

        if (!empty($info)) {
            $payload['info'] = $info;
        }

        return response()->json($payload, $code);
    }
}