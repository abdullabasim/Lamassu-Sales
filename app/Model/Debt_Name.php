<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Debt_Name extends Model
{
    protected $table = "debt_name";

    protected $fillable = [
        'title',
    ];

    public function debt()
    {
        return $this->belongsTo(Debt::class);
    }

    public function debt_paid()
    {
        return $this->belongsTo(Debt_Paid::class);
    }
}
