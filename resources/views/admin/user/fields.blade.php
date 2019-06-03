



<div class="form-group {{ $errors->has('usuario_nombre')?'has-danger':''}}">
    <label class="col-sm-3 control-label">
        Nombres
    </label>
    <div class="col-md-6 ">


      {!! Form::text('usuario_nombre',null,[
          'class' => 'form-control m-input',
          'placelholder' => ''
      ]) !!}

        <div id="usuario_nombre-error" class="form-control-notice">
            {!! $errors->first('usuario_nombre') !!}
        </div>
    </div>
</div>







<div class="form-group {{ $errors->has('usuario_apellidos')?'has-danger':''}}">
    <label class="col-sm-3 control-label">
        Apellido
    </label>
    <div class="col-md-6 ">
        {!! Form::text('usuario_apellidos',null,[
            'class' => 'form-control m-input',
            'placelholder' => ''
        ]) !!}
        <div id="usuario_apellidos-error" class="form-control-notice">
            {!! $errors->first('usuario_apellidos') !!}
        </div>
    </div>
</div>







<div class="form-group {{ $errors->has('email')?'has-danger':''}}">
    <label class="col-sm-3 control-label">
        Correo electrónico
    </label>
    <div class="col-md-6 ">
        {!! Form::text('usuario_email',null,[
            'class' => 'form-control m-input',
            'readonly' => 'readonly',
            'placelholder' => ''
        ]) !!}
        <div id="email-error" class="form-control-notice">
            {!! $errors->first('email') !!}
        </div>
    </div>

</div>






<div class="form-group {{ $errors->has('usuario_movil')?'has-danger':''}}">
    <label class="col-sm-3 control-label">
        Celular
    </label>
    <div class="col-md-6 ">
        {!! Form::text('usuario_movil',null,[
            'class' => 'form-control m-input',
            'placelholder' => ''
        ]) !!}
        <div id="usuario_movil-error" class="form-control-notice">
            {!! $errors->first('usuario_movil') !!}
        </div>
    </div>

</div>






<div class="form-group {{ $errors->has('usuario_dni')?'has-danger':''}}">
    <label class="col-sm-3 control-label">
        DNI
    </label>
    <div class="col-md-6 ">
        {!! Form::text('usuario_dni',null,[
            'class' => 'form-control m-input',
            'placelholder' => ''
        ]) !!}
        <div id="usuario_dni-error" class="form-control-notice">
            {!! $errors->first('usuario_dni') !!}
        </div>
    </div>

</div>





{{--

<div class="form-group {{ $errors->has('usuario_tipo')?'has-danger':''}}">
    <label class="col-sm-3 control-label">
        Tipo de usuario
    </label>
    <div class="col-md-6 ">
        {!! Form::text('usuario_tipo',null,[
            'class' => 'form-control m-input',
            'placelholder' => ''
        ]) !!}
        <div id="usuario_tipo-error" class="form-control-notice">
            {!! $errors->first('usuario_tipo') !!}
        </div>
    </div>
</div> --}}


<div class="form-group {{ $errors->has('nombre_referencia')?'has-danger':''}}">
    <label class="col-sm-3 control-label">
        Tipo de usuario
    </label>
    <div class="col-md-6">
      @php
      $tipos_ar_str = trim(implode(',', array_keys($tipos_ar)), ',');
      @endphp
        <div id="todos_tipos" data-todos_tipos="{!! $tipos_ar_str !!}"></div>

        {!! Form::select('referenciaUsuario_id',
                $tipos_ar,$referenciaUsuario_id,[
              'class' => 'form-control m-input',
              'placelholder' => ''
          ]) !!}


        <div id="nombre_referencia-error" class="form-control-notice">
            {!! $errors->first('nombre_referencia') !!}
        </div>
    </div>
</div>

<div class="form-group {{ $errors->has('created_at')?'has-danger':''}}">
    <label class="col-sm-3 control-label">
        Fecha de registro
    </label>
    <div class="col-md-6 value-label">
        {!! $model->usuario_fecharegistro !!}
        <div id="created_at-error" class="form-control-notice">
            {!! $errors->first('created_at') !!}
        </div>
    </div>
</div>

<div class="form-group {{ $errors->has('password')?'has-danger':''}}">
    <label class="col-sm-3 control-label">
        Contraseña
    </label>
    <div class="col-md-6">
        {!! Form::text('password',null,[
            'class' => 'form-control m-input',
            'placelholder' => ''
        ]) !!}
        <p style="clear:both" >* Dejar en blanco para no alterar la contraseña actual</p>
        <div id="password-error" class="form-control-notice">
            {!! $errors->first('password') !!}
        </div>
    </div>
    <br>

</div>


<div class="form-group {{ $errors->has('password')?'has-danger':''}}">
    <label class="col-sm-3 control-label">
        Confirmar contraseña
    </label>
    <div class="col-md-6">
      {!! Form::text('passwordb',null,[
          'class' => 'form-control m-input',
          'placelholder' => ''
      ]) !!}
        <div id="password-error" class="form-control-notice">
            {!! $errors->first('password') !!}
        </div>
    </div>

</div>
