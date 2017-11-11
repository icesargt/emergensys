<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    // primary key
    protected $primaryKey = 'id_patient';

    // fillable attrib
    protected $fillable = [
        'dpi', 'first_name', 'second_name', 'last_name', 'sex', 'mobile_number', 'email', 
        'social_security', 'civil_status', 'address_birth', 'photo',
    ];

   // Relationship. 1...n. Patient...Agenda
   public function getAgendasPatients()
   {
   		return $this->hasMany('App\Agenda', 'patient_id');
   }

   // Relationship. 1...n. Patient...SendAlert
   public function getAlertsPatients()
   {
   		return $this->hasMany('App\SendAlert', 'patient_id');
   }

   // Relationship. Patient has many Historys 1...n
   public function getHistoryPatient()
   {
      return $this->hasMany('App\History', 'patient_id');
   }

   // // Query scope para busqueda en speciality controller. Metodo index
   //  public function scopeSearchPatients($query, $search)
   //  {   
   //      if (trim($search !="")) {
   //          $query->where('first_name', "LIKE", "%$search%")
   //                ->orWhere('mobile_number', "LIKE", "%$search%")
   //                ->orWhere('email', "LIKE", "%$search%");           
   //      }      
   //  }

    // Scope Pacientes, para buscar empleado
    public function scopeSearchPatients($query, $search)
    {
        if (trim($search) != "") {           
            $query->where(\DB::raw("CONCAT(first_name, ' ', last_name)"), "LIKE", "%$search%")
                  ->orWhere('mobile_number', "LIKE", "%$search%")
                  ->orWhere('email', "LIKE", "%$search%");
        }
    }

}
