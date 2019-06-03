<div class="form-group {{ $errors->has('imagen')?'has-danger':''}}">
    <label class="col-sm-3 control-label">
        Vista
    </label>


    <div class="col-md-6 value-label">
        {{$model->vista}}
    </div>
</div>

<div class="form-group {{ $errors->has('imagen')?'has-danger':''}}">
    <label class="col-sm-3 control-label">
        Clave
    </label>


    <div class="col-md-6 value-label">
        {{$model->clave}}
    </div>
</div>

<div class="form-group {{ $errors->has('titulo')?'has-danger':''}}">
    <label class="col-sm-3 control-label">
        Título
    </label>
    <div class="col-md-6">
        {!! Form::text('titulo',null,[
                'class' => 'form-control m-input',
                'placelholder' => ''
            ]) !!}
        <div id="titulo-error" class="form-control-notice">
            {!! $errors->first('titulo') !!}
        </div>
    </div>
  </div>

      <div class="form-group {{ $errors->has('descripcion')?'has-danger':''}}">
    <label class="col-sm-3 control-label">
        Descripción
    </label>
    <div class="col-md-7">

      <div class="row">
          <div class="col-md-12">
            <div class="panel panel-default">
              <div class="">
                <div id="editor1a">{!! isset($model->descripcion)?$model->descripcion:''!!}</div>
                <input type="hidden" value="" name="descripcion" value="" id="descripcion">
              </div>
            </div>
          </div>
        </div>


        <div id="descripcion-error" class="form-control-notice">
            {!! $errors->first('descripcion') !!}
        </div>
    </div>

</div>
