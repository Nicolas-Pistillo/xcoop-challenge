<?php

namespace App\Models;

use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Tymon\JWTAuth\Contracts\JWTSubject;

class Client extends Model implements Authenticatable, JWTSubject
{
    use HasFactory;
    use \Illuminate\Auth\Authenticatable;

    public function vouchers() {

        return $this->hasMany(Voucher::class);
        
    }

    public function getPersonalData() {

        return [
            'id'          => $this->id, 
            'name'        => $this->name, 
            'profession'  => $this->profession
        ];
    }

    public function getJWTCustomClaims() {
        
        return [];

    }

    public function getJWTIdentifier() {
        
        return $this->getKey();

    }
}
