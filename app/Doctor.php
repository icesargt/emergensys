<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
    // primary key
    protected $primaryKey = 'id_doctor';

    // fillable attrib
    protected $fillable = [
       'specialty_id', 'job_id', 'dpi', 'first_name', 'second_name', 'last_name', 'sex', 'mobile_number', 'email', 
        'shift_id', 'start_date', 'inactivity_date', 'salary', 'bonus', 
    ];

    // Relationship. Doctors belons to Job. n...1
    public function getJobDoctors()
    {
    	return $this->belongsTo('App\Job', 'id_job');
    }

    // Relationship. Doctors belongs to Shift. n...1
    public function getShifDoctor()
    {
    	return $this->belongsTo('App\Shift', 'id_shift');
    }

    // Relationship. Doctors belongs to Specialties
    public function getSpecialityDoctor()
    {
    	return $this->belongsTo('App\Specialties', 'id_specialty');
    }

    // Relationship. Doctors has many histories. 1...n
    public function getHistoriesDoctor()
    {
    	return $this->hasMany('App\History', 'doctor_id');
    }
}
