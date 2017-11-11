<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Disease extends Model
{
    // primary key
    protected $primaryKey = 'id_disease';

    // fillable attrib
    protected $fillable = [
        'level_id', 'description', 'cause', 'first_sintom', 'second_sintom', 'third_sintom', 'day_detected'
    ];

    // Relationship. Disease has many Details. 1...n
    public function getDetailDisease()
    {
    	return $this->hasMany('App\Detail', 'disease_id');
    }

    // Relationship. Disease has many Prescription
    public function getPrescriptionDisease()
    {
    	return $this->hasMany('App\Prescription', 'disease_id');
    }

    // Relationship. Disease belongsTo Level. n...1
    public function getLevelDisease()
    {
    	return $this->belongsTo('App\Level', 'id_level');
    }

    // Query scope para busqueda en Igss controller. Metodo index
    public function scopeSearchDisease($query, $search)
    {   
        if (trim($search) != "") 
        {
            
            $query->where('description', "LIKE", "%$search%")
                  ->orWhere('cause', "LIKE", "%$search%")
                  ->orWhere('first_sintom', "LIKE", "%$search%")
                  ->orWhere('second_sintom', "LIKE", "%$search%");
                  // ->orWhere('year', "LIKE", "%$search%");
        }        
    }



}
