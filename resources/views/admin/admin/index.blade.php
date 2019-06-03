@extends('admin.layout.index')

@section('title')
    Lista de Administradores
@endsection

@section('page-header')
  Administradores
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
              <li>
                  <a href="{{route('adm.admin.new')}}" class="m-nav__link">
                      <span class="m-nav__link-text">
                          <i class="icon s7-plus"></i> Agregar
                      </span>
                  </a>
              </li>
              <li>
                  <a href="{{route('adm.admin.download')}}" class="m-nav__link">
                      <span class="m-nav__link-text">
                          <i class="icon s7-plus"></i> Descargar
                      </span>
                  </a>
              </li>
            </ul>
          </div>
          <div class="title">Lista de motivos de contacto</div>
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


        <div class="table-responsive noSwipe">
        <table id="table1" class="table table-striped table-fw-widget table-hover">
          <thead>
            <tr>
              <th>
                <a href="{{  route('adm.admin.order',['column-1', $order, 'pager' => $pager, 'search' => $search])}}">
                  Email
                  @if($column == 'column-1')
                      <span class="glyphicon glyphicon-sort-by-attributes{{$order == 'desc'? '':'-alt'}}"></span>
                  @endif
                </a>
              </th>
              <th>
                <a href="{{  route('adm.admin.order',['column-2', $order, 'pager' => $pager, 'search' => $search])}}">
                  Nombre
                  @if($column == 'column-2')
                      <span class="glyphicon glyphicon-sort-by-attributes{{$order == 'desc'? '':'-alt'}}"></span>
                  @endif
                </a>
              </th>
              <th>
                <a href="{{  route('adm.admin.order',['column-3', $order, 'pager' => $pager, 'search' => $search])}}">
                  Apellidos
                  @if($column == 'column-3')
                      <span class="glyphicon glyphicon-sort-by-attributes{{$order == 'desc'? '':'-alt'}}"></span>
                  @endif
                </a>
              </th>
              <th>
                <a href="{{  route('adm.admin.order',['column-4', $order, 'pager' => $pager, 'search' => $search])}}">
                  Perfil
                  @if($column == 'column-4')
                      <span class="glyphicon glyphicon-sort-by-attributes{{$order == 'desc'? '':'-alt'}}"></span>
                  @endif
                </a>
              </th>
              <th>
                <a href="{{  route('adm.admin.order',['column-5', $order, 'pager' => $pager, 'search' => $search])}}">
                  Fecha Creación
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
                  <span style="width: 200px;">{{ $model->email }}</span>
              </td>
              <td>
                  <span style="width: 200px;">{{ $model->usuario_nombre }}</span>
              </td>
              <td>
                  <span style="width: 200px;">{{ $model->usuario_apellidos }}</span>
              </td>

              <td>
                  <span style="width: 200px;">{{ $model->perfil }}</span>
              </td>
              <td>
                  <span style="width: 200px;">{{ $model->created_at }}</span>
              </td>

              <td class="text-center"><a href="{{ route('adm.admin.edit',$model->id) }}" class="ver-detail-item"
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
