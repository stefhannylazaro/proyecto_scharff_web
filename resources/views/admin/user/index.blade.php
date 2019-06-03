@extends('admin.layout.index')

@section('title')
    Administracion | Usuarios
@endsection

@section('page-header')
  Usuarios
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
                  @php($current = route('adm.user.order'))

                  @php($full = url()->full())
                  @php($query_str = parse_url($full, PHP_URL_QUERY))

                  <a href="{{route('adm.user.download') .'?'. $query_str  }}" class="m-nav__link" id="a_reserva_download">
                      <span class="">
                          Descargar Data Sistemas
                      </span>
                  </a>
              </li>
              <li class="m-nav__item">
                  @php($current = route('adm.user.order'))

                  @php($full = url()->full())
                  @php($query_str = parse_url($full, PHP_URL_QUERY))

                  <a href="{{route('adm.user.download_data') .'?'. $query_str  }}" class="m-nav__link open-external" id="a_reserva_download">
                      <span class="">
                          Descargar Data
                      </span>
                  </a>
              </li>
            </ul>
          </div>
          <div class="title">Lista de usuarios</div>
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
                <a href="{{  route('adm.user.order',['column-1', $order, 'pager' => $pager, 'search' => $search])}}">
                  ID
                  @if($column == 'column-1')
                      <span class="glyphicon glyphicon-sort-by-attributes{{$order == 'desc'? '':'-alt'}}"></span>
                  @endif
                </a>
              </th>
              <th>
                <a href="{{  route('adm.user.order',['column-2', $order, 'pager' => $pager, 'search' => $search])}}">
                  Nombre
                  @if($column == 'column-2')
                      <span class="glyphicon glyphicon-sort-by-attributes{{$order == 'desc'? '':'-alt'}}"></span>
                  @endif
                </a>
              </th>
              <th>
                <a href="{{  route('adm.user.order',['column-3', $order, 'pager' => $pager, 'search' => $search])}}">
                  Correo
                  @if($column == 'column-3')
                      <span class="glyphicon glyphicon-sort-by-attributes{{$order == 'desc'? '':'-alt'}}"></span>
                  @endif
                </a>
              </th>
              <th>
                <a href="{{  route('adm.user.order',['column-4', $order, 'pager' => $pager, 'search' => $search])}}">
                  Apellidos
                  @if($column == 'column-4')
                      <span class="glyphicon glyphicon-sort-by-attributes{{$order == 'desc'? '':'-alt'}}"></span>
                  @endif
                </a>
              </th>
              <th>
                <a href="{{  route('adm.user.order',['column-5', $order, 'pager' => $pager, 'search' => $search])}}">
                  DNI
                  @if($column == 'column-5')
                      <span class="glyphicon glyphicon-sort-by-attributes{{$order == 'desc'? '':'-alt'}}"></span>
                  @endif
                </a>
              </th>
              <th>
                <a href="{{  route('adm.user.order',['column-6', $order, 'pager' => $pager, 'search' => $search])}}">
                  Celular
                  @if($column == 'column-6')
                      <span class="glyphicon glyphicon-sort-by-attributes{{$order == 'desc'? '':'-alt'}}"></span>
                  @endif
                </a>
              </th>
              <th>
                <a href="{{  route('adm.user.order',['column-7', $order, 'pager' => $pager, 'search' => $search])}}">
                  Referencia
                  @if($column == 'column-7')
                      <span class="glyphicon glyphicon-sort-by-attributes{{$order == 'desc'? '':'-alt'}}"></span>
                  @endif
                </a>
              </th>
              <th>
                <a href="{{  route('adm.user.order',['column-8', $order, 'pager' => $pager, 'search' => $search])}}">
                  Fecha registrado
                  @if($column == 'column-8')
                      <span class="glyphicon glyphicon-sort-by-attributes{{$order == 'desc'? '':'-alt'}}"></span>
                  @endif
                </a>
              </th>
              <th class="text-center">Accíon</th>
            </tr>
          </thead>
          <tbody>
            @if(count($models))
              @foreach($models as $model)





            <tr class="odd gradeX">
              <td>{{ $model->id }}</td>
              <td>{{ $model->usuario_nombre }}</td>
              <td>{{ $model->usuario_email }}</td>
              <td>{{ $model->usuario_apellidos }}</td>
              <td>{{ $model->usuario_dni }}</td>
              <td>{{ $model->usuario_movil }}</td>
              <td>
                {{ $model->nombre_referencia }}
              </td>
              <td>{{ $model->created_at }}</td>
              <td class="text-center">
                @if (isset($casodb)&&$casodb=='api')
                  <a href="{{ route('adm.user.view_b',$model->id) }}" class="ver-detail-item"
                   title="Ver">
                    <span class="icon s7-look"></span>
                  </a>
                @else
                  <a href="{{ route('adm.user.view',$model->id) }}" class="ver-detail-item"
                   title="Ver">
                    <span class="icon s7-look"></span>
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
            window.open(esteurl, "_blank")
            return false;
          })

        });
    </script>

@endsection
