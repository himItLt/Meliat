<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpFoundation\Response;

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
     * @param \Exception $exception
     * @return void
     * @throws \Throwable
     */
    public function report(Exception|\Throwable $exception): void
    {
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Exception $exception
     * @return Response
     * @throws \Throwable
     */
    public function render($request, Exception|\Throwable $exception): Response
    {
        if ($this->isHttpException($exception)) {
            return match ($exception->getStatusCode()) {
                404 => redirect()->route('404'),
                default => $this->renderHttpException($exception),
            };
        } else {
            return parent::render($request, $exception);
        }
    }
}
