<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class RpdRequest extends FormRequest
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
            'rab_id' => ['required', 'exists:rabs,id'],
            'price' => ['required'],
            'month' => ['required'],
            'year' => ['required'],
        ];
    }

    public function messages()
    {
        return [
            'rab_id.required' => 'Rab harus diisi',
            'price.required' => 'Harga harus diisi',
            'month.required' => 'Bulan harus diisi',
            'year.required' => 'Tahun harus diisi',
        ];
    }
}
