<div class="form-group {{ $errors->has('opcion')?'has-danger':''}}">
    <label class="col-sm-3 control-label">
        Opción
    </label>
    <div class="col-md-6">
        {!! Form::text('opcion',null,[
               'class' => 'form-control m-input',
               'placelholder' => ''
           ]) !!}

        <div id="link-error" class="form-control-notice">
            {!! $errors->first('link') !!}
        </div>
    </div>

</div>

<div class="form-group {{ $errors->has('link')?'has-danger':''}}">
    <label class="col-sm-3 control-label">
        Valor
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
