<?php

namespace App\Http\Controllers\Admin;

use App\Models\Preferencia;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PreferenciaController extends Controller
{
    private $paginate = 10;

    private $directory = 'preferencia';

    public function index($column = null, $order = null){
        $request = request()->all();
        $pager = @$request['pager'] ? $request['pager'] : $this->paginate;
        $search = @$request['search'] ? $request['search'] : null;
        $models = Preferencia::search($pager, $search, $column, $order);
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
        $model = Preferencia::findOrFail($id);
        return view('admin.' . $this->directory . '.view', compact('model'));
    }

    public function update(Request $request,$id){
        $data = $request->all();
        $model = Preferencia::findOrFail($id);

        $model->fill($data);
        $model->save();

        return redirect()->route('adm.' . $this->directory . '.index')->with('mensaje','Preferencia actualizada con éxito!!');
    }


    public function create(){
        return view('admin.' . $this->directory . '.create');
    }



    public function save(Request $request)
    {
        $data = $request->all();
        $model = Preferencia::create($data);

        return redirect()->route('adm.' . $this->directory . '.index')->with('mensaje','Preferencia creada con éxito!!');
    }

}
