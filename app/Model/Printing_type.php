<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Printing_type extends Model
{
    protected $table = "printing_type";

    protected $fillable = [
        'title',
    ];

    public function printing()
    {
        return $this->belongsTo(Printing::class);
    }

    public function printing_company()
    {
        return $this->belongsTo(Printing_Company::class);
    }
}
