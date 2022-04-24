<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;

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
            //
        });
    }

    /**
     * Report or log an exception.
     *
     * @param  \Throwable  $exception
     * @return void
     *
     * @throws \Exception
     */
    public function report(Throwable $exception)
    {
        parent::report($exception);
    }

     /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Throwable  $exception
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @throws \Throwable
     */
    public function render($request, Throwable $exception)
    {
        if ($exception instanceof \Illuminate\Validation\ValidationException) {

            $arrError = $exception->errors();

            $messages = [];

            foreach ($arrError as $key => $value) {
                
                \array_push($messages, $value[0]);

            }

            $message = $messages[0];

            $code = 4;

        } else {

            $message = $exception->getMessage();

            $code = (int) $exception->getCode();

        }
        
        $status = 409;

        $stacktrace = $exception->getTrace();

        $line = $exception->getLine();

        $file = $exception->getFile();

        $route = $request->path();

        $method = $request->method();

        switch ($code) {
            case 1:
            case 2:
            case 3:
            case 4:
                $status = 500;
                break;
            default:
                $status = 409;
        }

        if ($status == 500 && getEnv('APP_DEBUG') == 'false') { 

            $message = "Erro Interno no Servidor";

        }

        if (getEnv('APP_DEBUG') == 'false') {

            $debug = "Only available in development mode";

        } else {

            $debug = [
                "status_code" => $status,
                "route" => $route,
                "file" => $file,
                "line" => $line,
                "ip" => $request->ip(),
                "trace" => $stacktrace,
            ];

        }

        $error = [
            "error" => [
                "message" => strpos($message, 'SQLSTATE') === false ? $message : 'Erro Interno no Servidor',
                "code" => $code,
                "debug" => $debug
            ]
        ];

        // create a log channel
        $log = new Logger(getEnv('APP_CLIENT_NAME'));

        $logDate = new \DateTime();

        $logDate = $logDate->format('Y-m-d');

        $logfile = base_path() . '/logs/'.$logDate.'-'.getEnv('APP_CLIENT_NAME').'.log';

        $log->pushHandler(new StreamHandler($logfile, Logger::WARNING));

        $error_log = 
        '['.$status.']['.$_SERVER['REMOTE_ADDR'].']['.$method.']['.$route.']'
        ;

        $log->error($error_log,[$exception->getMessage()]);

        return response()->json($error, $status);

    }
}
