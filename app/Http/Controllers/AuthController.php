<?php

namespace App\Http\Controllers;

use App\Helpers\ApiResponseHelper;
use App\Http\Requests\UserStoreRequest;
use App\Models\User;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;
use Throwable;

class AuthController extends BaseController
{
    /**
     * @throws Throwable
     */
    public function register(Request $request, ApiResponseHelper $apiResponseHelper): JsonResponse
    {
        DB::beginTransaction();
        try {
            $validator = Validator::make($request->all(), [
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users',
                'password' => 'required|string|min:6',
            ]);
            if ($validator->fails())
            {
                return ApiResponseHelper::returnError("VALIDATION_ERROR",Response::HTTP_BAD_REQUEST,"The given data was invalid.",$validator->errors()->messages());
            }

            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);

            $token = $user->createToken('auth_token')->plainTextToken;
            $result['user_id'] = $user->id;
            $result['user_name'] = $user->name;
            $result['access_token'] = $token;
            $result['token_type'] = 'Bearer';

            DB::commit();

            return new JsonResponse($result, Response::HTTP_CREATED);
        } catch (Throwable $e) {
            DB::rollBack();
            throw $e;
        }
    }

    public function login(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|string|email|max:255',
            'password' => 'required|string|min:6',
        ]);
        if ($validator->fails()) {
            return ApiResponseHelper::returnError("VALIDATION_ERROR",Response::HTTP_BAD_REQUEST,"The given data was invalid.",$validator->errors()->messages());
        }

        try{
            $user = User::where('email', $request->email)->first();
            if ($user) {
                if (Hash::check($request->password, $user->password)) {
                    $token = $user->createToken('Laravel Password Grant Client')->plainTextToken;
                    $responseArray = [
                        'message'   => "Successfully Logged in",
                        "uuid"      => $user->id,
                        "type"      => "Bearer",
                        "token"     => $token,
                        'timestamp' => Carbon::now(),
                    ];
                    return new JsonResponse($responseArray, Response::HTTP_OK);
                } else {
                    return ApiResponseHelper::returnError("BAD_REQUEST",422,null,"Password mismatch");
                }
            } else {
                return ApiResponseHelper::returnError("BAD_REQUEST",422,null,"User does not exist");

            }

        }
        catch(Exception $e){
            return ApiResponseHelper::returnError("BAD_REQUEST",Response::HTTP_BAD_REQUEST,null,config('settings.message.fatal_error'));
        }
    }
}
