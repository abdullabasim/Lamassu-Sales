<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Month_Salary extends Model
{
    protected $table = "month_salary";

    protected $fillable = [
        'bonas',
        'bonas_note',
        'subtract',
        'subtract_note',
        'salary_date',
        'employee_id',
    ];

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }

}
