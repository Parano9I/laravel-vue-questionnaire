<?php

namespace App\Services;

use App\Contracts\IQuestionnaireService;
use App\Exceptions\NotFoundQuestionnaireException;
use App\Models\Questionnaire;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\Query\JoinClause;
use Illuminate\Support\Collection as SupportCollection;
use Illuminate\Support\Facades\DB;

class QuestionnaireService implements IQuestionnaireService
{
    public function getAll(): Collection
    {
        return Questionnaire::all();
    }

    public function getAllByUser(User $user): SupportCollection
    {
        $data = DB::table('questionnaires AS q')
            ->leftJoin(
                DB::raw(
                    '(
                            SELECT
                                q.is_verified,
                                q.total_score,
                                q.questionnaire_id
                            FROM questionnaires_result q
                            WHERE q.user_id = :userId
                          ) AS qr',
                ),
                function (JoinClause $join) {
                    $join->on('qr.questionnaire_id', '=', 'q.id');
                }
            )->setBindings([':userId' => $user->id])
            ->get();

        return $data;
    }

    public function create(array $data): void
    {
    }

    public function getById(int $id): Model
    {
        try {
            $questionnaire = Questionnaire::query()->findOrFail((int)$id);
            return $questionnaire;
        } catch (ModelNotFoundException $e) {
            throw new NotFoundQuestionnaireException($id);
        }
    }
}
