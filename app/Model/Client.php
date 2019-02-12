<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use App\Model\Sales;

class Client extends Model
{
    protected $table = "client";

    protected $fillable = [
        'company_name',
        'specialty_id',
        'client_name',
        'client_phone',
        'email',
        'address',
    ];

    public function sales()
    {
        return $this->hasMany(Sales::class, 'client_id', 'id');
    }
    public function specialty()
    {
        return $this->hasOne(Specialty::class, 'id', 'specialty_id');
    }

}
