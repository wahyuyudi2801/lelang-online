<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Auction extends Model
{
    use HasFactory;

    protected $fillable = [
        'good_id',
        'user_id',
        'candidate',
        'bargain_price',
        'choose',
        'candidate_nomor',
    ];
}
