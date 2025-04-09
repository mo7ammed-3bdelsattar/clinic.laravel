<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Transactions extends Model
{
    use HasFactory;
    protected $fillable=[
        'amount_paid',
        'payment_method',
        'booking_id',
        'patient_id',
    ];
    public function booking(){
        return $this->belongsTo(Booking::class);
    }
    public function patient(){
        return $this->belongsTo(User::class);
    }
    
    
}
