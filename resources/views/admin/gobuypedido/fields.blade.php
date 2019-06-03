@if(isset($model))
    <!-- para editar -->
    <!-- <div class="form-group  {{ $errors->has('estado')?'has-danger':''}}">
        <label class="col-sm-3 control-label">
            Estado
        </label>
        <div class="col-md-6">
          {!! Form::select('gobuy_estado',
                  [
                    NULL=>"seleccionar",
                    0=>'Recibido',
                    1=>'Entregado',
                    2=>'En transito',
                    3=>'Llegada almacen'
                  ],null,[
                'class' => 'form-control m-input',
                'placelholder' => ''
            ]) !!}

            <div id="subtitulo-error" class="form-control-notice">
                {!! $errors->first('gobuy_estado') !!}
            </div>
        </div>
    </div> -->
    @php
      switch ($model->gobuy_estado) {

        case 0:
          $gobuy_estado = 'Registrado';
          break;
        case 1:
          $gobuy_estado = 'Recibido en Miami';
          break;
        case 2:
          $gobuy_estado = 'En tránsito';
          break;
        case 3:
          $gobuy_estado = 'En almacén Scharff (Lima)';
          break;
        case 4:
          $gobuy_estado = 'Entregado';
          break;
      }
    @endphp

    <div class="" hidden>
        <div class="col-sm-6">
          {!! Form::text('gobuy_cobrofinal',null,[
          'class' => 'form-control m-input',
          'id' => 'gobuy_cobrofinal'
          ]) !!}
        </div>
    </div>
    <div>
      <span hidden id="usuario-id">{{$model->usuario_id}}</span>
    </div>
    <div class="form-group {{ $errors->has('titulo')?'has-danger':''}}">
        <label class="col-sm-3 control-label">
            Estado:
        </label>
        <div class="col-md-6 value-label">
          <h3 style="margin: 0;">{{$gobuy_estado}}</h3>
        </div>
    </div><br>
    @if($model->gobuy_estado==3)
    <div class="form-group">
      <div class="col-sm-3">
      </div>
      <div class="col-sm-6">
        <div class="block-tarifador row">
          <div class="col-sm-12">
            <div class="col-sm-6">
              <div class="row mb-s">
                <label class="col-sm-5 value-label-other">
                    Valor declarado USD$
                </label>
                <div class="col-sm-6 value-label-other">
                    {{$model->gobuy_valordeclarado}}
                </div>
              </div>
              <div class="row mb-s">
                <label class="col-sm-5 value-label-other">
                    Peso declarado Kg
                </label>
                <div class="col-md-6 value-label-other">
                    {{$model->gobuy_peso}}
                </div>
              </div>
              <div class="row mb-s">
                <label class="col-sm-5 value-label-other">
                    Monto cobrado USD$
                </label>
                <div class="col-md-6 value-label-other" id="gobuy_costoenvio">
                    {{$model->gobuy_costoenvio}}
                </div>
              </div>
              <div class="row mb-s">
                <div class="col-md-12">
                  <button type="button" class="btn btn-space btn-costo-real btn-primary">Calcular</button>
                  <span hidden>{{ $model->gobuy_costoenvio }}</span>
                  <em id="msg-pc"></em>
                </div>
              </div>
            </div>
            <div class="col-sm-6">
              <div class="row mb-s">
                <label class="col-sm-5 value-label-other">
                    Valor real USD$
                </label>
                <div class="col-sm-6">
                  {!! Form::text('gobuy_valorreal',null,[
                  'class' => 'form-control m-input',
                  'id' => 'gobuy_valorreal',
                  'placelholder' => ''
                  ]) !!}
                </div>
              </div>
              <div class="row mb-s">
                <label class="col-sm-5 value-label-other">
                    Peso real Kg
                </label>
                <div class="col-sm-6">
                  {!! Form::text('gobuy_pesoreal',null,[
                  'class' => 'form-control m-input',
                  'id' => 'gobuy_pesoreal',
                  'placelholder' => ''
                  ]) !!}
                </div>
              </div>
              <div class="row mb-s">
                <label class="col-sm-5 value-label-other">
                    Impuestos $
                </label>
                <div class="col-sm-6">
                  {!! Form::text('gobuy_impuesto',null,[
                  'class' => 'form-control m-input',
                  'id' => 'gobuy_impuesto',
                  'placelholder' => ''
                  ]) !!}
                </div>
              </div>
              <div class="row mb-s">
                <label class="col-sm-5 value-label-other">
                    Monto real USD$
                </label>
                <span hidden id="gobuy_costoreal_origen">{{$model->gobuy_costoreal}}</span>
                <div class="col-sm-6">
                  {!! Form::text('gobuy_costoreal',null,[
                  'class' => 'form-control m-input',
                  'id' => 'gobuy_costoreal',
                  'readonly' => 'readonly',
                  'placelholder' => ''
                  ]) !!}
                </div>
              </div>
          </div>

          </div>
        </div>
      </div>

    </div>
    @endif
    <div class="form-group {{ $errors->has('gobuy_montoextra')?'has-danger':''}}">
        <label class="col-sm-3 control-label">
            Saldo a cobrar USD$
        </label>
        <label hidden id="monto-extra">{{ $model->gobuy_montoextra }}</label>
        <div class="col-md-6">
            {!! Form::text('gobuy_montoextra',null,[
            'class' => 'form-control m-input',
            'id' => 'gobuy_montoextra',            
            'readonly' => 'readonly',
            'placelholder' => ''
        ]) !!}
          <div id="titulo-error" class="form-control-notice">
              {!! $errors->first('gobuy_montoextra') !!}
          </div>
        </div>
    </div>
    <div class="form-group {{ $errors->has('titulo')?'has-danger':''}}">
        <label class="col-sm-3 control-label">
            Código tracking
        </label>
        <div class="col-md-6">
            {!! Form::text('gobuy_codetracking',null,[
            'class' => 'form-control m-input',
            'placelholder' => ''
        ]) !!}
          <div id="titulo-error" class="form-control-notice">
              {!! $errors->first('titulo') !!}
          </div>
        </div>
    </div>

    <div class="form-group {{ $errors->has('titulo')?'has-danger':''}}">
        <label class="col-sm-3 control-label">
            Fecha de solicitud
        </label>
        <div class="col-md-6 value-label">
            {{$model->created_at}}
        </div>
    </div>

    <div class="form-group  {{ $errors->has('gobuy_fecharecepcion')?'has-danger':''}}">
        <label class="col-sm-3 control-label">
            Fecha de recepción
        </label>
        <div class="col-md-2 input-group date datepicker" style="padding-left: 15px;">

            {!! Form::text('gobuy_fecharecepcion',null,[
                  'class' => 'form-control',
                  'readonly' => 'readonly',
                  'placelholder' => ''
              ]) !!}
            <span class="input-group-addon">
                <i class="glyphicon-th icon-th s7-date"></i>
            </span>

            <div id="subtitulo-error" class="form-control-notice">
                {!! $errors->first('gobuy_fecharecepcion') !!}
            </div>
        </div>

    </div>
    @if($model->gobuy_estado!=3)
      <div class="form-group {{ $errors->has('titulo')?'has-danger':''}}">
          <label class="col-sm-3 control-label">
              Valor declarado USD$
          </label>
          <div class="col-md-6 value-label">
              {{$model->gobuy_valordeclarado}}
          </div>
      </div>
      <div class="form-group {{ $errors->has('titulo')?'has-danger':''}}">
          <label class="col-sm-3 control-label">
              Peso declarado Kg
          </label>
          <div class="col-md-6 value-label">
              {{$model->gobuy_peso}}
          </div>
      </div>
      <div class="form-group {{ $errors->has('titulo')?'has-danger':''}}">
          <label class="col-sm-3 control-label">
              Monto cobrado USD$
          </label>
          <div class="col-md-6 value-label">
              {{$model->gobuy_costoenvio}}
          </div>
      </div>
    @endif

