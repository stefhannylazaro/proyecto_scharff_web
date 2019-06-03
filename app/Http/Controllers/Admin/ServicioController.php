<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\ServicioRequest;
use App\Models\Servicio;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ServicioController extends Controller
{
    private $paginate = 10;

    private $directory = 'servicio';

    public function index($column = null, $order = null)
    {
        $request = request()->all();
        $pager = @$request['pager'] ? $request['pager'] : $this->paginate;
        $search = @$request['search'] ? $request['search'] : null;
        $models = Servicio::search($pager, $search, $column, $order);
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
        $model = Servicio::findOrFail($id);

        return view('admin.' . $this->directory . '.view', compact('model'));
    }

    public function update(ServicioRequest $request,$id){
        $data = $request->all();
        $model = Servicio::findOrFail($id);

        if (isset($data['imagen']) && !empty($data['imagen'])) {
            $name_photo = $model->id . '_' . rand(10000000, 99999999);
            $name_photo = $name_photo . '.' . $data['imagen']->getClientOriginalExtension();
            $data['imagen']->move(config('app.url_image_servicio'), $name_photo);

            $data['imagen'] = $name_photo;

            if (file_exists(config('app.url_image_servicio'). $model->imagen)) {
                unlink(config('app.url_image_servicio'). $model->imagen);
            }
        }
        $model->fill($data);
        $model->save();

        return redirect()->route('adm.servicio.index')->with('mensaje','Servicio actualizado con éxito!!');
    }

    public function create(){
        return view('admin.' . $this->directory . '.create');
    }

    public function save(ServicioRequest $request)
    {
;
        $data = $request->all();
        $model = Servicio::create($data);

        if (isset($data['imagen']) && !empty($data['imagen'])) {
            if (!file_exists(config('app.url_image_servicio'))) {
                mkdir(config('app.url_image_servicio'), 0777, true);
                chmod(config('app.url_image_servicio'), 0777);
            }

            $name_photo = $model->id . '_' . rand(10000000, 99999999);
            $name_photo = $name_photo . '.' . $data['imagen']->getClientOriginalExtension();
            $data['imagen']->move(config('app.url_image_servicio'), $name_photo);

            $data['imagen'] = $name_photo;

            $model->fill($data);
            $model->save();
        }
        return redirect()->route('adm.servicio.index')->with('mensaje','Servicio creado con éxito!!');;
    }
}
