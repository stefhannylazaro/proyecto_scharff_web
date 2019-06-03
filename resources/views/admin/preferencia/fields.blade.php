
<div class="form-group {{ $errors->has('slug')?'has-danger':''}}">
    <label class="col-sm-3 control-label">
        Categoría
    </label>

    <div class="col-md-6">
        {!! Form::select('categoria',
                $assoc_cats,null,[
              'class' => 'form-control m-input',
              'placelholder' => ''
          ]) !!}

        <div id="categoria-error" class="form-control-notice">
            {!! $errors->first('categoria') !!}
        </div>
    </div>

</div>




<div class="form-group {{ $errors->has('pregunta')?'has-danger':''}}">
    <label class="col-sm-3 control-label">
        Pregunta
    </label>
    <div class="col-md-6">
      {!! Form::text('pregunta',null,[
            'class' => 'form-control m-input',
            'placelholder' => '',
            'data-provide' => 'markdown',
            'rows' => 10
        ]) !!}
        <div id="pregunta-error" class="form-control-notice">
            {!! $errors->first('pregunta') !!}
        </div>
    </div>
</div>


<div class="form-group {{ $errors->has('respuesta')?'has-danger':''}}">
    <label class="col-sm-3 control-label">
        Respuesta
    </label>
    <div class="col-md-6">
        {!! Form::textarea('respuesta',null,[
              'class' => 'form-control m-input',
              'placelholder' => ''
          ]) !!}

        <div id="respuesta-error" class="form-control-notice">
            {!! $errors->first('respuesta') !!}
        </div>
    </div>

</div>
