<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    use HasFactory;
    protected $fillable = [
        'room_number',
        'room_type_id',
        'is_avaliable'
    ];

    public function room_type(){
       return $this->belongsTo(RoomType::class);
    }
     public function review(){
       return $this->belongsTo(Review::class);
    }
}
