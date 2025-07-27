<?php

namespace App\Helpers;

class ApiResponse
{
    public static function success($data = null, $message = 'Operation successful', $status = 200)
    {
        return response()->json([
            'status' => true,
            'message' => $message,
            'errors' => null,
            'data' => $data,
        ], $status);
    }

    public static function error($errors = [], $status = 400, $message = 'Something went wrong')
    {
        return response()->json([
            'status' => false,
            'message' => $message,
            'errors' => $errors,
            'data' => null
        ], $status);
    }
}
