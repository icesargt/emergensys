<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Specialty extends Model
{
    // primary key
    protected $primaryKey = 'id_specialty';

    // fillable attrib
    protected $fillable = [
        'description', 
    ];

    // Relationshift. Speciality has many Doctors. 1..n
    public function getDoctorSpeciality()
    {
    	return $this->hasMany('App\Doctor', 'specialty_id');
    }


    // Query scope para busqueda en speciality controller. Metodo index
    public function scopeSearchSpeciality($query, $search)
    {   
        if (trim($search !="")) {
            $query->where('description', "LIKE", "%$search%");            
        }      
    }
}
