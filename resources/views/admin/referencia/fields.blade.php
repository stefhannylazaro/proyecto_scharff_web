<div class="form-group {{ $errors->has('id')?'has-danger':''}}">
    @if (isset($model))
      <label class="col-sm-3 control-label">
          ID
      </label>
      <div class="col-md-6 value-label">
            {{$model->id}}
      </div>
    @endif
</div>

<div class="form-group has-danger">
    <label class="col-sm-3 control-label">
        Nombre
    </label>
    <div class="col-md-6">
        {!! Form::text('nombre',null,[
               'class' => 'form-control m-input',
               'placelholder' => '',
               'id' => 'nombre'
           ]) !!}


        <div id="nombre-error" class="form-control-notice">

        </div>
    </div>

</div>


<div class="form-group {{ $errors->has('nombre')?'has-danger':''}}">
    <label class="col-sm-3 control-label">
        Enlace de registro
    </label>
    <div class="col-md-6 value-label">
        <span id="enlace"></span>
    </div>

</div>
