<?php

namespace App\Http\Controllers\Admin;

use App\Models\Accion;
use App\Models\Perfil;
use App\Models\PerfilAccion;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PerfilController extends Controller
{

    private $paginate = 10;

    private $directory = 'perfil';


    public function index($column = null, $order = null)
    {
        $request = request()->all();
        $pager = @$request['pager'] ? $request['pager'] : $this->paginate;
        $search = @$request['search'] ? $request['search'] : null;
        $models = Perfil::search($pager, $search, $column, $order);
        $order = ($order == 'asc') ? 'desc' : 'asc';
        return view('admin.' . $this->directory . '.index', compact(
            'models',
            'pager',
            'search',
            'column',
            'order',
            'request'
        ));
    }


    public function edit($id){

        $model = Perfil::findOrFail($id);

        $acciones = Accion::select('id','nombre', \DB::raw('0 as estado'))->get()->toArray();

        $seleccionadas = PerfilAccion::where('perfil_id', $id)
            ->where('estado', 1)
            ->select('accion_id')
            ->get()
            ->toArray();

        $lista = [];
        foreach ($acciones as $ac){
            foreach ($seleccionadas as $sel){
                if($ac['id'] == $sel['accion_id']){
                    $ac['estado'] = 1;
                    break;
                }
            }
            array_push($lista, $ac);
        }

        $acciones = $lista;

        return view('admin.' . $this->directory . '.view', compact('model', 'acciones'));
    }

    public function update(Request $request,$id){
        $data = $request->all();
        $model = Perfil::findOrFail($id);

        $data['accion'] = @$data['accion']? $data['accion']: [];

        $v = \Validator::make($data, [
            'nombre' => 'required',
            'accion.*' => 'required|exists:accion,id'
        ]);

        if ($v->fails() || count($data['accion']) == 0 ) {

            if(count($data['accion']) == 0){
                $v->errors()->add('accion', 'Debe seleccionar una acción');
                $acciones = Accion::select('accion.id','accion.nombre', \DB::raw( '0 as estado' ))->get()->toArray();

            }else{
                $acciones = Accion::select('accion.id','accion.nombre', \DB::raw('accion.id in (' . implode($data['accion']) . ')  as estado' ))->get()->toArray();
            }
            $errors = $v->errors();
            return view('admin.' . $this->directory . '.view', compact('model','acciones','errors'));
        } else{

            $model->nombre = $data['nombre'];
            $model->save();

            // Cambiar de estado a todos
            PerfilAccion::where('perfil_id', $model->id)->update(['estado' => 0]);

            $acciones = $data['accion'];
            foreach($acciones as $ac){
                $pa = PerfilAccion::where(['perfil_id' => $model->id, 'accion_id' => $ac ])->first();
                if (!$pa){
                    PerfilAccion::create(['perfil_id' => $model->id, 'accion_id' => $ac ]);
                } else{
                    $pa->estado = 1;
                    $pa->save();
                }
            }
            return redirect()->route('adm.perfil.index')->with('mensaje','Perfil actualizado con éxito!!');;
        }
    }

    public function create(){
        $acciones = Accion::select('accion.id','accion.nombre', \DB::raw('0 as estado' ))->get()->toArray();
        return view('admin.' . $this->directory . '.create', compact('acciones'));
    }

    public function save(Request $request){

        $data = $request->all();

        $data['accion'] = @$data['accion']? $data['accion']: [];

        $v = \Validator::make($data, [
            'nombre' => 'required',
            'accion.*' => 'exists:accion,id'
        ]);

        if ($v->fails() || count($data['accion']) == 0 ) {

            if(count($data['accion']) == 0){
                $v->errors()->add('accion', 'Debe seleccionar una acción');
                $acciones = Accion::select('accion.id','accion.nombre', \DB::raw( '0 as estado' ))->get()->toArray();

            }else{
                $acciones = Accion::select('accion.id','accion.nombre', \DB::raw('accion.id in (' . implode($data['accion']) . ')  as estado' ))->get()->toArray();
            }
            $errors = $v->errors();

            return view('admin.' . $this->directory . '.create', compact('acciones','errors'));
        } else{

            $perfil = new Perfil();
            $perfil->nombre = $data['nombre'];
            $perfil->save();

            $acciones = $data['accion'];
            foreach($acciones as $ac){
                PerfilAccion::create(['perfil_id' => $perfil->id, 'accion_id' => $ac ]);
            }

            return redirect()->route('adm.perfil.index')->with('mensaje','Perfil creado con éxito!!');;

        }
    }

}