@endif <!-- fin para editar -->

@if(!isset($model)) <!-- campos incluidos solo en crear nuevo -->
  <div class="form-group {{ $errors->has('titulo')?'has-danger':''}}">
      <label class="col-sm-3 control-label">
          Valor declarado USD$
      </label>
      <div class="col-md-6">
          {!! Form::text('gobuy_valordeclarado',null,[
          'class' => 'form-control m-input',
          'id' => 'gobuy_valordeclarado',
          'placelholder' => ''
      ]) !!}
  <div id="titulo-error" class="form-control-notice">
      {!! $errors->first('titulo') !!}
  </div>
  </div>
  </div>

  <div class="form-group {{ $errors->has('titulo')?'has-danger':''}}">
      <label class="col-sm-3 control-label">
          Peso declarado Kg
      </label>
      <div class="col-md-6">
          {!! Form::number('gobuy_peso',null,[
          'class' => 'form-control m-input',
          'id' => 'gobuy_peso',
          'min' => '0',
          'placelholder' => ''
      ]) !!}
  <div id="titulo-error" class="form-control-notice">
      {!! $errors->first('titulo') !!}
  </div>
  </div>
  </div>


@endif <!-- fin: campos incluidos solo en crear nuevo -->

<div class="form-group {{ $errors->has('titulo')?'has-danger':''}}">
    <label class="col-sm-3 control-label">
        Descripción
    </label>
    <div class="col-md-6">
        {!! Form::textarea('gobuy_descripcion', null, ['
                class'=>'form-control',
                'rows' => 3]) !!}
        <div id="titulo-error" class="form-control-notice">
            {!! $errors->first('gobuy_descripcion') !!}
        </div>
    </div>
