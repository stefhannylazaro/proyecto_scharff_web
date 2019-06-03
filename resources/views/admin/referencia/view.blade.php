@extends('admin.layout.index')

@section('title')
    Administración | Tipo de usuario | Editar
@endsection

@section('page-header')
            Tipo de usuario
@endsection

@section('content')
  <div class="row">
    <div class="col-md-12">
      <div class="panel panel-default">
        <div class="panel-heading">
          <h3>Editando Tipo de usuarios, con ID: {{$model->id}}</h3>
        </div>
        <div class="panel-body">
          <div style="border-radius: 0px;" class="form-horizontal group-border-dashed">
            {!! Form::model($model,[
            'method' => 'POST',
            'id' => 'frmBanner',
            'enctype' => 'multipart/form-data',
            'novalidate'=>"novalidate"
            ]) !!}


            @include('admin.referencia.fields')
            <div class="form-group">
                <label class="col-sm-3 control-label">
                  <a onclick="return confirm('¿Estas seguro?')" href="{{ route('adm.referencia.delete',$model->id) }}" class="ver-detail-item" title="Ver">
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
