<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Level extends Model
{
    // primary key
    protected $primaryKey = 'id_level';

    // fillable attrib
    protected $fillable = [
        'description',
    ];

    // Relationship. Level has many Diseases.
    public function getDiseaseLevel()
    {
    	return $this->hasMany('App\Disease', 'level_id');
    }

    // Query scope para busqueda en Igss controller. Metodo index
    public function scopeSearchLevel($query, $search)
    {   
        if (trim($search !="")) {
            $query->where('description', "LIKE", "%$search%");            
        }      
    }


}
