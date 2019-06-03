@extends('admin.layout.index')

@section('title')
    Administración | Pedido Express
@endsection

@section('page-header')
            Pedido Express
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
          <h3>Detalle del Pedido con ID : {{$model->pedido_id}}</h3>
        </div>
        <div class="panel-body">
          <div style="border-radius: 0px;" class="form-horizontal group-border-dashed">
            {!! Form::model($model,[
            'method' => 'POST',
            'id' => 'frmBanner',
            'enctype' => 'multipart/form-data',
            'novalidate'=>"novalidate"
            ]) !!}





            <div class="form-group">
                <label class="col-sm-3 control-label">
                    Codigo
                </label>
                <div class="col-md-6 value-label">
                    {{$model->pedido_codigo}}
                </div>
            </div>

            <div class="form-group">
                <label class="col-sm-3 control-label">
                    Fecha creacion
                </label>
                <div class="col-md-6 value-label">
                    {{$model->pedido_fechacreacion}}
                </div>
            </div>

            <div class="form-group">
                <label class="col-sm-3 control-label">
                    Calle desde
                </label>
                <div class="col-md-6 value-label">
                    {{$model->pedido_calledesde}}
                </div>
            </div>

            <div class="form-group">
                <label class="col-sm-3 control-label">
                    Calle hasta
                </label>
                <div class="col-md-6 value-label">
                    {{$model->pedido_callehasta}}
                </div>
            </div>

            <div class="form-group">
                <label class="col-sm-3 control-label">
                    Nombre emisor
                </label>
                <div class="col-md-6 value-label">
                    {{$model->pedido_nombreemisor}}
                </div>
            </div>

            <div class="form-group">
                <label class="col-sm-3 control-label">
                    Nombre receptor
                </label>
                <div class="col-md-6 value-label">
                    {{$model->pedido_nombrereceptor}}
                </div>
            </div>

            <div class="form-group">
                <label class="col-sm-3 control-label">
                    Cuanto paga
                </label>
                <div class="col-md-6 value-label">
                    {{$model->pedido_cuantopaga}}
                </div>
            </div>

            <div class="form-group">
                <label class="col-sm-3 control-label">
                    Corporativo
                </label>
                <div class="col-md-6 value-label">
                    {{$model->pedido_escorporativo}}
                </div>
            </div>

            <div class="form-group">
                <label class="col-sm-3 control-label">
                    Estado
                </label>
                <div class="col-md-6 value-label">
                    {{$model->pedido_estado}}
                </div>
            </div>


            <div class="row">
              <div class="text-center col-md-9">

                  <a href="{{ route('adm.pedido.index') }}" class="btn btn-space btn-default">
                          <span class="btn-label">
                              <i class="fa fa-times"></i>
                          </span>
                      Volver
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

            //
            // toastr.options = {
            //     "closeButton": false,
            //     "debug": false,
            //     "newestOnTop": false,
            //     "progressBar": false,
            //     "positionClass": "toast-top-right",
            //     "preventDuplicates": false,
            //     "onclick": null,
            //     "showDuration": "350",
            //     "hideDuration": "1000",
            //     "timeOut": "5000",
            //     "extendedTimeOut": "1000",
            //     "showEasing": "swing",
            //     "hideEasing": "linear",
            //     "showMethod": "fadeIn",
            //     "hideMethod": "fadeOut"
            // };
            //
            // @if(session('mensaje'))
            // toastr.success('{{session('mensaje')}}');
            // @endif

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
