<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    use HasFactory;

    protected $table = 'reservation';
    protected $fillable = ['user_id', 'room_id', 'reservation_code', 'check_in_date', 'check_out_date', 'number_of_days', 'total_amount'];
}
