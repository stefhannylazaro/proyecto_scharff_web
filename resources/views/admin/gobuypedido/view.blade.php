@extends('admin.layout.index')

@section('title')
    Administración | Pedido go & buy | Editar
@endsection

@section('page-header')
            Editar pedido go & buy
@endsection

@section('content')
  <style media="screen">
  .s7-date:before {
  content: "\e660";
  }
  .date.datepicker input{
  background: #fff;
  }
  </style>
  <div class="row">
    <div class="col-md-12">
      <div class="panel panel-default">
        <div class="panel-heading">
          <h3>Editar pedido go & buy ID: <span class="gobuy-id">{{$model->gobuy_id}}</span></h3>
        </div>
        <div class="panel-body">
          <div style="border-radius: 0px;" class="form-horizontal group-border-dashed">
            {!! Form::model($model,[
            'method' => 'POST',
            'id' => 'frmBanner',
            'enctype' => 'multipart/form-data',
            'novalidate'=>"novalidate"
            ]) !!}


            @include('admin.gobuypedido.fields')

            <div class="row">
              <span hidden class="id-estado">{{$model->gobuy_estado}}</span>
              @if($model->gobuy_estado==3)
              <div class="col-md-3">
                <button type="button" class="btn btn-space btn-primary btn-modal-devolver">
                    Devolver
                </button>
              </div>
              @endif


              <div class="col-sm-6" style="display:none">
                {!! Form::text('gobuy_estado',null,[
                'class' => 'form-control m-input',
                'id' => 'gobuy_estado',
                'readonly' => 'readonly',
                'placelholder' => ''
                ]) !!}
              </div>
              <div class="text-inverse col-md-9">
                  <button type="submit" class="btn btn-space btn-primary btn-save">
                      <span class="btn-label">
                          <i class="fa fa-check"></i>
                      </span>
                      Guardar
                  </button>

                  <a href="{{ route('adm.gobuypedido.type',$model->gobuy_estado) }}" class="btn btn-space btn-default">
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

  <!-- Modal update pedido en elmacén-->
  <div class="modal fade" id="modal-actualizar-pedido" role="dialog">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header" style="border-bottom: 1px solid #e68e8e;">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Aviso</h4>
        </div>
        <div class="modal-body">
          <p>¿Estas seguro de guardar el registro? Se <span class="text-action"></span> <span class="text-mount"></span> USD$ al cliente <span class=""></span></p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-primary btn-actualizar-pedido"><span> Aceptar</span></button>
          <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button><br>
          <span class="infoCargo"></span>
        </div>
      </div>
    </div>
  </div>

  <!-- Modal update pedido en elmacén-->
  <div class="modal fade" id="modal-devolucion" role="dialog">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header" style="border-bottom: 1px solid #e68e8e;">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Devolución de dinero</h4>
        </div>
        <div class="modal-body">
          <div class="row">
              <label class="col-sm-5 value-label-other">
                  Ingrese el monto a devolver
              </label>
              <div class="col-sm-6 value-label-other">
                <input type="text" name="" value="" class="other-monto-extra">
              </div>
          </div>
        </div>


        <div class="modal-footer">
          <button type="button" class="btn btn-primary btn-devolucion"><span> Aceptar</span></button>
          <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button><br>
          <span class="infoCargo"></span>
        </div>
      </div>
    </div>
  </div>


@endsection

