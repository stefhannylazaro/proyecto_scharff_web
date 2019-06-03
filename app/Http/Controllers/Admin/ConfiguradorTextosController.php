<?php

namespace App\Http\Controllers\Admin;

use App\Models\ConfiguradorTexto;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ConfiguradorTextosController extends Controller
{
    private $paginate = 10;

    private $directory = 'configuradortexto';

    public function index($column = null, $order = null)
    {
        $request = request()->all();
        $pager = @$request['pager'] ? $request['pager'] : $this->paginate;
        $search = @$request['search'] ? $request['search'] : null;
        $models = ConfiguradorTexto::search($pager, $search, $column, $order);
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
        $model = ConfiguradorTexto::findOrFail($id);


        return view('admin.' . $this->directory . '.view', compact('model'));
    }

    public function update($id){
        $data = request()->all();
        $model = ConfiguradorTexto::findOrFail($id);
        if(!isset($data['descripcion'])){
          $model['descripcion'] = '';
        }

        $model->fill($data);
        $model->save();

        return view('admin.' . $this->directory . '.view', compact('model'));

        return redirect()->route('adm.configtext.index')->with('mensaje','Configurado de texto actualizado con éxito!!');
    }
}
