@extends('admin.layout.index')

@section('title')
    Registro de incidencia
@endsection

@section('page-header')
            Incidencia
@endsection

@section('content')
  <div class="row">
    <div class="col-md-12">
      <div class="panel panel-default">
        <div class="panel-heading">
          <h3>Detalle de incidencia: {{$model->id}}</h3>
        </div>
        <div class="panel-body">
          <div style="border-radius: 0px;" class="form-horizontal group-border-dashed">
            <div class="form-group">
                <label class="col-sm-3 control-label">
                    Incidencia Nro.
                </label>
                <div class="col-md-6 value-label">
                    {{$model->id}}
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-3 control-label">
                    Customer id
                </label>
                <div class="col-md-6 value-label">
                    {{$model->customer_id}}
                </div>
            </div>


            <div class="form-group">
                <label class="col-sm-3 control-label">
                    Tipo de acción
                </label>
                <div class="col-md-6 value-label">
                    {{$model->tipo_accion}}
                </div>
            </div>



            <div class="form-group">
                <label class="col-sm-3 control-label">
                    Respuesta de la operación
                </label>
                <div class="col-md-6 value-label">
                    {{$model->trama_respuesta_culqi}}
                </div>
            </div>



            <div class="form-group">
                <label class="col-sm-3 control-label">
                    Fecha de registro
                </label>
                <div class="col-md-6 value-label">
                    {{$model->created_at}}
                </div>
            </div>
          </div>
          <div class="row">
            <div class="text-center col-md-9">

                <a href="{{ route('adm.log.index') }}" class="btn btn-space btn-default">
                        <span class="btn-label">
                            <i class="fa fa-times"></i>
                        </span>
                    Volver
                </a>
            </div>
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
