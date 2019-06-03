<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\BannerRequest;
use App\Models\Banner;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Laracasts\Flash\Flash;

class BannerController extends Controller
{
    private $paginate = 10;

    private $directory = 'banner';

    public function index($column = null, $order = null)
    {
        $request = request()->all();
        $pager = @$request['pager'] ? $request['pager'] : $this->paginate;
        $search = @$request['search'] ? $request['search'] : null;
        $models = Banner::search($pager, $search, $column, $order);
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

    public function edit($id){
        $model = Banner::findOrFail($id);
        $model_atributos = @$model->atributos;
        $model_atributos_ob = '';
        if($model_atributos){
          if(!empty($model_atributos)&&$model_atributos!="\"\""){
            $model_atributos_ob = json_decode($model_atributos);
            $model->btn_text = $model_atributos_ob->btn_text;
          }else{
            $model->btn_text = "";
          }

        };

        return view('admin.' . $this->directory . '.view', compact('model'));
    }

    public function active(Request $request){

        $data = $request->all();
        $model = Banner::findOrFail($data['id']);
        try {
          if($model->estado)
            $model->estado=0;
          else
            $model->estado=1;
          $model->save();
          $data_respuesta['mensaje'] = 'Actualizado';
          $data_respuesta['status'] = 1;
        } catch (\Exception $e) {
          $data_respuesta['mensaje'] = "Ocurrió un error al actualizar.";
          $data_respuesta['status'] = 0;
        }
        return response()->json( $data_respuesta );

    }

    public function update(BannerRequest $request, $id){
        $data = $request->all();
        $model = Banner::findOrFail($id);
        $btn_text = $data['btn_text'];
        if(!$request->has('estado')) {
          $model->estado = 0;
        } else {
          $model->estado = 1;
        }

        if (isset($data['imagen']) && !empty($data['imagen'])) {
            $name_photo = $model->id . '_' . rand(10000000, 99999999);
            $name_photo = $name_photo . '.' . $data['imagen']->getClientOriginalExtension();
            $data['imagen']->move(config('app.url_image_banner'), $name_photo);

            $data['imagen'] = $name_photo;

            if (file_exists(config('app.url_image_banner'). $model->imagen)) {
                unlink(config('app.url_image_banner'). $model->imagen);
            }
        }


        $model_atributos = @$model->atributos;
        $model_atributos_ob = '';

        if($model_atributos&&$model_atributos!="\"\""){
          $model_atributos_ob = json_decode($model_atributos);
          $model_atributos_ob->btn_text = $btn_text;

          $model_atributos_json = json_encode($model_atributos_ob);
          $data['atributos'] = $model_atributos_json;
        }else{
          $arrayName = array(
            "btn_text" => $btn_text,
            "btn_style"=> "pink"
          );
          $object = json_decode(json_encode($arrayName), FALSE);
          $data['atributos'] = json_encode($object);
        }

        $model->order=$data['order'];
        $model->fill($data);
        $model->save();
        return view('admin.' . $this->directory . '.view', compact('model'))->with('mensaje','Banner actualizado con éxito!!');
        //return redirect()->route('adm.banner.index')->with('mensaje','Banner actualizado con éxito!!');
    }

    public function create(){
        return view('admin.' . $this->directory . '.create');
    }

    public function save(BannerRequest $request)
    {
        $data = $request->all();
        $model = Banner::create($data);
        if(!$request->has('estado')) {
          $model->estado = 0;
        } else {
          $model->estado = 1;
        }
        $btn_text = $data['btn_text'];
        if (isset($data['imagen']) && !empty($data['imagen'])) {
          if (!file_exists(config('app.url_image_banner'))) {
              mkdir(config('app.url_image_banner'), 0777, true);
              chmod(config('app.url_image_banner'), 0777);
          }

          $name_photo = $model->id . '_' . rand(10000000, 99999999);
          $name_photo = $name_photo . '.' . $data['imagen']->getClientOriginalExtension();
          $data['imagen']->move(config('app.url_image_banner'), $name_photo);

          $data['imagen'] = $name_photo;
          $model_atributos = @$model->atributos;
          $model_atributos_ob = '';
          //

          $arrayName = array(
            "btn_text" => $btn_text,
            "btn_style"=> "pink"
          );

          $object = json_decode(json_encode($arrayName), FALSE);
          $data['atributos'] = json_encode($object);
          
          $model->order=$data['order'];
          $model->fill($data);
          $model->save();
        }
        return redirect()->route('adm.banner.index')->with('mensaje','Banner creado con éxito!!');;
    }


}
