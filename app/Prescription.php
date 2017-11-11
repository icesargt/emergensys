<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Prescription extends Model
{
    // primary key
    protected $primaryKey = 'id_prescription';

    // fillable attrib
    protected $fillable = [
        'disease_id', 'recet', 'observations',
    ];

    // Relationship. Prescription belongs to Disease.
    public function getDiseasePrescription()
    {
    	return $this->belongsTo('App\Disease', 'id_disease');
    }
    

    // Query scope para busqueda en Igss controller. Metodo index
    public function scopeSearchPrescription($query, $search)
    {   
        if (trim($search) != "") 
        {
            
            $query->where('recet', "LIKE", "%$search%")
                  ->orWhere('observations', "LIKE", "%$search%");                  
        }        
    }
}
