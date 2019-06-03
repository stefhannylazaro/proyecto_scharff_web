


<div class="form-group {{ $errors->has('valor')?'has-danger':''}}">
    <label class="col-sm-3 control-label">
        {{$model->nombre}}
    </label>
    <div class="col-md-6">


        @if($model->tipo ==='checkbox')
          {{Form::hidden('valor',0)}}
          {!! Form::checkbox('valor',1, null,[
              'class' => '',
              'placelholder' => ''
          ]) !!}


        @elseif($model->tipo ==='opcion')
          @php
          $obj = (array)json_decode($model->options);
          $obj_opciones = [];
          if(isset($obj['opciones'])){
            $obj_opciones = $obj['opciones'];
          }

          @endphp
          {{-- {{$model->valor}} <br>
          {{print_r($obj_opciones)}} <br> --}}
          {!! Form::select('valor',
                  $obj_opciones,null,[
                'class' => 'form-control m-input',
                'placelholder' => ''
            ]) !!}


        @else
          {!! Form::text('valor',null,[
                  'class' => 'form-control m-input',
                  'placelholder' => ''
          ]) !!}

        @endif
        <div id="valor-error" class="form-control-notice">
            {!! $errors->first('valor') !!}
        </div>

        {!! Form::hidden('tipo',null,[
        ]) !!}

    </div>

</div>
<style type="text/css" media="screen">
input[type="checkbox"] {
font-size: 64px;
  margin-top: 10px;
}
</style>
