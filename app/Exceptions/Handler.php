<?php

namespace App\Exceptions;

use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\JsonResponse;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * The list of the inputs that are never flashed to the session on validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     */
    public function register(): void
    {
        $this->renderable(function (AuthorizationException $e) {
            return response()->json([
               "Status" => "error" ,
                'errors' => [
                    'generic' => 'Not authenticated'
                ]
            ],JsonResponse::HTTP_UNAUTHORIZED);
        });

        $this->renderable(function (Throwable $e) {
            return response()->json([
                "Status" => "error",
                'errors' => [
                    'generic' => 'Unknown Error, Please Try Again'
                ]
            ],JsonResponse::HTTP_BAD_REQUEST);
        });
    }
}
