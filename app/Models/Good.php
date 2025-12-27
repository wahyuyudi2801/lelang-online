<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Good extends Model
{
    use HasFactory;
    protected $fillable = [
        'category_id',
        'user_id',
        'good_name',
        'open_price',
        'closing_date',
        'url_good',
        'description',
    ];
}
