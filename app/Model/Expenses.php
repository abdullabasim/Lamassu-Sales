<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Expenses extends Model
{
    protected $table = "expenses";

    protected $fillable = [
        'expenses_type_id',
        'amount',
        'note',
        'date'
    ];

    public function expenses_type()
    {
     return $this->hasOne(Expenses_Type::class, 'id', 'expenses_type_id');
    }
}
