<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\SucursalRequest;
use App\Models\Sucursal;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SucursalController extends Controller
{
    private $paginate = 10;

    private $directory = 'sucursal';

    public function index($column = null, $order = null)
    {
        $request = request()->all();
        $pager = @$request['pager'] ? $request['pager'] : $this->paginate;
        $search = @$request['search'] ? $request['search'] : null;
        $models = Sucursal::search($pager, $search, $column, $order);
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
        $model = Sucursal::findOrFail($id);

        $direccionF = json_decode($model['direccion']);

        $model->departamento = $direccionF->departamento;
        $model->dirOne = $direccionF->dirOne;
        $model->dirTwo = $direccionF->dirTwo;
        $model->tel = $direccionF->tel;

        return view('admin.' . $this->directory . '.view', compact('model'));
    }

    public function update(SucursalRequest $request,$id){
        $data = $request->all();
        $model = Sucursal::findOrFail($id);
        unset($data['input_search_index']);
        $data['direccion'] = json_encode([
          'departamento'=>$data['departamento'],
          'dirOne'=>$data['dirOne'],
          'dirTwo'=>$data['dirTwo'],
          'tel'=>$data['tel']
        ]);

        unset($data['departamento']);
        unset($data['dirOne']);
        unset($data['dirTwo']);
        unset($data['tel']);




        $model->fill($data);
        $model->save();


        return redirect()->route('adm.sucursal.index')->with('mensaje','Sucursal actualizado con éxito!!');
    }

    public function create(){

        return view('admin.' . $this->directory . '.create');
    }

    public function save(SucursalRequest $request)
    {

        $data = $request->all();
        unset($data['input_search_index']);

        $data['direccion'] = json_encode([
          'departamento'=>$data['departamento'],
          'dirOne'=>$data['dirOne'],
          'dirTwo'=>$data['dirTwo'],
          'tel'=>$data['tel']
        ]);

        unset($data['departamento']);
        unset($data['dirOne']);
        unset($data['dirTwo']);
        unset($data['tel']);

        $model = Sucursal::create($data);

        return redirect()->route('adm.sucursal.index')->with('mensaje','Sucursal creado con éxito!!');
    }
}
