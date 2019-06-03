@extends('admin.layout.index')

@section('title')
    Administración | Referencia | Editar
@endsection

@section('page-header')
            Tipo de usuario
@endsection

@section('content')
  <div class="row">
    <div class="col-md-12">
      <div class="panel panel-default">
        <div class="panel-heading">
          <h3>Crear tipo de usuario</h3>
        </div>
        <div class="panel-body">
          <div style="border-radius: 0px;" class="form-horizontal group-border-dashed">
            {!! Form::model(null,[
            'method' => 'POST',
            'id' => 'frmBanner',
            'enctype' => 'multipart/form-data',
            'novalidate'=>"novalidate"
            ]) !!}


            @include('admin.referencia.fields')

            <div class="row">
              <div class="text-inverse col-md-9">
                  <button type="submit" class="btn btn-space btn-primary">
                      <span class="btn-label">
                          <i class="fa fa-check"></i>
                      </span>
                      Guardar
                  </button>

                  <a href="{{ route('adm.referencia.index') }}" class="btn btn-space btn-default">
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


        $(document).ready(function(){
          $('#enlace').html('https://holascharff.com/registro?tipo='+$('#nombre').val());
          $('#nombre').on('keypress', function(e) {
              if (e.which == 32){
                  return false;
              }
          });

          $('#nombre').on('keyup', function(e) {
              $('#enlace').html('https://holascharff.com/registro?tipo='+$('#nombre').val());
          });


          $('#frmBanner').submit(function() {
            if($('#nombre').val()==''){
              $('#nombre-error').html("Debes ingresar un texto válido")
              return false;
            };
          });


        })
    </script>
@endsection
