<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Staff extends Model
{
    use HasFactory;
     protected $fillable = [
        'name',
        'email',
        'password',
        'phone',
        'address',
        'role',
        'departmetn_id'

    ];

     public function department()
    {
        return $this->belongsTo(Department::class);
    }

}
