<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\ConfiguradorLinkRequest;
use App\Models\ConfiguradorLink;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ConfiguradorLinksController extends Controller
{
    private $paginate = 10;

    private $directory = 'configuradorlink';

    public function index($column = null, $order = null)
    {
        $request = request()->all();
        $pager = @$request['pager'] ? $request['pager'] : $this->paginate;
        $search = @$request['search'] ? $request['search'] : null;
        $models = ConfiguradorLink::search($pager, $search, $column, $order);
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
        $model = ConfiguradorLink::findOrFail($id);

        return view('admin.' . $this->directory . '.view', compact('model'));
    }

    public function update(ConfiguradorLinkRequest $request,$id){
        $data = $request->all();
        $model = ConfiguradorLink::findOrFail($id);

        $model->fill($data);
        $model->save();

        return redirect()->route('adm.configlink.index')->with('mensaje','Configurado de link actualizado con éxito!!');
    }
}
