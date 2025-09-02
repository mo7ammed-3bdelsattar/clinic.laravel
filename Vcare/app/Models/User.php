<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Models\Admin;
use App\Models\Image;
use App\Models\Doctor;
use App\Models\Message;
use App\Models\Patient;
use App\Enums\UserTypesEnum;
use App\Enums\UserGendersEnum;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable,HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'phone',
        'type',
        'gender',
        'password',
        'provider',
        'provider_id'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'type' => UserTypesEnum::class,
        'gender' => UserGendersEnum::class,
    ];
    
    public function admin()
    {
        return $this->hasOne(Admin::class);
    }
    public function patient()
    {
        return $this->hasOne(Patient::class);
    }
    public function doctor()
    {
        return $this->hasOne(Doctor::class);
    }
    public function image()
    {
        return $this->morphOne(Image::class, 'imageable');
    }
    public function messages()
    {
        return $this->hasMany(Message::class, 'sender');
    }
    
}
