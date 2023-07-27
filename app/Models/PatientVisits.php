<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PatientVisits extends Model
{
    use HasFactory;
    protected $fillable = 
    [
      'patient_id',
      'date',
      'room',
      'invoice_number',
      'tx_number',
      'dx_code',
      'gmt',
      'gmu',
      'modality',
      'time_start',
      'time_end',
      'signature',
      'night_rate',
      'holiday_rate',
      'weekend_rate',
      'day',
      'amount',
      'comment',
      'created_at',
      'user_id',
      'hospital_id',
      'status'
    ];


    public function patient(){
      return $this->belongsTo(Patients::class);
    }
}
