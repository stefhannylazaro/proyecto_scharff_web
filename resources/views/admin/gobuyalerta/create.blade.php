@extends('admin.layout.index')

@section('title')
    Administración | Alerta go & buy | Nuevo
@endsection

@section('page-header')
            Nueva alerta
@endsection

@section('content')
<style media="screen">
  .s7-date:before {
    content: "\e660";
  }
  .date.datepicker input{
    background: #fff;
  }
</style>
  <div class="row">
    <div class="col-md-12">
      <div class="panel panel-default">
        <div class="panel-heading">
          <h3>Nueva alerta</h3>
        </div>
        <div class="panel-body">
          <div style="border-radius: 0px;" class="form-horizontal group-border-dashed">
            {!! Form::model(null,[
            'method' => 'POST',
            'id' => 'frmBanner',
            'enctype' => 'multipart/form-data',
            'novalidate'=>"novalidate"
            ]) !!}


            @include('admin.gobuyalerta.fields')

            <div class="row">
              <div class="text-inverse col-md-9">
                  <button type="submit" class="btn btn-space btn-primary">
                      <span class="btn-label">
                          <i class="fa fa-check"></i>
                      </span>
                      Guardar
                  </button>

                  <a href="{{ route('adm.gobuyalerta.index') }}" class="btn btn-space btn-default">
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
      
    </script>
@endsection
