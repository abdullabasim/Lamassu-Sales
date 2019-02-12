<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Delivery_Type extends Model
{
    protected $table = "delivery_type";

    protected $fillable = [
        'title',
    ];

    public function delivery()
    {
        return $this->belongsTo(Delivery::class);
    }
}
