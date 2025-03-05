<?php

namespace App\Http\Exceptions;

use Exception;
use Illuminate\Http\Request;

class ResourceNotFoundException extends Exception
{
    public function __construct($message = 'Resource not found', $code = 404)
    {
        parent::__construct($message, $code);
    }

    public function render(Request $request)
    {
        if ($request->isJson()) {
            return response()->json(['status' => 'error', 'message' => $this->getMessage()], $this->getCode());
        }
    }
}