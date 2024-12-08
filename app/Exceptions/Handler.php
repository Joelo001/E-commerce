<?php

namespace App\Exceptions;

use App\Http\Resources\ErrorResource;
use Illuminate\Validation\ValidationException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Support\Facades\Log;
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
        $this->reportable(function (Throwable $e) {
            //
        });
    }
    public function render($request, Throwable $e)
    {
        // Gestion des erreurs de validation
        if ($e instanceof ValidationException) {
            return (new ErrorResource((object) [
                'status' => false,
                'message' => 'Erreur de validation des champs!',
                'errors' => $e->errors(),
                'code' => 422,
            ]))->response()->setStatusCode(422);
        }
    
        // Gestion des autres exceptions
        return (new ErrorResource((object) [
            'status' => false,
            'message' => 'Something is wrong!',
            'errors' => config('app.debug') ? $e->getMessage() : 'Une erreur inattendue est survenue.',
            'code' => $e->getCode() > 0 ? $e->getCode() : 500,
        ]))->response()->setStatusCode(500);
    }
    public function report(Throwable $e){
        if ($this->shouldReport($e)) {
            Log::error($e->getMessage());
        }
    
        parent::report($e);
    }
}
