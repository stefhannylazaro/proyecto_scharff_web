<div class="form-group {{ $errors->has('nombre')?'has-danger':''}}">
    <label class="col-sm-3 control-label">
        Nombre de Perfil
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


<div class="form-group {{ $errors->has('accion')?'has-danger':''}}">
    <label class="col-sm-3 control-label">
        Acciones
    </label>


    <div class="col-md-6">
        <div class="m-checkbox-list">

            @foreach($acciones as $ac)
                <label class="m-checkbox">
                    <input type="checkbox" name="accion[]" value="{{$ac['id']}}" {!! $ac['estado'] == 1 ? 'checked' : ''!!}>
                    {{$ac['nombre']}}
                    <span></span>
                </label><br>
            @endforeach
        </div>
        <div id="accion-error" class="form-control-notice">
            {!! $errors->first('accion') !!}
        </div>
    </div>

</div>
