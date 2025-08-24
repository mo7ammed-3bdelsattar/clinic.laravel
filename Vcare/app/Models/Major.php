<?php

namespace App\Models;

use App\Models\Image;
use App\Models\Doctor;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Major extends Model
{
    use HasFactory;
    protected $fillable=[
        'title',
        'image',
        'description',
    ];
    public function doctors(){
        return $this->hasMany(Doctor::class);
    }
    public function image(){
        return $this->morphOne(Image::class,'imageable');
    }
}
