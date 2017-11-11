<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Detail extends Model
{
    // primary key
    protected $primaryKey = 'id_detail';

    // fillable attrib
    protected $fillable = [
        'history_id', 'desease_id', 'origin', 'reason', 'personal_history', 'sala', 'bed', 'recet_detail',
        'day_week', 
    ];

    // Relationship. Detail belongs to Histroy
    public function getHistoryDetail()
    {
    	return $this->belongsTo('App\History', 'id_history');
    }

    // Relationship. Diseases has many Details
    public function getDiseaseDetail()
    {
    	return $this->belongsTo('App\Disease', 'id_disease');
    }
    
}

