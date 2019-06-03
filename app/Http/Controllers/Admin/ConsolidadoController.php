<?php

namespace App\Http\Controllers\Admin;

use App\Models\Consolidado;
use App\Models\GobuyPedido;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ConsolidadoController extends Controller
{
    private $paginate = 10;

    private $directory = 'gobuypedido';

    public function index($column = null, $order = null)
    {
        $request = request()->all();
        $pager = @$request['pager'] ? $request['pager'] : $this->paginate;
        $search = @$request['search'] ? $request['search'] : null;
        $models = Consolidado::search($pager, $search, $column, $order);
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


    public function save(Request $request){
        try {
          $data = $request->all();
          $model = Consolidado::create();//
          $model->consolidado_codigo='CONS'.$model->consolidado_id;
          $model->save();

          $items=$data['list'];
          for ($i=0; $i < count($items); $i++) {
            $modelPedido=GobuyPedido::findOrFail($items[$i]);
            $modelPedido->consolidado_id=$model->consolidado_id;
            $modelPedido->save();
          }

          $data_respuesta =  [
            'status' => 1,
            'mensajes' => ['Se guardo con éxito.']
          ];
        } catch (\Exception $e) {
          $data_respuesta =  [
            'status' => 2,
            'mensajes' => ['Error al guardar.']
          ];
        }
        return response()->json($data_respuesta);
    }













}
