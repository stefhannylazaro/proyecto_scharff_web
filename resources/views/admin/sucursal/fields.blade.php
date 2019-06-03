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


<div class="form-group {{ $errors->has('pais')?'has-danger':''}}">
    <label class="col-sm-3 control-label">
        PAIS
    </label>
    <div class="col-md-6">
      {!! Form::select('pais',['PERÚ' => 'PERÚ', 'BOLIVIA'=>'BOLIVIA'],null,[
              'class' => 'form-control m-input',
              'placelholder' => ''
          ]) !!}
        <div id="pais-error" class="form-control-notice">
            {!! $errors->first('pais') !!}
        </div>
    </div>

</div>






<div class="form-group {{ $errors->has('ciudad')?'has-danger':''}}">
    <label class="col-sm-3 control-label">
        Ciudad
    </label>
    <div class="col-md-6">
      {!! Form::text('ciudad',null,[
            'class' => 'form-control m-input',
            'placelholder' => ''
        ]) !!}
        <div id="ciudad-error" class="form-control-notice">
            {!! $errors->first('ciudad') !!}
        </div>
    </div>

</div>


<div class="form-group {{ $errors->has('departamento')?'has-danger':''}}">
    <label class="col-sm-3 control-label">
        Departamento
    </label>
    <div class="col-md-6">
      {!! Form::text('departamento',null,[
            'class' => 'form-control m-input',
            'placelholder' => ''
        ]) !!}
        <div id="departamento-error" class="form-control-notice">
            {!! $errors->first('departamento') !!}
        </div>
    </div>
</div>

<div class="form-group {{ $errors->has('dirOne')?'has-danger':''}}">
    <label class="col-sm-3 control-label">
        Dirección uno
    </label>
    <div class="col-md-6">
      {!! Form::text('dirOne',null,[
            'class' => 'form-control m-input',
            'placelholder' => ''
        ]) !!}
        <div id="dirOne-error" class="form-control-notice">
            {!! $errors->first('dirOne') !!}
        </div>
    </div>
</div>

<div class="form-group {{ $errors->has('dirTwo')?'has-danger':''}}">
    <label class="col-sm-3 control-label">
        Dirección dos
    </label>
    <div class="col-md-6">
      {!! Form::text('dirTwo',null,[
            'class' => 'form-control m-input',
            'placelholder' => ''
      ]) !!}
      <div id="dirTwo-error" class="form-control-notice">
          {!! $errors->first('dirTwo') !!}
      </div>
    </div>
</div>

<div class="form-group {{ $errors->has('dirTwo')?'has-danger':''}}">
    <label class="col-sm-3 control-label">
        Teléfono
    </label>
    <div class="col-md-6">
      {!! Form::text('tel',null,[
            'class' => 'form-control m-input',
            'placelholder' => ''
      ]) !!}
      <div id="tel-error" class="form-control-notice">
          {!! $errors->first('tel') !!}
      </div>
    </div>
</div>


{!! Form::hidden('latitud', null ,['id'=>'lat']) !!}
{!! Form::hidden('longitud', null ,['id'=>'lng']) !!}


<div class="form-group  {{ $errors->has('ciudad')?'has-danger':''}}">
    <label class="col-sm-3 control-label">
        Ubicación
    </label>
    <div class="col-md-6">
        <div class="search_box" style="">

            <p>Usa el buscador o mueve el PIN para ubicar tu dirección.</p>

          <!--  <a id="btngeolocaliza" href="Javascript:gmaps.geolocalizacion();" class="search_marker left">
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
