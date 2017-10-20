<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Igss extends Model
{
    // primary key
    protected $primaryKey = 'id_igss';

    // fillable attrib
    protected $fillable = [
        'year', 'quota', 'status',        
    ];

    // relation payroll_details 1 ... n
    public function payroll_detail()
    {
    	return $this->hasMany('PayrollDetail');
    }    
}
