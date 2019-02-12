<?php

namespace App\Model2;

use Illuminate\Database\Eloquent\Model;

class Project_Type extends Model
{
    protected $connection = 'mysql2';

    protected $table = "project_type";

    protected $fillable = [
        'title',


    ];

    public function application_manage()
    {
        return $this->belongsTo(Application_Manage::class);
    }
}
