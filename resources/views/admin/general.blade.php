@extends('admin.layout.index')

@section('title')
    Dashboard - Listado general
@endsection

@section('page-header')
  Dashboard - Listado general
@endsection

@section('content')

  <div class="row">
    <div class="col-sm-12">
      <div class="widget widget-fullwidth widget-small">
        <div class="widget-head">
          <div class="tools input-group-btn">
            <span class="icon s7-menu2"  data-toggle="dropdown" ></span>
            <ul class="dropdown-menu pull-right">
              <li>
                <span class="m-nav__section-text">
                  Acciones
                </span>
              </li>
              <li class="m-nav__item">
                  @php
                  $current = route('adm.general.order');
                  $full = url()->full();
                  $query_str = parse_url($full, PHP_URL_QUERY);
                  @endphp


                  <a href="{{route('adm.general.downloadsistemas') .'?'. $query_str  }}" class="m-nav__link open-external" id="a_reserva_download">
                      <span class="">
                          Descargar Data Sistemas
                      </span>
                  </a>
              </li>
              <li class="m-nav__item">
                  @php
                  $current = route('adm.general.order');
                  $full = url()->full();
                  $query_str = parse_url($full, PHP_URL_QUERY);
                  @endphp


                  <a href="{{route('adm.general.download') .'?'. $query_str  }}" class="m-nav__link open-external">
                      <span class="">
                          Descargar Data
                      </span>
                  </a>
              </li>
            </ul>
          </div>
          <div class="title">Listado general</div>
        </div>


        {!! Form::open([
           'method' => 'GET',
           'id' => 'frmSearch'
        ]) !!}

        <div class="panel-body row">
          <form role="form" >
            <div class=" col-md-4 ">
              <div class="dataTables_info value-label" id="table1_info" role="status" aria-live="polite">
                Mostrando &nbsp;&nbsp;{!! Form::select('pager',
                      [
                          10 => '10',
                          20 => '20',
                          25 => '25',
                          50 => '50',
                          100 => '100'
                      ],@$pager,
                      [
                          'class'=>'selectpicker m-datatable__pager-size select-pager',
                          'tabindex'=>"-98",
                          'data-width'=>'70px'
                      ]) !!} &nbsp;&nbsp; filas

              </div>
            </div>

            <div class="col-md-4">
              <div class="form-group m-form__group class_1530115754">
                <div class="row">


                  <div class="input-group date datepicker" style="padding-left: 15px;">
                      <input class="form-control datetimepicker" value="{{$fecha_inicio}}" data-min-view="2" autocomplete="off" data-date-format="yyyy-mm-dd" placeholder="Fecha inicio" id="filtro_fecha_inicio" name="filtro_fecha_inicio" type="text">
                      <span class="input-group-addon">
                          <i class="icon-th s7-date"></i>
                      </span>
                  </div>

                  <div class="input-group date datepicker" style="padding-left: 15px;">
                      <input class="form-control datetimepicker" value="{{$fecha_fin}}" data-min-view="2" autocomplete="off" data-date-format="yyyy-mm-dd" placeholder="Fecha fin" id="filtro_fecha_fin" name="filtro_fecha_fin" type="text">
                      <span class="input-group-addon">
                          <i class="icon-th s7-date"></i>
                      </span>
                  </div>

                </div>





              </div>
            </div>
            <div class=" col-md-4 ">
              <div class="input-group ">
                <input name="search" value="{{ $search }}" id="generalSearch" placeholder="Buscar:" type="text" class="form-control"><span class="input-group-btn">
                  <button type="submit" class="btn btn-primary">Buscar</button></span>
              </div>
            </div>
          </form>
        </div>








        <div class="table-responsive noSwipe">
        <table id="table1" class="table table-striped table-fw-widget table-hover">
          <thead>
            <tr>
              <th>
              <a href="{{  route('adm.general.order',['column-1', $order, 'pager' => $pager, 'search' => $search])}}">
                ID transacción
                  @if($column == 'column-1')
                      <span class="glyphicon glyphicon-sort-by-attributes{{$order == 'desc'? '':'-alt'}}"></span>
                  @endif
                </a>
              </th>
              <th>
              <a href="{{  route('adm.general.order',['column-2', $order, 'pager' => $pager, 'search' => $search])}}">
                Fecha de transacción
                  @if($column == 'column-2')
                      <span class="glyphicon glyphicon-sort-by-attributes{{$order == 'desc'? '':'-alt'}}"></span>
                  @endif
                </a>
              </th>
              <th>
              <a href="{{  route('adm.general.order',['column-3', $order, 'pager' => $pager, 'search' => $search])}}">
                ID cliente
                  @if($column == 'column-3')
                      <span class="glyphicon glyphicon-sort-by-attributes{{$order == 'desc'? '':'-alt'}}"></span>
                  @endif
                </a>
              </th>
              <th>
              <a href="{{  route('adm.general.order',['column-4', $order, 'pager' => $pager, 'search' => $search])}}">
                Servicio
                  @if($column == 'column-4')
                      <span class="glyphicon glyphicon-sort-by-attributes{{$order == 'desc'? '':'-alt'}}"></span>
                  @endif
                </a>
              </th>
              <th>
              <a href="{{  route('adm.general.order',['column-5', $order, 'pager' => $pager, 'search' => $search])}}">
                Nombres Cliente
                  @if($column == 'column-5')
                      <span class="glyphicon glyphicon-sort-by-attributes{{$order == 'desc'? '':'-alt'}}"></span>
                  @endif
                </a>
              </th>
              <th>
              <a href="{{  route('adm.general.order',['column-5', $order, 'pager' => $pager, 'search' => $search])}}">
                Apellidos Cliente
                  @if($column == 'column-5')
                      <span class="glyphicon glyphicon-sort-by-attributes{{$order == 'desc'? '':'-alt'}}"></span>
                  @endif
                </a>
              </th>
              <th>
              <a href="{{  route('adm.general.order',['column-5', $order, 'pager' => $pager, 'search' => $search])}}">
                Correo cliente
                  @if($column == 'column-5')
                      <span class="glyphicon glyphicon-sort-by-attributes{{$order == 'desc'? '':'-alt'}}"></span>
                  @endif
                </a>
              </th>
              <th>
              <a href="{{  route('adm.general.order',['column-5', $order, 'pager' => $pager, 'search' => $search])}}">
                Número de documento
                  @if($column == 'column-5')
                      <span class="glyphicon glyphicon-sort-by-attributes{{$order == 'desc'? '':'-alt'}}"></span>
                  @endif
                </a>
              </th>
              <th>
              <a href="{{  route('adm.general.order',['column-5', $order, 'pager' => $pager, 'search' => $search])}}">
                Razón Social
                  @if($column == 'column-5')
                      <span class="glyphicon glyphicon-sort-by-attributes{{$order == 'desc'? '':'-alt'}}"></span>
                  @endif
                </a>
              </th>
              <th>
              <a href="{{  route('adm.general.order',['column-5', $order, 'pager' => $pager, 'search' => $search])}}">
                Comprobante
                  @if($column == 'column-5')
                      <span class="glyphicon glyphicon-sort-by-attributes{{$order == 'desc'? '':'-alt'}}"></span>
                  @endif
                </a>
              </th>
              <th>
              <a href="{{  route('adm.general.order',['column-5', $order, 'pager' => $pager, 'search' => $search])}}">
                Cantidad
                  @if($column == 'column-5')
                      <span class="glyphicon glyphicon-sort-by-attributes{{$order == 'desc'? '':'-alt'}}"></span>
                  @endif
                </a>
              </th>
              <th>
              <a href="{{  route('adm.general.order',['column-5', $order, 'pager' => $pager, 'search' => $search])}}">
                Tarifa
                  @if($column == 'column-5')
                      <span class="glyphicon glyphicon-sort-by-attributes{{$order == 'desc'? '':'-alt'}}"></span>
                  @endif
                </a>
              </th>
              <th>
                <a href="{{  route('adm.general.order',['column-5', $order, 'pager' => $pager, 'search' => $search])}}">
                Dirección Facturación
                  @if($column == 'column-5')
                      <span class="glyphicon glyphicon-sort-by-attributes{{$order == 'desc'? '':'-alt'}}"></span>
                  @endif
                </a>
              </th>
              <th>
              <a href="{{  route('adm.general.order',['column-5', $order, 'pager' => $pager, 'search' => $search])}}">
                Medio de pago
                  @if($column == 'column-5')
                      <span class="glyphicon glyphicon-sort-by-attributes{{$order == 'desc'? '':'-alt'}}"></span>
                  @endif
                </a>
              </th>
              <th>
              <a href="{{  route('adm.general.order',['column-5', $order, 'pager' => $pager, 'search' => $search])}}">
                Tarjeta
                  @if($column == 'column-5')
                      <span class="glyphicon glyphicon-sort-by-attributes{{$order == 'desc'? '':'-alt'}}"></span>
                  @endif
                </a>
              </th>
              <th>
              <a href="{{  route('adm.general.order',['column-5', $order, 'pager' => $pager, 'search' => $search])}}">
                Código Medio Pago
                  @if($column == 'column-5')
                      <span class="glyphicon glyphicon-sort-by-attributes{{$order == 'desc'? '':'-alt'}}"></span>
                  @endif
                </a>
              </th>
              <th>
              <a href="{{  route('adm.general.order',['column-5', $order, 'pager' => $pager, 'search' => $search])}}">
                Estado Medio de Pago
                  @if($column == 'column-5')
                      <span class="glyphicon glyphicon-sort-by-attributes{{$order == 'desc'? '':'-alt'}}"></span>
                  @endif
                </a>
              </th>

              <th class="text-center">Acciones</th>
            </tr>
          </thead>
          <tbody>
            @if(count($models))
              @foreach($models as $model)

                <tr class="odd gradeX">
                  <td>{{ $model->id }}</td>
                  <td>{{ $model->created_at }}</td>
                  <td>{{ $model->usuario_id }}</td>

                  <td>
                    @if($model->tipo == 'reserva' )
                      Stop Locker
                    @elseif ($model->tipo == 'regular')
                      Envio regular
                    @else
                      Envio express
                    @endif
                  </td>
                  <td>{{ $model->usuario_nombre }}</td>
                  <td>{{ $model->usuario_apellidos }}</td>
                  <td>{{ $model->email }}</td>
                  <td>{{ $model->usuario_dni }}</td>
                  <td>
                    @isset($model->usuario_razon_social)
                      {{ $model->usuario_razon_social }}
                    @endisset
                  </td>
                  <td>
                    @isset($model->comprobante)
                      {{ $model->comprobante }}
                    @endisset
                  </td>
                  <td>{{ 1 }}</td>
                  <td>{{ $model->tarifa }}</td>
                  <td>
                    @isset($model->direcciónfacturación)
                      {{ $model->direcciónfacturación }}
                    @endisset
                  </td>
                  <td>
                    @isset($model->medio_de_pago)
                      {{ $model->medio_de_pago }}
                    @endisset
                  </td>
                  <td>
                    @isset($model->tarjeta)
                      {{ $model->tarjeta }}
                    @endisset
                  </td>
                  <td>
                    @isset($model->codigo_mediopago)
                      {{ $model->codigo_mediopago }}
                    @endisset
                  </td>
                  <td>
                    @isset($model->estado_medio_pago)
                      {{ $model->estado_medio_pago }}
                    @endisset
                  </td>
                  <td class="text-center">
                    @if (isset($model->tipo)&&!empty($model->tipo))
                      <a href="{{route('adm.'.$model->tipo.'.view',$model->id) }}" class="ver-detail-item"
                        title="Ver"><span class="icon s7-look"></span>
                      </a>
                    @endif


                  </td>

                </tr>
          @endforeach
          @else
              <span class="m-datatable--error" style="width: 100%;">No records found</span>
          @endif

          </tbody>
        </table>
      </div>



      <div class="row am-datatable-footer">
        <div class="col-sm-5">
          <div class="dataTables_info" id="table1_info" role="status" aria-live="polite">
            @php
              $nMostrados = $pager;
              if($models->cuantosson<$pager){
                $nMostrados = $models->cuantosson;
              }
            @endphp
            Mostrando {{$nMostrados}} registros de {{$models->cuantosson}}

          </div>
        </div>
        <div class="col-sm-7">
          <div class="dataTables_paginate paging_simple_numbers" id="table1_paginate">
          </div>
        </div>
      </div>



      </div>
    </div>
  </div>





