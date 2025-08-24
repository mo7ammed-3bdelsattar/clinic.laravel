<?php

namespace App\Models;

use App\Models\Doctor;
use App\Models\Booking;
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
    public function time(){
        return \Carbon\Carbon::parse(\App\Enums\DaysEnum::from($this->date)->label())
            ->translatedFormat('l')." ".$this->start_at." - ".$this->end_at;
    }
}
