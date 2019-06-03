@extends('admin.layout.index')

@section('title')
    Administración | Envío regular
@endsection

@section('page-header')
            Envío regular
@endsection

@section('content')
  <style media="screen">
  .s7-date:before {
  content: "\e660";
}
  </style>




  <div class="row">
    <div class="col-md-12">
      <div class="panel panel-default">
        <div class="panel-heading">
          <h3>Detalle del ID Envío regular: {{$model->id}}</h3>
        </div>
        <div class="panel-body">
          <div style="border-radius: 0px;" class="form-horizontal group-border-dashed">
            {!! Form::model($model,[
            'method' => 'POST',
            'id' => 'frmBanner',
            'enctype' => 'multipart/form-data',
            'novalidate'=>"novalidate"
            ]) !!}



            <div class="form-group">
                <label class="col-sm-3 control-label">
                    Origen calle
                </label>
                <div class="col-md-6 value-label">
                    {{$model->origen_calle}}
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-3 control-label">
                    Origen Dirección
                </label>
                <div class="col-md-6 value-label">
                    {{$model->origen_direccion_full}}
                </div>
            </div>


            <div class="form-group">
                <label class="col-sm-3 control-label">
                    Origen interior
                </label>
                <div class="col-md-6 value-label">
                    {{$model->origen_interior}}
                </div>
            </div>



            <div class="form-group">
                <label class="col-sm-3 control-label">
                    Origen referencia
                </label>
                <div class="col-md-6 value-label">
                    {{$model->origen_referencia}}
                </div>
            </div>



            <div class="form-group">
                <label class="col-sm-3 control-label">
                    Nombre remitente
                </label>
                <div class="col-md-6 value-label">
                    {{$model->origen_remitente}}
                </div>
            </div>



            <div class="form-group">
                <label class="col-sm-3 control-label">
                    Remitente celular
                </label>
                <div class="col-md-6 value-label">
                    {{$model->origen_celular}}
                </div>
            </div>

            <div class="form-group  {{ $errors->has('origen_documento')?'has-danger':''}}">
                <label class="col-sm-3 control-label">
                    Remitente documento
                </label>
                <div class="col-md-6">
                    {!! Form::text('origen_documento',null,[
                          'class' => 'form-control m-input',
                          'placelholder' => ''
                      ]) !!}

                    <div id="subtitulo-error" class="form-control-notice">
                        {!! $errors->first('origen_documento') !!}
                    </div>
                </div>
            </div>
            <div class="form-group  {{ $errors->has('codigo_postal')?'has-danger':''}}">
                <label class="col-sm-3 control-label">
                    Codigo postal
                </label>
                <div class="col-md-6">
                    {!! Form::text('codigo_postal',null,[
                          'class' => 'form-control m-input',
                          'placelholder' => ''
                      ]) !!}

                    <div id="subtitulo-error" class="form-control-notice">
                        {!! $errors->first('codigo_postal') !!}
                    </div>
                </div>
            </div>



            <div class="form-group">
                <label class="col-sm-3 control-label">
                    Destino calle
                </label>
                <div class="col-md-6 value-label">
                    {{$model->destino_calle}}
                </div>
            </div>



            <div class="form-group">
                <label class="col-sm-3 control-label">
                    Destino dirección
                </label>
                <div class="col-md-6 value-label">
                    {{$model->destino_direccion_full}}
                </div>
            </div>



            <div class="form-group">
                <label class="col-sm-3 control-label">
                    Destino calle
                </label>
                <div class="col-md-6 value-label">
                    {{$model->destino_interior}}
                </div>
            </div>



            <div class="form-group">
                <label class="col-sm-3 control-label">
                    Destino referencia
                </label>
                <div class="col-md-6 value-label">
                    {{$model->destino_referencia}}
                </div>
            </div>



            <div class="form-group">
                <label class="col-sm-3 control-label">
                    Remitente nombre
                </label>
                <div class="col-md-6 value-label">
                    {{$model->destino_remitente}}
                </div>
            </div>



            <div class="form-group">
                <label class="col-sm-3 control-label">
                    Remitente celular
                </label>
                <div class="col-md-6 value-label">
                    {{$model->destino_celular}}
                </div>
            </div>



            <div class="form-group">
                <label class="col-sm-3 control-label">
                    Dimenciones envío - ancho
                </label>
                <div class="col-md-6 value-label">
                    {{$model->ancho}} cm.
                </div>
            </div>



            <div class="form-group">
                <label class="col-sm-3 control-label">
                    Dimenciones envío - altura
                </label>
                <div class="col-md-6 value-label">
                    {{$model->altura}} cm.
                </div>
            </div>



            <div class="form-group">
                <label class="col-sm-3 control-label">
                    Dimenciones envío - profundidad
                </label>
                <div class="col-md-6 value-label">
                    {{$model->profundidad}} cm.
                </div>
            </div>



            <div class="form-group">
                <label class="col-sm-3 control-label">
                  Envío - peso
                </label>
                <div class="col-md-6 value-label">
                    {{$model->peso}} kg.
                </div>
            </div>



            <div class="form-group">
                <label class="col-sm-3 control-label">
                    Envío tiempo
                </label>
                <div class="col-md-6 value-label">
                    {{$model->tiempo}}
                </div>
            </div>



            <div class="form-group">
                <label class="col-sm-3 control-label">
                    Costo total
                </label>
                <div class="col-md-6 value-label">
                    S/.{{$model->costo_total}}
                </div>
            </div>



            <div class="form-group">
                <label class="col-sm-3 control-label">
                    Cupon de descuento
                </label>
                <div class="col-md-6 value-label">
                    {{$model->cupon_descuento}}
                </div>
            </div>



            <div class="form-group">
                <label class="col-sm-3 control-label">
                    Tarjeta
                </label>
                <div class="col-md-6 value-label">
                    {{$model->tarjeta_id}}
                </div>
            </div>



            <div class="form-group">
                <label class="col-sm-3 control-label">
                    Usuario
                </label>
                <div class="col-md-6 value-label">
                    {{$model->usuario_id}}
                </div>
            </div>


            <div class="form-group">
                <label class="col-sm-3 control-label">
                    Usuario Nombre
                </label>
                <div class="col-md-6 value-label">
                    {{$model->usuario_nombre}}
                </div>
            </div>
            <!-- add -->
            <div class="form-group  {{ $errors->has('tipo_origen')?'has-danger':''}}">
                <label class="col-sm-3 control-label">
                    Tipo origen
                </label>
                <div class="col-md-6">

                      {!! Form::select('tipo_origen',
                              [
                                ''=>'Seleccionar',
                                'Dirección',
                                'Punto Scharff'
                              ],null,[
                            'class' => 'form-control m-input',
                            'placelholder' => ''
                        ]) !!}

                    <div id="subtitulo-error" class="form-control-notice">
                        {!! $errors->first('tipo_origen') !!}
                    </div>
                </div>
            </div>
            <div class="form-group  {{ $errors->has('id_origen_punto_scharff')?'has-danger':''}}">
                <label class="col-sm-3 control-label">
                    ID punto origen scharff
                </label>
                <div class="col-md-6">
                    {!! Form::number('id_origen_punto_scharff',null,[
                          'class' => 'form-control m-input',
                          'min' => '0',
                          'max' => '9999',
                          'placelholder' => ''
                      ]) !!}

                    <div id="subtitulo-error" class="form-control-notice">
                        {!! $errors->first('id_origen_punto_scharff') !!}
                    </div>
                </div>
            </div>
            <div class="form-group  {{ $errors->has('tipo_destino')?'has-danger':''}}">
                <label class="col-sm-3 control-label">
                    Tipo destino
                </label>
                <div class="col-md-6">

                      {!! Form::select('tipo_destino',
                              [
                                ''=>'Seleccionar',
                                'Dirección',
                                'Punto Scharff'
                              ],null,[
                            'class' => 'form-control m-input',
                            'placelholder' => ''
                        ]) !!}
                    <div id="subtitulo-error" class="form-control-notice">
                        {!! $errors->first('tipo_destino') !!}
                    </div>
                </div>
            </div>
            <div class="form-group  {{ $errors->has('tipo_destino')?'has-danger':''}}">
                <label class="col-sm-3 control-label">
                    Tipo de embalaje
                </label>
                <div class="col-md-6">

                      {!! Form::select('tipo_embalaje',
                              [
                                NULL=>'Seleccionar',
                                1=>'Sobre',
                                2=>'Paquete'
                              ],null,[
                            'class' => 'form-control m-input',
                            'placelholder' => ''
                        ]) !!}
                    <div id="subtitulo-error" class="form-control-notice">
                        {!! $errors->first('tipo_destino') !!}
                    </div>
                </div>
            </div>
            <div class="form-group  {{ $errors->has('id_destino_punto_scharff')?'has-danger':''}}">
                <label class="col-sm-3 control-label">
                    ID punto destino scharff
                </label>
                <div class="col-md-6">
                    {!! Form::number('id_destino_punto_scharff',null,[
                          'class' => 'form-control m-input',
                          'min' => '0',
                          'max' => '9999',
                          'placelholder' => ''
                      ]) !!}

                    <div id="subtitulo-error" class="form-control-notice">
                        {!! $errors->first('id_destino_punto_scharff') !!}
                    </div>
                </div>
            </div>
            <div class="form-group  {{ $errors->has('valor_paquete')?'has-danger':''}}">
                <label class="col-sm-3 control-label">
                    Valor del paquete
                </label>
                <div class="col-md-6">
                    {!! Form::number('valor_paquete',null,[
                          'class' => 'form-control m-input',
                          'min' => '0',
                          'placelholder' => ''
                      ]) !!}

                    <div id="subtitulo-error" class="form-control-notice">
                        {!! $errors->first('valor_paquete') !!}
                    </div>
                </div>
            </div>
            <div class="form-group  {{ $errors->has('sexo')?'has-danger':''}}">
                <label class="col-sm-3 control-label">
                    Seguro
                </label>
                <div class="col-md-6">
                  {!! Form::select('seguro_envio_check',
                          [
                            'Sin seguro',
                            'Con seguro'
                          ],null,[
                        'class' => 'form-control m-input',
                        'placelholder' => ''
                    ]) !!}

                    <div id="subtitulo-error" class="form-control-notice">
                        {!! $errors->first('seguro_envio_check') !!}
                    </div>
                </div>
            </div>
            <div class="form-group  {{ $errors->has('metodo_pago')?'has-danger':''}}">
                <label class="col-sm-3 control-label">
                    Método de pago
                </label>
                <div class="col-md-6">
                  {!! Form::text('metodo_pago',null,[
                        'class' => 'form-control m-input',
                        'placelholder' => ''
                    ]) !!}

                    <div id="subtitulo-error" class="form-control-notice">
                        {!! $errors->first('metodo_pago') !!}
                    </div>
                </div>
            </div>
            <div class="form-group  {{ $errors->has('medio_pago')?'has-danger':''}}">
                <label class="col-sm-3 control-label">
                    Medio de pago
                </label>
                <div class="col-md-6">
                  {!! Form::text('medio_pago',null,[
                        'class' => 'form-control m-input',
                        'placelholder' => ''
                    ]) !!}

                    <div id="subtitulo-error" class="form-control-notice">
                        {!! $errors->first('medio_pago') !!}
                    </div>
                </div>
            </div>

            <div class="form-group  {{ $errors->has('regular_codetracking')?'has-danger':''}}">
                <label class="col-sm-3 control-label">
                    Código de rastreo
                </label>
                <div class="col-md-6">
                  {!! Form::text('regular_codetracking',null,[
                        'class' => 'form-control m-input',
                        'placelholder' => '',
                        'id' => 'regular_codetracking'
                    ]) !!}


                    <div id="subtitulo-error" class="form-control-notice">
                        {!! $errors->first('regular_codetracking') !!}
                    </div>
                </div>
            </div>

