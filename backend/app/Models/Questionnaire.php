<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Questionnaire extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
    ];

    public function questions()
    {
        return $this->hasMany(Question::class);
    }

    public function results()
    {
        return $this->hasMany(QuestionnaireResult::class);
    }
}
