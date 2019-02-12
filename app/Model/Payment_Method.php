<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Payment_Method extends Model
{
    protected $table = "payment";

    protected $fillable = [
        'title',
    ];
}
