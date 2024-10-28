<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Reservation extends Model
{
    use HasFactory;
    protected $fillable=[
        'status',
        'price',
        'date',
    ];
    
    public function doctors()
    {
        return $this->belongsToMany(Doctor::class, 'booking_doctor');
    }
}
