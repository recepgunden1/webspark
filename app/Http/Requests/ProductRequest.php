<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

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
        return [
            'name'=>'required|string|min:1',
            'content'=>'required|',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'baslik alani doldurulmalidir',
            'name.string' => 'baslik alani karakterlerden olusmalidir',
            'name.min' => 'baslik alani en az 1 karakterden olusmalidir',

            'content.required' => 'icerik alani doldurulmalidir',
        ];
    }
}
