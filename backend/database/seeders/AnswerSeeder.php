<?php

namespace Database\Seeders;

use App\Models\Answer;
use App\Models\Questionnaire;
use App\Models\User;
use Illuminate\Database\Seeder;

class AnswerSeeder extends Seeder
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
        $questions = $questionnaire->questions()->getModels();

        foreach ($users as $user) {
            foreach ($questions as $question) {
                Answer::factory()->create([
                    'user_id' => $user->id,
                    'question_id' => $question->id
                ]);
            }
        }
    }
}
