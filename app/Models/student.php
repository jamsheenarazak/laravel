<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class student extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'standard',
        'dob',
        'father_name',
        'mother_name',
        'phone',
        'email',
    ];
}
