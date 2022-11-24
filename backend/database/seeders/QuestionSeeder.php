<?php

namespace Database\Seeders;

use App\Models\Question;
use App\Models\Questionnaire;
use Illuminate\Database\Seeder;

class QuestionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $questionnaire = Questionnaire::where(['title' => 'Geography'])->first();

        Question::create([
            'question_body' => 'What is the name of the tallest mountain in the world?',
            'questionnaire_id' => $questionnaire->id,
        ]);
        Question::create([
            'question_body' => 'Which country has the largest population in the world?',
            'questionnaire_id' => $questionnaire->id,
        ]);
        Question::create([
            'question_body' => 'What are the names of the seven continents of the world?',
            'questionnaire_id' => $questionnaire->id,
        ]);
        Question::create([
            'question_body' => 'What are the names of the five oceans of the world?',
            'questionnaire_id' => $questionnaire->id,
        ]);
        Question::create([
            'question_body' => 'What is the name of the longest river in Africa??',
            'questionnaire_id' => $questionnaire->id,
        ]);
        Question::create([
            'question_body' => 'What American city is the Golden Gate Bridge located in?',
            'questionnaire_id' => $questionnaire->id,
        ]);
        Question::create([
            'question_body' => 'What is the name of the largest country in the world?',
            'questionnaire_id' => $questionnaire->id,
        ]);
        Question::create([
            'question_body' => 'What U.S. state is home to no documented poisonous snakes?',
            'questionnaire_id' => $questionnaire->id,
        ]);
        Question::create([
            'question_body' => 'Where is the Eiffel Tower located?',
            'questionnaire_id' => $questionnaire->id,
        ]);
        Question::create([
            'question_body' => 'What is the capital of Canada?',
            'questionnaire_id' => $questionnaire->id,
        ]);
    }
}
