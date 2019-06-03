<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Administrator extends Model
{
    protected $guarded = [];

    public $timestamps = true;

    public static function search($pager,$search,$column,$order){

        $columns = [
            'column-1'=>'email',
            'column-2'=>'usuario_nombre',
            'column-3'=>'usuario_apellidos',
            'column-4'=>'perfil',
            'column-5'=>'created_at',
        ];
        $model = Administrator::join('users', 'users.id', '=', 'administrators.user_id')
            ->leftJoin('perfil', 'perfil.id', '=', 'administrators.perfil_id')
            ->select('administrators.id','users.email','users.usuario_nombre', 'users.usuario_apellidos','users.created_at', 'perfil.nombre as perfil' )
            ->where(function ($query) use ($search){
            $query->where( 'users.email','like','%'.$search.'%');
            $query->orWhere( 'users.usuario_nombre','like','%'.$search.'%');
            $query->orWhere( 'users.usuario_apellidos','like','%'.$search.'%');

        })->where('users.rol','superadmin');


        if(@$column){
            if(@$columns[$column]){
                $model = $model->orderBy($columns[$column],$order);
            }else{
                abort(404);
            }
        }
        $model = $model->orderBy('administrators.id','desc')->paginate($pager);
        return $model;
    }

    public function user(){
        return $this->belongsTo(User::class);
    }
}
