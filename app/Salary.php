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
    public function salarydetail()
    {
    	return $this->hasMany('App\PayrollDetail','salary_id');
    }

    // Scope salario, para formulario de busqueda en index.
    public function scopeSalarios($query, $salario)
    {
        if (trim($salario) != "") {
            $query->where('ordinary_salary', "LIKE", "%$salario%")
                  ->orWhere('year', "LIKE", "%$salario%");
        }
    }

    // Scope salariesPayroll: usar para buscar año de planilla.
    public function scopeSalariesPayroll($query, $year)
    {
        if (trim($year != "")) 
        {    
            $query->where('year', $year)                    
                    ->where('status', 1);
        }
    }



}
