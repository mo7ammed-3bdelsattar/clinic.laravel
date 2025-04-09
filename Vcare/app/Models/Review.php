<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Review extends Model
{
    use HasFactory;
    protected $fillable=[
        'rating',
        'comment',
        'patient_id',
    ];
    public function patient(){
        return $this->belongsTo(Patient::class);
    }
    public function booking(){
        return $this->belongsTo(Booking::class);
    }
    

}
