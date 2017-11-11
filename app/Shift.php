<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Shift extends Model
{
    // primary key
    protected $primaryKey = 'id_shift';

    // fillable attrib
    protected $fillable = [
        'description', 'times_start', 'time_end',
    ];

    // Relationship. Shift has many Doctors. 1...n
    public function getDoctorShift()
    {
    	return $this->hasMany('App\Doctor', 'shift_id');
    }
}
