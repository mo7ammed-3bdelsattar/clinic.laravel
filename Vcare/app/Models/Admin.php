<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Admin extends Authenticatable
{
    use HasFactory;
    protected $fillable = [
        'user_id',   
    ];
    

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
}
