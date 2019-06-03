<?php

namespace App\Http\Controllers\Service;

use App\Models\Referencia;
use App\Models\Promocion;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ReferenciaController extends Controller
{
    private $paginate = 10;

    private $directory = 'referencia';

    public function index($column = null, $order = null)
    {
        $request = request()->all();
        $pager = @$request['pager'] ? $request['pager'] : $this->paginate;
        $search = @$request['search'] ? $request['search'] : null;
        $models = Referencia::search($pager, $search, $column, $order);
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
        $model = Referencia::findOrFail($id);
        return view('admin.' . $this->directory . '.view', compact('model'));
    }

    public function update(Request $request,$id){
        $data = $request->all();
        $model = Referencia::findOrFail($id);

        $model->fill($data);
        $model->save();

        return redirect()->route('adm.' . $this->directory . '.index')->with('mensaje','Referencia actualizada con éxito!!');
    }


    public function create(){
        return view('admin.' . $this->directory . '.create');
    }


    public function delete($id){

      if($id){
        Referencia::destroy($id);
        Promocion::where('tipo_id', $id)
            ->update(['tipo_id' => NULL]);

      }
      return redirect()->route('adm.' . $this->directory . '.index')->with('mensaje','Elemento eliminardo con éxito!!');

    }




    public function save(Request $request)
    {
        $data = $request->all();
        $model = Referencia::create($data);

        return redirect()->route('adm.' . $this->directory . '.index')->with('mensaje','Referencia creada con éxito!!');
    }

}
