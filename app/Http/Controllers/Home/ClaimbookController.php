<?php

namespace App\Http\Controllers\Home;

use App\Http\Requests\ClaimbookRequest;
use App\Library\Funciones;
use App\Models\Claimbook;
use App\Models\Ubigeo;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Laracasts\Flash\Flash;

class ClaimbookController extends Controller
{
    public function index()
    {
        $departments[""] = "Departamento";
        $departments += \DB::table('ubigeos')->select('departamento')->distinct()->pluck('departamento','departamento')->toArray();//->lists('departamento','departamento');
        $provinces[""] = "Provincia";
        $districts[""] = "Distrito";
        $location_list = Ubigeo::all();
        $department = "";
        $province = "";
        $district = "";

        $claimbook = Claimbook::where('session_id', session()->getId())->where('estado_reclamo', false)->first();

        if (!$claimbook){
            $numero_reclamo = Funciones::generar_numero_reclamo();
            Claimbook::create([
                'numero_reclamo' => $numero_reclamo,
                'session_id' => session()->getId()
            ]);
        }else{
            $numero_reclamo = $claimbook->numero_reclamo;
            $claimbook->updated_at = now();
            $claimbook->save();
        }

        return view('home.claimbook', compact('departments', 'provinces', 'districts', 'location_list','department','province', 'district', 'numero_reclamo'));
    }

    public function save(Request $request)
    {
        $data = $request->all();

        $claimbook = Claimbook::where('session_id', session()->getId())->where('estado_reclamo', false)->first();

        if (!$claimbook){
            return redirect('/');
        }else{
            $numero_reclamo = $claimbook->numero_reclamo;
        }


        $departamentos =  \DB::table('ubigeos')->select('departamento')->distinct()->pluck('departamento','departamento')->toArray();
        $departamento_list = 'in:'.implode(',', $departamentos);
        $provincia_list = '';
        $distrito_list = '';
        if ($data['departamento']) {
            $provincias = Ubigeo::where('departamento', $data['departamento'])->select('provincia')->distinct()->pluck('provincia')->toArray();;
            $provincia_list = '|in:'.implode(',', $provincias);
        }

        if ($data['provincia']) {
            $distritos = Ubigeo::where('provincia', $data['provincia'])->select('distrito')->distinct()->pluck('distrito')->toArray();;
            $distrito_list = '|in:'.implode(',', $distritos);
        }

        $validator = Validator::make($request->all(),
            [
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
            ]

            );

        $departments[""] = "Departamento";
        $departments += Ubigeo::select('departamento')->distinct()->pluck('departamento','departamento')->toArray();
        $location_list = Ubigeo::all();
        $provinces[""] = "Provincia";
        $department = $data['departamento'];
        $province = $data['provincia'];
        $district = $data['distrito'];

        if ($data['departamento'] != ""){
            $provinces += Ubigeo::where('departamento',$data['departamento'])->select('provincia')->distinct()->pluck('provincia','provincia')->toArray();
        }
        $districts[""] = "Distrito";
        if ($data['provincia'] != ""){
            $districts += Ubigeo::where('provincia',$data['provincia'])->select('distrito')->distinct()->pluck('distrito','distrito')->toArray();
        }


        if ($validator->fails()) {
            $errors = $validator->messages();
            return view('home.claimbook', compact('departments', 'provinces', 'districts', 'errors','location_list','department','province', 'district', 'numero_reclamo'))->withInput($data);
        }


        $ubigeo = Ubigeo::where('departamento',$data['departamento'])
            ->where('provincia',$data['provincia'])
            ->where('distrito', $data['distrito'])
            ->first();
        if (!$ubigeo){
            $validator->errors()->add('departamento', 'Selecione Correctaente');
            $validator->errors()->add('provincia', 'Selecione Correctaente');
            $validator->errors()->add('distrito', 'Selecione Correctaente');

            $errors = $validator->messages();
            return view('home.claimbook', compact('departments', 'provinces', 'districts', 'errors','location_list','department','province', 'district', 'numero_reclamo'))->withInput($data);
        }

        unset($data['departamento']);
        unset($data['provincia']);
        unset($data['distrito']);
        $data['ubigeo_id'] = $ubigeo->id;
        $data['estado_reclamo'] = true;
        $data['fecha_reclamo'] = now();
        $claimbook->fill($data);
        $claimbook->save();

        Flash::success("Su solicitud fue enviada");
        return redirect('/');

    }
}
