<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
    use HasFactory;
    protected $fillable=[
        'name',
        'email',
        'phone',
        'adress',
        'visitors',
        'dates',
        'user_id',
    ];
    public function major(){
        return $this->belongsTo(Major::class);
    }
    public function user(){
        return $this->belongsTo(User::class);
    }
    
}
