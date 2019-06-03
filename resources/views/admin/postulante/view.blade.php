@extends('admin.layout.index')

@section('title')
    Postulante Scharffer
@endsection

@section('page-header')
            Postulante Scharffer
@endsection

@section('content')
  <div class="row">
    <div class="col-md-12">
      <div class="panel panel-default">
        <div class="panel-heading">
          <h3>Detalle del Postulante Scharff. ID : {{$model->id}}</h3>
        </div>
        <div class="panel-body">
          <div style="border-radius: 0px;" class="form-horizontal group-border-dashed">
            {!! Form::model($model,[
            'method' => 'POST',
            'id' => 'frmBanner',
            'enctype' => 'multipart/form-data',
            'novalidate'=>"novalidate"
            ]) !!}
            <div class="form-group  {{ $errors->has('nombre')?'has-danger':''}}">
                <label class="col-sm-3 control-label">
                    Nombre
                </label>
                <div class="col-md-6">
                    {!! Form::text('nombre',null,[
                          'class' => 'form-control m-input',
                          'placelholder' => ''
                      ]) !!}

                    <div id="subtitulo-error" class="form-control-notice">
                        {!! $errors->first('nombre') !!}
                    </div>
                </div>
            </div>


            <div class="form-group  {{ $errors->has('apellidos')?'has-danger':''}}">
                <label class="col-sm-3 control-label">
                    Apellidos
                </label>
                <div class="col-md-6">
                    {!! Form::text('apellidos',null,[
                          'class' => 'form-control m-input',
                          'placelholder' => ''
                      ]) !!}

                    <div id="subtitulo-error" class="form-control-notice">
                        {!! $errors->first('apellidos') !!}
                    </div>
                </div>
            </div>

            <div class="form-group  {{ $errors->has('correo')?'has-danger':''}}">
                <label class="col-sm-3 control-label">
                    Correo
                </label>
                <div class="col-md-6">
                    {!! Form::text('correo',null,[
                          'class' => 'form-control m-input',
                          'placelholder' => ''
                      ]) !!}

                    <div id="subtitulo-error" class="form-control-notice">
                        {!! $errors->first('correo') !!}
                    </div>
                </div>
            </div>

            <div class="form-group  {{ $errors->has('celular')?'has-danger':''}}">
                <label class="col-sm-3 control-label">
                    Celular
                </label>
                <div class="col-md-6">
                    {!! Form::text('celular',null,[
                          'class' => 'form-control m-input',
                          'placelholder' => ''
                      ]) !!}

                    <div id="subtitulo-error" class="form-control-notice">
                        {!! $errors->first('celular') !!}
                    </div>
                </div>
            </div>

            <div class="form-group  {{ $errors->has('fecha_nacimiento')?'has-danger':''}}">
                <label class="col-sm-3 control-label">
                    Fecha nacimiento
                </label>
                <div class="col-md-6">
                    {!! Form::text('fecha_nacimiento',null,[
                          'class' => 'form-control m-input',
                          'placelholder' => ''
                      ]) !!}

                    <div id="subtitulo-error" class="form-control-notice">
                        {!! $errors->first('fecha_nacimiento') !!}
                    </div>
                </div>
            </div>


            <div class="form-group {{ $errors->has('tipo_scharfer')?'has-danger':''}}">
                <label class="col-sm-3 control-label">
                    Tipo Scharffer 
                </label>
                <div class="col-md-6">
                  {!! Form::select('tipo_scharfer',
                          $tipos_scharfer_ar,null,[
                        'class' => 'form-control m-input',
                        'placelholder' => ''
                    ]) !!}


                    <div id="subtitulo-error" class="form-control-notice">
                        {!! $errors->first('tipo_scharfer') !!}
                    </div>
                </div>
            </div>

            <div class="form-group  {{ $errors->has('Dispositivo')?'has-danger':''}}">
                <label class="col-sm-3 control-label">
                    Dispositivo
                </label>
                <div class="col-md-6">
                    {!! Form::text('dispositivo',null,[
                      'class' => 'form-control m-input',
                      'placelholder' => ''
                      ]) !!}

                    <div id="subtitulo-error" class="form-control-notice">
                        {!! $errors->first('Dispositivo') !!}
                    </div>
                </div>
            </div>
            <div class="form-group  {{ $errors->has('dni')?'has-danger':''}}">
                <label class="col-sm-3 control-label">
                    DNI
                </label>
                <div class="col-md-6">
                    {!! Form::text('dni',null,[
                          'class' => 'form-control m-input',
                          'placelholder' => ''
                      ]) !!}

                    <div id="subtitulo-error" class="form-control-notice">
                        {!! $errors->first('dni') !!}
                    </div>
                </div>
            </div>
            <div class="form-group  {{ $errors->has('sexo')?'has-danger':''}}">
                <label class="col-sm-3 control-label">
                    Sexo
                </label>
                <div class="col-md-6">
                  {!! Form::select('sexo',
                          [
                            null=>"seleccionar",
                            'Masculino',
                            'Femenino'
                          ],null,[
                        'class' => 'form-control m-input',
                        'placelholder' => 'sss'
                    ]) !!}

                    <div id="subtitulo-error" class="form-control-notice">
                        {!! $errors->first('sexo') !!}
                    </div>
                </div>
            </div>
            <div class="form-group  {{ $errors->has('direccion')?'has-danger':''}}">
                <label class="col-sm-3 control-label">
                    Dirección
                </label>
                <div class="col-md-6">
                    {!! Form::text('direccion',null,[
                          'class' => 'form-control m-input',
                          'placelholder' => ''
                      ]) !!}

                    <div id="subtitulo-error" class="form-control-notice">
                        {!! $errors->first('direccion') !!}
                    </div>
                </div>
            </div>
            <div class="form-group  {{ $errors->has('direccion')?'has-danger':''}}">
                <label class="col-sm-3 control-label">
                    Distrito dirección
                </label>
                <div class="col-md-6">
                    {!! Form::text('distrito',null,[
                          'class' => 'form-control m-input',
                          'placelholder' => ''
                      ]) !!}

                    <div id="subtitulo-error" class="form-control-notice">
                        {!! $errors->first('direccion') !!}
                    </div>
                </div>
            </div>

            <div class="form-group  {{ $errors->has('zona')?'has-danger':''}}">
                <label class="col-sm-3 control-label">
                    Zona
                </label>
                <div class="col-md-6">
                    {!! Form::text('zona',null,[
                          'class' => 'form-control m-input',
                          'placelholder' => ''
                      ]) !!}

                    <div id="subtitulo-error" class="form-control-notice">
                        {!! $errors->first('zona') !!}
                    </div>
                </div>
            </div>
            <div class="form-group  {{ $errors->has('placa')?'has-danger':''}}">
                <label class="col-sm-3 control-label">
                    Placa
                </label>
                <div class="col-md-6">
                    {!! Form::text('placa',null,[
                          'class' => 'form-control m-input',
                          'placelholder' => ''
                      ]) !!}

                    <div id="subtitulo-error" class="form-control-notice">
                        {!! $errors->first('placa') !!}
                    </div>
                </div>
            </div>
            <div class="form-group  {{ $errors->has('banco')?'has-danger':''}}">
                <label class="col-sm-3 control-label">
                    Banco
                </label>
                <div class="col-md-6">
                    {!! Form::text('banco',null,[
                          'class' => 'form-control m-input',
                          'placelholder' => ''
                      ]) !!}

                    <div id="subtitulo-error" class="form-control-notice">
                        {!! $errors->first('banco') !!}
                    </div>
                </div>
            </div>
            <div class="form-group  {{ $errors->has('numero_cuenta')?'has-danger':''}}">
                <label class="col-sm-3 control-label">
                    Número de cuenta
                </label>
                <div class="col-md-6">
                    {!! Form::text('numero_cuenta',null,[
                          'class' => 'form-control m-input',
                          'placelholder' => ''
                      ]) !!}

                    <div id="subtitulo-error" class="form-control-notice">
                        {!! $errors->first('numero_cuenta') !!}
                    </div>
                </div>
            </div>
            <div class="form-group  {{ $errors->has('cci')?'has-danger':''}}">
                <label class="col-sm-3 control-label">
                    CCI
                </label>
                <div class="col-md-6">
                    {!! Form::text('cci',null,[
                          'class' => 'form-control m-input',
                          'placelholder' => ''
                      ]) !!}

                    <div id="subtitulo-error" class="form-control-notice">
                        {!! $errors->first('cci') !!}
                    </div>
                </div>
            </div>
            <div class="form-group  {{ $errors->has('ficha_datos')?'has-danger':''}}">
                <label class="col-sm-3 control-label">
                    Ficha datos
                </label>
                <div class="col-md-6">
                      {!! Form::select('ficha_datos',
                              [
                                null=>"seleccionar",
                                'Completada',
                                'No completada'
                              ],null,[
                            'class' => 'form-control m-input',
                            'placelholder' => ''
                        ]) !!}

                    <div id="subtitulo-error" class="form-control-notice">
                        {!! $errors->first('ficha_datos') !!}
                    </div>
                </div>
            </div>
            <div class="form-group  {{ $errors->has('validacion_datos')?'has-danger':''}}">
                <label class="col-sm-3 control-label">
                    Validación datos
                </label>
                <div class="col-md-6">
                      {!! Form::select('validacion_datos',
                              [
                                null=>"seleccionar",
                                'Aplica',
                                'No aplica'
                              ],null,[
                            'class' => 'form-control m-input',
                            'placelholder' => 'asdasd'
                        ]) !!}

                    <div id="subtitulo-error" class="form-control-notice">
                        {!! $errors->first('validacion_datos') !!}
                    </div>
                </div>
            </div>
            <div class="form-group  {{ $errors->has('motivo_rechazo')?'has-danger':''}}">
                <label class="col-sm-3 control-label">
                    Motivo rechazo
                </label>
                <div class="col-md-6">
                      {!! Form::select('motivo_rechazo',
                            [
                            null=>"seleccionar",
                            'Antescedentes',
                            'Datos no válidos',
                            'Otro'
                            ],null,[
                            'class' => 'form-control m-input',
                            'placelholder' => ''
                        ]) !!}

                    <div id="subtitulo-error" class="form-control-notice">
                        {!! $errors->first('motivo_rechazo') !!}
                    </div>
                </div>
            </div>
            <div class="form-group  {{ $errors->has('nota_evaluacion')?'has-danger':''}}">
                <label class="col-sm-3 control-label">
                    Nota Evaluación
                </label>
                <div class="col-md-6">
                    {!! Form::text('nota_evaluacion',null,[
                          'class' => 'form-control m-input',
                          'placelholder' => ''
                      ]) !!}

                    <div id="subtitulo-error" class="form-control-notice">
                        {!! $errors->first('nota_evaluacion') !!}
                    </div>
                </div>
            </div>
            <div class="form-group  {{ $errors->has('termino_condiciones')?'has-danger':''}}">
                <label class="col-sm-3 control-label">
                    Término & condiciones
                </label>
                <div class="col-md-6">
                      {!! Form::select('termino_condiciones',
                            [
                            null=>"seleccionar",
                            'Aceptó',
                            'No aceptó'
                            ],null,[
                            'class' => 'form-control m-input',
                            'placelholder' => ''
                        ]) !!}
                    <div id="subtitulo-error" class="form-control-notice">
                        {!! $errors->first('termino_condiciones') !!}
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
                        null=>"seleccionar",
                        'Activado',
                        'Desactivado'
                        ],null,[
                        'class' => 'form-control m-input',
                        'placelholder' => ''
                    ]) !!}

                    <div id="subtitulo-error" class="form-control-notice">
                        {!! $errors->first('estado') !!}
                    </div>
                </div>
            </div>
            <div class="form-group  {{ $errors->has('capacidad')?'has-danger':''}}">
                <label class="col-sm-3 control-label">
                    Capacidad
                </label>
                <div class="col-md-6">

                  {!! Form::select('capacidad',
                        [
                        null=>"seleccionar",
                        'Mochila',
                        'POS',
                        'Casaca'
                        ],null,[
                        'class' => 'form-control m-input',
                        'placelholder' => ''
                    ]) !!}


                    <div id="subtitulo-error" class="form-control-notice">
                        {!! $errors->first('capacidad') !!}
                    </div>
                </div>
            </div>
            <div class="form-group  {{ $errors->has('calificacion_estrella')?'has-danger':''}}">
                <label class="col-sm-3 control-label">
                    Calificación estrellas
                </label>
                <div class="col-md-6">

                      {!! Form::select('calificacion_estrella',
                            [
                            null=>"seleccionar",
                            '1',
                            '2',
                            '3',
                            '4',
                            '5'
                            ],null,[
                            'class' => 'form-control m-input',
                            'placelholder' => 'Estrellas'
                        ]) !!}
                    <div id="subtitulo-error" class="form-control-notice">
                        {!! $errors->first('calificacion_estrella') !!}
                    </div>
                </div>
            </div>
            <div class="form-group  {{ $errors->has('clave')?'has-danger':''}}">
                <label class="col-sm-3 control-label">
                    Clave
                </label>
                <div class="col-md-6">
                    {!! Form::text('clave',null,[
                          'class' => 'form-control m-input',
                          'placelholder' => ''
                      ]) !!}

                    <div id="subtitulo-error" class="form-control-notice">
                        {!! $errors->first('clave') !!}
                    </div>
                </div>
            </div>
            <div class="form-group  {{ $errors->has('mochila')?'has-danger':''}}">
                <label class="col-sm-3 control-label">
                    Mochila
                </label>
                <div class="col-md-6">
                    {!! Form::text('mochila',null,[
                          'class' => 'form-control m-input',
                          'placelholder' => ''
                      ]) !!}

                    <div id="subtitulo-error" class="form-control-notice">
                        {!! $errors->first('mochila') !!}
                    </div>
                </div>
            </div>
            <div class="form-group  {{ $errors->has('pos')?'has-danger':''}}">
                <label class="col-sm-3 control-label">
                    POS
                </label>
                <div class="col-md-6">
                    {!! Form::text('pos',null,[
                          'class' => 'form-control m-input',
                          'placelholder' => ''
                      ]) !!}

                    <div id="subtitulo-error" class="form-control-notice">
                        {!! $errors->first('pos') !!}
                    </div>
                </div>
            </div>



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
        //banner.init();
    </script>
@endsection
