<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>Scharff - Grupo Scharff</title>
        <meta name="description" content="En Scharff creamos conexiones de alto valor para nuestros clientes a través de soluciones estratégicas diseñadas en nuestro Scharff Lab, el primer laboratorio de innovación logística en el Perú. A partir de nuestra experiencia. Carga. Aduana. Transporte. Almacenamiento. Distribución. FedEx Express. ¡Vive la experiencia!"  />
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, minimal-ui">
        <!-- Fonts -->
        <!-- <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css"> -->
        <link rel="stylesheet" type="text/css" href="{{ mix('css/app.css') }}">
        <link href='https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Material+Icons' rel="stylesheet">
        
        <!-- Styles -->

    </head>
    <body>


    {!! Form::model(null,[
       'method'=>'POST',
       'role'=>'form',
       'class' => 'form-horizontal',
       'id' =>"frmValidate",
       'enctype' => "multipart/form-data"]) !!}


        <p>Número Reclamo: {{$numero_reclamo}}</p>
    <hr>
    <br>
        <p>                {!!Form::text('nombre',  null, ['placeholder'=>'Nombre del Consumidor', 'class' => 'form-control'])!!}

            @if($errors->has('nombre'))
                <span class="help-block">
                <strong>{{ $errors->first('nombre') }}</strong>
            </span>
            @endif
        </p>
        <p>
            Departamento : {!!Form::select('departamento', $departments, $department,["id" =>"id_department" ,'class' => 'ubigeo form-control'])!!}
            @if($errors->has('departamento'))
                <span class="help-block">
                <strong>{{ $errors->first('departamento') }}</strong>
            </span>
            @endif
            <br>
            Provincia : {!!Form::select('provincia', $provinces, $province,["id" =>"id_province",'class' => 'form-control ubigeo'])!!}
            @if($errors->has('provincia'))
                <span class="help-block">
                <strong>{{ $errors->first('provincia') }}</strong>
            </span>
            @endif
            <br>
            Distrito : {!!Form::select('distrito', $districts, $district,["id" =>"id_district",'class' => 'form-control field'])!!}
            @if($errors->has('distrito'))
                <span class="help-block">
                <strong>{{ $errors->first('distrito') }}</strong>
            </span>
            @endif
            <br>
        </p>

        <p>                {!!Form::text('direccion',  null, ['placeholder'=>'Domicilio', 'class' => 'form-control'])!!}
            @if($errors->has('direccion'))
                <span class="help-block">
                <strong>{{ $errors->first('direccion') }}</strong>
            </span>
            @endif
        </p>

        <p>                {!!Form::text('documento',  null, ['placeholder'=>'DNI/CE', 'class' => 'form-control'])!!}
            @if($errors->has('documento'))
                <span class="help-block">
                <strong>{{ $errors->first('documento') }}</strong>
            </span>
            @endif
        </p>

        <p>                {!!Form::text('telefono',  null, ['placeholder'=>'Teléfono', 'class' => 'form-control'])!!}
            @if($errors->has('telefono'))
                <span class="help-block">
                <strong>{{ $errors->first('telefono') }}</strong>
            </span>
            @endif
        </p>

        <p>                {!!Form::text('correo',  null, ['placeholder'=>'Correo electrónico', 'class' => 'form-control'])!!}
            @if($errors->has('correo'))
                <span class="help-block">
                <strong>{{ $errors->first('correo') }}</strong>
            </span>
            @endif
        </p>

        <p>                {!!Form::textarea('descripcion_menor_edad',  null, ['placeholder'=>'Descripcion Menor de edad', 'class' => 'form-control'])!!}
        </p>

    <hr>
    <br>

        <p>
            <span>{!! Form::radio('bien_contratado', 'Producto', true) !!} Producto</span>
            <span>{!! Form::radio('bien_contratado', 'Servicio', false) !!} Servicio</span>
        </p>


    <p>                {!!Form::text('monto_reclamado',  null, ['placeholder'=>'Monto Reclamado', 'class' => 'form-control'])!!}
        @if($errors->has('monto_reclamado'))
            <span class="help-block">
                <strong>{{ $errors->first('monto_reclamado') }}</strong>
            </span>
        @endif
    </p>

    <p>                {!!Form::textarea('descripcion_bien_contratado',  null, ['placeholder'=>'Descripcion bien contratado', 'class' => 'form-control'])!!}
    </p>

    <hr>
    <br>
    <p>
        <span>{!! Form::radio('tipo_reclamo', 'Reclamo', true) !!} Reclamo</span>
        <span>{!! Form::radio('tipo_reclamo', 'Queja', false) !!} Queja</span>
    </p>

    <p>                {!!Form::textarea('detalle_reclamo',  null, ['placeholder'=>'Descripcion Reclamo', 'class' => 'form-control'])!!}
    </p>

    <p>                {!!Form::textarea('pedido_reclamo',  null, ['placeholder'=>'Pedido Reclamo', 'class' => 'form-control'])!!}
    </p>

    <hr>
    <br>
    <p>                {!!Form::textarea('observacion',  null, ['placeholder'=>'Observación Detalle', 'class' => 'form-control'])!!}
    </p>

    {!! Html::script('assets/admin/js/jquery.min.js') !!}

    <div class="col-md-6 -col-md-6 frm-actions">
        <div class="form-group text-center">
            <button class="btn btn-rounded btn-success">
                            <span class="btn-label">
                                <i class="fa fa-check"></i>
                            </span>
                Guardar
            </button>
        </div>
    </div>

    {!! Form::close() !!}

    <script>
        $(function (){

            $(".ubigeo").change(function (){
                var id = $(this).attr('id');
                var value = $(this).val();
                var cadena = (id.search('department') >= 0) ? 'Provincia': 'Distrito';
                var id_2;
                var newOptions = {
                    '' : cadena
                };
                if (id.search('department') >= 0){
                    clean_district(id);
                    department(newOptions,value);
                    id_2 = id.replace('department', 'province');
                }else{
                    province(newOptions, value);
                    id_2 = id.replace('province', 'district');
                }
                var options;
                var selectedOption = '';
                var select = $('#'+id_2);
                if(select.prop){
                    options = select.prop('options');
                }
                else {
                    options = select.attr('options');
                }
                $('option', select).remove();

                $.each(newOptions, function(val, text) {
                    options[options.length] = new Option(text, val);
                });
                select.val(selectedOption);
            });

            function department(options,value){
                @foreach($location_list as $location)
                if ("{{$location->departamento}}" == value){
                    options["{{$location->provincia}}"] = "{{$location->provincia}}";
                }
                @endforeach
            }

            function province(options, value){
                @foreach($location_list as $location)
                if ("{{$location->provincia}}" == value){
                    options["{{$location->distrito}}"] = "{{$location->distrito}}";
                }
                @endforeach
            }

            function clean_district(ids){
                var newOptions = {
                    '' : 'Distrito'
                };
                var selectedOption = '';
                var id = ids.replace('department', 'district');
                var select = $('#' + id);
                var options;
                if(select.prop){
                    options = select.prop('options');
                }
                else {
                    options = select.attr('options');
                }
                $('option', select).remove();


                console.log(newOptions);

                $.each(newOptions, function(val, text) {
                    options[options.length] = new Option(text, val);
                });
                select.val(selectedOption);
            }
        });



    </script>
    </body>
</html>
