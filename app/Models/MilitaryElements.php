<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MilitaryElements extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = ['name', 'birthdate', 'cellphone', 'address', 'admission', 'militarygrade', 'location', 'unit', 'servicestate'];
}