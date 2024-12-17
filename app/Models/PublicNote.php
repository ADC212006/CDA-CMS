<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PublicNote extends Model
{
    use HasFactory;

    protected $table = 'public_notes';

    protected $fillable = [
        'date',
        'description',
        'image',
        'status',
    ];
}
