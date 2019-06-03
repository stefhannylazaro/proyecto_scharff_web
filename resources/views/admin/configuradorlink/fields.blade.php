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
    <div class="col-md-6 value-label">
        {{$model->titulo}}
    </div>
</div>

<div class="form-group {{ $errors->has('link')?'has-danger':''}}">
    <label class="col-sm-3 control-label">
        Link
    </label>
    <div class="col-md-6">
        {!! Form::text('link',null,[
               'class' => 'form-control m-input',
               'placelholder' => ''
           ]) !!}


        <div id="link-error" class="form-control-notice">
            {!! $errors->first('link') !!}
        </div>
    </div>

</div>
