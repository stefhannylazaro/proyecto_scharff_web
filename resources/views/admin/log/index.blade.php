@extends('admin.layout.index')

@section('title')
    Log de transacciones
@endsection

@section('page-header')
  Log de transacciones
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
                  @php($current = route('adm.log.order'))

                  @php($full = url()->full())
                  @php($query_str = parse_url($full, PHP_URL_QUERY))

                  <a href="{{route('adm.log.download') .'?'. $query_str  }}" class="m-nav__link" id="a_reserva_download">
                      <span class="">
                          Descargar Data Sistemas
                      </span>
                  </a>
              </li>
            </ul>
          </div>
          <div class="title">Log de transacciones</div>
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
                <a href="{{  route('adm.log.order',['column-1', $order, 'pager' => $pager, 'search' => $search])}}">
                  ID
                  @if($column == 'column-1')
                      <span class="glyphicon glyphicon-sort-by-attributes{{$order == 'desc'? '':'-alt'}}"></span>
                  @endif
                </a>
              </th>
              <th>
                <a href="{{  route('adm.log.order',['column-2', $order, 'pager' => $pager, 'search' => $search])}}">
                  Customer id
                  @if($column == 'column-2')
                      <span class="glyphicon glyphicon-sort-by-attributes{{$order == 'desc'? '':'-alt'}}"></span>
                  @endif
                </a>
              </th>
              <th>
                <a href="{{  route('adm.log.order',['column-3', $order, 'pager' => $pager, 'search' => $search])}}">
                  Tipo de acción
                  @if($column == 'column-3')
                      <span class="glyphicon glyphicon-sort-by-attributes{{$order == 'desc'? '':'-alt'}}"></span>
                  @endif
                </a>
              </th>
              <th>
                <a href="{{  route('adm.log.order',['column-4', $order, 'pager' => $pager, 'search' => $search])}}">
                  Respuesta obtenida
                  @if($column == 'column-4')
                      <span class="glyphicon glyphicon-sort-by-attributes{{$order == 'desc'? '':'-alt'}}"></span>
                  @endif
                </a>
              </th>
              <th>
                <a href="{{  route('adm.log.order',['column-5', $order, 'pager' => $pager, 'search' => $search])}}">
                  Fecha registro
                  @if($column == 'column-5')
                      <span class="glyphicon glyphicon-sort-by-attributes{{$order == 'desc'? '':'-alt'}}"></span>
                  @endif
                </a>
              </th>
              <th class="text-center">Acción</th>
            </tr>
          </thead>








          <tbody>
            @if(count($models))
              @foreach($models as $model)




            <tr class="odd gradeX">
              <td>
                  <span style="width: 200px;">{{ $model->id }}</span>
              </td>
              <td>
                  <span style="width: 200px;">{{ $model->customer_id }}</span>
              </td>
              <td>
                  <span style="width: 200px;">{{ $model->tipo_accion }}</span>
              </td>

              <td>
                  <span style="width: 200px;">{{ $model->trama_respuesta_culqi }}</span>
              </td>

              <td>
                  <span style="width: 200px;">{{ $model->created_at }}</span>
              </td>
              <td class="text-center"><a href="{{ route('adm.log.view',$model->id) }}" class="ver-detail-item"
                 title="Ver">
                  <span class="icon s7-look"></span>
              </a></td>





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




      </div>
    </div>
  </div>





@endsection

@section('script')
    <script>
        //app.init();

        $(document).ready(function(){
          $(".datetimepicker").datetimepicker({
            autoclose: true,
            componentIcon: '.s7-date',
            navIcons:{
              rightIcon: 's7-angle-right',
              leftIcon: 's7-angle-left'
            }
          });
        })

    </script>

@endsection
