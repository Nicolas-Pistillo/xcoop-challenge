<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Voucher extends Model
{
    use HasFactory;

    public function client() {

        return $this->hasOne(Client::class);
        
    }

    /**
     * Verifica si un voucher ya expiró
     */
    public function isExpired() {

        return Carbon::now() >= $this->expiration;

    }
}
