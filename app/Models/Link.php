<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Link extends Model
{
    use HasFactory;
  

    // Table name if not the plural of the model name
    protected $table = 'links';

    // Fillable fields for mass assignment
    protected $fillable = [
        'title',
        'image',
        'status',
        'url',
    ];
}
