<?php

namespace App\Http\Controllers\Admin;

use App\Models\Promocion;
use App\Models\Referencia;
use App\Models\Cupon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PromocionController extends Controller
{
    private $paginate = 10;

    private $directory = 'promocion';

    public function index($column = null, $order = null){
        $request = request()->all();
        $pager = @$request['pager'] ? $request['pager'] : $this->paginate;
        $search = @$request['search'] ? $request['search'] : null;
        $models = Promocion::search($pager, $search, $column, $order);
        $tipos_descuentos_ar = $this->tiposDescuentos();

        $tipos_ar = $this->tiposLista();
        $order = ($order == 'asc') ? 'desc' : 'asc';
        return view('admin.' . $this->directory . '.index', compact(
            'models',
            'pager',
            'search',
            'column',
            'order',
            'request',
            'tipos_ar',
            'tipos_descuentos_ar'
        ));
    }


    public function edit($id){

        $tipos_ar = $this->tiposLista();
        $tipos_descuentos_ar = $this->tiposDescuentos();
        $servicios_ar = Promocion::serviciosLista();

        $model = Promocion::findOrFail($id);


        $cuponItem = Cupon::where('promocion_id', '=', $id)->first();
        if($cuponItem){
          $model['cupon'] = $cuponItem->cupon_texto;
          $model['cupon_id'] = $cuponItem->cupon_id;
        }


        return view('admin.' . $this->directory . '.view', compact('model','tipos_ar','servicios_ar','tipos_descuentos_ar'));
    }



    public function delete($id){

      if($id){
        Promocion::destroy($id);

        Cupon::where('promocion_id', '=', $id)->delete();
      }
      return redirect()->route('adm.' . $this->directory . '.index')->with('mensaje','Elemento eliminardo con éxito!!');

    }

    public function update(Request $request,$id){
        $data = $request->all();


        unset($data['tipo_id_arf']);


        if(isset($data['cupon'])){
          $cuponItem = Cupon::where('promocion_id', '=', $id)->first();
          if($cuponItem){
            $cuponItem->cupon_texto = $data['cupon'];
            $cuponItem->save();
          }else{
            $newCuponData = array(
              'promocion_id' => $id,
              'cupon_texto' => $data['cupon'],
            );
            Cupon::create($newCuponData);
          }

        }
        unset($data['cupon']);


        $model = Promocion::findOrFail($id);

        $model->fill($data);

        $model->save();

        return redirect()->route('adm.' . $this->directory . '.index')->with('mensaje','Promoción actualizada con éxito!!');
    }


    public function create(){

        $tipos_ar = $this->tiposLista();
        $tipos_descuentos_ar = $this->tiposDescuentos();
        $servicios_ar = Promocion::serviciosLista();
        return view('admin.' . $this->directory . '.create', compact('tipos_ar','servicios_ar','tipos_descuentos_ar'));
    }



    public function save(Request $request)
    {
        $data = $request->all();
        unset($data['tipo_id_arf']);

        $cuponaux = NULL;
        if(isset($data['cupon'])){
        $cuponaux = $data['cupon'];

        }
        unset($data['cupon']);
        $model = Promocion::create($data);

        if(isset($cuponaux)){
            $newCuponData = array(
              'promocion_id' => $model->promocion_id,
              'cupon_texto' => $cuponaux,
            );
            Cupon::create($newCuponData);
        }












        return redirect()->route('adm.' . $this->directory . '.index')->with('mensaje','Promoción creada con éxito!!');
    }


    public function tiposLista(){
        $tipos = Referencia::select('id','nombre')->orderBy('nombre','desc')->get()->toArray();
        $tipos_ar = array();
        $tipos_ar[null] = 'Todos';
        for ($i = 0; $i < count($tipos); $i++){
           $tipos_ar[$tipos[$i]['id']] = $tipos[$i]['nombre'];
        }
        return $tipos_ar;
    }




    public function tiposDescuentos(){
        return [1=>'Descuento en porcentaje',2=>'Descuento FLAT'];
    }
}
