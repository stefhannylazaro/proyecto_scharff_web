<?php

namespace App\Http\Controllers\Admin;

use App\Models\MotivoContacto;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MotivoContactoController extends Controller
{
    private $paginate = 10;

    private $directory = 'motivo';

    public function index($column = null, $order = null)
    {
        $request = request()->all();
        $pager = @$request['pager'] ? $request['pager'] : $this->paginate;
        $search = @$request['search'] ? $request['search'] : null;
        $models = MotivoContacto::search($pager, $search, $column, $order);
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
        $obj = MotivoContacto::findOrFail($id);

        return view('admin.' . $this->directory . '.view', compact('obj'));
    }




    public function edit($id){
        $model = MotivoContacto::findOrFail($id);

        return view('admin.' . $this->directory . '.view', compact('model'));
    }

    public function update(Request $request,$id){
        $data = $request->all();
        $model = MotivoContacto::findOrFail($id);


        $model->fill($data);
        $model->save();

        return redirect()->route('adm.motivo.index')->with('mensaje','Motivo de contacto actualizado con éxito!!');
    }

    public function create(){
        return view('admin.' . $this->directory . '.create');
    }

    public function save(Request $request){

        $data = $request->all();
        $model = MotivoContacto::create($data);
        return redirect()->route('adm.motivo.index')->with('mensaje','Motivo creado con éxito!!');;
    }








}
