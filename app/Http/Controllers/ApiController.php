<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Voucher;

class ApiController extends ApiBaseController
{
    /**
     * Verifica la validez de un voucher.
     * Se requiere el parametro hash, que hace referencia al hash del voucher
     * retorna un booleano indicando si ya expiró (expired),
     * un mensaje de estado del voucher (message)
     * y el objeto del voucher, haciendo referencia a su modelo (voucher)
     */
    public function checkVoucher(Request $req) {

        if (!$req->hash) return $this->error('The hash parameter is required');

        $voucher = Voucher::where('hash', $req->hash)->first();

        if (!$voucher instanceof Voucher)
            return $this->error('The hash does not correspond to any existing voucher');

        $expired = false;
        $message = "¡Great!, your voucher is currently active";

        if ($voucher->isExpired()) {

            $expired = true;
            $message = "¡Ups!...looks like your voucher has been expired";
        } 

        return $this->ok(compact('expired', 'message', 'voucher'));

    }
}
