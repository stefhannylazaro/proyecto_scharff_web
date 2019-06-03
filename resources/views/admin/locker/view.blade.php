@extends('admin.layout.index')

@section('title')
    Administración | Locker | Editar
@endsection

@section('page-header')
            Locker
@endsection

@section('content')
  <div class="row">
    <div class="col-md-12">
      <div class="panel panel-default">
        <div class="panel-heading">
          <h3>Editar Locker</h3>
        </div>
        <div class="panel-body">
          <div style="border-radius: 0px;" class="form-horizontal group-border-dashed">
            {!! Form::model($model,[
            'method' => 'POST',
            'id' => 'frmBanner',
            'enctype' => 'multipart/form-data',
            'novalidate'=>"novalidate"
            ]) !!}


            @include('admin.locker.fields')

            <div class="row">
              <div class="text-inverse col-md-9">
                  <button type="submit" class="btn btn-space btn-primary">
                      <span class="btn-label">
                          <i class="fa fa-check"></i>
                      </span>
                      Guardar
                  </button>

                  <a href="{{ route('adm.locker.index') }}" class="btn btn-space btn-default">
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
    <script src="/assets/app/js/mapa-sucursal.js" charset="utf-8"></script>
    <script type="text/javascript">
        var draggable = false;
    </script>

    <script async defer
            src="//maps.googleapis.com/maps/api/js?key={{config('app.APP_MAPA_ID')}}&libraries=drawing,places&callback=initMap">
    </script>
@endsection
