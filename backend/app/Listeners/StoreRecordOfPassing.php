<?php

namespace App\Listeners;

use App\Events\TakingTest;
use App\Models\QuestionnaireResult;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;

class StoreRecordOfPassing
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {

    }

    /**
     * Handle the event.
     *
     * @param  \App\Events\TakingTest  $event
     * @return void
     */
    public function handle(TakingTest $event)
    {
        try {
            $user = $event->user;
            $questionnaire = $event->questionnaire;

            $record = new QuestionnaireResult();

            $record->questionnaire_id = $questionnaire->id;
            $record->user_id = $user->id;
            $record->total_score = 0.00;
            $record->is_verified = false;
            $record->save();
        } catch (\Error $error){
            Log::error($error);
        }

    }
}
