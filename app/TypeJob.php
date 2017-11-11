<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TypeJob extends Model
{
    // primary key
    protected $primaryKey = 'id_type';

    // fillable attrib
    protected $fillable = [
        'description',
    ];

    // Relationship. TypeJobs has many Jobs. 1...n
    public function getJobs()
    {
    	return $this->hasMany('App\Job', 'id_job');
    }

    // Scope: searchTypes
    public function scopeSearchTypes($query, $search)
    {
        if (trim($search !="")) {
            $query->where('description', "LIKE", "%$search%");            
        }
    }
    
}
