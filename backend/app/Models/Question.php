<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;

    protected $fillable = [
        'question_body',
    ];

    public function answers()
    {
        return $this->hasMany(Answer::class);
    }

    public function answersAvg(){
        return $this->hasMany(Answer::class)->avg('point');
    }

    public function questionnaire()
    {
        return $this->belongsTo(Questionnaire::class)->first();
    }
}
