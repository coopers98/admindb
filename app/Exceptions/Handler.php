<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;
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
        'password',
        'password_confirmation',
    ];

    /**
     * Report or log an exception.
     *
     * @param \Throwable $exception
     * @return void
     *
     * @throws \Throwable
     */
    public function report(Throwable $exception)
    {
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Throwable               $exception
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @throws \Throwable
     */
    public function render($request, Throwable $exception)
    {
        if ($request->wantsJson() || $request->ajax()) {

            $httpCode = Response::HTTP_INTERNAL_SERVER_ERROR;
            $message  = $exception->getMessage();
            $headers  = [];

            switch (get_class($exception)) {
                case \Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException::class:
                    $message = 'That request method is not allowed.';
                case \Symfony\Component\HttpKernel\Exception\BadRequestHttpException::class:
                case \Symfony\Component\HttpKernel\Exception\ConflictHttpException::class:
                case \Symfony\Component\HttpKernel\Exception\NotFoundHttpException::class:
                case \Symfony\Component\HttpKernel\Exception\UnprocessableEntityHttpException::class:
                case \Symfony\Component\HttpKernel\Exception\GoneHttpException::class:
                case \GuzzleHttp\Exception\ClientException::class:
                    $response = $exception->getResponse();
                    $httpCode = $response->getStatusCode();
                    $code     = $response->getReasonPhrase();
                    $message  = $exception->getMessage();
                    break;
                case \Illuminate\Validation\ValidationException::class:
                    $httpCode = \Illuminate\Http\Response::HTTP_UNPROCESSABLE_ENTITY;
                    $message  = $exception->validator->errors()->getMessages();
                    break;
                case \Illuminate\Database\Eloquent\ModelNotFoundException::class:
                    $httpCode = \Illuminate\Http\Response::HTTP_NOT_FOUND;
                    $message  = 'The requested resource is not found';
                    break;
                case \Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException::class:
                case \Symfony\Component\HttpKernel\Exception\TooManyRequestsHttpException::class:
                case \Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException::class:
                case \Symfony\Component\HttpKernel\Exception\PreconditionFailedHttpException::class:
                    $code     = 'Bad Request';
                    $httpCode = Response::HTTP_BAD_REQUEST;
                    $message  = $exception->validator->errors()->getMessages();
                    break;
                default:
                    break;
            }
            $code = \Illuminate\Http\Response::$statusTexts[$httpCode];

            $error_api_response = [
                'error' => [
                    'code'      => $code,
                    'http_code' => $httpCode,
                    'message'   => $message
                ]
            ];

            Log::error('API EXCEPTION THROWN', ['errors' => $error_api_response]);
            if (config('app.debug')) {
                $error_api_response['error']['stack'] = $exception->getTrace();
            }

            return response()
                ->json($error_api_response, $httpCode)
                ->withHeaders($headers);
        }

        return parent::render($request, $exception);
    }
}
