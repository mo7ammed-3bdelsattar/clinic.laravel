<?php

namespace App\Models;

use App\Models\User;
use App\Models\Review;
use App\Models\Booking;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Patient extends Model
{
    use HasFactory , HasRoles;
    protected $fillable=[
        'user_id',
    ];
    public function user(){
        return $this->belongsTo(User::class);
    }
    public function bookings(){
        return $this->hasMany(Booking::class);
    }
    public function reviews(){
        return $this->hasMany(Review::class);
    }
    
}
