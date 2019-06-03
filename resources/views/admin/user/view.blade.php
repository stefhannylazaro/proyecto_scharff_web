@extends('admin.layout.index')

@section('title')
    Administración | Usuario | Ver
@endsection

@section('page-header')
            Usuario
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
          <h3>Ver usuario con ID: {!!@$model->id!!}</h3>
        </div>
        <div class="panel-body">
          <div style="border-radius: 0px;" class="form-horizontal group-border-dashed">
            {!! Form::model($model,[
            'method' => 'POST',
            'id' => 'frmBanner',
            'enctype' => 'multipart/form-data',
            'novalidate'=>"novalidate"
            ]) !!}


            @include('admin.user.fields')

            <div class="row">
              <div class="text-inverse col-md-9">
                  <button type="submit" class="btn btn-space btn-primary">
                      <span class="btn-label">
                          <i class="fa fa-check"></i>
                      </span>
                      Guardar
                  </button>

                  <a href="{{ route('adm.user.index') }}" class="btn btn-space btn-default">
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
