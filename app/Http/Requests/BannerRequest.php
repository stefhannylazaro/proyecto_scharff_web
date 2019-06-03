<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Routing\Route;
use Illuminate\Validation\Rule;

class BannerRequest extends FormRequest
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
            'imagen' => 'image|mimes:jpg,png,jpeg|max:2000',
            'titulo' => 'required',
            'subtitulo' => 'required',
            //'url'   => '',
            // 'slug' => ['required',
            //             Rule::in('home',
            //                 'distribucion_nacional',
            //                 'aduanas',
            //                 'carga',
            //                 'almacenes',
            //                 'envios_internacionales',
            //                 'scharff_express',
            //                 'scharff_stop',
            //                 'cotizador',
            //                 'scharff_lab')
            // ]
        ];

        if (!$this->id){
            $rules['imagen'] = 'required|image|mimes:jpg,png,jpeg|max:2000';
        }

        return $rules;
    }
}
