<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Consultation extends Model
{
    use HasFactory;
    protected $fillable=[
        'doctor_id',
      'day',
      'duration',
        'date',
      'start_time',
      'end_time' ,
    ];

}
