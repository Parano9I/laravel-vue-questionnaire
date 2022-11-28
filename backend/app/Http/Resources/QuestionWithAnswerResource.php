<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class QuestionWithAnswerResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'question' => [
                'id' => $this->id,
                'title' => $this->question_body,
                'answers_avg_point' => $this->answers_avg_point,
            ],
            'answer' => new AnswerResource($this->answers[0])
        ];
    }
}
