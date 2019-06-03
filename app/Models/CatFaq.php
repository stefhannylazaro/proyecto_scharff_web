<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CatFaq extends Model
{
    protected $guarded = [];
    protected $table = 'catfaqs';



    public static function getCatsArray(){
      $catfaq = CatFaq::all()->toArray();
      $assoc_cats = array_reduce($catfaq, function ($result, $item) {
          $result[$item['id']] = $item['categoria'];
          return $result;
      }, array());
      return $assoc_cats;
    }

    public static function getCatsArrayFull(){
      $catfaq = CatFaq::all()->toArray();
      $assoc_cats = array_reduce($catfaq, function ($result, $item) {
          $result[$item['id']] = ['categoria'=>$item['categoria'],'icono'=>$item['icono']];
          return $result;
      }, array());
      return $assoc_cats;
    }

}