</div>

<div class="form-group {{ $errors->has('titulo')?'has-danger':''}}">
    <label class="col-sm-3 control-label">
        Piezas
    </label>
    <div class="col-md-6">
      {!! Form::number('gobuy_piezas',null,[
            'class' => 'form-control m-input',
            'min' => '0',
            'max' => '9999',
            'placelholder' => ''
        ]) !!}
<div id="titulo-error" class="form-control-notice">
    {!! $errors->first('titulo') !!}
</div>
</div>
</div>

<!-- <div class="form-group {{ $errors->has('titulo')?'has-danger':''}}">
    <label class="col-sm-3 control-label">
        Peso consolidado Kg
    </label>
    <div class="col-md-6">
        {!! Form::number('gobuy_pesoconsolidado',null,[
        'class' => 'form-control m-input',
        'min' => '0',
        'id' => 'gobuy_pesoconsolidado',
        'placelholder' => ''
    ]) !!}
<div id="titulo-error" class="form-control-notice">
    {!! $errors->first('titulo') !!}
</div>
</div>
</div> -->

<div class="form-group {{ $errors->has('titulo')?'has-danger':''}}">
    <label class="col-sm-3 control-label">
        Cantidad de bultos
    </label>
    <div class="col-md-6">
      {!! Form::number('gobuy_numbultos',null,[
            'class' => 'form-control m-input',
            'min' => '0',
            'max' => '9999',
            'placelholder' => ''
        ]) !!}
<div id="titulo-error" class="form-control-notice">
    {!! $errors->first('titulo') !!}
</div>
</div>
</div>

<div class="form-group {{ $errors->has('titulo')?'has-danger':''}}">
    <label class="col-sm-3 control-label">
        Dirección destino
    </label>
    <div class="col-md-6">
            {!! Form::text('gobuy_direccion_destino',null,[
            'class' => 'form-control m-input',
            'placelholder' => ''
        ]) !!}

        <div id="titulo-error" class="form-control-notice">
            {!! $errors->first('titulo') !!}
        </div>
    </div>
</div>


<div class="form-group {{ $errors->has('usuario_email')?'has-danger':''}}">
    <label class="col-sm-3 control-label">
        Correo usuario
    </label>
    <div class="col-md-6 control-label" style="text-align:left">
            {!! Form::text('usuario_email',null,[
            'class' => 'form-control m-input',
            'id' => 'usuario_email',
            'placelholder' => ''
        ]) !!}

        <div id="email-error" class="form-control-notice">
            {!! $errors->first('usuario_email') !!}
        </div>
    </div>

</div>

<div class="form-group {{ $errors->has('gobuy_confirmacioncompra')?'has-danger':''}}">
  <label class="col-sm-3 control-label">Constancia</label>
  <div class="col-sm-6">

    <div class="fileinput
    @if(isset($model))
      @if($model->gobuy_confirmacioncompra)
              fileinput-exists
      @else
          fileinput-new
      @endif
    @else
        fileinput-new
    @endif
    "
      data-provides="fileinput">
        <div class="fileinput-new thumbnail" style="width: 300px; height: 150px;">
            <img src="http://www.placehold.it/300x150" alt=""/>
        </div>
        <div class="fileinput-preview fileinput-exists thumbnail"
             style="width: 300px; height: 150px;">
            @if(isset($model))
                @if($model->gobuy_confirmacioncompra)
                    @if ( substr(strrchr($model->gobuy_confirmacioncompra, '.'), 1) == 'pdf' )
                        <a target="_blank" href="/{{'elements/gobuy'}}/{{ $model->gobuy_confirmacioncompra }}">Ver pdf</a>
                    @else
                        <img src="/{{'elements/gobuy'}}/{{ $model->gobuy_confirmacioncompra }}" alt="" width="600px" height="300px"/>
                    @endif
                @endif
            @endif
        </div>
        <div>
    <span class="btn default btn-file">
        <span class="fileinput-new "> Seleccionar Archivo </span>
        <span class="fileinput-exists"> Cambiar </span>
        <input type="file" name="gobuy_confirmacioncompra">
    </span>
            <a href="javascript:;" class="btn red fileinput-exists" data-dismiss="fileinput"> Eliminar </a>
        </div>
    </div>
    <div id="imagen-error" class="form-control-notice">
        {!! $errors->first('imagen') !!}
    </div>

  </div>
</div>
