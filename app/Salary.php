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

    // Scope salario, para formulario de busqueda
    public function scopeSalarios($query, $salario)
    {
        if (trim($salario) != "") {
            $query->where('ordinary_salary', "LIKE", "%$salario%");
        }
    }

}
