<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProductRequest extends FormRequest
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

        $id = $this->route('product');
        return [
            'name'=>[
                'required',
                // 'unique:products,name,except,{{$id}}',
                Rule::unique('products','name')->ignore($id),
                'max:255'
            ],
            'description'=>[
                'nullable',
                'string',
                'max:255',
            ],
            'image' =>[
                'nullable',
                'image',

            ],
            'price'=>[
                'required',
                'numeric',
                'min:1'
            ],
            'compare_price'=>[
                'required',
                'numeric',
                'min:1'
            ],
            'options'=>'nullable',
            'rating'=>[
                'min:0',

            ],
            'featured'=>[
                'boolean',

            ],
            'status'=>'in:active,draft,archived',
            'store_id'=>[
                'required',
                'exists:stores,id',
            ],
            'category_id'=>[
                'required',
                'exists:categories,id',
            ]

        ];
    }
}
