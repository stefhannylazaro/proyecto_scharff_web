@if(isset($model))
<div class="form-group {{ $errors->has('titulo')?'has-danger':''}}">
    <label class="col-sm-3 control-label">
        Fecha de creación
    </label>
    <div class="col-md-6 value-label">
        {{$model->created_at}}
    </div>
</div>
@endif


<div class="form-group {{ $errors->has('alerta_descripcion')?'has-danger':''}}">
    <label class="col-sm-3 control-label">
        Descripción
    </label>
    <div class="col-md-7">
      <div class="row">
          <div class="col-md-12">
            <div class="panel panel-default">
              <div class="">
                <div id="editor1a">{!! isset($model->alerta_descripcion)?$model->alerta_descripcion:''!!}</div>
                <input type="hidden" name="alerta_descripcion" id="alerta_descripcion" value="">
              </div>
            </div>
          </div>
        </div>
        <div id="alerta_descripcion-error" class="form-control-notice">
            {!! $errors->first('alerta_descripcion') !!}
        </div>
    </div>

</div>

<div class="form-group  {{ $errors->has('alerta_fecha')?'has-danger':''}}">
    <label class="col-sm-3 control-label">
        Fecha de alerta
    </label>
    <div class="col-md-2 input-group date datepicker" data-min-view="2" style="padding-left: 15px;">
        {!! Form::text('alerta_fecha',null,[
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
@section('script')
    <script type="text/javascript">
      $('.datepicker').datetimepicker({
          todayHighlight: true,
          autoclose: true,
          pickerPosition: 'bottom-left',
          format: 'yyyy-mm-dd',
          clearBtn: true
      });
      $('#editor1a').summernote({
        height: 250
      });
      $('#frmBanner').submit(function() {
        var aaaa = $("#editor1a").code();
        $('#alerta_descripcion').val(aaaa);
      });

    </script>
@endsection
