<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BoardMeeting extends Model
{
    use HasFactory;

    protected $table = 'board_meetings';

    protected $fillable = [
        'date',
        'description',
        'image',
        'status',
    ];
}
