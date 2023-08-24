<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function returnResponse($response_code, $status, $data, $message) {
        $response = [
            'code' => $response_code,
            'status' => $status, /** success/error/warning */
            'data' => $data,
            'message' => $message
        ];
        return response($response, $response_code);
    }
}
