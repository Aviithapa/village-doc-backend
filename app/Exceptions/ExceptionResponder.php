<?php


namespace App\Exceptions;

use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\UnauthorizedException;
use Illuminate\Validation\ValidationException;
use InvalidArgumentException;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;
use Symfony\Component\Translation\Exception\NotFoundResourceException;
use Throwable;

/**
 * Trait ExceptionResponder
 * @package App\Exceptions
 */
trait ExceptionResponder
{

    /**
     * Respond exception with json format
     *
     * @param Request $request
     * @param Throwable $exception
     * @return JsonResponse
     */
    public function respondWithJson(Request $request, Throwable $exception): JsonResponse
    {
        return $this->resolveHttpExceptionResponse($request, $exception);
    }

    /**
     * Format Response based on Exception
     *
     * @param Request $request
     * @param Throwable $exception
     * @return JsonResponse
     */
    private function resolveHttpExceptionResponse(Request $request, Throwable $exception): JsonResponse
    {
        if ($exception instanceof BadRequestHttpException) {
            return new JsonResponse([
                "success" => false,
                "message" => $exception->getMessage(),
            ], ResponseAlias::HTTP_BAD_REQUEST);
        }

        if ($exception instanceof InvalidArgumentException) {
            return new JsonResponse([
                "success" => false,
                "message" => "Invalid argument supplied",
            ], ResponseAlias::HTTP_BAD_REQUEST);
        }

        if ($exception instanceof AuthenticationException) {
            return new JsonResponse([
                "success" => false,
                "message" => $exception->getMessage()
            ], ResponseAlias::HTTP_UNAUTHORIZED);
        }

        if ($exception instanceof UnauthorizedHttpException) {
            return new JsonResponse([
                "success" => false,
                "message" => $exception->getMessage()
            ], ResponseAlias::HTTP_FORBIDDEN);
        }

        if ($exception instanceof NotFoundHttpException) {
            return new JsonResponse([
                "success" => false,
                "message" => "404 not found.",
            ], ResponseAlias::HTTP_NOT_FOUND);
        }

        if ($exception instanceof ModelNotFoundException) {
            return new JsonResponse([
                "success" => false,
                "message" => 'Record not found.',
            ], ResponseAlias::HTTP_NOT_FOUND);
        }

        if ($exception instanceof MethodNotAllowedHttpException) {
            return new JsonResponse([
                "success" => false,
                "message" => 'Method Not allowed',
            ], ResponseAlias::HTTP_METHOD_NOT_ALLOWED);
        }

        if ($exception instanceof ValidationException) {
            return new JsonResponse([
                "success" => false,
                "message" => $exception->getMessage(),
                "errors"  => $exception->errors(),
            ], ResponseAlias::HTTP_UNPROCESSABLE_ENTITY);
        }

        if ($exception instanceof NotFoundResourceException) {
            return new JsonResponse([
                "success" => false,
                "message" => $exception->getMessage(),
            ], ResponseAlias::HTTP_NOT_FOUND);
        }

        if (
            $exception instanceof AuthorizationException
            ||
            $exception instanceof UnauthorizedException
        ) {
            return new JsonResponse([
                "success" => false,
                "message" => $exception->getMessage(),
            ], ResponseAlias::HTTP_FORBIDDEN);
        }


        if (!App::environment('local')) {

            Log::critical($exception->getMessage(), $exception->getTrace());

            return new JsonResponse([
                "success" => false,
                "message" => "Something went wrong.",
            ], ResponseAlias::HTTP_INTERNAL_SERVER_ERROR);
        }

        return new JsonResponse([
            "success" => false,
            "message" => $exception->getMessage(),
            "traces"  => $exception->getTrace()
        ], ResponseAlias::HTTP_INTERNAL_SERVER_ERROR);
    }
}
