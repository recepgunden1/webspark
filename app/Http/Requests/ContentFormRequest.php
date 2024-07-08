<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContentFormRequest extends FormRequest
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
            'email'=>'required|email',
            'subject'=>'required|',
            'message'=>'required|',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'isim soyisim alani doldurulmalidir',
            'name.string' => 'isim soyisim alani karakterlerden olusmalidir',
            'name.min' => 'isim soyisim alani en az 1 karakterden olusmalidir',
            'email.required' => 'email alani doldurulmalidir',
            'email.email' => 'email alani gecerli olmalidir',
            'subject.required' => 'konu alani doldurulmalidir',
            'message.required' => 'mesaj alani doldurulmalidir',
        ];
    }
}
