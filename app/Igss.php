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

    // Query scope para busqueda en Igss controller. Metodo index
    public function scopeBuscar($query, $cuota)
    {   
        if (trim($cuota) != "") 
        {
            $query->where('quota', "LIKE", "%$cuota%");
        }
        
    }
    
}
