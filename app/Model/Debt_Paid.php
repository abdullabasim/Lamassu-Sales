<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Debt_Paid extends Model
{
    protected $table = "debt_paid";

    protected $fillable = [
        'debt_id',
        'debt_name_id',
        'amount',
        'note',
    ];


    public function depts_name()
    {
        return $this->hasOne(Debt_Name::class, 'id', 'debt_name_id');
    }

    public function dept()
    {

        return $this->hasOne(Debt::class, 'id', 'debt_id');
    }

}
