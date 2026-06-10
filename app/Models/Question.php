<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $fillable = [
        'sila',
        'sila_number',
        'question_text',
        'question_order',
    ];
}
