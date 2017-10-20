<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payroll extends Model
{
    // primary key
    protected $primaryKey = 'id_payroll';

    // fillable attrib
    protected $fillable = [
       'year','month','status','user_id','generated_date',
    ];

    // Payroll has many PayrollDetail 1 ... n
    public function payroll_detail()
    {
    	return $this->hasMany('PayrollDetail');
    }  

    // Payroll belongs to User 
    public function user()
    {
    	return $this->belongsTo('User');
    }
}
