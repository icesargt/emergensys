<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Agenda extends Model
{
    // primary key
    protected $primaryKey = 'id_agend';

    // fillable attrib
    protected $fillable = [
        'patient_id', 'description', 'selectd_day', 'start_time', 'end_time',
    ];

   // Relationship. n...1 Agenda...Patient
   public function getPatients()
   {
   		return $this->belongsTo('App\Patient', 'id_patient');
   }
  
}
