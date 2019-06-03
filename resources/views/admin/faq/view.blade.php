@extends('admin.layout.index')

@section('title')
    Preguntas frecuentes | Editar
@endsection

@section('page-header')
            Preguntas frecuentes
@endsection

@section('content')
  <div class="row">
    <div class="col-md-12">
      <div class="panel panel-default">
        <div class="panel-heading">
          <h3>Editar pregunta frecuente</h3>
        </div>
        <div class="panel-body">
          <div style="border-radius: 0px;" class="form-horizontal group-border-dashed">
            {!! Form::model($model,[
            'method' => 'POST',
            'id' => 'frmBanner',
            'enctype' => 'multipart/form-data',
            'novalidate'=>"novalidate"
            ]) !!}
@include('admin.faq.fields')



            <div class="row">
              <div class="text-inverse col-md-9">
                <button type="submit" class="btn btn-space btn-primary">
                    <span class="btn-label">
                        <i class="fa fa-check"></i>
                    </span>
                    Guardar
                </button>
                  <a href="{{ route('adm.faq.index') }}" class="btn btn-space btn-default">
                      <span class="btn-label">
                          <i class="fa fa-times"></i>
                      </span>
                      Regresar
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
    </script>
@endsection
