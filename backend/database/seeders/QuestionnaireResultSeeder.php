<?php

namespace Database\Seeders;

use App\Models\Answer;
use App\Models\Question;
use App\Models\Questionnaire;
use App\Models\QuestionnaireResult;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class QuestionnaireResultSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = User::all();
        $questionnaire = Questionnaire::query()->first();
        $questionsId = $questionnaire->questions()->pluck('id')->toArray();


        foreach ($users as $user){
            $totalScore = Answer::query()->whereIn('question_id', $questionsId)
                ->where(['user_id' => $user->id])
                ->sum('point');

            $questionnaireResult = new QuestionnaireResult();

            $questionnaireResult->user_id = $user->id;
            $questionnaireResult->questionnaire_id = $questionnaire->id;
            $questionnaireResult->total_score = $totalScore;
            $questionnaireResult->is_verified = true;
            $questionnaireResult->save();
        }

    }
}
