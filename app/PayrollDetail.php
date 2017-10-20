<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PayrollDetail extends Model
{
    // primary key default
    // protected $primaryKey = 'id';

    // fillable attrib
    protected $fillable = [
        'payroll_id', 
        'employee_id', 
        'salary_id', 
        'igss_id', 
        'ordinary_salary', 
        'bonus', 
        'total_salary', 
        'isr_tetention', 
        'igss',
        'net_salary', 
        'status',
    ];

    // PayrollDetail belongs to Payroll 
    public function payroll()
    {
        return $this->belongsTo('Payroll');
    }

    // PayrollDetail belongs to Salary
    public function salary()
    {
        return $this->belongsTo('Salary');
    }

    // PayrollDetail belongs to Salary
    public function igss()
    {
        return $this->belongsTo('Igss');
    } 

    // PayrollDetail belongs to Employee
    public function employee()
    {
        return $this->belongsTo('Employee');
    }
}
