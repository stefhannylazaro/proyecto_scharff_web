<?php

namespace App\Http\Controllers\Admin;

use App\Models\Opciones;
use App\Models\OpcionesGenerales;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class OpcionesController extends Controller
{
    private $paginate = 10;

    private $directory = 'opciones';

    public function index($column = null, $order = null)
    {
        $request = request()->all();
        $pager = @$request['pager'] ? $request['pager'] : $this->paginate;
        $search = @$request['search'] ? $request['search'] : null;
        $models = Opciones::search($pager, $search, $column, $order);
        $order = ($order == 'asc') ? 'desc' : 'asc';


        //print_r((array)json_decode($model->valor));
        // foreach ($models as $model) {
        //
        //   print_r($model->tipo);
        //   print_r("\n\r");
        //   print_r($model->options);
        //   print_r("\n\r");
        //   print_r("---------\n\r");
        //   // code...
        // }

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
        $obj = Opciones::findOrFail($id);

        return view('admin.' . $this->directory . '.view', compact('obj'));
    }




    public function edit($id){
        $model = Opciones::findOrFail($id);
        return view('admin.' . $this->directory . '.view', compact('model'));
    }

    public function editGeneral($id){
        $model = OpcionesGenerales::findOrFail($id);
        return view('admin.' . $this->directory . '.view', compact('model'));
    }

    public function update(Request $request,$id){

        $data = $request->all();
        $model = Opciones::findOrFail($id);


        $model->fill($data);
        $model->save();


        return redirect()->route('adm.opciones.index')->with('mensaje','Motivo de contacto actualizado con éxito!!');
    }

    public function updateGeneral(Request $request,$id){

        $data = $request->all();
        $model = OpcionesGenerales::findOrFail($id);


        $model->fill($data);
        $model->save();


        return redirect()->route('adm.codigopedido.index')->with('mensaje','Motivo de contacto actualizado con éxito!!');
    }

    public function reset(Request $request){

        $data = $request->all();
        $model = OpcionesGenerales::findOrFail($data['id']);
        try {
          $model->valor=1;
          $model->save();
          $data_respuesta['mensaje'] = 'Actualización correcta';
          $data_respuesta['status'] = 1;
        } catch (\Exception $e) {
          $data_respuesta['mensaje'] = "Ocurrió un error al actualizar.";
          $data_respuesta['status'] = 0;
        }
        return response()->json( $data_respuesta );

    }

    public function create(){
        return view('admin.' . $this->directory . '.create');
    }

    public function save(Request $request){

        $data = $request->all();
        $model = Opciones::create($data);



        return redirect()->route('adm.opciones.index')->with('mensaje','Opción creada con éxito!!');;
    }









    public function codigoPedidosIndex($column = null, $order = null)
    {
        $request = request()->all();
        $pager = @$request['pager'] ? $request['pager'] : $this->paginate;
        $search = @$request['search'] ? $request['search'] : null;



        $models = OpcionesGenerales::searchCodigoPedidos($pager, $search, $column, $order, 'codigopedido');
        $order = ($order == 'asc') ? 'desc' : 'asc';

        return view('admin.' . $this->directory . '.codigopedidos', compact(
            'models',
            'pager',
            'search',
            'column',
            'order',
            'request'
        ));

    }







}
