<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Doctor extends Model
{
    use HasFactory;
    protected $fillable=[
        'name',
        'email',
        'phone',
        'adress',
        'image',
        'dates',
        'price',
        'admin_id',
        'major_id',
    ];
    public function major(){
        return $this->belongsTo(Major::class);
    }
    public function admin(){
        return $this->belongsTo(Admin::class);
    }
     public function reservations()
    {
        return $this->belongsToMany(Reservation::class, 'reservation_doctor');
    }
    
}
