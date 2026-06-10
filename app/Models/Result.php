<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Result extends Model
{
    protected $fillable = [
        'total_score',
        'total_percentage',
        'sila1_score',
        'sila1_percentage',
        'sila1_category',
        'sila2_score',
        'sila2_percentage',
        'sila2_category',
        'sila3_score',
        'sila3_percentage',
        'sila3_category',
        'sila4_score',
        'sila4_percentage',
        'sila4_category',
        'sila5_score',
        'sila5_percentage',
        'sila5_category',
        'answers',
    ];

    protected $casts = [
        'answers' => 'array',
    ];
}
