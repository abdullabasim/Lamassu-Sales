<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Printing_Company extends Model
{
    protected $table = "printing_company";

    protected $fillable = [
        'title',
        'printing_company_type_id'

    ];

    public function printing()
    {
        return $this->belongsTo(Printing::class);
    }

    public function printing_company_type()
    {
        return $this->hasOne(Printing_type::class, 'id', 'printing_company_type_id');
    }


}
