<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Validator;
use Symfony\Component\HttpFoundation\Response;

class BaseController extends Controller
{
    /**
     * store data
     *
     * @param $validator
     * @param $model
     * @param $apiResponseHelper
     * @return JsonResponse
     */
    protected function storeModelData($validator, $model, $apiResponseHelper)
    {
        DB::beginTransaction();
        try {
            $input = ($validator instanceof Validator) ? $validator->validated() : $validator;
            $model = $model->create($input);
            DB::commit();
            $message = config('settings.message.saved');
            return $apiResponseHelper::returnSuccess($message, $model, Response::HTTP_CREATED);
        } catch (Exception $e) {
            DB::rollBack();
            return $apiResponseHelper::returnError("BAD_REQUEST", Response::HTTP_BAD_REQUEST, $e->getMessage(), config('settings.message.fatal_error'));
        }
    }

    /**
     * update data
     *
     * @param $validator
     * @param $model
     * @param $apiResponseHelper
     * @return JsonResponse
     */
    protected function updateModelData($validator, $model, $apiResponseHelper): JsonResponse
    {
        DB::beginTransaction();
        try {
            $input = ($validator instanceof Validator) ? $validator->validated() : $validator;
            $model->update($input);
            DB::commit();
            $message = config('settings.message.updated');
            return $apiResponseHelper::returnSuccess($message, $model, Response::HTTP_OK);
        } catch (Exception $e) {
            DB::rollBack();
            return $apiResponseHelper::returnError("BAD_REQUEST", Response::HTTP_BAD_REQUEST, null, config('settings.message.fatal_error'));
        }
    }

    /**
     * delete data
     *
     * @param $model
     * @param $apiResponseHelper
     * @return JsonResponse
     */
    protected function softDeleteModelData($model, $apiResponseHelper): JsonResponse
    {
        DB::beginTransaction();
        try {
            $model->delete();
            $model->save();

            DB::commit();
            return new JsonResponse("", Response::HTTP_NO_CONTENT);
        } catch (Exception $e) {
            DB::rollBack();
            return $apiResponseHelper::returnError("BAD_REQUEST", Response::HTTP_BAD_REQUEST, $e->getMessage(), config('settings.message.fatal_error'));
        }
    }
}
