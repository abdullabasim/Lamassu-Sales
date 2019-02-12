<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Delivery extends Model
{
    protected $table = "delivery";

    protected $fillable = [
        'delivery_type_id',
        'amount',
        'delivery_date',
        'note'
    ];

    public function delivery_type()
    {
        return $this->hasOne(Delivery_Type::class, 'id', 'delivery_type_id');
    }


}
