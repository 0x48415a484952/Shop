<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Illuminate\Http\Response;
//use Illuminate\Support\Facades\Response;

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
        'password',
        'password_confirmation',
    ];

    /**
     * Report or log an exception.
     *
     * @param  \Exception  $exception
     * @return void
     */
    public function report(Exception $exception)
    {
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Exception  $exception
     * @return \Illuminate\Http\Response
     */
    public function render($request, Exception $exception)
    {
        // dd($exception);
        if ($request->expectsJson()) {
            if ($exception instanceof NotFoundHttpException) {
                return response()->json(['status' => 'fail', 'message' => 'route is incorect'], Response::HTTP_NOT_FOUND);
            }
        }
        
        return parent::render($request, $exception);
    }

    // public function render($request, Exception $exception)
    // {
    //     $isRouteApi = strpos($request->path(), 'api/');
    //     if (true == is_numeric($isRouteApi)) {
    //         return $this->getJsonResponseForException($request, $exception);
    //     }
    //     return parent::render($request, $exception);
    // }

}
