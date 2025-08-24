<?php

namespace App\Models;

use App\Models\User;
use App\Models\Major;
use App\Models\Review;
use App\Models\Booking;
use App\Models\Appointment;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Doctor extends Model
{
    use HasFactory;
    protected $fillable=[
        'address',
        'price',
        'major_id',
        'user_id',
    ];
    public function major(){
        return $this->belongsTo(Major::class);
    }
    public function user(){
        return $this->belongsTo(User::class);
    }
    public function appointments(){
        return $this->hasMany(Appointment::class);
    }
    public function reviews(){
        return $this->hasMany(Review::class);
    }
    public function bookings(){
        return $this->hasMany(Booking::class);
    }
    
    
}
