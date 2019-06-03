<?php

namespace App\Http\Controllers\Admin;

use App\Models\GobuyAlerta;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class GobuyAlertaController extends Controller
{
    private $paginate = 10;

    private $directory = 'gobuyalerta';

    public function index($column = null, $order = null)
    {
        $request = request()->all();
        $pager = @$request['pager'] ? $request['pager'] : $this->paginate;
        $search = @$request['search'] ? $request['search'] : null;
        $models = GobuyAlerta::search($pager, $search, $column, $order);
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

    public function view($id){
        $obj = GobuyAlerta::findOrFail($id);

        return view('admin.' . $this->directory . '.view', compact('obj'));
    }




    public function edit($id){
        $model = GobuyAlerta::findOrFail($id);

        return view('admin.' . $this->directory . '.view', compact('model'));
    }

    public function update(Request $request,$id){
        $data = $request->all();
        $model = GobuyAlerta::findOrFail($id);


        $model->fill($data);
        //print_r($data);die();
        $model->save();

        return redirect()->route('adm.gobuyalerta.index')->with('mensaje','Alerta de contacto actualizado con éxito!!');
    }

    public function create(){
        return view('admin.' . $this->directory . '.create');
    }

    public function save(Request $request){

        $data = $request->all();
        $model = GobuyAlerta::create($data);
        return redirect()->route('adm.gobuyalerta.index')->with('mensaje','Alerta creado con éxito!!');;
    }

    public function list_alert_gobuy(Request $request){
        try {
          $modelGobuyAlerta = GobuyAlerta::where('estado',1)->orderBy('alerta_fecha','desc')->get()->toArray();
          $data_respuesta =  [
              'status' => 1,
              'data'=> $modelGobuyAlerta,
              'mensajes' => ['Respuesta exitosa.']
          ];

        } catch (\Exception $e) {
          $data_respuesta =  [
            'status' => 2,
            'mensajes' => ['Error al cargar información.']
          ];
        }
        return response()->json($data_respuesta);
    }

}
