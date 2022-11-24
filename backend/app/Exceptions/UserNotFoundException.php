<?php

namespace App\Exceptions;

use Exception;

class UserNotFoundException extends Exception
{
    public function render()
    {
        return response()->json([
            'status' => 'error',
            'message' => 'Incorrect email or password'
        ], 401);
    }
}
