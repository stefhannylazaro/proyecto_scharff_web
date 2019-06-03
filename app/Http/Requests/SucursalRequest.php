<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SucursalRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules =  [
            'pais' => 'required|in:PERÚ,BOLIVIA',
            'ciudad' => 'required',
            'latitud' => 'required',
            'longitud' => 'required'
        ];

        return $rules;
    }
}
