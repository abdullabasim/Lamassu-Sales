<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Specialty extends Model
{
    protected $table = "specialty";

    public $timestamps = false;

    protected $fillable = [
        'title',
    ];

    public function client()
    {
        return $this->belongsTo(Client::class);
    }
}
