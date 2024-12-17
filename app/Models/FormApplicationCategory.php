<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FormApplicationCategory extends Model
{
    use HasFactory;

    protected $table = 'form_application_categories';

    protected $fillable = [
        'category',
    ];
    
}
