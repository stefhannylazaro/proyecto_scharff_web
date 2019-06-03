@extends('admin.layout.index')

@section('title')
    Administracion | Pedido Go & Buy
@endsection

@section('page-header')
  Pedidos Go & Buy
@endsection

@section('content')
  <style>

  </style>

  <div class="row">
    <div class="col-sm-12">
      <div class="widget widget-fullwidth widget-small">
        <div class="widget-head">
          <!-- <div class="widget-head">
            <div class="tools input-group-btn">
              <span class="icon s7-menu2"  data-toggle="dropdown" ></span>
              <ul class="dropdown-menu pull-right">
                <li>
                  <span class="m-nav__section-text">
                        Acciones
                  </span>
                </li>
                <li>
                    <a href="{{route('adm.banner.new')}}" class="m-nav__link">
                        <span class="m-nav__link-text">
                            <i class="icon s7-plus"></i> Agregar
                        </span>
                    </a>
                </li>
              </ul>
            </div>
            <div class="title">Crear</div>
          </div> -->
          <div class="tools input-group-btn">
            <span class="icon s7-menu2"  data-toggle="dropdown" ></span>
            <ul class="dropdown-menu pull-right">
              <li>
                <span class="m-nav__section-text">
                      Acciones
                </span>
              </li>
              <li>
                  <a href="{{route('adm.gobuypedido.new')}}" class="m-nav__link">
                      <span class="m-nav__link-text">
                          <i class="icon s7-plus"></i> Agregar
                      </span>
                  </a>
              </li>
            </ul>
          </div>

          <h3 class="">Lista de pedidos Go & Buy</h3>
        </div>


        {!! Form::open([
           'method' => 'GET',
           'id' => 'frmSearch'
        ]) !!}

        <div class="panel-body row">
          <form role="form" >
            <div class=" col-md-8 ">
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
            <div class=" col-md-4 ">
              <div class="input-group ">
                <input name="search" value="{{ $search }}" id="generalSearch" placeholder="Buscar:" type="text" class="form-control"><span class="input-group-btn">
                  <button type="submit" class="btn btn-primary">Buscar</button></span>
              </div>
            </div>
          </form>
        </div>
        <!-- <div class="panel-body row">
          <div class="col-md-2 text-left">
            Actualizar estado &nbsp;&nbsp;
            {!! Form::select('',
                    [
                      NULL=>"seleccionar",
                      0=>'Recibido',
                      1=>'Entregado',
                      2=>'En transito',
                      3=>'Llegada almacen'
                    ],null,[
                  'class' => 'select-status m-input',
                  'placelholder' => ''
              ]) !!}
          </div>
          <span class="infoChangeStatus" style="display:none;"></span>
        </div> -->
        <!-- aqui -->
        <div class="widget-head" style="position:relative">
          <ul class="nav nav-pills mb-3" id="estado-tab" role="tablist">
            <li class="nav-item" id='item-0'>
              <a class="nav-link" href="{{ route('adm.gobuypedido.type',0) }}">Registrado</a>
            </li>
            <li class="nav-item" id='item-1'>
              <a class="nav-link" href="{{ route('adm.gobuypedido.type',1) }}" >Recibido en Miami</a>
            </li>
            <li class="nav-item" id='item-2'>
              <a class="nav-link" href="{{ route('adm.gobuypedido.type',2) }}" >En tránsito</a>
            </li>
            <li class="nav-item" id='item-3'>
              <a class="nav-link" href="{{ route('adm.gobuypedido.type',3) }}" >En almacén Scharff ( Lima )</a>
            </li>
            <li class="nav-item" id='item-4'>
              <a class="nav-link" href="{{ route('adm.gobuypedido.type',4) }}" >Entregado</a>
            </li>
          </ul><br>
          <div class="row text-right switch-pedido hide">
            <div class="col-md-12">
              <ul class="nav nav-pills mb-3 nav-opcion" role="tablist" style="display: inline-block;">
                <li class="nav-item" id='item-pedido'>
                  <a class="nav-link btn-default" href="{{ route('adm.gobuypedido.type',2) }}">Ver lista de pedidos</a>
                </li>
                <li class="nav-item" id='item-cons'>
                  <a class="nav-link btn-default" href="{{ route('adm.gobuypedido.type_cons',2) }}" >Ver consolidados</a>
                </li>
              </ul>
            </div>
          </div>
          <!-- <div class="row switch-pedido hide">
            <div class="col-md-6 text-right">
              <h4 class="nameOption title-check"></h4>
              <label class="switch">
                  <input type="checkbox" class="check-consolidado">
                  <span class="slider round"></span>
              </label>
            </div>
          </div> -->
          <div class="row">
            <div class="col-sm-12 text-right">
              <button type="button" class="btn btn-primary btn-consolidado-modal hide">Crear consolidado</button>
            </div>
          </div>
        </div>


      @if(isset($models))
        <div class="table-responsive noSwipe">
            <table id="table1" class="table table-striped table-fw-widget table-hover">
              <thead>
                <tr>
                  <th>
                    <a href="{{  route('adm.gobuypedido.order',['column-1', $order, 'pager' => $pager, 'search' => $search])}}">
                    id
                      @if($column == 'column-1')
                          <span class="glyphicon glyphicon-sort-by-attributes{{$order == 'desc'? '':'-alt'}}"></span>
                      @endif
                    </a>
                  </th>
                  <th>
                    <a href="{{  route('adm.gobuypedido.order',['column-2', $order, 'pager' => $pager, 'search' => $search])}}">
                    Estado
                      @if($column == 'column-2')
                          <span class="glyphicon glyphicon-sort-by-attributes{{$order == 'desc'? '':'-alt'}}"></span>
                      @endif
                    </a>
                  </th>
                  <th>
                    <a href="{{  route('adm.gobuypedido.order',['column-3', $order, 'pager' => $pager, 'search' => $search])}}">
                    Codigo de tracking
                      @if($column == 'column-3')
                          <span class="glyphicon glyphicon-sort-by-attributes{{$order == 'desc'? '':'-alt'}}"></span>
                      @endif
                    </a>
                  </th>
                  <th class="th-consolidado hide">
                    <a href="{{  route('adm.gobuypedido.order',['column-3', $order, 'pager' => $pager, 'search' => $search])}}">
                    Consolidado
                      @if($column == 'column-3')
                          <span class="glyphicon glyphicon-sort-by-attributes{{$order == 'desc'? '':'-alt'}}"></span>
                      @endif
                    </a>
                  </th>
                  <th>
                    <a href="{{  route('adm.gobuypedido.order',['column-4', $order, 'pager' => $pager, 'search' => $search])}}">
                    Valor declarado
                      @if($column == 'column-4')
                          <span class="glyphicon glyphicon-sort-by-attributes{{$order == 'desc'? '':'-alt'}}"></span>
                      @endif
                    </a>
                  </th>
                  <th>
                    <a href="{{  route('adm.gobuypedido.order',['column-1', $order, 'pager' => $pager, 'search' => $search])}}">
                    Piezas
                      @if($column == 'column-5')
                          <span class="glyphicon glyphicon-sort-by-attributes{{$order == 'desc'? '':'-alt'}}"></span>
                      @endif
                    </a>
                  </th>
                  <th>
                    <a href="{{  route('adm.gobuypedido.order',['column-2', $order, 'pager' => $pager, 'search' => $search])}}">
                    Peso
                      @if($column == 'column-6')
                          <span class="glyphicon glyphicon-sort-by-attributes{{$order == 'desc'? '':'-alt'}}"></span>
                      @endif
                    </a>
                  </th>
                  <th>
                    <a href="{{  route('adm.gobuypedido.order',['column-3', $order, 'pager' => $pager, 'search' => $search])}}">
                    Costo de envio
                      @if($column == 'column-7')
                          <span class="glyphicon glyphicon-sort-by-attributes{{$order == 'desc'? '':'-alt'}}"></span>
                      @endif
                    </a>
                  </th>
                  <th>
                    <a href="{{  route('adm.gobuypedido.order',['column-3', $order, 'pager' => $pager, 'search' => $search])}}">
                    Monto Extra
                      @if($column == 'column-3')
                          <span class="glyphicon glyphicon-sort-by-attributes{{$order == 'desc'? '':'-alt'}}"></span>
                      @endif
                    </a>
                  </th>
                  <th>
                    <a href="{{  route('adm.gobuypedido.order',['column-4', $order, 'pager' => $pager, 'search' => $search])}}">
                    Fecha
                      @if($column == 'column-8')
                          <span class="glyphicon glyphicon-sort-by-attributes{{$order == 'desc'? '':'-alt'}}"></span>
                      @endif
                    </a>
                  </th>
                  <th class="text-center">Ver</th>
                  <th class="text-center th-acciones hide">Acciones</th>
                  <th class="text-center th-check-cons hide">Seleccionar</th>
                </tr>
              </thead>
              <tbody>
                @if(count($models))
                  @foreach($models as $model)

                    @php

                      switch ($model->gobuy_estado) {

                        case 0:
                          $gobuy_estado = 'Registrado';
                          break;
                        case 1:
                          $gobuy_estado = 'Recibido en Miami';
                          break;
                        case 2:
                          $gobuy_estado = 'En tránsito';
                          break;
                        case 3:
                          $gobuy_estado = 'En almacén Scharff ( Lima )';
                          break;
                        case 4:
                          $gobuy_estado = 'Entregado';
                          break;
                      }
                    @endphp

                <tr class="odd gradeX">
                  <td>{{ $model->gobuy_id }}</td>
                  <td>{{ $gobuy_estado }}</td>
                  <td>{{ $model->gobuy_codetracking }}</td>
                  @if($model->gobuy_estado==2 || $model->gobuy_estado==3)
                    <td>{{ $model->consolidado_codigo }}</td>
                  @endif
                  <td>{{ $model->gobuy_valordeclarado }}</td>
                  <td>{{ $model->gobuy_piezas }}</td>
                  <td>{{ $model->gobuy_peso }}</td>
                  <td>{{ $model->gobuy_costoenvio }}</td>
                  <td>{{ $model->gobuy_montoextra }}</td>
                  <td>{{ $model->created_at }}</td>
                  <td class="text-center">
                    <a href="{{ route('adm.gobuypedido.edit',$model->gobuy_id) }}" class="ver-detail-item"
                     title="Ver">
                      <span class="icon s7-look"></span>
                    </a>
                  </td>
                @if($model->gobuy_estado!=2)
                  <td class="text-center td-acciones hide"><!-- acciones -->
                    <!-- <input type="checkbox" style="vertical-align: top;display: inline-block;margin-left: 5px;" name="" value="" class="change-status"> -->
                    <span hidden class="id-pedido">{{ $model->gobuy_id }}</span>
                    @if($model->gobuy_estado==0)
                      <button type="submit" class="btn btn-border btn-state-modal" data-state="1">
                          Recibido en Miami
                      </button>
                    @endif
                    @if($model->gobuy_estado==1)
                      <!-- <input type="checkbox" style="display: inline-block;margin-right: 5px;" name="" value="" class="change-status-type"> -->
                      <button type="submit" class="btn btn-border btn-state-modal" data-state="0">
                          Registrado
                      </button>
                    @endif
                    @if($model->gobuy_estado==3)
                    <button type="submit" class="btn btn-border btn-state-modal-group" data-state="2">
                        Regresar a estado En tránsito
                    </button>
                    <button type="submit" class="btn btn-border btn-state-modal" data-state="4">
                        Entregado
                    </button>
                    @endif
                    @if($model->gobuy_estado==4)
                      <button type="submit" class="btn btn-border btn-state-modal" data-state="3">
                          En almacén Scharff
                      </button>
                    @endif
                  </td>
                  @if($model->gobuy_estado==1)
                  <td class="text-center">
                    <span hidden class="id-pedido">{{ $model->gobuy_id }}</span>
                    <input type="checkbox" style="display: inline-block;margin-right: 5px;" name="" value="" class="change-status-type">
                  </td>
                  @endif
                @endif
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
              Mostrando {{ $models->lastItem() }}
                  de {{ $models->total() }}
                  registros

            </div>
          </div>
          <div class="col-sm-7">
            <div class="dataTables_paginate paging_simple_numbers" id="table1_paginate">
              {!! $models->appends($request)->render() !!}
            </div>
          </div>
        </div>
      @endif

      @if(isset($modelsC))
        <!-- tabla consolidado -->
        <div class="table-responsive noSwipe">
          <table id="table2" class="table table-striped table-fw-widget table-hover">
            <thead>
              <tr>
                <th>
                  <a href="{{  route('adm.gobuypedido.order',['column-1', $order, 'pager' => $pager, 'search' => $search])}}">
                  id
                    @if($column == 'column-1')
                        <span class="glyphicon glyphicon-sort-by-attributes{{$order == 'desc'? '':'-alt'}}"></span>
                    @endif
                  </a>
                </th>
                <th>
                  <a href="{{  route('adm.gobuypedido.order',['column-2', $order, 'pager' => $pager, 'search' => $search])}}">
                  Estado
                    @if($column == 'column-2')
                        <span class="glyphicon glyphicon-sort-by-attributes{{$order == 'desc'? '':'-alt'}}"></span>
                    @endif
                  </a>
                </th>
                <th>
                  <a href="{{  route('adm.gobuypedido.order',['column-3', $order, 'pager' => $pager, 'search' => $search])}}">
                  Codigo
                    @if($column == 'column-3')
                        <span class="glyphicon glyphicon-sort-by-attributes{{$order == 'desc'? '':'-alt'}}"></span>
                    @endif
                  </a>
                </th>
                <th class="text-right">Acciones</th>

              </tr>
            </thead>
            <tbody>
              @if(count($modelsC))
                @foreach($modelsC as $model)

              <tr class="odd gradeX">
                <td>{{ $model->consolidado_id }}</td>
                <td>{{ $model->estado }}</td>
                <td>{{ $model->consolidado_codigo }}</td>

                <td class="text-right">
                  <span hidden class="id-consolidado">{{ $model->consolidado_id }}</span>
                  <button type="submit" class="btn btn-border btn-state-modal-cons" data-state="1">Regresar a Recibido en Miami</button>
                  <button type="submit" class="btn btn-border btn-state-modal-cons" data-state="3">En almacén Scharff ( Lima )</button>
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
              Mostrando {{ $modelsC->lastItem() }}
                  de {{ $modelsC->total() }}
                  registros

            </div>
          </div>
          <div class="col-sm-7">
            <div class="dataTables_paginate paging_simple_numbers" id="table1_paginate">
              {!! $modelsC->appends($requestC)->render() !!}
            </div>
          </div>
          <div class="col-sm-12">
            <button type="button" class="btn btn-space btn-primary btn-consolidado-modal hide">Crear consolidado</button>
          </div>
        </div>
        @endif
        <!-- end second table -->
      </div>
    </div>
  </div>

    <!-- Modal cambio de estado-->
    <div class="modal fade" id="modal-tab-recibido" role="dialog">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header" style="border-bottom: 1px solid #e68e8e;">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Cambio de estado pedido</h4>
          </div>
          <div class="modal-body">
            <p>¿Esta seguro que desea cambiar el estado del pedido <span class="code-pedido"></span> a <span class="text-state"></span> ?</p>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-primary btn-update-state">Aceptar</button>
            <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button><br>
            <span class="infoState1"></span>
          </div>
        </div>
      </div>
    </div>

    <!-- Modal cambio de estado de pedidos asociados a un consolidado-->
    <div class="modal fade" id="modal-change-status-cons" role="dialog">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header" style="border-bottom: 1px solid #e68e8e;">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Cambio de estado pedido</h4>
          </div>
          <div class="modal-body">
            <p>¿Esta seguro que desea cambiar el estado del pedido <span class="code-pedido"></span> a <span class="text-state"></span> ?.
              Se cambiará para todos los pedidos que están en ese consolidado.</p>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-primary btn-update-state-by-cons"> Aceptar</button>
            <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button><br>
            <span class="infoState1"></span>
          </div>
        </div>
      </div>
    </div>

    <!-- Modal crear consolidado-->
    <div class="modal fade" id="modal-consolidado" role="dialog">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header" style="border-bottom: 1px solid #e68e8e;">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Crear consolidado</h4>
          </div>
          <div class="modal-body">
            <p>¿Esta seguro de crear un consolidado para <span class="text-pedidos-1"></span> <span class="code-pedidos"></span>? <span class="text-pedidos-2"></span> a estado En Tránsito.</p>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-primary btn-create-consolidado"><span>Aceptar</span></button>
            <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button><br>
            <span class="infoState2"></span>
          </div>
        </div>

      </div>
    </div>

    <div class="modal fade" id="modal-consolidado-m" role="dialog">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header" style="border-bottom: 1px solid #e68e8e;">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Desactivar consolidado</h4>
          </div>
          <div class="modal-body">
            <p>Todos los pedidos cambiarán a estado En almacén Scharff (Lima), por tal se desactivará el consolidado. ¿Está seguro?.</p>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-primary btn-update-consolidado">Aceptar</button>
            <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button><br>
            <span class="infoStateCons"></span>
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
    </script>

@endsection
