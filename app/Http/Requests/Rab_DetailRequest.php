<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class Rab_DetailRequest extends FormRequest
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
            'rab_id'   => ['required', 'exists:rabs,id'],
            'sub_component_id'   => ['required', 'exists:sub_components,id'],
            'program_id'   => ['required', 'exists:programs,id'],
            'type_id'   => ['required', 'exists:types,id'],
            'description' => ['required'],
            'volume' => ['required'],
            'unit' => ['required'],
            'price' => ['required'],
        ];
    }

    public function messages()
    {
        return [
            'rab_id.required' => 'RAB harus diisi',
            'sub_component_id.required' => 'Sub Komponen harus diisi',
            'program_id.required' => 'Program harus diisi',
            'type_id.required' => 'Tipe harus diisi',
            'description.required' => 'Deskripsi harus diisi',
            'volume.required' => 'Volume harus diisi',
            'unit.required' => 'Satuan harus diisi',
            'price.required' => 'Harga harus diisi',
        ];
    }
}
