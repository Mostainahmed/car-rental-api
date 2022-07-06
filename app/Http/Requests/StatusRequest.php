<?php

namespace App\Http\Requests;

use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;
use Symfony\Component\HttpFoundation\Response;


class StatusRequest extends FormRequest
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
            'travel_status' => 'required|in:ONGOING,BOOKED,FINISHED,PARKED',
        ];
    }

    public function messages()
    {
        return [

        ];
    }
}
