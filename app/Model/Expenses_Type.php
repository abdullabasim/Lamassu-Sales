<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Expenses_Type extends Model
{
    protected $table = "expenses_type";

    protected $fillable = [
        'title',
        'note',
    ];

    public function expenses()
    {
        return $this->belongsTo(Expenses::class);
    }
}
