<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Slider extends Model
{
    use HasFactory;

    // Table name if not the plural of the model name
    protected $table = 'slider';

    // Fillable fields for mass assignment
    protected $fillable = [
        'title',
        'description',
        'text',
        'image',
        'status',
        'url',
        'mobile_image',              // Add this line
        'is_same_as_laptop_view',    // Add this line
    ];

    // Casts for attributes
    protected $casts = [
        'is_same_as_laptop_view' => 'boolean',
    ];
}
