<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;

    protected $fillable = [
        'created_at',
        'updated_at',
        'publisher_id',
        'message',
        'date_time',
        'is_read',
        'user_id',
        'type',
    ];

    public function pubnotic(){
        return $this->belongsTo(Publisher::class,'publisher_id','id');
    }
    public function usernotification(){
        return $this->belongsTo(User::class,'user_id');
    }
}
