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
        'isr_retention', 
        'igss',
        'net_salary', 
        'status',
    ];

    // PayrollDetail belongs to Payroll 
    public function detailpay()
    {
        return $this->belongsTo('App\Payroll','id_payroll');
    }

    // PayrollDetail belongs to Salary
    public function detailsalary()
    {
        return $this->belongsTo('App\Salary', 'id_salary');
    }

    // PayrollDetail belongs to Salary
    public function detailigss()
    {
        return $this->belongsTo('App\Igss', 'id_igss');
    } 

    // PayrollDetail belongs to Employee
    public function detailemployee()
    {
        return $this->belongsTo('App\Employee', 'id_employee');
    }
}
