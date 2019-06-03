<div class="form-group {{ $errors->has('imagen')?'has-danger':''}}">
    <label class="col-sm-3 control-label">
        Imagen
    </label>


    <div class="col-md-9">
            <div class="fileinput
            @if(isset($model))
            @if($model->imagen)
                    fileinput-exists
                @else
                    fileinput-new
                @endif
            @else
                    fileinput-new
                @endif"
                 data-provides="fileinput">
                <div class="fileinput-new thumbnail" style="width: 200px; height: 100px;">
                    <img src="http://www.placehold.it/200x100" alt=""/>
                </div>
                <div class="fileinput-preview fileinput-exists thumbnail"
                     style="width: 200px; height: 100px;">
                    @if(isset($model))
                        @if($model->imagen)
                            <img  src="/{{config('app.url_image_servicio')}}/{{ $model->imagen }}" alt="" width="200px" height="100px"/>
                        @endif
                    @endif
                </div>
                <div>
            <span class="btn default btn-file">
                <span class="fileinput-new "> Seleccionar Imagen </span>
                <span class="fileinput-exists"> Cambiar </span>
                <input type="file" name="imagen">
            </span>
                    <a href="javascript:;" class="btn red fileinput-exists" data-dismiss="fileinput"> Eliminar </a>
                </div>
                <br>
            </div>
        <div id="imagen-error" class="form-control-notice">
            {!! $errors->first('imagen') !!}
        </div>
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

<div class="form-group {{ $errors->has('orden')?'has-danger':''}}">
    <label class="col-sm-3 control-label">
        Orden
    </label>
    <div class="col-md-6">
        {!! Form::number('orden',null,[
              'class' => 'form-control m-input',
              'placelholder' => '',
              'min'=>'1',
              'max' => '99',
              'step'=>'1'
          ]) !!}

        <div id="orden-error" class="form-control-notice">
            {!! $errors->first('orden') !!}
        </div>
    </div>

</div>
