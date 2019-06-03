<?php

namespace App\Http\Requests;

use App\Models\Ubigeo;
use Illuminate\Foundation\Http\FormRequest;

class ClaimbookRequest extends FormRequest
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
        $departamentos =  Ubigeo::select('departamento')->distinct()->pluck('departamento')->toArray();
        $departamento_list = 'in:'.implode(',', $departamentos);
        $provincia_list = '';
        $distrito_list = '';
        if ($this->request->all()['departamento']) {
            $provincias = Ubigeo::where('departamento', $this->request->all()['departamento'])->select('provincia')->distinct()->pluck('provincia')->toArray();;
            $provincia_list = '|in:'.implode(',', $provincias);
        }

        if ($this->request->all()['provincia']) {
            $distritos = Ubigeo::where('provincia', $this->request->all()['provincia'])->select('distrito')->distinct()->pluck('distrito')->toArray();;
            $distrito_list = '|in:'.implode(',', $distritos);
        }

        return [
            'nombre' => 'required',
            'departamento'=>  'required|'.$departamento_list,
            'provincia'	=> 	'required|'.$provincia_list,
            'distrito'	=>	'required'.$distrito_list,
            'direccion' =>  'required',
            'documento' =>  'required',
            'telefono'  =>  'required',
            'correo'    =>  'required|email',
            'descripcion_menor_edad' => '',
            'bien_contratado' => 'required|in:Producto,Servicio',
            'monto_reclamado' => 'required|numeric',
            'descripcion_bien_contratado',
            'tipo_reclamo' => 'required|in:Reclamo,Queja',
            'detalle_reclamo' => '',
            'pedido_reclamo' => '',
            'observacion' => ''
        ];
    }
}
