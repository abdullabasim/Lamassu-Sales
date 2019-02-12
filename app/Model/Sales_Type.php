<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Sales_Type extends Model
{
    protected $table = "sales_type";

    protected $fillable = [
        'title',
    ];

    public function sales()
    {
        return $this->belongsTo(Sales::class);
    }
}
