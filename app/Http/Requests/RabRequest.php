<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class RabRequest extends FormRequest
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
            'component_id'   => ['required', 'exists:components,id'],
            'type_id'   => ['required', 'exists:types,id'],
            'description' => ['required', 'max:255'],
            'volume' => ['required', 'integer'],
            'frequency' => ['required', 'integer'],
            'price' => ['required', 'integer'],
        ];
    }

    public function messages()
    {
        return [
            'component_id.required' => 'Component harus diisi',
            'type_id.required' => 'Type harus diisi',
            'description.required' => 'Deskripsi harus diisi',
            'volume.required' => 'Volume harus diisi',
            'frequency.required' => 'Frekuensi harus diisi',
            'price.required' => 'Harga harus diisi',
        ];
    }
}
