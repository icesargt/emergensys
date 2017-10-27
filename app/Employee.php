<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    // primary key
    protected $primaryKey = 'id_employee';

    // fillable attrib
    protected $fillable = [
        'name', 'last_name', 'start_date', 'status', 'inactivity_date', 'bonus', 'isr',
    ];

    // relations models
    
    // Relation 1..n Employee - PayrollDetail
    public function payroll_detail()
    {
    	return $this->hasMany('PayrollDetail');
    }

    // Relation 1..n Employee - Records
    public function records()
    {
    	return $this->hasMany('Record');
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
