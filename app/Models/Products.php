<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    use HasFactory;

    protected $fillable = [


        'category_id',
        'name',
        'description',
        'image',
        'price',
        'view_count',
        'waiting_time'

    ];
}
