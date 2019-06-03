<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GobuyPedido extends Model
{
    protected $connection = 'pickapp_api';
    protected $guarded = [];
    protected $table = 'gobuypedido';
    protected $primaryKey = 'gobuy_id';

    protected $fillable = [
        'gobuy_estado',
        'gobuy_codetracking',
        'gobuy_valordeclarado',
        'gobuy_piezas',
        'gobuy_peso',
        'gobuy_costoenvio',
        'usuario_id',
        'gobuy_confirmacioncompra',
        'gobuy_numbultos',
        'gobuy_montoextra',
        'gobuy_preciocliente',
        'gobuy_fecharecepcion',
        'gobuy_descripcion',
        'gobuy_pesoconsolidado',
        'gobuy_direccion_destino',
        'gobuy_valorreal',
        'gobuy_pesoreal',
        'gobuy_costoreal',
        'gobuy_impuesto',
        'gobuy_codeculqi_pago',
        'gobuy_estado_medio_pago',
        'gobuy_medio_pago',
    ];

    public static function search($pager,$search,$column,$order){

        $columns = [
          'column-1' =>'gobuy_id',
          'column-2' =>'gobuy_estado',
          'column-3' =>'gobuy_codetracking',
          'column-4' =>'gobuy_valordeclarado',
          'column-5' =>'gobuy_piezas',
          'column-6' =>'gobuy_peso',
          'column-7' =>'gobuy_costoenvio',
          'column-8' =>'created_at',
        ];
        $model = GobuyPedido::where(function ($query) use ($search){
          $query->where( 'gobuy_id','like','%'.$search.'%');
          $query->orWhere( 'gobuy_codetracking','like','%'.$search.'%');
        });


        if(@$column){
            if(@$columns[$column]){
                $model = $model->orderBy($columns[$column],$order);
            }else{
                abort(404);
            }
        }
        $model = $model->orderBy('gobuy_id','desc')->paginate($pager);
        return $model;
    }

    public static function searchType($pager,$search,$column,$order,$type){

        $columns = [
          'column-1' =>'gobuy_id',
          'column-2' =>'gobuy_estado',
          'column-3' =>'gobuy_codetracking',
          'column-4' =>'gobuy_valordeclarado',
          'column-5' =>'gobuy_piezas',
          'column-6' =>'gobuy_peso',
          'column-7' =>'gobuy_costoenvio',
          'column-8' =>'created_at',
        ];

        // $model = GobuyPedido::where(function ($query) use ($search){
        //   $query->where( 'gobuy_id','like','%'.$search.'%');
        //   $query->orWhere( 'gobuy_codetracking','like','%'.$search.'%');
        // })->where('gobuy_estado',$type);

        $model = GobuyPedido::leftJoin('consolidado', 'consolidado.consolidado_id', '=', 'gobuypedido.consolidado_id')
        ->select(
            'consolidado.*',
            'gobuypedido.*'
        )
        ->where(function ($query) use ($search){
          $query->where( 'gobuy_id','like','%'.$search.'%');
          $query->orWhere( 'gobuy_codetracking','like','%'.$search.'%');
        })->where('gobuy_estado',$type);

        if(@$column){
            if(@$columns[$column]){
                $model = $model->orderBy($columns[$column],$order);
            }else{
                abort(404);
            }
        }
        $model = $model->orderBy('gobuy_id','desc')->paginate($pager);
        return $model;
    }









}
