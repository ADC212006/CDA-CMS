<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FormApplicationEntry extends Model
{
    use HasFactory;

    protected $fillable = ['category_id', 'title', 'file','status'];

    public function category()
    {
        return $this->belongsTo(FormApplicationCategory::class);
    }
}
