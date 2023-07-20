<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Doctor extends Model
{
    use HasFactory;
    protected $fillable=[
        'first_name',
        'last_name',
        'qualification',
        'designation',
        'department',
        'image',
    ];
    public function slot():HasMany
    {
        return $this->hasMany(Timeslot::class);

    }
    public function department()
    {
        return $this->belongsTo(Department::class, 'doctor_specializations');

    }
}
