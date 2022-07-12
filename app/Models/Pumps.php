<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pumps extends Model
{
    use HasFactory;
    protected $fillable = [
        'brand',
        'size',
        'body',
        'elastomer',
        'atex',
        'end_connections',
        'joints'
    ];
}
