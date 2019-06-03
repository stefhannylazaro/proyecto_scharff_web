<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Faq extends Model
{
    protected $guarded = [];

    public static function search($pager,$search,$column,$order){

        $columns = [
            'column-1'=>'id',
            'column-2'=>'categoria',
            'column-3'=>'pregunta',
            'column-4'=>'respuesta',
            'column-5'=>'created_at',
        ];
        $model = Faq::where(function ($query) use ($search){
            $query->where( 'categoria','like','%'.$search.'%');
            $query->orWhere( 'pregunta','like','%'.$search.'%');
            $query->orWhere( 'respuesta','like','%'.$search.'%');
        });


        if(@$column){
            if(@$columns[$column]){
                $model = $model->orderBy($columns[$column],$order);
            }else{
                abort(404);
            }
        }

        $model = $model->orderBy('id','desc')->paginate($pager);
        return $model;
    }

    public static function categoriasFaq(){
      $faqs = Faq::select('categoria')
                   ->groupBy('categoria')
                   ->get();
      return $faqs;
    }
}
