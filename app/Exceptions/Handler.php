<?php

namespace App\Exceptions;

use App\Models\LogError;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;
use Illuminate\Auth\AuthenticationException;

use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array<int, class-string<Throwable>>
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
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
     *
     * @return void
     */
    public function register()
    {
        $this->reportable(function (Throwable $e) {
            $user = auth()->user();

            LogError::create([
                'user_id' => $user ? $user->id : 0,
                'message' => $e->getMessage(),
                'exception' => get_class($e),
                'line' => $e->getLine(),
                'trace' =>
                array_map(
                    function ($trace) {
                        unset($trace['args']);
                        return $trace;
                    },
                    $e->getTrace(),
                ),
                'method' => request()->getMethod(),
                'params' => request()->all(),
                'uri' => request()->getPathInfo(),
                'user_agent' => request()->userAgent(),
                'header' => request()->headers->all(),
            ]);
        });

        $this->renderable(function (\Exception $e, $request) {
            return $this->handleException($request, $e);
        });
    }

    protected function unauthenticated($request, AuthenticationException $exception)
    {
        return response('授權失敗');
    }

    # 增加錯誤處理
    private function handleException($request, \Exception $exception)
    {
        switch (true) {
            case $exception instanceof NotFoundHttpException:
                return response()->json([
                    'message' => 'Http not found.'
                ], 404);
            case $exception instanceof MethodNotAllowedHttpException:
                return response()->json([
                    'message' => 'Method not allowed.'
                ], 405);
            case $exception instanceof UnauthorizedHttpException:
                return response()->json([
                    'message' => 'Unauthorized.'
                ], 401);
        }

        return null;
    }
}
