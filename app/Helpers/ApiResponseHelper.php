<?php

namespace App\Helpers;

use Carbon\Carbon;
use Illuminate\Http\JsonResponse;

class ApiResponseHelper
{
    /**
     * Error Response
     *
     * @param null $key
     * @param int $responseCode
     * @param null $message
     * @param null $errors
     * @return JsonResponse
     */
    public static function returnError($key=null, int $responseCode=400, $message = null, $errors = null): JsonResponse
    {
        return new JsonResponse([
            'key'       => $key,
            'message'   => $message,
            'errors'    => $errors,
            'timestamp' => Carbon::now(),
        ], $responseCode);
    }

    /**
     * Success Response
     *
     * @param null $message
     * @param null $result
     * @param int $responseCode
     * @return JsonResponse
     */
    public static function returnSuccess($message = null, $result = null,$responseCode=200): JsonResponse
    {
        return new JsonResponse($result, $responseCode);
    }
}
