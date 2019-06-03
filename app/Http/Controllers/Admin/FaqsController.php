<?php

namespace App\Http\Controllers\Admin;

use App\Models\Faq;
use App\Models\CatFaq;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FaqsController extends Controller
{
    private $paginate = 10;

    private $directory = 'faq';

    public function index($column = null, $order = null)
    {
        $request = request()->all();
        $pager = @$request['pager'] ? $request['pager'] : $this->paginate;
        $search = @$request['search'] ? $request['search'] : null;
        $models = Faq::search($pager, $search, $column, $order);
        $order = ($order == 'asc') ? 'desc' : 'asc';


        $assoc_cats = CatFaq::getCatsArray();


        return view('admin.' . $this->directory . '.index', compact(
            'models',
            'pager',
            'search',
            'column',
            'order',
            'request',
            'assoc_cats'
        ));
    }




    public function view($id){
        $obj = Faq::findOrFail($id);

        return view('admin.' . $this->directory . '.view', compact('obj'));
    }





    public function edit($id){
        $model = Faq::findOrFail($id);
        //$cats = Faq::categoriasFaq()->toArray();


        $assoc_cats = CatFaq::getCatsArray();
        //$cats_ar = array();
        // print_r($assoc_cats);
        // for ($i = 0; $i < count($cats); $i++){
        //     $cats_ar[$cats[$i]['categoria']] = $assoc_cats[$cats[$i]['categoria']];
        // }
        // print_r($cats_ar);

        return view('admin.' . $this->directory . '.view', compact('model','assoc_cats'));
    }



    public function update(Request $request,$id){
        $data = $request->all();
        $model = Faq::findOrFail($id);


        $model->fill($data);
        $model->save();

        return redirect()->route('adm.faq.index')->with('mensaje','Motivo de contacto actualizado con éxito!!');
    }


    public function create(){
      //$cats = Faq::categoriasFaq();


      $assoc_cats = CatFaq::getCatsArray();


      // $cats_ar = array();
      //
      // $assoc_cats = CatFaq::getCatsArray();
      // print_r($cats);
      // print_r($assoc_cats);
      // for ($i = 0; $i < count($cats); $i++){
      //     $cats_ar[$cats[$i]->categoria] = $assoc_cats[$cats[$i]->categoria]->categoria;
      // }
      // print_r($cats_ar);
      // return;

        return view('admin.' . $this->directory . '.create',compact('assoc_cats'));
    }

    public function save(Request $request){

        $data = $request->all();
        $model = Faq::create($data);
        return redirect()->route('adm.faq.index')->with('mensaje','Motivo creado con éxito!!');;
    }



    public function apiIndex(){

      $faqs = \DB::table('faqs')
          ->select(\DB::raw('id,categoria,pregunta, respuesta'))
          ->orderBy('id', 'DESC')
          ->get()->toArray();

      $assoc_cats = CatFaq::getCatsArrayFull();

      $ar = array();
      $ar['faqs']=$faqs;
      $ar['cats']=$assoc_cats;
      return response()->json($ar);

    }









}
