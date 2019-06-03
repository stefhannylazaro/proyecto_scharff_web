
<div class="form-group {{ $errors->has('imagen')?'has-danger':''}}">
  <label class="col-sm-3 control-label">Imagen</label>
  <div class="col-sm-6">

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
        <div class="fileinput-new thumbnail" style="width: 600px; height: 340px;">
            <img src="http://www.placehold.it/1280x800" alt=""/>
        </div>
        <div class="fileinput-preview fileinput-exists thumbnail"
             style="width: 600px; height: 340px;">
            @if(isset($model))
                @if($model->imagen)
                    <img src="/{{config('app.url_image_banner')}}/{{ $model->imagen }}" alt="" width="600px" height="300px"/>
                @endif
            @endif
        </div>
        <br><em>*Medidas para banner: 1280px x 800px</em>
        <div>
    <span class="btn default btn-file">
        <span class="fileinput-new "> Seleccionar Imagen </span>
        <span class="fileinput-exists"> Cambiar </span>
        <input type="file" name="imagen">
    </span>
            <a href="javascript:;" class="btn red fileinput-exists" data-dismiss="fileinput"> Eliminar </a>
        </div>
    </div>
    <div id="imagen-error" class="form-control-notice">
        {!! $errors->first('imagen') !!}
    </div>

  </div>
</div>



<div class="form-group {{ $errors->has('titulo')?'has-danger':''}}">
  <label class="col-sm-3 control-label">Título</label>
  <div class="col-sm-7">
      <div class="row">
        <div class="col-md-12">
          <div class="panel panel-default">
            <div class="">
              <div id="editor1a">{!! isset($model->titulo)?$model->titulo:''!!}</div>
              <input type="hidden" name="titulo" value="" id="titulo">
            </div>
          </div>
        </div>
      </div>

      <div id="titulo-error" class="form-control-notice">
          {!! $errors->first('titulo') !!}
      </div>
  </div>
</div>





<div class="form-group {{ $errors->has('subtitulo')?'has-danger':''}}">
    <label class="col-sm-3 control-label">
        Sub Título
    </label>
    <div class="col-sm-7">
      <div class="row">
        <div class="col-md-12">
          <div class="panel panel-default">
            <div class="" >
              <div id="editor2a" >{!! isset($model->subtitulo)?$model->subtitulo:''!!}</div>
              <input type="hidden" name="subtitulo" value="" id="subtitulo">
            </div>
          </div>
        </div>
      </div>

        <div id="subtitulo-error" class="form-control-notice">
            {!! $errors->first('subtitulo') !!}
        </div>
    </div>

</div>

<div class="form-group {{ $errors->has('slug')?'has-danger':''}}">
    <label class="col-sm-3 control-label">
        Seccion
    </label>
    <div class="col-sm-6">
        {!! Form::select('slug',
                ['home'=> 'Home',
                'distribucion_nacional'=>'Distribucion_nacional',
                'aduanas'=>'Aduanas',
                'carga' => 'Carga',
                'almacenes'=> 'Almacenes',
                'domestica' => 'Domestica',
                'scharff_express' => 'Scharff_express',
                'scharff_stop'=>'Scharff_stop',
                'scharff_lab' => 'Scharff_lab',
                'empresa' => 'Empresa',
                'paraTi' => 'Para ti',
                'gobuy' => 'Go Buy',

                ],null,[
              'class' => 'form-control m-input',
              'placelholder' => ''
          ]) !!}

        <div id="slug-error" class="form-control-notice">
            {!! $errors->first('slug') !!}
        </div>
    </div>

</div>


<div class="form-group {{ $errors->has('url')?'has-danger':''}}">
    <label class="col-sm-3 control-label">
        Url
    </label>
    <div class="col-sm-6">
        {!! Form::text('url',null,[
              'class' => 'form-control m-input',
              'placelholder' => ''
          ]) !!}

        <div id="url-error" class="form-control-notice">
            {!! $errors->first('url') !!}
        </div>
    </div>

</div>


<div class="form-group {{ $errors->has('btn_text')?'has-danger':''}}">
    <label class="col-sm-3 control-label">
        Texto del boton
    </label>
    <div class="col-sm-6">
        {!! Form::text('btn_text',null,[
              'class' => 'form-control m-input',
              'placelholder' => ''
          ]) !!}
          <span>*Para quitar el boton, dejar en blanco este campo</span>

        <div id="btn_text-error" class="form-control-notice">
            {!! $errors->first('btn_text') !!}
        </div>
    </div>

</div>
<div class="form-group {{ $errors->has('estado')?'has-danger':''}}">
    <label class="col-sm-3 control-label">
        Activar
    </label>
    <div class="col-sm-6 control-label" style="text-align:left">
        {!! Form::checkbox('estado'); !!}
        <div id="btn_text-error" class="form-control-notice">
            {!! $errors->first('estado') !!}
        </div>
    </div>

</div>

<!-- <div class="form-group  {{ $errors->has('order')?'has-danger':''}}">
    <label class="col-sm-3 control-label">
        Orden
    </label>
    <div class="col-md-6">
        {!! Form::number('order',null,[
            'class' => 'form-control m-input',
            'min' => '1',
            'placelholder' => ''
        ]) !!}
        <div id="subtitulo-error" class="form-control-notice">
            {!! $errors->first('order') !!}
        </div>
    </div>
</div> -->
<div class="form-group {{ $errors->has('order')?'has-danger':''}}">
    <label class="col-sm-3 control-label">
        Orden
    </label>
    <div class="col-sm-6">
        {!! Form::number('order',null,[
              'class' => 'form-control m-input',
              'min' => '1',
              'placelholder' => ''
          ]) !!}
        <div id="btn_text-error" class="form-control-notice">
            {!! $errors->first('btn_text') !!}
        </div>
    </div>

</div>