{{--
            <input type="text" id="asignado_tracking" name="asignado_tracking" value="0"> --}}


            <div class="row">
              <div class="text-inverse col-md-9">
                  <button type="submit" id="elqueenvia" class="btn btn-space btn-primary">
                      <span class="btn-label">
                          <i class="fa fa-check"></i>
                      </span>
                      Guardar
                  </button>

                  <a href="{{ route('adm.regular.index') }}" class="btn btn-space btn-default">
                          <span class="btn-label">
                              <i class="fa fa-times"></i>
                          </span>
                      Cancelar
                  </a>
              </div>
            </div>
            {!! Form::close() !!}
            <!-- add -->

          </div>

        </div>
      </div>
    </div>
  </div>

<input type="text" name="" id="regular_codetracking_bk" value="{{$model->regular_codetracking}}">

  <div class="modal fade" id="modal-enviar-tracking" role="dialog">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header" style="border-bottom: 1px solid #e68e8e;">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Aviso</h4>
        </div>
        <div class="modal-body">
          <p>Estás asignando un número de rastreo, se enviará un correo electrónico al cliente con dicho número.</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-primary btn-aceptar-tracking"><span> Aceptar</span></button>
          <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button><br>
          <span class="infoCargo"></span>
        </div>
      </div>
    </div>
  </div>

