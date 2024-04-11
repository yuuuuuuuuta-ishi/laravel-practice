<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'clock_in',
        'clock_out',
        'work_details',
        'work_date',
    ];

    protected $dates = [
        'clock_in',
        'clock_out',
        'work_date',
    ];
}
