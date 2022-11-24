<?php

namespace App\Services;

use App\Contracts\IAnswerService;
use App\Contracts\IQuestionService;
use App\Models\Answer;
use App\Models\Questionnaire;
use App\Models\User;

class AnswerService implements IAnswerService
{

    public function __construct(
        IQuestionService $questionService
    )
    {
    }

    public function createAll(Questionnaire $questionnaire, User $user, array $data): void
    {
        $questions = $questionnaire->questions();
        $answers = $data['answer'];

        foreach ($answers as $answerData){
            $question = $questions->findOrFail($answerData['questionId']);

            $answer = new Answer();
            $answer->answer_body = $answerData['answer'];
            $answer->question()->associate($question);
            $answer->user()->associate($user);
            $answer->save();
        }
    }
}