@endsection



@section('script')
        <script type="text/javascript">

            //
            // toastr.options = {
            //     "closeButton": false,
            //     "debug": false,
            //     "newestOnTop": false,
            //     "progressBar": false,
            //     "positionClass": "toast-top-right",
            //     "preventDuplicates": false,
            //     "onclick": null,
            //     "showDuration": "350",
            //     "hideDuration": "1000",
            //     "timeOut": "5000",
            //     "extendedTimeOut": "1000",
            //     "showEasing": "swing",
            //     "hideEasing": "linear",
            //     "showMethod": "fadeIn",
            //     "hideMethod": "fadeOut"
            // };
            //
            // @if(session('mensaje'))
            // toastr.success('{{session('mensaje')}}');
            // @endif

            $(function () {
                $('.datepicker').datetimepicker({
                    todayHighlight: true,
                    autoclose: true,
                    pickerPosition: 'bottom-left',
                    format: 'yyyy-mm-dd hh:ii:00',
                    clearBtn: true,

                });
            });

            $(document).ready(function(){
              // $('#frmBanner').on('submit',function(){
              //
              //   $('#modal-enviar-tracking').modal();
              //   return false;
              // })

              //$('#asignado_tracking').val('0');
              $('#elqueenvia').on('click',function(){
                if($('#regular_codetracking').val()!==$('#regular_codetracking_bk').val()){
                  $('#modal-enviar-tracking').modal();
                  return false;
                }
              });
              $('.btn-aceptar-tracking').on('click',function(){
                //$('#asignado_tracking').val('1');

                $('#frmBanner').submit();
                console.log(4);
              });
            });
    </script>
@endsection
