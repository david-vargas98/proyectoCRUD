<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HighSeverity extends Model
{
    use HasFactory;

    //Se le indica que ese es el nombre de la tabla porque el seeder intenta meter los registros en "high_severities"
    protected $table = 'high_severity';
}
