@extends('admin.layout.index')

@section('title')
    Administración | Cupón | Editar
@endsection

@section('page-header')
            Cupón
@endsection

@section('content')
  <style media="screen">
  .s7-date:before {
  content: "\e660";
}
  </style>
  <div class="row">
    <div class="col-md-12">
      <div class="panel panel-default">
        <div class="panel-heading">
          <h3>Editando cupón con ID: {{$model->cupon_id}}</h3>
        </div>
        <div class="panel-body">
          <div style="border-radius: 0px;" class="form-horizontal group-border-dashed">
            {!! Form::model($model,[
            'method' => 'POST',
            'id' => 'frmBanner',
            'enctype' => 'multipart/form-data',
            'novalidate'=>"novalidate"
            ]) !!}


            @include('admin.cupon.fields')
            <div class="row">
              <div class=" col-md-9">

          </div>
          </div>


          <div class="form-group">
              <label class="col-sm-3 control-label">
                <a onclick="return confirm('¿Estas seguro?')" href="{{ route('adm.cupon.delete',$model->cupon_id) }}" class="ver-detail-item" title="Ver">
                    Eliminar
                </a>
              </label>
              <div class="col-md-6">

              </div>
          </div>






            <div class="row">
              <div class="text-inverse col-md-9">
                  <button type="submit" class="btn btn-space btn-primary">
                      <span class="btn-label">
                          <i class="fa fa-check"></i>
                      </span>
                      Guardar
                  </button>

                  <a href="{{ route('adm.cupon.index') }}" class="btn btn-space btn-default">
                          <span class="btn-label">
                              <i class="fa fa-times"></i>
                          </span>
                      Cancelar
                  </a>


              </div>
            </div>

            {!! Form::close() !!}
          </div>

        </div>
      </div>
    </div>
  </div>




@endsection

@section('script')
    <script type="text/javascript">
        //banner.init();


        $(function () {
            $('.datepicker').datetimepicker({
                todayHighlight: true,
                autoclose: true,
                pickerPosition: 'bottom-left',
                format: 'yyyy-mm-dd hh:ii:00',
                clearBtn: true,

            });
        });
    </script>
@endsection
