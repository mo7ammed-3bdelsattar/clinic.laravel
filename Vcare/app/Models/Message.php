<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Message extends Model
{
    use HasFactory;
    protected $fillable = [
        'sender',
        'receiver',
        'message',
        'is_read', // text, image, file, etc.
        'sent_at', // sent, delivered, read
    ];
    protected $casts = [
        'sent_at' => 'datetime',
        'is_read' => 'boolean',
    ];
    public function senderUser()
    {
        return $this->belongsTo(User::class, 'sender', 'id');
    }
    public function receiverUser()
    {
        return $this->belongsTo(User::class, 'receiver', 'id');
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
