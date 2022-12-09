<?php

namespace App\Services;

use App\Contracts\IQuestionnaireService;
use App\Exceptions\NotFoundQuestionnaireException;
use App\Models\Questionnaire;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Collection as SupportCollection;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\Query\JoinClause;
use Illuminate\Support\Facades\DB;

class QuestionnaireService implements IQuestionnaireService
{
    public function getAll(): Collection
    {
        return Questionnaire::all();
    }

    public function getAllByUser($userId): SupportCollection
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
                ), function (JoinClause $join) {
                $join->on('qr.questionnaire_id', '=', 'q.id');
            })->setBindings([':userId' => $userId])
            ->get();

        return $data;
    }

    public function create(array $data): void
    {
    }

    public function getById(int $id): Questionnaire
    {
        try {
            return Questionnaire::query()->findOrFail($id)->first();
        } catch (ModelNotFoundException $e) {
            throw new NotFoundQuestionnaireException($id);
        }
    }
}
