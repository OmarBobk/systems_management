<?php

namespace App\Http\Requests\Backend;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Response;
use Illuminate\Validation\ValidationException;

class ProductRequest extends FormRequest
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
                    'code'        => 'required',
                    'city'        => 'required',

                    'serial'      => 'required|integer',
                    'amount'      => 'required|integer',
                    'cost'        => 'required|integer',

                    'description'      => 'required|json',
                    'extra_attributes' => 'nullable|json',

                    'seller_id'    => 'required|integer',
                    'brand_id'    => 'required|integer',
                    'category_id' => 'required|integer',
                ];
            case "PUT":
            case "PATCH":
                return [
                    'name'        => 'required|sometimes',
                    'code'        => 'required|sometimes',
                    'city'        => 'required|sometimes',

                    'serial'      => 'required|sometimes|integer',
                    'amount'      => 'required|sometimes|integer',
                    'cost'        => 'required|sometimes|integer',

                    'description'      => 'required|sometimes|json',
                    'extra_attributes' => 'nullable|json',

                    'seller_id'    => 'required|sometimes|integer',
                    'brand_id'    => 'required|sometimes|integer',
                    'category_id' => 'required|sometimes|integer',
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
            'code.required'        => 'Code Can Not Be Empty.',
            'city.required'        => 'City Can Not Be Empty.',

            'serial.required'      => 'Serial Can Not Be Empty.',
            'serial.integer'       => 'Serial should be Numeric.',
            'amount.required'      => 'Amount Can Not Be Empty.',
            'amount.integer'       => 'Amount should be Numeric.',
            'cost.required'        => 'Cost Can Not Be Empty.',
            'cost.integer'         => 'Cost should be Numeric.',

            'description.required' => 'Description can not be empty',
            'description.json'     => 'Description need to be in json format.',
            'extra_attributes.json'     => 'extra_attributes need to be in json format.',

            'seller_id.required'   => 'Seller Can Not Be Empty.',
            'seller_id.integer'    => 'Seller should be Numeric.',
            'brand_id.required'    => 'Brand Can Not Be Empty.',
            'brand_id.integer'     => 'Brand should be Numeric.',
            'category_id.required' => 'Category Can Not Be Empty.',
            'category_id.integer'  => 'Category should be Numeric.',
        ];
    }

}
