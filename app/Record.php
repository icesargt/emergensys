<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Record extends Model
{
    // primary key
    protected $primaryKey = 'id_record';

    // fillable attrib
    protected $fillable = [
        'employee_id', 'bonus', 'bonus_date', 'isr', 'isr_date'        
    ];

    // Relation 1..n Employee - PayrollDetail
    public function employee()
    {
        return $this->belongsTo('Employee');
    }
}
