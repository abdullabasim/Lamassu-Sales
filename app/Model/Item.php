<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    protected $table = "item";

    protected $fillable = [
        'title',
        'description',
        'quantity',
        'amount',
        'sales_id'
    ];


}
