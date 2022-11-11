<?php

namespace App\Http\Requests\Backend;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class SellersRequest extends FormRequest
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

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        switch ($this->method()) {
            case "POST":
                return [
                    'name'        => 'required',
                    'phone'      => 'required',
                    'address'      => 'required',
                ];
            case "PUT":
            case "PATCH":
                return [
                    'name'        => 'required|sometimes',
                    'phone'      => 'required|sometimes',
                    'address'      => 'required|sometimes',
                ];
            default:
                break;
        }
    }

    public function failedValidation(Validator $validator) {
        throw new HttpResponseException(response()->json([
            'success'   => false,
            'message'   => 'Validation errors',
            'data'      => $validator->errors()
        ]));
    }

    /**
     * @return string[]
     */
    public function messages(): array
    {
        return [
            'name.required'        => 'Name Can Not Be Empty.',
            'phone.required' => 'Description can not be empty',
            'address.required' => 'Description can not be empty',
        ];
    }
}
