<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Printing extends Model
{
    protected $table = "printing";

    protected $fillable = [
        'printing_company_id',
        'amount',
        'exchange_date',
        'note',
    ];

    public function printing_company()
    {
        return $this->hasOne(Printing_Company::class, 'id', 'printing_company_id');
    }


}
