<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Routing\Route;

class ServicioRequest extends FormRequest
{
    private $id;

    public function __construct(Route $route)
    {
        $this->id = (int)$route->parameter('id');
    }

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
            'imagen' => '',
            'titulo' => 'required',
            'orden'  => 'integer|min:0|max:99',
        ];

        if (!$this->id){
            $rules['imagen'] = 'required';
        }

        return $rules;
    }
}
