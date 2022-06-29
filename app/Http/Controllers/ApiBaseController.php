<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ApiBaseController extends Controller
{
    public function ok($data = null, $status = 200) {

        return response()->json([
            'status'  => 'ok',
            'data'    => $data
        ], $status);
    }

    public function error($message, $status = 406) {
        
        return response()->json([
            'status'   => 'error',
            'message'  => $message
        ], $status);
    }
}
