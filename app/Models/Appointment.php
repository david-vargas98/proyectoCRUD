<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    use HasFactory;

    //Se agrega el fillable para asinaciones masivas
    protected $fillable = ['patient_id', 'appointment_date', 'start_time', 'end_time', 'appointment_status', 'observations_location', 'observations_name'];

    //Relación 1:m con Patient
    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }
}
