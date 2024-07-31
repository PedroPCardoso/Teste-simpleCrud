<?php

namespace App\Http\Controllers;

use App\Utils\ResponseUtil;

class BaseController extends Controller
{
     public function sendResponse($result, $message)
    {
        return ResponseUtil::makeResponse($message, $result);
    }

    public function sendError($error, $code = 404)
    {
        return ResponseUtil::makeError($error, $code);
    }
}
