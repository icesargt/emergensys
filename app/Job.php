<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    // primary key
    protected $primaryKey = 'id_job';

    // fillable attrib
    protected $fillable = [
        'type_id', 'description',
    ];

   // Relationship. Jobs belongsTo TypeJobs. n...1
    public function getTypeJobs()
    {
    	return $this->belongsTo('App\TypeJob', 'id_type');
    }

    // Relationship. Jobs has many Doctors. 1...n
    public function getDosctorsJob()
    {
    	return $this->hasMany('App\Doctor', 'job_id');
    }

    // Scope searchJob. 
    public function scopeSearchJob($query, $search)
    {
        if (trim($search !="")) {
            $query->where('description', "LIKE", "%$search%");            
        }  
    }
   
}
