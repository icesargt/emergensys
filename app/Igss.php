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
    public function igssdetail()
    {
    	return $this->hasMany('App\PayrollDetail', 'igss_id');
    }

    // Query scope para busqueda en Igss controller. Metodo index
    public function scopeBuscar($query, $cuota)
    {   
        if (trim($cuota) != "") 
        {
            //$query->where('quota', "LIKE", "%$cuota%");
            $query->where('quota', "LIKE", "%$cuota%")
                  ->orWhere('year', "LIKE", "%$cuota%");
        }        
    }

    // Scope salariesPayroll: usar para buscar año de Igss.
    public function scopeIgssPayroll($query, $year)
    {
        if (trim($year != "")) 
        {    
            $query->where('year', $year)                    
                    ->where('status', 1);
        }
    }
    
}
