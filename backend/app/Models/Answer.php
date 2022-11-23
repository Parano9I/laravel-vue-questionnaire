<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    use HasFactory;

    protected $fillable = [
        'answer_body',
        'point'
    ];

    public function question(){
        return $this->belongsTo(Question::class)->first();
    }

    public function user(){
        return $this->belongsTo(User::class)->first();
    }
}