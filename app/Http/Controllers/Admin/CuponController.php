<?php

namespace App\Http\Controllers\Admin;

use App\Models\Cupon;
use App\Models\Promocion;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CuponController extends Controller
{
    private $paginate = 10;

    private $directory = 'cupon';

    public function index($column = null, $order = null){
        $request = request()->all();
        $pager = @$request['pager'] ? $request['pager'] : $this->paginate;
        $search = @$request['search'] ? $request['search'] : null;
        $models = Cupon::search($pager, $search, $column, $order);
        $promociones_ar = $this->promocionesLista();
        $order = ($order == 'asc') ? 'desc' : 'asc';
        return view('admin.' . $this->directory . '.index', compact(
            'models',
            'pager',
            'search',
            'column',
            'order',
            'request',
            'promociones_ar'
        ));
    }


    public function edit($id){


      $promociones_ar = $this->promocionesLista();

      $model = Cupon::findOrFail($id);
      return view('admin.' . $this->directory . '.view', compact('model','promociones_ar','servicios_ar'));

    }


    public function delete($id){

      if($id){
        Cupon::destroy($id);
      }
      return redirect()->route('adm.' . $this->directory . '.index')->with('mensaje','Elemento eliminardo con éxito!!');

    }

    public function update(Request $request,$id){
        $data = $request->all();

        $model = Cupon::findOrFail($id);


        $model->fill($data);
        $model->save();


        return redirect()->route('adm.' . $this->directory . '.index')->with('mensaje','Cupón actualizado con éxito!!');
    }


    public function create(){

        //$promociones = Promocion::select('promocion_id','promocion_nombre')->orderBy('promocion_nombre','asc')->get()->toArray();


        $promociones_ar = $this->promocionesLista();
        return view('admin.' . $this->directory . '.create', compact('promociones_ar'));

    }



    public function save(Request $request)
    {

        $data = $request->all();
        $model = Cupon::create($data);

        return redirect()->route('adm.' . $this->directory . '.index')->with('mensaje','Promoción creada con éxito!!');
    }

    public function promocionesLista(){
      $promociones = Promocion::select('promocion_id','promocion_nombre')->get()->toArray();

      $promociones_ar = array();
      for ($i = 0; $i < count($promociones); $i++){
         $promociones_ar[$promociones[$i]['promocion_id']] = $promociones[$i]['promocion_nombre'];
      }
      return $promociones_ar;

    }

}
