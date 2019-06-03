<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

class Perfil extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $table = 'perfil';

    public $timestamps = true;

    public static function search($pager,$search,$column,$order){

        $columns = [
            'column-1'=>'nombre',
            'column-2'=>'numero'
        ];
        $model = Perfil::select(
            'perfil.id',
            'perfil.nombre',
            DB::Raw('(select count(*)  from administrators adm WHERE adm.perfil_id = perfil.id) numero'))
            ->where(function ($query) use ($search){
                $query->where( 'perfil.nombre','like','%'.$search.'%');
            });


        if(@$column){
            if(@$columns[$column]){
                $model = $model->orderBy($columns[$column],$order);
            }else{
                abort(404);
            }
        }
        $model = $model->orderBy('perfil.id','desc')->paginate($pager);
        return $model;
    }

}
