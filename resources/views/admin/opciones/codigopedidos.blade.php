@extends('admin.layout.index')

@section('title')
    Códigos de pedido
@endsection

@section('page-header')
    Código de pedido
@endsection

@section('content')

  <div class="row">
    <div class="col-sm-12">
      <div class="widget widget-fullwidth widget-small">
        <div class="widget-head">

          <div class="title">Códigos Pedido (Reservas Lockers)</div>
        </div>


        {!! Form::open([
           'method' => 'GET',
           'id' => 'frmSearch'
        ]) !!}


        <div class="table-responsive noSwipe">
        <table id="table1" class="table table-striped table-fw-widget table-hover">
          <thead>
            <tr>
              <th>
                <a>
                  Opción
                  @if($column == 'column-1')
                      <span class="glyphicon glyphicon-sort-by-attributes{{$order == 'desc'? '':'-alt'}}"></span>
                  @endif
                </a>
              </th>
              <th>
                <a>
                  Valor
                  @if($column == 'column-2')
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

                @if (strpos($model->slug, 'stop') !== false)




            <tr class="odd gradeX">

              <td>
                  <span style="width: 200px;">{{ $model->nombre }}</span>
              </td>
              <td>
                <span style="width: 200px;">
                  {{$model->valor}}
                </span>
              </td>

              <td class="text-center"><a href="{{ route('adm.opciones.editGeneral',$model->id) }}" class="ver-detail-item"
                 title="Ver">
                  <span class="icon s7-look"></span>
              </a>
            </td>


            </tr>
            @endif
          @endforeach
          @else
              <span class="m-datatable--error" style="width: 100%;">No records found</span>
          @endif

          </tbody>
        </table>
      </div>


      <div class="row am-datatable-footer">
        <div class="col-sm-5">
          <!-- <div class="dataTables_info" id="table1_info" role="status" aria-live="polite">
            Mostrando {{ $models->lastItem() }}
                de {{ $models->total() }}
                registros

          </div> -->
        </div>
        <div class="col-sm-7">
          <div class="dataTables_paginate paging_simple_numbers" id="table1_paginate">
            {!! $models->appends($request)->render() !!}
          </div>
        </div>
      </div>

      <div class="panel-body row">
        <div class="col-md-12 text-right">
            <a class="btn btn-primary reset-locker" id="locker">Resetear</a>
        </div>
        <div class="col-md-12 text-right">
            <span class="infoReset" style="display:none;"></span>
        </div>
      </div>


      </div>
    </div>
  </div>

  <!-- SECOND TABLE -->
  <div class="row">
    <div class="col-sm-12">
      <div class="widget widget-fullwidth widget-small">
        <div class="widget-head">

          <div class="title">Códigos Pedido (envíos regulares)</div>
        </div>


        {!! Form::open([
           'method' => 'GET',
           'id' => 'frmSearch'
        ]) !!}


        <div class="table-responsive noSwipe">
        <table id="table1" class="table table-striped table-fw-widget table-hover">
          <thead>
            <tr>
              <th>
                <a>
                  Opción
                  @if($column == 'column-1')
                      <span class="glyphicon glyphicon-sort-by-attributes{{$order == 'desc'? '':'-alt'}}"></span>
                  @endif
                </a>
              </th>
              <th>
                <a>
                  Valor
                  @if($column == 'column-2')
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

                @if (strpos($model->slug, 'regular') !== false)




            <tr class="odd gradeX">

              <td>
                  <span style="width: 200px;">{{ $model->nombre }}</span>
              </td>
              <td>
                <span style="width: 200px;">
                  {{$model->valor}}
                </span>
              </td>

              <td class="text-center"><a href="{{ route('adm.opciones.editGeneral',$model->id) }}" class="ver-detail-item"
                 title="Ver">
                  <span class="icon s7-look"></span>
              </a>
            </td>


            </tr>
            @endif
          @endforeach
          @else
              <span class="m-datatable--error" style="width: 100%;">No records found</span>
          @endif

          </tbody>
        </table>
      </div>


      <div class="row am-datatable-footer">
        <div class="col-sm-5">
          <!-- <div class="dataTables_info" id="table1_info" role="status" aria-live="polite">
            Mostrando {{ $models->lastItem() }}
                de {{ $models->total() }}
                registros

          </div> -->
        </div>
        <div class="col-sm-7">
          <div class="dataTables_paginate paging_simple_numbers" id="table1_paginate">
            {!! $models->appends($request)->render() !!}
          </div>
        </div>
      </div>

      <div class="panel-body row">
        <div class="col-md-12 text-right">
            <a class="btn btn-primary reset-locker" id="regular">Resetear</a>
        </div>
        <div class="col-md-12 text-right">
            <span class="infoReset" style="display:none;"></span>
        </div>
      </div>


      </div>
    </div>
  </div>

  <!--  TABLE GOBUY-->
  <div class="row">
    <div class="col-sm-12">
      <div class="widget widget-fullwidth widget-small">
        <div class="widget-head">

          <div class="title">Códigos Pedido (GOBUY)</div>
        </div>


        {!! Form::open([
           'method' => 'GET',
           'id' => 'frmSearch'
        ]) !!}


        <div class="table-responsive noSwipe">
        <table id="table1" class="table table-striped table-fw-widget table-hover">
          <thead>
            <tr>
              <th>
                <a>
                  Opción
                  @if($column == 'column-1')
                      <span class="glyphicon glyphicon-sort-by-attributes{{$order == 'desc'? '':'-alt'}}"></span>
                  @endif
                </a>
              </th>
              <th>
                <a>
                  Valor
                  @if($column == 'column-2')
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

                @if (strpos($model->slug, 'gobuy') !== false)




            <tr class="odd gradeX">

              <td>
                  <span style="width: 200px;">{{ $model->nombre }}</span>
              </td>
              <td>
                <span style="width: 200px;">
                  {{$model->valor}}
                </span>
              </td>

              <td class="text-center"><a href="{{ route('adm.opciones.editGeneral',$model->id) }}" class="ver-detail-item"
                 title="Ver">
                  <span class="icon s7-look"></span>
              </a>
            </td>


            </tr>
            @endif
          @endforeach
          @else
              <span class="m-datatable--error" style="width: 100%;">No records found</span>
          @endif

          </tbody>
        </table>
      </div>


      <div class="row am-datatable-footer">
        <div class="col-sm-5">
          <!-- <div class="dataTables_info" id="table1_info" role="status" aria-live="polite">
            Mostrando {{ $models->lastItem() }}
                de {{ $models->total() }}
                registros

          </div> -->
        </div>
        <div class="col-sm-7">
          <div class="dataTables_paginate paging_simple_numbers" id="table1_paginate">
            {!! $models->appends($request)->render() !!}
          </div>
        </div>
      </div>

      <div class="panel-body row">
        <div class="col-md-12 text-right">
            <a class="btn btn-primary reset-locker" id="gobuy">Resetear</a>
        </div>
        <div class="col-md-12 text-right">
            <span class="infoReset" style="display:none;"></span>
        </div>
      </div>


      </div>
    </div>
  </div>


@endsection

@section('script')
    <script>
        //app.init();
    </script>

@endsection
