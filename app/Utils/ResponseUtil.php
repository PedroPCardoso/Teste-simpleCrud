<?php

namespace App\Utils;

class ResponseUtil
{
    public static function makeResponse($message, $data, $code = 200)
    {
        return response()->json([
            'success' => true,
            'message' => $message,
            'data' => $data
        ], $code);
    }
    public static function makeError($message, $code)
    {
        return response()->json([
            'success' => false,
            'message' => $message
        ], $code);
    }
}
