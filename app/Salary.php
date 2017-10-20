<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Salary extends Model
{
    // primary key
    protected $primaryKey = 'id_salary';

    // fillable attrib
    protected $fillable = [
        'year', 'ordinary_salary', 'status',        
    ];

    // relation payroll_details 1 ... n
    public function payroll_detail()
    {
    	return $this->hasMany('PayrollDetail');
    }  
}
