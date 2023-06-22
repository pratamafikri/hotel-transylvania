<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    use HasFactory;

    protected $table = 'room';
    protected $fillable = ['id', 'room_number', 'room_type', 'bed', 'price', 'status', 'maintenance_start', 'maintenance_end'];
}
