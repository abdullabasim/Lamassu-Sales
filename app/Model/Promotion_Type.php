<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Promotion_Type extends Model
{
    protected $table = "promotion_type";

    protected $fillable = [
        'title',
    ];

    public function expenses()
    {
        return $this->belongsTo(Expenses::class);
    }
}
