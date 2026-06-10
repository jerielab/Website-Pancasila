<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Survey extends Model
{
    protected $fillable = ['question', 'is_active'];

    public function options()
    {
        return $this->hasMany(SurveyOption::class);
    }
}
