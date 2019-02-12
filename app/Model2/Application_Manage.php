<?php

namespace App\Model2;

use Illuminate\Database\Eloquent\Model;

class Application_Manage extends Model
{
    protected $connection = 'mysql2';

    protected $table = "project_manager";

    protected $fillable = [
        'full_name',
        'company_name',
        'phone_number',
        'project_type_id',
        'project_name',
        'start_date',
        'end_date',
        'email',
        'note',
        'price'

    ];

    public function projectType()
    {
        return $this->hasOne(Project_Type::class, 'id', 'project_type_id');
    }
}
