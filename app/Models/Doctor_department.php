<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Doctor_department extends Model
{
    use HasFactory;
    protected $fillable=[
        'doctor_id',
        'department_id',
    ];
}
