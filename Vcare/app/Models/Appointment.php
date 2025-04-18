<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Appointment extends Model
{
    use HasFactory;
    protected $fillable=[
        'date',
        'start_at',
        'end_at',
        'doctor_id',
    ];
    public function doctor(){
        return $this->belongsTo(Doctor::class);
    }
    public function bookings(){
        return $this->hasMany(Booking::class);
    }
    
}
