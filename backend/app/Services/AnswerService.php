<?php

namespace App\Services;

use App\Contracts\IAnswerService;
use App\Contracts\IQuestionService;
use App\Exceptions\AnswerByUserAndQuestionnaireIsExistException;
use App\Models\Answer;
use App\Models\Questionnaire;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;

class AnswerService implements IAnswerService
{

    public function __construct(
        IQuestionService $questionService
    ) {
    }

    public function createAll(Questionnaire $questionnaire, User $user, array $data): void
    {
        try {
            $questions = $questionnaire->questions()->get('id');
            $answers = $data['answers'];


            foreach ($answers as $answerData) {
                $question = $questions->filter(
                    fn($questId) => $questId->id === $answerData['questionId']
                )->firstOrFail();

                $answer = new Answer();
                $answer->answer_body = $answerData['answer'];
                $answer->question()->associate($question);
                $answer->user()->associate($user);
                $answer->save();
            }
        } catch (\Exception $exception) {
            switch ($exception->getCode()) {
                case 23000:
                    throw new AnswerByUserAndQuestionnaireIsExistException();
                    break;
            }
        }
    }

    public function getResult(Questionnaire $questionnaire, User $user): Collection
    {
        $data = $questionnaire->questions()
            ->withAvg('answers', 'point')
            ->withWhereHas(
                'answers',
                fn($query) => $query->where('user_id', $user->id)
            )->get();

        return $data;
    }
}
