@extends('admin.layout.index')

@section('title')
    Administración | Pedidos Go & Buy | Editar
@endsection

@section('page-header')
            Pedidos Go & Buy
@endsection

@section('content')
  <style media="screen">
  .s7-date:before {
    content: "\e660";
  }
  .datepicker input.form-control{
    background: #fff;
  }
  </style>
  <div class="row">
    <div class="col-md-12">
      <div class="panel panel-default">
        <div class="panel-heading">
          <h3>Crear GobuyPedido </h3>
        </div>
        <div class="panel-body">
          <div style="border-radius: 0px;" class="form-horizontal group-border-dashed">
            {!! Form::model(null,[
            'method' => 'POST',
            'id' => 'frmBanner',
            'enctype' => 'multipart/form-data',
            'novalidate'=>"novalidate"
            ]) !!}


            @include('admin.gobuypedido.fields')

            <div class="row">
              <div class="text-inverse col-md-9">
                  <button type="submit" class="btn btn-space btn-primary btn-save-new">
                      <span class="btn-label">
                          <i class="fa fa-check"></i>
                      </span>
                      Guardar
                  </button>

                  <a href="{{ route('adm.gobuypedido.index') }}" class="btn btn-space btn-default">
                          <span class="btn-label">
                              <i class="fa fa-times"></i>
                          </span>
                      Cancelar
                  </a>
                  <p id="mensajito"></p>
              </div>
            </div>

            {!! Form::close() !!}

          </div>

        </div>
      </div>
    </div>
  </div>




@endsection

@section('script')
    <script type="text/javascript">
      // $('#frmBanner').submit(function() {
      //   var a = $("#gobuy_pesoconsolidado").val();
      //   //var isnum = /^\d+$/.test(a);
      //   var isnum =/^\d+(\.\d{1,2})?$/.test(a);
      //   if(a=="" ||  a==0 || a=='0'  || a=='0.00' || !isnum){
      //     $('#mensajito').html("Para poder calcular la tarifa, ingrese un peso consolidado válido");
      //     return false;
      //   }
      //
      // });
      var scharff_api='';
      $(document).ready(function(){

        //**
        if(window.location.origin.indexOf("localhost") > -1) {
          scharff_api = 'http://localhost:8001/pickapp/api/v1/';
        } else {
          if(window.location.origin.indexOf("holascharff") > -1) {
            scharff_api = 'https://api.holascharff.com/pickapp/api/v1/';
          } else {
            scharff_api = 'https://schrf-api-dev.jnq.io/pickapp/api/v1/';
          }
        }
        //**
        $('.btn-save-new').on('click', function(){
          //
          console.log('asd');
          // return false;
          if($('#gobuy_valordeclarado').val()>0 && $('#gobuy_valordeclarado').val()!="") {

            $.ajax({
                  url:scharff_api+"gobuypedidos/createIn",
                  data : {
                      gobuy_valordeclarado: $('#gobuy_valordeclarado').val(),
                      gobuy_peso: $('#gobuy_peso').val(),
                      usuario_email: $('#usuario_email').val()
                  },
                  type : 'post',
                  dataType : 'json',
                  headers: {
                    "Authorization": "Basic " + btoa("admin@pickapp.com" + ":" + "PickJanaq18")
                  },
                  beforeSend: function(){
                    $(".btn-save-new i").remove();
                    $('.btn-save-new').prepend('<i class="fa fa-spinner fa-spin"></i>').attr("disabled",true);
                  },
                  success : function(data) {
                    console.log(data);
                    console.log(data.tipo);
                    // return false;
                    $(".btn-save-new").attr("disabled",false);
                    $(".btn-save-new>i").remove();
                    if(data.tipo==1) {
                      console.log('pago guardado');
                      //$('#frmBanner').submit();
                    } else {
                      return false;
                    }
                  },
            });
            return false;
          }

        });
      });
    </script>
@endsection
