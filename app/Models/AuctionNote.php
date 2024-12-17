<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AuctionNote extends Model
{
    use HasFactory;

    protected $table = 'auction_notes';

    protected $fillable = [
        'date',
        'description',
        'image',
        'status',
    ];
}
