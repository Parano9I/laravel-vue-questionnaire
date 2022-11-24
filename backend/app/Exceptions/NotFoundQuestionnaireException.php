<?php

namespace App\Exceptions;

use Exception;

class NotFoundQuestionnaireException extends Exception
{
    public function render($request){
        return response()->json([
            'status' => 'error',
            'message' => "Questionnaire with {$this->getMessage()} id, not found."
        ], 404);
    }
}
