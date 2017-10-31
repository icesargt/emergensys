<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    // primary key
    protected $primaryKey = 'id_employee';

    // fillable attrib
    protected $fillable = [
        'name', 'last_name', 'start_date', 'status', 'inactivity_date', 'bonus', 'isr', 'created_record',
    ];

    // relations models
    
    // Relation 1..n Employee - PayrollDetail
    public function employeedetail()
    {
    	return $this->hasMany('App\PayrollDetail', 'employee_id');
    }

    // Relation 1..n Employee - Records
    public function employeerecord()
    {
    	return $this->hasMany('App\Record', 'employee_id');
    }

    // Scope Empleados, para buscar empleado
    public function scopeEmpleados($query, $nombre)
    {
        if (trim($nombre) != "") {
            // $query->where('name','LIKE',"%$nombre%");
            $query->where(\DB::raw("CONCAT(name, ' ', last_name)"), "LIKE", "%$nombre%");
        }
    }

} // end class
