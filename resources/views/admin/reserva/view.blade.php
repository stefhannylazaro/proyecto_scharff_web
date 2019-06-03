@extends('admin.layout.index')

@section('title')
    Administración | Reserva Locker
@endsection

@section('page-header')
            Reserva Locker
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
          <h3>Detalle del ID RESERVA: {{$model->id}}</h3>
        </div>
        <div class="panel-body">
          <div style="border-radius: 0px;" class="form-horizontal group-border-dashed">
            {!! Form::model($model,[
            'method' => 'POST',
            'id' => 'frmBanner',
            'enctype' => 'multipart/form-data',
            'novalidate'=>"novalidate"
            ]) !!}



            <div class="form-group  {{ $errors->has('articulo')?'has-danger':''}}">
                <label class="col-sm-3 control-label">
                    Articulo
                </label>
                <div class="col-md-6">
                    {!! Form::text('articulo',null,[
                          'class' => 'form-control m-input',
                          'placelholder' => ''
                      ]) !!}

                    <div id="subtitulo-error" class="form-control-notice">
                        {!! $errors->first('articulo') !!}
                    </div>
                </div>

            </div>

            <div class="form-group  {{ $errors->has('codigo_recojo')?'has-danger':''}}">
                <label class="col-sm-3 control-label">
                    Código Recojo
                </label>
                <div class="col-md-6">
                    {!! Form::text('codigo_recojo',null,[
                          'class' => 'form-control m-input',
                          'placelholder' => ''
                      ]) !!}

                    <div id="subtitulo-error" class="form-control-notice">
                        {!! $errors->first('codigo_recojo') !!}
                    </div>
                </div>
            </div>

            <div class="form-group  {{ $errors->has('estado')?'has-danger':''}}">
                <label class="col-sm-3 control-label">
                    Estado
                </label>
                <div class="col-md-6">
                    {!! Form::select('estado',
                            [
                              '1'=> 'RESERVA SOLICITADA',
                              '2'=> 'PAQUETE RECOGIDO',
                              '3'=> 'RESERVA CONFIRMADA',
                              '4'=> 'RESERVA RECHAZADA',
                              '5'=> 'ENTREGADA (CLIENTE)',
                              '6'=> 'ENTREGA SCHARFF',
                              '7'=> 'RETIRADA (CLIENTE)',
                              '8'=> 'RETIRO SCHARFF',
                              '9'=> 'CANCELADA POR RETIRAR',
                              '10'=> 'CANCELADA',
                              '11'=> 'ENTREGA VENCIDA',
                              '12'=> 'RECOJO VENCIDO POR RETIRAR',
                              '13'=> 'RECOJO VENCIDO RETIRADO',
                              '14'=> 'ENTREGADA EN DOMICILIO'
                            ],null,[
                          'class' => 'form-control m-input',
                          'placelholder' => ''
                      ]) !!}

                    <div id="slug-error" class="form-control-notice">
                        {!! $errors->first('estado') !!}
                    </div>
                </div>

            </div>

            <div class="form-group ">
                <label class="col-sm-3 control-label">
                    Fecha solicitud
                </label>
                <div class="col-md-6 value-label">
                    {{$model->created_at}}
                </div>

            </div>

            <div class="form-group  {{ $errors->has('fecha_reserva')?'has-danger':''}}">
                <label class="col-sm-3 control-label">
                    Fecha Reserva
                </label>
                <div class="col-md-2 input-group date datepicker" style="padding-left: 15px;">
                    {!! Form::text('fecha_reserva',null,[
                         'class' => 'form-control',
                         'readonly' => 'readonly',
                         'placelholder' => '',
                     ]) !!}
                    <span class="input-group-addon">
                        <i class="glyphicon-th icon-th s7-date"></i>
                    </span>



                    <div id="subtitulo-error" class="form-control-notice">
                        {!! $errors->first('fecha_reserva') !!}
                    </div>
                </div>

            </div>

            <div class="form-group  {{ $errors->has('fecha_entrega')?'has-danger':''}}">
                <label class="col-sm-3 control-label">
                    Fecha Entrega
                </label>
                <div class="col-sm-2 input-group date datepicker" style="padding-left: 15px;">
                    {!! Form::text('fecha_entrega',null,[
                         'class' => 'form-control',
                         'readonly' => 'readonly',
                         'placelholder' => '',
                     ]) !!}
                    <span class="input-group-addon">
                        <i class="glyphicon-th icon-th s7-date"></i>
                    </span>



                    <div id="subtitulo-error" class="form-control-notice">
                        {!! $errors->first('fecha_entrega') !!}
                    </div>
                </div>

            </div>

            <div class="form-group  {{ $errors->has('fecha_recojo')?'has-danger':''}}">
                <label class="col-sm-3 control-label">
                    Fecha Recojo
                </label>
                <div class="col-md-2 input-group date datepicker" style="padding-left: 15px;">

                    {!! Form::text('fecha_recojo',null,[
                          'class' => 'form-control',
                          'readonly' => 'readonly',
                          'placelholder' => ''
                      ]) !!}
                    <span class="input-group-addon">
                        <i class="glyphicon-th icon-th s7-date"></i>
                    </span>

                    <div id="subtitulo-error" class="form-control-notice">
                        {!! $errors->first('fecha_recojo') !!}
                    </div>
                </div>

            </div>


            <div class="form-group  {{ $errors->has('tiempo_espera_recojo')?'has-danger':''}}">
                <label class="col-sm-3 control-label">
                    Tiempo espera Recojo (horas)
                </label>
                <div class="col-md-6">
                    {!! Form::number('tiempo_espera_recojo',null,[
                          'class' => 'form-control m-input',
                          'min' => '0',
                          'max' => '9999',
                          'placelholder' => ''
                      ]) !!}

                    <div id="subtitulo-error" class="form-control-notice">
                        {!! $errors->first('tiempo_espera_recojo') !!}
                    </div>
                </div>
            </div>

            <div class="form-group  {{ $errors->has('tiempo_espera_entrega')?'has-danger':''}}">
                <label class="col-sm-3 control-label">
                    Tiempo espera Entrega (horas)
                </label>
                <div class="col-md-6">
                    {!! Form::number('tiempo_espera_entrega',null,[
                          'class' => 'form-control m-input',
                          'min' => '0',
                          'max' => '9999',
                          'placelholder' => ''
                      ]) !!}

                    <div id="subtitulo-error" class="form-control-notice">
                        {!! $errors->first('tiempo_espera_entrega') !!}
                    </div>
                </div>
            </div>
            <!-- add  -->
            <div class="form-group ">
                <label class="col-sm-3 control-label">
                    ID boxeway
                </label>
                <div class="col-md-6 value-label">
                    {{$model->id_op_boxeway}}
                </div>

            </div>
            <div class="form-group  {{ $errors->has('plazo_reserva')?'has-danger':''}}">
                <label class="col-sm-3 control-label">
                    Plazo reserva (horas)
                </label>

                <div class="col-md-6">
                      {!! Form::select('plazo_reserva',
                              [
                                ''=> 'Seleccionar',
                                '1'=> '24 Hr',
                                '2'=> '48 Hr'
                              ],null,[
                            'class' => 'form-control m-input',
                            'placelholder' => ''
                        ]) !!}



                    <div id="subtitulo-error" class="form-control-notice">
                        {!! $errors->first('plazo_reserva') !!}
                    </div>
                </div>
            </div>
            <div class="form-group  {{ $errors->has('tipo_retiro')?'has-danger':''}}">
                <label class="col-sm-3 control-label">
                    Tipo retiro
                </label>
                <div class="col-md-6">

                      {!! Form::select('tipo_retiro',
                              [
                                ''=> 'Seleccionar',
                                'Delivery a domicilio',
                                'Otro locker',
                                'Mismo locker'
                              ],null,[
                            'class' => 'form-control m-input',
                            'placelholder' => ''
                        ]) !!}

                    <div id="subtitulo-error" class="form-control-notice">
                        {!! $errors->first('tipo_retiro') !!}
                    </div>
                </div>
            </div>
            <div class="form-group  {{ $errors->has('direccion_destino')?'has-danger':''}}">
                <label class="col-sm-3 control-label">
                    Dirección destino
                </label>
                <div class="col-md-6">
                    {!! Form::text('direccion_destino',null,[
                          'class' => 'form-control m-input',
                          'placelholder' => ''
                      ]) !!}

                    <div id="subtitulo-error" class="form-control-notice">
                        {!! $errors->first('direccion_destino') !!}
                    </div>
                </div>
            </div>
            <div class="form-group  {{ $errors->has('provincia_destino')?'has-danger':''}}">
                <label class="col-sm-3 control-label">
                    Provincia destino
                </label>
                <div class="col-md-6">
                    {!! Form::text('provincia_destino',null,[
                          'class' => 'form-control m-input',
                          'placelholder' => ''
                      ]) !!}

                    <div id="subtitulo-error" class="form-control-notice">
                        {!! $errors->first('provincia_destino') !!}
                    </div>
                </div>
            </div>
            <div class="form-group  {{ $errors->has('departamento_destino')?'has-danger':''}}">
                <label class="col-sm-3 control-label">
                    Departamento destino
                </label>
                <div class="col-md-6">
                    {!! Form::text('departamento_destino',null,[
                          'class' => 'form-control m-input',
                          'placelholder' => ''
                      ]) !!}

                    <div id="subtitulo-error" class="form-control-notice">
                        {!! $errors->first('departamento_destino') !!}
                    </div>
                </div>
            </div>

            <div class="form-group  {{ $errors->has('fecha_vencimiento_entrega')?'has-danger':''}}">
                <label class="col-sm-3 control-label">
                    Fecha de vencimiento para entrega
                </label>
                <div class="col-sm-2 input-group date datepicker" style="padding-left: 15px;">
                    {!! Form::text('fecha_vencimiento_entrega',null,[
                         'class' => 'form-control',
                         'readonly' => 'readonly',
                         'placelholder' => '',
                     ]) !!}
                    <span class="input-group-addon">
                        <i class="glyphicon-th icon-th s7-date"></i>
                    </span>

                    <div id="subtitulo-error" class="form-control-notice">
                        {!! $errors->first('fecha_vencimiento_entrega') !!}
                    </div>
                </div>
            </div>
            <div class="form-group  {{ $errors->has('fecha_vencimiento_recojo')?'has-danger':''}}">
                <label class="col-sm-3 control-label">
                    Fecha de vencimiento para recojo
                </label>
                <div class="col-sm-2 input-group date datepicker" style="padding-left: 15px;">
                    {!! Form::text('fecha_vencimiento_recojo',null,[
                         'class' => 'form-control',
                         'readonly' => 'readonly',
                         'placelholder' => '',
                     ]) !!}
                    <span class="input-group-addon">
                        <i class="glyphicon-th icon-th s7-date"></i>
                    </span>

                    <div id="subtitulo-error" class="form-control-notice">
                        {!! $errors->first('fecha_vencimiento_recojo') !!}
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
            <!-- add  -->

            <div class="row">
              <div class="text-inverse col-md-9">
                  <button type="submit" class="btn btn-space btn-primary">
                      <span class="btn-label">
                          <i class="fa fa-check"></i>
                      </span>
                      Guardar
                  </button>

                  <a href="{{ route('adm.reserva.index') }}" class="btn btn-space btn-default">
                          <span class="btn-label">
                              <i class="fa fa-times"></i>
                          </span>
                      Cancelar
                  </a>
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
    </script>
@endsection
