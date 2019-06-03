@extends('admin.layout.index')

@section('title')
    Administración | Configurador Link | Libro de Reclamación
@endsection

@section('page-header')
            Libro de Reclamación
@endsection

@section('content')
  <div class="row">
    <div class="col-md-12">
      <div class="panel panel-default">
        <div class="panel-heading">
          <h3>Detalle del Reclamo</h3>
        </div>
        <div class="panel-body">
          <div style="border-radius: 0px;" class="form-horizontal group-border-dashed">


            <h3> Numero : {{$obj->numero_reclamo}}</h3>
            <p>Fecha Creación: {{$obj->created_at}} </p>
            <p>Línea de Servicio: {{$obj->obtenerLineaServicio()}} </p>
            <p>Tipo Moneda: {{$obj->tipo_moneda}} </p>
            <hr>
            <h2>Identificación del consumidor</h2>
            <p>Nombre: {{$obj->nombre}}</p>
            <p>Departamento: {{$obj->ubigeo->departamento}}</p>
            <p>Provincia: {{$obj->ubigeo->provincia}}</p>
            <p>Distrito: {{$obj->ubigeo->distrito}}</p>
            <p>Domicilio: {{$obj->direccion}} </p>
            <p>DNI/CE: {{$obj->documento}} </p>
            <p>Teléfono: {{$obj->telefono}} </p>
            <p>Correo: {{$obj->correo}} </p>
            <p>Nombre del Padre o Madre (En caso de ser menor de edad):  {{$obj->descripcion_menor_edad? $obj->descripcion_menor_edad:'-'}}  </p>
            <hr>
            <h2>Identificación del bien contratado</h2>
            <p>Bien contratato: {{$obj->bien_contratado}} </p>
            <p>Monto reclamado: {{$obj->monto_reclamado}} </p>
            <p>Descripción: {{$obj->descripcion_bien_contratado? $obj->descripcion_bien_contratado: '-'}} </p>
            <hr>
            <h2>Detalle de reclamación y pedido del consumidor</h2>
            <p>Tipo de reclamo: {{$obj->tipo_reclamo}} </p>
            <p>Descripción: {{$obj->detalle_reclamo}} </p>
            <p>Pedido: {{$obj->pedido_reclamo? $obj->pedido_reclamo: '-'}} </p>
            <hr>
            <h2>Observaciones y acciones adoptadas por el proveedor</h2>
            <p>Detalle: {{$obj->observacion}} </p>

            @if ($obj->imagen_name)
              <hr>
              <h2>Imagen</h2>
              <img src="/{{config('app.url_image_claim')}}/{{ $obj->imagen_name }}" alt="" style="min-width:200px;display:block;"/>
            @endif

            <a class="btn btn-primary" href="{{ route('adm.claimbook.index') }}" role="button">
                Regresar
            </a>


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
