<?php

namespace App\Exceptions;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use phpDocumentor\Reflection\Types\Parent_;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     *
     * @return void
     */
    public function register()
    {
        $this->reportable(function (Throwable $e) {
            //
        });

        $this->renderable(function (Throwable  $e, $request) {

            $model_name = explode('\\', $e->getPrevious()->getModel());

            if ($request->is('api/*')) {
                if ( $e->getPrevious() instanceof ModelNotFoundException ) {
                    return response()->json([
                        'error' => 'Entry for ' . $model_name[array_key_last($model_name)].' Not Found!',
                    ], 404);
                }

            }
            return $this;
        });
    }
}
