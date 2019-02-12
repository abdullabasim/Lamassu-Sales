<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Debt extends Model
{
    protected $table = "debt";

    protected $fillable = [
        'name',
        'debt_name_id',
        'amount',
        'remaining',
        'date',
        'note',
    ];

    public function dept_paid()
    {
        return $this->hasMany(Debt_Paid::class, 'debt_id', 'id');
    }

    public function depts_name()
    {
        return $this->hasOne(Debt_Name::class, 'id', 'debt_name_id');
    }
}
