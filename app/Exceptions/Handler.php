<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Validation\ValidationException; 
use Throwable;

class Handler extends ExceptionHandler
{
    // ... kode lainnya ...

    public function register(): void
    {
        $this->reportable(function (Throwable $e) {
            //
        });
        $this->renderable(function (ValidationException $e) {
            return response()->json([
                'status'  => 'error',
                'data'    => null,
                'message' => collect($e->errors())->flatten()->first(),
            ], 500);
        });
    }
}