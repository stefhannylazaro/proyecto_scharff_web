<style>
    .search_box {
        width: 470px;
        padding: 15px 15px 12px 15px;
        background-color: white;
        border: 1px solid #d6cac2;
        border-radius: 5px;
        margin-left: 148px;
        z-index: 100;
        top: 10px;
        position: absolute;
    }

    .search_box .search_marker {
        width: 10px;
        height: 17px;
        background: url(/assets/app/media/img/ico_marker_mini.png) center no-repeat transparent;
        display: inline-block;
        float: left;
        margin-top: 7px;
        margin-left: 0;
        position: relative;
        margin-right: 10px;
    }

    .search_box input#search{
    font-size: 12px;
    color: #5e5e5e;
    background-color: rgba(0, 0, 0, 0.075);
    border-color: rgba(0, 0, 0, 0.075);
    padding-left: 10px;
    height: 25px;
    width: 410px;
    }
</style>

<div class="form-group {{ $errors->has('nombre')?'has-danger':''}}">
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

<div class="form-group {{ $errors->has('direccion')?'has-danger':''}}">
    <label class="col-sm-3 control-label">
        Referencia
    </label>
    <div class="col-md-6">
        {!! Form::text('referencia',null,[
              'class' => 'form-control m-input',
              'placelholder' => ''
          ]) !!}

        <div id="referencia-error" class="form-control-notice">
            {!! $errors->first('referencia') !!}
        </div>
    </div>

</div>

<div class="form-group {{ $errors->has('direccion')?'has-danger':''}}">
    <label class="col-sm-3 control-label">
        Observacion
    </label>
    <div class="col-md-6">
        {!! Form::text('observacion',null,[
              'class' => 'form-control m-input',
              'placelholder' => ''
          ]) !!}

        <div id="observacion-error" class="form-control-notice">
            {!! $errors->first('observacion') !!}
        </div>
    </div>

</div>

<div class="form-group {{ $errors->has('direccion')?'has-danger':''}}">
    <label class="col-sm-3 control-label">
        Código Referencial
    </label>
    <div class="col-md-6">
        {!! Form::text('codigo_referencial',null,[
              'class' => 'form-control m-input',
              'placelholder' => ''
          ]) !!}

        <div id="codigo_referencial-error" class="form-control-notice">
            {!! $errors->first('codigo_referencial') !!}
        </div>
    </div>

</div>

<div class="form-group {{ $errors->has('direccion')?'has-danger':''}}">
    <label class="col-sm-3 control-label">
        Dirección
    </label>
    <div class="col-md-6">
        {!! Form::text('direccion',null,[
              'class' => 'form-control m-input',
              'placelholder' => ''
          ]) !!}

        <div id="direccion-error" class="form-control-notice">
            {!! $errors->first('direccion') !!}
        </div>
    </div>

</div>

<div class="form-group {{ $errors->has('slug')?'has-danger':''}}">
    <label class="col-sm-3 control-label">
        Tamaño
    </label>
    <div class="col-md-4">
        {!! Form::select('size',
                ['pequeño'=> 'Pequeño',
                'mediano'=>'Mediano',
                'grande'=>'Grande',
                ],null,[
              'class' => 'form-control m-input',
              'placelholder' => ''
          ]) !!}

        <div id="slug-error" class="form-control-notice">
            {!! $errors->first('slug') !!}
        </div>
    </div>

</div>

{!! Form::hidden('ubicacion_lat', null ,['id'=>'lat']) !!}
{!! Form::hidden('ubicacion_lng', null ,['id'=>'lng']) !!}


<div class="form-group {{ $errors->has('ubicacion_lat')?'has-danger':''}}">
    <label class="col-sm-3 control-label">
        Ubicación
    </label>
    <div class="col-md-6">
        <div class="search_box" style="">

            <p>Usa el buscador o mueve el PIN para ubicar tu dirección.</p>

          <!--  aa<a id="btngeolocaliza" href="Javascript:gmaps.geolocalizacion();" class="search_marker left">
                &nbsp;
                <span class="tooltip">Pedir desde donde estoy</span>
            </a>-->
            <div class="txt_search">
                <input type="search" name="input_search_index" id="search" placeholder="Ingresa tu ubicación" autocomplete="off" class="">
            </div>
        </div>
        <div class="col-md-12" style="height: 400px;" id="mapa-sucursal"></div>
    </div>

</div>
