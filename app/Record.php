<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Record extends Model
{
    // primary key
    protected $primaryKey = 'id_record';

    // fillable attrib
    protected $fillable = [
        'employee_id', 'bonus_rec', 'isr_rec', 'created_record'
    ];

    // Relation 1..n Employee - PayrollDetail
    public function recordemployee()
    {
        return $this->belongsTo('App\Employee', 'id_employee');
    }
}
