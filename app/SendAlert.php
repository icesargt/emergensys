<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SendAlert extends Model
{
    // primary key
    protected $primaryKey = 'id_alert';

    // fillable attrib
    protected $fillable = [
        'patient_id', 'phone_number', 'message', 
    ];

   // Relationship. n...1 SendAlert...Patient
   public function getPatientAlert()
   {
   		return $this->belongsTo('App\Patient', 'id_patient');
   }

   // Relationship. n...1 SendAlert...User
   public function getUserAlert()
   {
   		return $this->belongsTo('App\User', 'id');
   }

   // Scope Pacientes, para buscar empleado
    public function scopeSearchAlerts($query, $search)
    {
        if (trim($search) != "") {           
            $query->where('phone_number', "LIKE", "%$search%");                  
        }
    }
}
