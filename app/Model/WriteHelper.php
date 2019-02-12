<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class WriteHelper extends Model
{
    protected $table = "write_helper";

   // public $timestamps = false;

    protected $fillable = [
        'title',
    ];

}
