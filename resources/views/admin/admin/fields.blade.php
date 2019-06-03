<div class="form-group {{ $errors->has('perfil')?'has-danger':''}}">
    <label class="col-sm-3 control-label">
        Perfil
    </label>
    <div class="col-md-6">
        {!! Form::select('perfil',
                $perfil,@$model->perfil_id,[
              'class' => 'form-control m-input',
              'placelholder' => ''
          ]) !!}

        <div id="perfil-error" class="form-control-notice">
            {!! $errors->first('perfil') !!}
        </div>
    </div>

</div>

<div class="form-group {{ $errors->has('nombre')?'has-danger':''}}">
    <label class="col-sm-3 control-label">
        Nombres
    </label>
    <div class="col-md-6">
        {!! Form::text('nombre',@$model->user->usuario_nombre,[
              'class' => 'form-control m-input',
              'placelholder' => ''
          ]) !!}

        <div id="nombre-error" class="form-control-notice">
            {!! $errors->first('nombre') !!}
        </div>
    </div>

</div>

<div class="form-group {{ $errors->has('apellido')?'has-danger':''}}">
    <label class="col-sm-3 control-label">
        Apellido
    </label>
    <div class="col-md-6">
        {!! Form::text('apellido',@$model->user->usuario_apellidos,[
              'class' => 'form-control m-input',
              'placelholder' => ''
          ]) !!}

        <div id="apellido-error" class="form-control-notice">
            {!! $errors->first('apellido') !!}
        </div>
    </div>

</div>

<div class="form-group {{ $errors->has('celular')?'has-danger':''}}">
    <label class="col-sm-3 control-label">
        Celular
    </label>
    <div class="col-md-6">
        {!! Form::text('celular',@$model->user->usuario_movil,[
              'class' => 'form-control m-input',
              'placelholder' => '',
              'minlength' => '9',
              'maxlength' => '9'
          ]) !!}

        <div id="celular-error" class="form-control-notice">
            {!! $errors->first('celular') !!}
        </div>
    </div>

</div>

<div class="form-group {{ $errors->has('email')?'has-danger':''}}">
    <label class="col-sm-3 control-label">
        Email
    </label>
    <div class="col-md-6">
        {!! Form::email('email',@$model->user->email,[
              'class' => 'form-control m-input',
              'placelholder' => '',
          ]) !!}
        <div id="email-error" class="form-control-notice">
            {!! $errors->first('email') !!}
        </div>
    </div>

</div>

<div class="form-group {{ $errors->has('password')?'has-danger':''}}">
    <label class="col-sm-3 control-label">
        Password
    </label>
    <div class="col-md-6">
        {!! Form::password('password',[
              'class' => 'form-control m-input',
              'placelholder' => '',
          ]) !!}
        <div id="pasword-error" class="form-control-notice">
            {!! $errors->first('password') !!}
        </div>
    </div>

</div>

<div class="form-group {{ $errors->has('password_confirmation')?'has-danger':''}}">
    <label class="col-sm-3 control-label">
        Confirmar Password
    </label>
    <div class="col-md-6">
        {!! Form::password('password_confirmation',[
              'class' => 'form-control m-input',
              'placelholder' => '',
          ]) !!}
        <div id="password_confirmation-error" class="form-control-notice">
            {!! $errors->first('password_confirmation') !!}
        </div>
    </div>

</div>
