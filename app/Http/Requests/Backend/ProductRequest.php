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
        // Name, Code, Price, Serial, Description, Brand, Category
        return [
            'name'        => 'required',
            'code'        => 'required',
            'price'       => 'required|integer',
            'serial'      => 'required|integer',
            'description' => 'nullable',
            'brand_id'    => 'required|integer',
            'category_id' => 'required|integer',
        ];
    }

    public function failedValidation(Validator $validator) {
        throw new HttpResponseException(response()->json([
            'success'   => false,
            'message'   => 'Validation errors',
            'data'      => $validator->errors()
        ]));
    }

    public function messages()
    {
        return [
            'name.required'        => 'Name Can Not Be Empty.',
            'code.required'        => 'Code Can Not Be Empty.',
            'price.required'       => 'Price Can Not Be Empty.',
            'price.integer'        => 'Price should be Numeric.',
            'serial.required'      => 'Serial Can Not Be Empty.',
            'serial.integer'       => 'Serial should be Numeric.',
            'brand_id.required'    => 'Brand Can Not Be Empty.',
            'brand_id.integer'     => 'Brand should be Numeric.',
            'category_id.required' => 'Category Can Not Be Empty.',
            'category_id.integer'  => 'Category should be Numeric.',
        ];
    }

}
