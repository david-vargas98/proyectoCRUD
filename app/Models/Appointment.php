<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    use HasFactory;

    //Relación 1:m con Patient
    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }
}
