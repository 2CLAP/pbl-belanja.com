<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return True;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'name'=> 'required|max:255',
            'categories_id'=> 'required|exists:categories,id',
            'price'=> 'required|integer',
            'stock'=> 'required|integer',
            'description'=> 'required',
            'tags_id'=> 'nullable',
            'discount_price'=> 'nullable|integer',
        ];
    }
}
