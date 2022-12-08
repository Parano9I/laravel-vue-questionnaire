<?php

namespace App\Exceptions;

use Exception;

class AnswerByUserAndQuestionnaireIsExistException extends Exception
{
    public function render($request){
        return response()->json([
            'status' => 'error',
            'message' => "This answer is exist"
        ], 400);
    }
}
