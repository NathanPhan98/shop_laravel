<?php

namespace App\Http\Requests\Product;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request. OK OK bạn
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required',
            'thumbnail' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Vui long nhap ten san pham',
            'thumbnail.required' => 'file khong duoc bo trong'
        ];
    }
}
