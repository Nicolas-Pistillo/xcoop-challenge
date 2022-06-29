<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;
use App\Models\Voucher;
use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Facades\JWTAuth;

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

    /**
     * Retorna un JWT segun el documento legal (DNI en el caso de argentina) 
     * y un PIN de 4 digitos del cliente
     */
    public function authenticate(Request $req) {

        if (!$req->legal_doc || !$req->pin) 
            return $this->error('legal_doc and PIN are required');

        $client = Client::where([
            'legal_doc' => $req->legal_doc, 
            'pin'       => $req->pin
        ])->first();

        if (!$client instanceof Client)
            return $this->error('Invalid legal_doc or PIN', 401);

        if (!$token = JWTAuth::fromUser($client)) 
            return $this->error('The credentials are invalid');

        return $this->ok(compact('token'));

    }

    /**
     * Retorna los vouchers asociados a un cliente, 
     * se requiere el JWT para solicitar esta información
     */
    public function getClientVouchers(Request $req) {

        return $this->ok([
            'client'    => $req->client->getPersonalData(),
            'vouchers'  => $req->client->vouchers
        ]);
    }
}
