@extends('admin.layout.index')

@section('title')
    Administración | Contacto | Ver Contacto
@endsection

@section('page-header')
            Contacto
@endsection

@section('content')
  <div class="row">
    <div class="col-md-12">
      <div class="panel panel-default">
        <div class="panel-heading">
          <h3>Detalle de Contacto</h3>
        </div>
        <div class="panel-body">
          <div style="border-radius: 0px;" class="form-horizontal group-border-dashed">


            <div class="form-group">
                <label class="col-sm-3 control-label">
                    Fecha Creación:
                </label>
                <div class="col-md-6 value-label">
                    {{$obj->created_at}}
                </div>
            </div>

            <div class="form-group">
                <label class="col-sm-3 control-label">
                    Empresa :
                </label>
                <div class="col-md-6 value-label">
                    {{$obj->empresa}}
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-3 control-label">
                    Nombre del Contacto:
                </label>
                <div class="col-md-6 value-label">
                    {{$obj->nombre}}
                </div>
            </div>

            <div class="form-group">
                <label class="col-sm-3 control-label">
                    Correo corporativo: {{$obj->correo}}
                </label>
                <div class="col-md-6 value-label">
                    {{$obj->correo}}
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-3 control-label">
                    Teléfono o Celular: {{$obj->contacto}}
                </label>
                <div class="col-md-6 value-label">
                    {{$obj->contacto}}
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-3 control-label">
                    Motivo de contacto:
                </label>
                <div class="col-md-6 value-label">
                    {{$obj->motivo}}
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-3 control-label">
                    Servicios: {{$obj->servicios}}
                </label>
                <div class="col-md-6 value-label">
                    {{$obj->servicios}}
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-3 control-label">
                    Mensaje: {{$obj->mensaje}}
                </label>
                <div class="col-md-6 value-label">
                    {{$obj->mensaje}}
                </div>
            </div>




            <div class="row">
              <div class="text-center col-md-9">

                  <a href="{{ route('adm.contacto.index') }}" class="btn btn-space btn-default">
                      <span class="btn-label">
                          
                      </span>
                      Regresar
                  </a>
              </div>
            </div>

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
