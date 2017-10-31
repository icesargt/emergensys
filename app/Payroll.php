<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payroll extends Model
{
    // primary key
    protected $primaryKey = 'id_payroll';

    // fillable attrib
    protected $fillable = [
       'year','month','status','user_id','generated_date',
    ];

    // Payroll has many PayrollDetail 1 ... n
    public function paydetail()
    {
    	return $this->hasMany('App\PayrollDetail', 'payroll_id');
    }  

    // Payroll belongs to User 
    public function user()
    {
    	return $this->belongsTo('App\User','id');
    }

    /**
     * [scopePlanillaExistente buscar planilla existente.
     * @param  [type] $query funcion
     * @param  [type] $year  
     * @param  [type] $month 
     * @return [type]        scope
     */
    public function scopePayrollExists($query, $year, $month)
    {
        if (trim($year != "") && trim($month != "")) 
        {    
            $query->where('year', $year)
                    ->where('month', $month)
                    ->where('status', 1);
        }
    }

} // fin de clase
