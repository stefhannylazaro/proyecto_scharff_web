<h1>Hola admin </h1>
<p> Se ha recibido una un reclamo en Scharff.</p>

<hr>
<h2>Los datos ingresados fueron: </h2>

<p> Numero : {{$obj->numero_reclamo}}</p>
<p>Fecha Creación: {{$obj->created_at}} </p>
<p>Línea de Servicio: {{$obj->obtenerLineaServicio()}} </p>
<p>Tipo Moneda: {{$obj->tipo_moneda}} </p>

<p>Identificación del consumidor</p>
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
<p>Descripción: {{$obj->detalle_reclamo? $obj->detalle_reclamo:'' }} </p>
<p>Pedido: {{$obj->pedido_reclamo? $obj->pedido_reclamo: '-'}} </p>
<hr>
<h2>Observaciones y acciones adoptadas por el proveedor</h2>
<p>Detalle: {{$obj->observacion? $obj->observacion:'-' }} </p>