@section('script')
    <script type="text/javascript">
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

            $('.datepicker').datetimepicker({
                todayHighlight: true,
                autoclose: true,
                pickerPosition: 'bottom-left',
                format: 'yyyy-mm-dd hh:ii:00',
                clearBtn: true,

            });
            $('#editor1a').summernote({
              height: 300
            });
            $('#frmBanner').submit(function() {
              var bbbb = $("#editor1a").code();
              $('#descripcion').val(bbbb);
            });

            //almacen******************
            $('.btn-save').on('click',function(){
              $('.infoCargo').text('');
              $(".btn-actualizar-pedido>i").remove();
              $(".btn-actualizar-pedido").attr("disabled",false);
              // $('#mensajito').html('');
              // var a = $("#gobuy_pesoconsolidado").val();
              // var isnum =/^\d+(\.\d{1,2})?$/.test(a);
              // if(a=="" ||  a==0 || a=='0'  || a=='0.00' || !isnum){
              //     $('#mensajito').html("Para poder calcular la tarifa, ingrese un peso consolidado válido");
              //     return false;
              // }

              var costo_extra=$('#gobuy_montoextra').val();
              if($('.id-estado').text()==3 && costo_extra!=0 &&  $('#gobuy_costoreal_origen').text()!=$('#gobuy_costoreal').val() ) {

                $('#modal-actualizar-pedido').modal();
                $('.infoCargo').text('');
                $('.text-mount').text(costo_extra);
                if(costo_extra>0) {
                  $('.text-action').text('cobrará');
                } else {
                  $('.text-action').text('devolverá');
                }


                //**boton modal
                return false;
              }

            });


            //**boton modal
            $('.btn-actualizar-pedido').on('click',function(){

                costo_extra=$('#gobuy_montoextra').val();
                if(costo_extra!=0){
                  getInfo(function(){
                    if(costo_extra>0) {//cobrar
                      //console.log('1. cobrarrrrr');
                      $.ajax({
                            url:scharff_api+"gobuypedido/cargo-pedidoextra?token="+localStorage.getItem("token_value"),
                            data : {
                               costo_extra: costo_extra,
                               gobuy_id: $('.gobuy-id').text()
                            },
                            type : 'post',
                            dataType : 'json',
                            headers: {
                              "Authorization": "Basic " + btoa("admin@pickapp.com" + ":" + "PickJanaq18")
                            },
                            beforeSend: function(){
                              $(".btn-actualizar-pedido i").remove();
                              $('.btn-actualizar-pedido').prepend('<i class="fa fa-spinner fa-spin"></i>').attr("disabled",true);
                            },
                            success : function(data) {
                              $('.infoCargo').text('');
                              $(".btn-actualizar-pedido").attr("disabled",false);
                              $(".btn-actualizar-pedido>i").remove();
                              if(data.tipo==1) {
                                $('#gobuy_montoextra').val(0);//resetear caja
                                $('#modal-actualizar-pedido').modal('hide');
                                console.log('pago guardado');
                                $('#frmBanner').submit();
                              } else {
                                $('.infoCargo').text(data.mensajes[0]);
                              }
                            },
                      });
                    } else {//devolver
                      //console.log('2. devolverrrr');
                      $.ajax({
                            url:scharff_api+"gobuypedido/devolucion-pedidoextra?token="+localStorage.getItem("token_value"),
                            data : {
                               costo_extra: costo_extra*-1,
                               gobuy_id: $('.gobuy-id').text()
                            },
                            type : 'post',
                            dataType : 'json',
                            headers: {
                              "Authorization": "Basic " + btoa("admin@pickapp.com" + ":" + "PickJanaq18")
                            },
                            beforeSend: function(){
                              $(".btn-actualizar-pedido i").remove();
                              $('.btn-actualizar-pedido').prepend('<i class="fa fa-spinner fa-spin"></i>').attr("disabled",true);
                            },
                            success : function(data) {
                              $('.infoCargo').text('');
                              $(".btn-actualizar-pedido").attr("disabled",false);
                              $(".btn-actualizar-pedido>i").remove();
                              if(data.tipo==1) {
                                $('#modal-actualizar-pedido').modal('hide');
                                $('#gobuy_montoextra').val(0);//resetear caja
                                $('#frmBanner').submit();
                              } else {
                                $('.infoCargo').text(data.mensajes[0]);
                              }
                            },
                      });
                    }
                  });

                } else {
                  $('.infoCargo').text("Monto no debe ser 0...");
                }
            });
            //almacen*******************
        })
        function getInfo(a){
          console.log('function');
          var token='';
          $.ajax({
                url:scharff_api+"usuario/get_info",
                data : {usuario_id: $('#usuario-id').text()},
                type : 'post',
                dataType : 'json',
                headers: {
                  "Authorization": "Basic " + btoa("admin@pickapp.com" + ":" + "PickJanaq18")
                },
                success : function(data) {
                  if(data.tipo==1) {
                    token=data.data.token_value;
                    localStorage.setItem("token_value", token);
                    a();
                  }
                },
          });
        }

        $('.btn-modal-devolver').on('click',function(){
          $('#modal-devolucion').modal();
        })
        $('.btn-devolucion').on('click',function(){
          var costo_extra=$('.other-monto-extra').val();
          $.ajax({
                url:scharff_api+"gobuypedido/devolucion-pedidoextra?token="+localStorage.getItem("token_value"),
                data : {
                   costo_extra: costo_extra,
                   gobuy_id: $('.gobuy-id').text()
                },
                type : 'post',
                dataType : 'json',
                headers: {
                  "Authorization": "Basic " + btoa("admin@pickapp.com" + ":" + "PickJanaq18")
                },
                beforeSend: function(){
                  $(".btn-devolucion i").remove();
                  $('.btn-devolucion').prepend('<i class="fa fa-spinner fa-spin"></i>').attr("disabled",true);
                },
                success : function(data) {
                  $('.infoCargo').text('');
                  $(".btn-devolucion").attr("disabled",false);
                  $(".btn-devolucion>i").remove();
                  if(data.tipo==1) {
                    $('.infoCargo').text(data.mensajes[0]);
                    setTimeout(function(){
                      location.reload();
                    }, 1000);
                    //$('#modal-devolucion').modal('hide');
                  } else {
                    $('.infoCargo').text(data.mensajes[0]);
                  }
                },
          });
        });

    </script>
@endsection
