





<div class="form-group {{ $errors->has('nombre')?'has-danger':''}}">
    <label class="col-sm-3 control-label">
        Promoción
    </label>
    <div class="col-md-6">
        {!! Form::select('promocion_id',
              $promociones_ar,null,[
            'class' => 'form-control m-input',
            'placelholder' => ''
        ]) !!}

      <div id="link-error" class="form-control-notice">
          {!! $errors->first('link') !!}
      </div>
    </div>

</div>


<div class="form-group {{ $errors->has('nombre')?'has-danger':''}}">
    <label class="col-sm-3 control-label">
        Texto del cupon
    </label>
    <div class="col-md-6">
        {!! Form::text('cupon_texto',null,[
       'class' => 'form-control m-input',
       'placelholder' => ''
       ]) !!}


        <div id="link-error" class="form-control-notice">
            {!! $errors->first('link') !!}
        </div>
    </div>
</div>



@if (isset($model))

  <div class="form-group {{ $errors->has('nombre')?'has-danger':''}}">
      <label class="col-sm-3 control-label">
          Número de usos
      </label>
      <div class="col-md-6 value-label">
          {{ $model->cupon_numero_usos?$model->cupon_numero_usos:0 }}
      </div>
  </div>

  <div class="form-group {{ $errors->has('nombre')?'has-danger':''}}">
      <label class="col-sm-3 control-label">
          Fecha de creación
      </label>
      <div class="col-md-6 value-label">
          {{ $model->created_at }}
      </div>
  </div>

@endif
