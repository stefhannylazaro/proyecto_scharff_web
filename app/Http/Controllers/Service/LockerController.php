<?php

namespace App\Http\Controllers\Service;

use App\Models\Locker;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LockerController extends Controller
{
    private $directory = 'locker';
    private $paginate = 10;


    //ADMIN
    public function index($column = null, $order = null){

      $request = request()->all();
      $pager = @$request['pager'] ? $request['pager'] : $this->paginate;
      $search = @$request['search'] ? $request['search'] : null;
      $models = Locker::search($pager, $search, $column, $order);
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


    //ADMIN
    public function create(Request $request){
      return view('admin.' . $this->directory . '.create');
    }



    //ADMIN
    public function save(Request $request)
    {
      $data = $request->all();
      unset($data['input_search_index']);
      $model = Locker::create($data);


      return redirect()->route('adm.locker.index')->with('mensaje','Locker creado con éxito!!');;
    }


    //ADMIN
    public function edit($id){

        $model = Locker::findOrFail($id);

        return view('admin.' . $this->directory . '.view', compact('model'));
    }



    //ADMIN
    public function update(Request $request,$id){
        $data = $request->all();
        unset($data['input_search_index']);

        $model = Locker::findOrFail($id);


        $model->fill($data);
        $model->save();

        return redirect()->route('adm.locker.index')->with('mensaje','Locker actualizado con éxito!!');
    }






    //API
    public function apiLockers(){
      $lockers = \DB::table('lockers')
          ->select(\DB::raw('id,nombre,direccion,size,ubicacion_lat,ubicacion_lng'))
          ->orderBy('id', 'DESC')
          ->get()->toArray();

      return response()->json($lockers);
    }


    //API
    public function apiLockerCreate(Request $request){

      $data = $request->all();
      //$obj = $data['estado'];

      //return $obj;

      $validator = \Validator::make($data,
            [
              'direccion' => 'required',
              'size' => 'required|in:pequeño,mediano,grande',
              'ubicacion_lat' => 'required',
              'ubicacion_lng' => 'required'
            ]
      );

      if ($validator->fails()) {
          return response()->json(
              [
                  'status' => 0,
                  'error' => $validator->errors()->first(),
                  'data' => []
              ]
          );
      }

      $Locker =  Locker::create($data);


      $data_respuesta =  [
          'status' => 0,
          'data' => 'Error al guardar',
      ];

      if($Locker){
        $data_respuesta =  [
            'status' => 1,
            'data' => 'Se guardo con exito',
        ];
      };

      return response()->json($data_respuesta);
    }










    //API
    public function apiLockerTarifa(){


      return response()->json(
          [
              'precio' => 10,
              'tiempo_espera_entrega' => 24,
              'tiempo_espera_recojo' => 24,
          ]
      );

    }



    public function admview($id){
        $obj = Locker::reservaConUsuario($id)->get()->first();
        //$obj = ReservaLocker::findOrFail($id);
        print_r($obj);
        return view('admin.' . $this->directory . '.view', compact('obj'));
    }




    public function get_district(Request $request, $provincia)
    {
        $data = [];
        $data_respuesta =  [
            'status' => 0,
            'error' => 'No existe data',
            'data' => $data
        ];

        $prov = \DB::table('ubigeos')
            ->select(\DB::raw('id, provincia as name'))
            ->where('id', (int) $provincia)
            ->groupBy('provincia')
            ->first();

        if ($prov){
            $districts = \DB::table('ubigeos')
                ->select(\DB::raw('id, distrito as name'))
                ->where('provincia','like','%'.$prov->name)
                ->get()->toArray();

            if (count($districts) > 0){
                $data_respuesta['status'] = 1;
                $data_respuesta['error'] = '';
                $data_respuesta['data'] = $districts;
            }
        }

        return response()->json($data_respuesta);
    }
}
