<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class Rab_RequestRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'price' => ['required'],
            'description' => ['required'],
            'unit' => ['required'],
        ];
    }

    public function messages()
    {
        return [
            'price.required' => 'Harga harus diisi',
            'description.required' => 'Deskripsi harus diisi',
            'unit.required' => 'Satuan harus diisi',
        ];
    }
}
