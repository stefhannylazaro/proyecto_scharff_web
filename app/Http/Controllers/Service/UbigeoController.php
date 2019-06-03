<?php

namespace App\Http\Controllers\Service;

use App\Models\Ubigeo;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UbigeoController extends Controller
{


    public function get_department()
    {
        $departments = \DB::table('ubigeos')
            ->select(\DB::raw('id, departamento as name'))
            ->groupBy('departamento')
            ->get()->toArray();
        $data = [];
        $data_respuesta =  [
            'status' => 0,
            'error' => 'No existe data',
            'data' => $data
        ];

        if (count($departments) > 0){
            $data_respuesta['status'] = 1;
            $data_respuesta['error'] = '';
            $data_respuesta['data'] = $departments;
        }
        return response()->json($data_respuesta);
    }


    public function get_province(Request $request, $departamento)
    {
        $data = [];
        $data_respuesta =  [
            'status' => 0,
            'error' => 'No existe data',
            'data' => $data
        ];

        $departments = \DB::table('ubigeos')
            ->select(\DB::raw('id, departamento as name'))
            ->where('id', (int) $departamento)
            ->groupBy('departamento')
            ->first();

        if ($departments){
            $provinces = \DB::table('ubigeos')
                ->select(\DB::raw('id, provincia as name'))
                ->where('departamento','like','%'.$departments->name)
                ->groupBy('provincia')
                ->orderBy('id')
                ->get()->toArray();

            if (count($provinces) > 0){

                $data_respuesta['status'] = 1;
                $data_respuesta['error'] = '';
                $data_respuesta['data'] = $provinces;
            }
        }

        return response()->json($data_respuesta);
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
                ->groupBy('distrito')
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
