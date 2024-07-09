<?php

namespace App\Http\Requests\Product;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'string',
            'description' => 'string',
            'cover' => 'string',
            'brand_id' => 'integer',
            'sku' => 'string',
            'barcode' => 'string|nullable',
            'sale_price' => 'decimal:0,2',

            'chars' => 'array',
            'chars.*.char_id' => 'integer',
            'chars.*.value' => 'string',

            'params' => 'array',
            'params.*.param_id' => 'integer',
            'params.*.value' => 'string',

            'images' => 'array',
            'images.*.img' => 'string',
            'images.*.sort_order' => 'integer',

            'categories' => 'array',
            'categories.*.category_id' => 'integer',

            'title' => 'string',
            'description_short' => 'string'
        ];
    }
}
