<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class History extends Model
{
    // primary key
    protected $primaryKey = 'id_history';

    // fillable attrib
    protected $fillable = [
        'patient_id', 'description', 'date_in', 'date_up', 'doctor_id',
    ];

    // Relationship. History belongs to Doctor. n...1
    public function getDoctorHistory()
    {
    	return $this->belongsTo('App\Doctor', 'id_doctor');
    }

    // Relationship. History belongs to Patients. n...1
    public function getPatientHistroy()
    {
    	return $this->belongsTo('App\Patient', 'id_patient');
    }

    // Relationship. Histroy has many details. 1...n
    public function getDetailHistory()
    {
    	return $this->hasMany('App\Detail', 'history_id');
    }
}
