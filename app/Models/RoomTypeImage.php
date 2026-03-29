<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoomTypeImage extends Model
{
    use HasFactory;

     protected $fillable = [
        'img_src',
        'img_alt',
        'room_type_id'
    ];

}

