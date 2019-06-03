




<div class="form-group {{ $errors->has('nombre')?'has-danger':''}}">
    <label class="col-sm-3 control-label">
        Nombre de la promoción
    </label>
    <div class="col-md-6">
        {!! Form::text('promocion_nombre',null,[
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
        Tipos de usuario
    </label>
    <div class="col-md-6">
      @php

      $tipos_ar_str = trim(implode(',', array_keys($tipos_ar)), ',');
      @endphp
      <div id="todos_tipos" data-todos_tipos="{!! $tipos_ar_str !!}"></div>
        {!! Form::select('tipo_id_arf',
              $tipos_ar,null,[
            'class' => 'form-control m-input',
            'placelholder' => '',
            'multiple' => 'multiple',
            'id'=>'tipo_id_arf'
        ]) !!}
        <span style="font-size:12px">Presione ctrl para seleccionar mas de un tipo de usuario</span>
        {!! Form::hidden('tipo_id',null,[
         'class' => 'form-control m-input',
         'placelholder' => '',
         'id' => 'tipo_id'
         ]) !!}


      <div id="link-error" class="form-control-notice">
          {!! $errors->first('link') !!}
      </div>
    </div>

</div>


<div class="form-group {{ $errors->has('nombre')?'has-danger':''}}">
    <label class="col-sm-3 control-label">
        Tipos de descuento
    </label>
    <div class="col-md-6">
        {!! Form::select('promocion_descuento_porcentaje',
              $tipos_descuentos_ar,null,[
            'class' => 'form-control m-input',
            'placelholder' => ''
        ]) !!}

      <div id="link-error" class="form-control-notice">
          {!! $errors->first('link') !!}
      </div>
    </div>

</div>

{{-- <div class="form-group {{ $errors->has('nombre')?'has-danger':''}}">
    <label class="col-sm-3 control-label">
        Descuento FLAT (S/.)
    </label>
    <div class="col-md-6">
        {!! Form::text('promocion_descuento_flat',null,[
       'class' => 'form-control m-input',
       'placelholder' => ''
       ]) !!}


        <div id="link-error" class="form-control-notice">
            {!! $errors->first('link') !!}
        </div>
    </div>

</div> --}}

<div class="form-group {{ $errors->has('promocion_descuento_flat')?'has-danger':''}}">
    <label class="col-sm-3 control-label">
        Descuento
    </label>
    <div class="col-md-6">
        {!! Form::text('promocion_descuento_flat',null,[
         'class' => 'form-control m-input',
         'placelholder' => ''
         ]) !!}


        <div id="link-error" class="form-control-notice">
            {!! $errors->first('link') !!}
        </div>
    </div>

</div>


<div class="form-group  {{ $errors->has('promocion_fecha_inicio')?'has-danger':''}}">
    <label class="col-sm-3 control-label">
        Fecha inicio promoción
    </label>
    <div class="col-md-2 input-group date datepicker" data-min-view="2" style="padding-left: 15px;">
        {!! Form::text('promocion_fecha_inicio',null,[
             'class' => 'form-control',
             'readonly' => 'readonly',
             'placelholder' => '',
             'data-date-format'=>"yyyy-mm-dd"
         ]) !!}
        <span class="input-group-addon">
            <i class="glyphicon-th icon-th s7-date"></i>
        </span>



        <div id="subtitulo-error" class="form-control-notice">
            {!! $errors->first('promocion_fecha_inicio') !!}
        </div>
    </div>

</div>



<div class="form-group  {{ $errors->has('promocion_fecha_fin')?'has-danger':''}}">
    <label class="col-sm-3 control-label">
        Fecha fin promoción
    </label>
    <div class="col-md-2 input-group date datepicker" data-min-view="2" style="padding-left: 15px;">
        {!! Form::text('promocion_fecha_fin',null,[
             'class' => 'form-control',
             'readonly' => 'readonly',
             'placelholder' => '',
             'data-date-format'=>"yyyy-mm-dd"
         ]) !!}
        <span class="input-group-addon">
            <i class="glyphicon-th icon-th s7-date"></i>
        </span>



        <div id="subtitulo-error" class="form-control-notice">
            {!! $errors->first('promocion_fecha_fin') !!}
        </div>
    </div>

</div>



<div class="form-group {{ $errors->has('nombre')?'has-danger':''}}">
    <label class="col-sm-3 control-label">
        Incluye cupón
    </label>
    <div class="col-md-6">

       <div class="am-checkbox">
            {{Form::hidden('promocion_cupon_bool',0)}}
            {!! Form::checkbox('promocion_cupon_bool',1, null,[
                 'class' => 'needsclick needsclick',
                 'placelholder' => '',
                 'id'=>"check1"
            ]) !!}
            <label for="check1">Marcar si esta promoción incluye un cupón</label>
         </div>

        <div id="link-error" class="form-control-notice">
            {!! $errors->first('link') !!}
        </div>
    </div>

</div>


<div id="cupones_promo_group" class="form-group {{ $errors->has('nombre')?'has-danger':''}}">
    <label class="col-sm-3 control-label">
        Cupón
    </label>
    <div class="col-md-6">

       <div class="am-checkbox">
             {!! Form::text('cupon',null,[
            'class' => 'form-control m-input',
            'placelholder' => '',

            ]) !!}
            <label style="margin-top: 4px;font-size: 12px;">
              Cupon para esta promoción
              @if (isset($model->cupon_id))
(<a style="pointer-events: initial;" href="{{route('adm.cupon.edit',$model->cupon_id)}}">ver detalles de este cupon</a>)
              @endif


            </label>
         </div>

        <div id="link-error" class="form-control-notice">
            {!! $errors->first('link') !!}
        </div>
    </div>

</div>


<div class="form-group {{ $errors->has('nombre')?'has-danger':''}}">
    <label class="col-sm-3 control-label">
        Prioridad
    </label>
    <div class="col-md-6">
        {!! Form::text('promocion_prioridad',null,[
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
        En servicios:
    </label>
    <div class="col-md-6">

       {!! Form::select('promocion_cualesservicios',
             $servicios_ar,null,[
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
        Valido por "N" transacciones
    </label>
    <div class="col-md-6">
        {!! Form::text('promocion_transacciones',null,[
       'class' => 'form-control m-input',
       'placelholder' => ''
       ]) !!}


        <div id="link-error" class="form-control-notice">
            {!! $errors->first('link') !!}
        </div>
    </div>

</div>


<div class="form-group {{ $errors->has('promocion_minimo')?'has-danger':''}}">
    <label class="col-sm-3 control-label">
        Mínimo a cobrar
    </label>
    <div class="col-md-6">
        {!! Form::text('promocion_minimo',null,[
       'class' => 'form-control m-input',
       'placelholder' => ''
       ]) !!}


        <div id="link-error" class="form-control-notice">
            {!! $errors->first('link') !!}
        </div>
    </div>

</div>
