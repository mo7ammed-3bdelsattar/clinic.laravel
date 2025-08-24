<?php

namespace App\Models;

use App\Models\Doctor;
use App\Models\Review;
use App\Models\Patient;
use App\Models\Appointment;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Booking extends Model
{
    use HasFactory;
    protected $fillable=[
        'status',
        'appointment_id',
        'patient_id',
        'doctor_id',
    ];
    public function appointment(){
        return $this->belongsTo(Appointment::class);
    }
    public function patient(){
        return $this->belongsTo(Patient::class);
    }
    public function reviews(){
        return $this->hasMany(Review::class);
    }
    public function doctor(){
        return $this->belongsTo(Doctor::class);
    }
}
