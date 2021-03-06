<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;
use App\Traits\ApiResponser;


use Illuminate\Database\Eloquent\ModelNotFoundException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Illuminate\Database\QueryException;

use Exception;
use Illuminate\Validation\ValidationException;
use Illuminate\Auth\AuthenticationException;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Illuminate\Http\Response;

class Handler extends ExceptionHandler
{
    use ApiResponser;
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
        if($exception instanceof ValidationException){
            $this->convertValidationExceptionToResponse($exception,$request);
        }
        if ($exception instanceof ModelNotFoundException){
            $modelo = strtolower(class_basename($exception->getModel()));
            return $this->errorResponse("No esiste una instancia de {$modelo} con el id especificado",404);
        }

        if ($exception instanceof NotFoundHttpException){
            return $this->errorResponse("No se encontro la url especificada",404);
        }

        if ($exception instanceof MethodNotAllowedHttpException){
            return $this->errorResponse("El metodo especificado en la peticion no es valido",405);
        }

        if($exception instanceof QueryException){
            $codigo = $exception->errorInfo[1];
            if($codigo == 1451){
                return $this->errorResponse("No se puede eliminar de forma permanente esta instancia porque se encuentra relacionado",409);
            }
        }

        if($exception instanceof HttpException){
            $code = $exception->getStatusCode();
            $message = $exception->getMessage();
            return $this->errorResponse($message, $code);
        }

        if(config('app.debug')){
            return parent::render($request, $exception);
        }
        return $this->errorResponse("Falla inesperada. Instente mas tarde",500);
    }

    /**
     * Create a response object from the given validation exception.
     *
     * @param  \Illuminate\Validation\ValidationException  $e
     * @param  \Illuminate\Http\Request  $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    protected function convertValidationExceptionToResponse(ValidationException $e, $request)
    {

        $errors = $e->validator->errors()->getMessages();
        return $this->errorResponse($errors, 422);
        
    }
}
