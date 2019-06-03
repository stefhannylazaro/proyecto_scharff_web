@extends('admin.layout.index')

@section('title')
    Administración | Servicio | Ver Motivo
@endsection

@section('page-header')
            Ver motivo
@endsection

@section('content')
  <div class="row">
    <div class="col-md-12">
      <div class="panel panel-default">
        <div class="panel-heading">
          <h3>Ver motivo</h3>
        </div>
        <div class="panel-body">
          <div style="border-radius: 0px;" class="form-horizontal group-border-dashed">
            {!! Form::model($model,[
            'method' => 'POST',
            'id' => 'frmBanner',
            'enctype' => 'multipart/form-data',
            'novalidate'=>"novalidate"
            ]) !!}


            @include('admin.motivo.fields')

            <div class="row">
              <div class="text-inverse col-md-9">
                  <button type="submit" class="btn btn-space btn-primary">
                      <span class="btn-label">
                          <i class="fa fa-check"></i>
                      </span>
                      Guardar
                  </button>

                  <a href="{{ route('adm.motivo.index') }}" class="btn btn-space btn-default">
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
        $(document).ready(function(){

            $('#editor1a').summernote({
              height: 250
            });
            $('#editor2a').summernote({
              height: 250
            });
            $('#frmBanner').submit(function() {
              var aaaa = $("#editor1a").code();
              $('#mensaje_personalizado_staff').val(aaaa);
              var bbbb = $("#editor2a").code();
              $('#mensaje_personalizado_cliente').val(bbbb);
            });
        })
        //banner.init();
    </script>
@endsection
