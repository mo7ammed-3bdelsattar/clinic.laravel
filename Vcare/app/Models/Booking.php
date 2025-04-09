<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Booking extends Model
{
    use HasFactory;
    protected $fillable=[
        'status',
        'appointment_id',
        'patient_id',
    ];
    public function appointment(){
        return $this->belongsTo(Appointment::class);
    }
    public function patient(){
        return $this->belongsTo(User::class);
    }
    public function reviews(){
        return $this->hasMany(Review::class);
    }
}
