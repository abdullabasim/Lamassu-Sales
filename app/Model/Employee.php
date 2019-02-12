<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected $table = "employee";

    protected $fillable = [
        'full_name',
        'basic_salary',
        'department_id',
        'start_date',
    ];

    public function department()
    {
        return $this->hasOne(Department::class, 'id', 'department_id');
    }

    public function month_salary()
    {
        return $this->hasOne(Month_Salary::class, 'employee_id', 'id');
    }
}
