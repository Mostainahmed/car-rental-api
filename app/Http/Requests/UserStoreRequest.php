<?php

namespace App\Http\Requests;

use Carbon\Carbon;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Symfony\Component\HttpFoundation\Response;

class UserStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    protected function failedValidation(Validator $validator)
    {
        $result['message'] = config('settings.message.validation_fail');
        $result['timestamp'] = Carbon::now();
        $result['details'] = $validator->errors();

        throw new HttpResponseException(response()->json($result, Response::HTTP_BAD_REQUEST));
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'email' => 'required_without:phone|email|max:255',
            'phone' => 'required_without:email|',
            'name' => 'required|max:255',
            'password' => [
                'required',
                'min:6',
                'confirmed'
            ]
        ];
    }

    public function messages()
    {
        return [

        ];
    }
}
