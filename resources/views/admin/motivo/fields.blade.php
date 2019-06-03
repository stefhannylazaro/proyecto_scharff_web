
<div class="form-group {{ $errors->has('titulo')?'has-danger':''}}">
    <label class="col-sm-3 control-label">
        Nombre
    </label>
    <div class="col-md-6">
        {!! Form::text('nombre',null,[
                'class' => 'form-control m-input',
                'placelholder' => ''
            ]) !!}
        <div id="nombre-error" class="form-control-notice">
            {!! $errors->first('nombre') !!}
        </div>
    </div>

</div>


<div class="form-group {{ $errors->has('correo')?'has-danger':''}}">
    <label class="col-sm-3 control-label">
        Correo
    </label>
    <div class="col-md-6">
        {!! Form::text('correo',null,[
                'class' => 'form-control m-input',
                'placelholder' => ''
            ]) !!}
        <div id="correo-error" class="form-control-notice">
            {!! $errors->first('correo') !!}
        </div>
    </div>

</div>




<div class="form-group {{ $errors->has('mensaje_personalizado_staff')?'has-danger':''}}">
    <label class="col-sm-3 control-label">
        Mensaje personalizado staff
    </label>
    <div class="col-md-7">
      <div class="row">
          <div class="col-md-12">
            <div class="panel panel-default">
              <div class="">
                <div id="editor1a">{!! isset($model->mensaje_personalizado_staff)?$model->mensaje_personalizado_staff:''!!}</div>
                <input type="hidden" name="mensaje_personalizado_staff" id="mensaje_personalizado_staff" value="">
              </div>
            </div>
          </div>
        </div>


        <div id="mensaje_personalizado_staff-error" class="form-control-notice">
            {!! $errors->first('mensaje_personalizado_staff') !!}
        </div>
    </div>

</div>



<div class="form-group {{ $errors->has('mensaje_personalizado_cliente')?'has-danger':''}}">
    <label class="col-sm-3 control-label">
        Mensaje personalizado cliente
    </label>
    <div class="col-md-7">
      <div class="row">
          <div class="col-md-12">
            <div class="panel panel-default">
              <div class="">
                <div id="editor2a">{!! isset($model->mensaje_personalizado_cliente)?$model->mensaje_personalizado_cliente:''!!}</div>
                <input type="hidden" name="mensaje_personalizado_cliente" id="mensaje_personalizado_cliente" value="">
              </div>
            </div>
          </div>
        </div>

        <div id="mensaje_personalizado_cliente-error" class="form-control-notice">
            {!! $errors->first('mensaje_personalizado_cliente') !!}
        </div>
    </div>

</div>


<div class="form-group {{ $errors->has('orden')?'has-danger':''}}">
    <label class="col-sm-3 control-label">
        Orden
    </label>
    <div class="col-md-6">
        {!! Form::text('orden',null,[
                'class' => 'form-control m-input',
                'placelholder' => ''
            ]) !!}
        <div id="orden-error" class="form-control-notice">
            {!! $errors->first('orden') !!}
        </div>
    </div>

</div>