@endsection

@section('script')
    <script>
        //app.init();

        toastr.options = {
            "closeButton": false,
            "debug": false,
            "newestOnTop": false,
            "progressBar": false,
            "positionClass": "toast-top-right",
            "preventDuplicates": false,
            "onclick": null,
            "showDuration": "350",
            "hideDuration": "1000",
            "timeOut": "5000",
            "extendedTimeOut": "1000",
            "showEasing": "swing",
            "hideEasing": "linear",
            "showMethod": "fadeIn",
            "hideMethod": "fadeOut"
        };

        @if(session('mensaje'))
            toastr.success('{{session('mensaje')}}');
        @endif



        $(document).ready(function(){
          $(".datetimepicker").datetimepicker({
            autoclose: true,
            componentIcon: '.s7-date',
            navIcons:{
              rightIcon: 's7-angle-right',
              leftIcon: 's7-angle-left'
            }
          });


          $('.open-external').on('click',function(){
            var esteurl = $(this).attr('href');


            if(esteurl.indexOf('filtro_fecha_inicio')===-1){


              var fecha_inicio = $('#filtro_fecha_inicio').val();
              var fecha_fin = $('#filtro_fecha_fin').val();
              if(fecha_inicio!=''&&fecha_fin!=''){
                if(esteurl.indexOf('?')!==-1){
                  a = '&filtro_fecha_inicio='+fecha_inicio+'&filtro_fecha_fin='+fecha_fin;
                }else{
                  a  = '?filtro_fecha_inicio='+fecha_inicio+'&filtro_fecha_fin='+fecha_fin;
                }
                esteurl += a;
              }
            }

            console.log("open");
            console.log(esteurl);
            window.open(esteurl, "_blank")
            return false;
          })
        })
    </script>

@endsection
