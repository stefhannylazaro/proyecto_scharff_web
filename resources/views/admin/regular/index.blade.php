@extends('admin.layout.index')

@section('title')
    Administracion | Envíos regulares
@endsection

@section('page-header')
  Envíos regulares
@endsection

@section('content')
  <style media="screen">
   .lds-dual-ring {display: inline-block;width: 26px;height: 20px;padding-left: 8px;}
 .lds-dual-ring:after {content: " ";display: block;width: 30px;height: 30px;margin: 1px;border-radius: 74%;border: 2px solid #949494;border-color: #949494 transparent #949494 transparent;animation: lds-dual-ring 1.2s linear infinite;padding: 0;margin: 0;}
 @keyframes  lds-dual-ring {
 0% {
   transform: rotate(0deg);
 }
 100% {
   transform: rotate(360deg);
 }
 }
 .loading-ubigeos {
     display: none;
     font-size: 13px;
     font-weight: 400;
     padding-left: 10px;
 }
 .loading-ubigeos.active{
    display: inline;

 }
 .table > tbody > tr > td {
     white-space: nowrap;
 }
   </style>

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
                  {{-- @php($current = route('adm.pedido.order')) --}}

                  @php($full = url()->full())
                  @php($query_str = parse_url($full, PHP_URL_QUERY))

                  <a href="{{route('adm.regular.downloadsistemas') .'?'. $query_str  }}" class="m-nav__link" id="a_reserva_download">
                      <span class="">
                          Descargar Data Sistemas
                      </span>
                  </a>
              </li>

              <li class="m-nav__item">
                  {{-- @php($current = route('adm.pedido.order')) --}}

                  @php($full = url()->full())
                  @php($query_str = parse_url($full, PHP_URL_QUERY))

                  <a href="{{route('adm.regular.download') .'?'. $query_str  }}" class="m-nav__link" id="a_reserva_download">
                      <span class="">
                          Descargar Data
                      </span>
                  </a>
              </li>

              <li class="m-nav__item">
                  <a href="{{route('adm.regular.download-ubigeos')}}" class="m-nav__link">
                      <i class="icon s7-plus"></i>

                          Descargar Ubigeos

                  </a>
              </li>

              <li class="m-nav__item" id="upload_ubigeos">


                  <a style="cursor:pointer" class="m-nav__link">
                      <i class="icon s7-plus"></i>

                          Importar Ubigeos

                  </a>
              </li>
              <li class="m-nav__item">
                  <a href="{{route('adm.codigopedido.index')}}" class="m-nav__link">
                          Códigos de pedido
                  </a>
              </li>

            </ul>
          </div>
          <div class="title">Lista de envíos regulares <div class="loading-ubigeos">
              Actualizando lista de ubigeos <div class="lds-dual-ring"></div>
          </div></div>
        </div>



        {!! Form::open(array('route' => 'adm.regular.upload-ubigeos','method'=>'POST','files'=>'true','id' => 'form-regular', 'data-url' => route('adm.regular.upload-ubigeos') , "enctype"=>"multipart/form-data")) !!}
        {{csrf_field()}}
        <input type="file" name="theFileInput" id="theFileInput" style="display: none;"/>

        <input type="hidden" name="data" id="dataInput" />

        {!! Form::close() !!}
        <button type="button" name="button" type="submit" id="enviarExcel"  style="display: none;"></button>




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
                  <a href="{{  route('adm.regular.order',['column-1', $order, 'pager' => $pager, 'search' => $search])}}">
                    ID regular
                    @if($column == 'column-1')
                        <span class="glyphicon glyphicon-sort-by-attributes{{$order == 'desc'? '':'-alt'}}"></span>
                    @endif
                  </a>
                </th>
                <th>
                  <a href="{{  route('adm.regular.order',['column-2', $order, 'pager' => $pager, 'search' => $search])}}">
                    Origen calle
                    @if($column == 'column-2')
                        <span class="glyphicon glyphicon-sort-by-attributes{{$order == 'desc'? '':'-alt'}}"></span>
                    @endif
                  </a>
                </th>
                <th>
                  <a href="{{  route('adm.regular.order',['column-3', $order, 'pager' => $pager, 'search' => $search])}}">
                    Origen Direccion
                    @if($column == 'column-3')
                        <span class="glyphicon glyphicon-sort-by-attributes{{$order == 'desc'? '':'-alt'}}"></span>
                    @endif
                  </a>
                </th>
                <th>
                  <a href="{{  route('adm.regular.order',['column-4', $order, 'pager' => $pager, 'search' => $search])}}">
                    Origen interior
                    @if($column == 'column-4')
                        <span class="glyphicon glyphicon-sort-by-attributes{{$order == 'desc'? '':'-alt'}}"></span>
                    @endif
                  </a>
                </th>
                <th>
                  <a href="{{  route('adm.regular.order',['column-5', $order, 'pager' => $pager, 'search' => $search])}}">
                    Origen referencia
                    @if($column == 'column-5')
                        <span class="glyphicon glyphicon-sort-by-attributes{{$order == 'desc'? '':'-alt'}}"></span>
                    @endif
                  </a>
                </th>
                <th>
                  <a href="{{  route('adm.regular.order',['column-6', $order, 'pager' => $pager, 'search' => $search])}}">
                    Origen remitente
                    @if($column == 'column-6')
                        <span class="glyphicon glyphicon-sort-by-attributes{{$order == 'desc'? '':'-alt'}}"></span>
                    @endif
                  </a>
                </th>
                <th>
                  <a href="{{  route('adm.regular.order',['column-7', $order, 'pager' => $pager, 'search' => $search])}}">
                    Origen celular
                    @if($column == 'column-7')
                        <span class="glyphicon glyphicon-sort-by-attributes{{$order == 'desc'? '':'-alt'}}"></span>
                    @endif
                  </a>
                </th>
                <th>
                  <a href="{{  route('adm.regular.order',['column-8', $order, 'pager' => $pager, 'search' => $search])}}">
                    Destino calle
                    @if($column == 'column-8')
                        <span class="glyphicon glyphicon-sort-by-attributes{{$order == 'desc'? '':'-alt'}}"></span>
                    @endif
                  </a>
                </th>
                <th>
                  <a href="{{  route('adm.regular.order',['column-9', $order, 'pager' => $pager, 'search' => $search])}}">
                    Destino Dirección
                    @if($column == 'column-9')
                        <span class="glyphicon glyphicon-sort-by-attributes{{$order == 'desc'? '':'-alt'}}"></span>
                    @endif
                  </a>
                </th>
                <th>
                  <a href="{{  route('adm.regular.order',['column-10', $order, 'pager' => $pager, 'search' => $search])}}">
                    Destino interior
                    @if($column == 'column-10')
                        <span class="glyphicon glyphicon-sort-by-attributes{{$order == 'desc'? '':'-alt'}}"></span>
                    @endif
                  </a>
                </th>
                <th>
                  <a href="{{  route('adm.regular.order',['column-11', $order, 'pager' => $pager, 'search' => $search])}}">
                    Destino referencia
                    @if($column == 'column-11')
                        <span class="glyphicon glyphicon-sort-by-attributes{{$order == 'desc'? '':'-alt'}}"></span>
                    @endif
                  </a>
                </th>
                <th>
                  <a href="{{  route('adm.regular.order',['column-12', $order, 'pager' => $pager, 'search' => $search])}}">
                    Destino remitente
                    @if($column == 'column-12')
                        <span class="glyphicon glyphicon-sort-by-attributes{{$order == 'desc'? '':'-alt'}}"></span>
                    @endif
                  </a>
                </th>
                <th>
                  <a href="{{  route('adm.regular.order',['column-13', $order, 'pager' => $pager, 'search' => $search])}}">
                    Destino celular
                    @if($column == 'column-13')
                        <span class="glyphicon glyphicon-sort-by-attributes{{$order == 'desc'? '':'-alt'}}"></span>
                    @endif
                  </a>
                </th>
                <th>
                  <a href="{{  route('adm.regular.order',['column-14', $order, 'pager' => $pager, 'search' => $search])}}">
                    Dimensiones
                    @if($column == 'column-14')
                        <span class="glyphicon glyphicon-sort-by-attributes{{$order == 'desc'? '':'-alt'}}"></span>
                    @endif
                  </a>
                </th>
                <th>
                  <a href="{{  route('adm.regular.order',['column-15', $order, 'pager' => $pager, 'search' => $search])}}">
                    Peso
                    @if($column == 'column-15')
                        <span class="glyphicon glyphicon-sort-by-attributes{{$order == 'desc'? '':'-alt'}}"></span>
                    @endif
                  </a>
                </th>
                <th>
                  <a href="{{  route('adm.regular.order',['column-16', $order, 'pager' => $pager, 'search' => $search])}}">
                    Tiempo
                    @if($column == 'column-16')
                        <span class="glyphicon glyphicon-sort-by-attributes{{$order == 'desc'? '':'-alt'}}"></span>
                    @endif
                  </a>
                </th>
                <th>
                  <a href="{{  route('adm.regular.order',['column-17', $order, 'pager' => $pager, 'search' => $search])}}">
                    Costo total
                    @if($column == 'column-17')
                        <span class="glyphicon glyphicon-sort-by-attributes{{$order == 'desc'? '':'-alt'}}"></span>
                    @endif
                  </a>
                </th>
                <th>
                  <a href="{{  route('adm.regular.order',['column-18', $order, 'pager' => $pager, 'search' => $search])}}">
                    Cupon descuento
                    @if($column == 'column-18')
                        <span class="glyphicon glyphicon-sort-by-attributes{{$order == 'desc'? '':'-alt'}}"></span>
                    @endif
                  </a>
                </th>
                <th>
                  <a href="{{  route('adm.regular.order',['column-19', $order, 'pager' => $pager, 'search' => $search])}}">
                    Tarjeta
                    @if($column == 'column-19')
                        <span class="glyphicon glyphicon-sort-by-attributes{{$order == 'desc'? '':'-alt'}}"></span>
                    @endif
                  </a>
                </th>
                <th>
                  <a href="{{  route('adm.regular.order',['column-20', $order, 'pager' => $pager, 'search' => $search])}}">
                    Usuario
                    @if($column == 'column-20')
                        <span class="glyphicon glyphicon-sort-by-attributes{{$order == 'desc'? '':'-alt'}}"></span>
                    @endif
                  </a>
                </th>
                <th>
                  <a href="{{  route('adm.regular.order',['column-21', $order, 'pager' => $pager, 'search' => $search])}}">
                    Peso volumetrico
                    @if($column == 'column-21')
                        <span class="glyphicon glyphicon-sort-by-attributes{{$order == 'desc'? '':'-alt'}}"></span>
                    @endif
                  </a>
                </th>
                <th>
                  <a href="{{  route('adm.regular.order',['column-22', $order, 'pager' => $pager, 'search' => $search])}}">
                    Fecha
                    @if($column == 'column-22')
                        <span class="glyphicon glyphicon-sort-by-attributes{{$order == 'desc'? '':'-alt'}}"></span>
                    @endif
                  </a>
                </th>
                <th>
                  <a href="#">
                    Emitir factura
                  </a>
                </th>
                <th>
                  <a href="#">
                    RUC
                  </a>
                </th>
                <th>
                  <a href="#">
                    Razón social
                  </a>
                </th>


                <th>
                  <a href="{{  route('adm.regular.order',['column-22', $order, 'pager' => $pager, 'search' => $search])}}">
                    Codigo pago
                    @if($column == 'column-22')
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
@php($emitirfactura = $model->emitir_factura==1?'RUC':'BOLETA')



              <tr class="odd gradeX">
                <td>
                    <span>{{  $model->id  }}</span>
                </td>
                <td style="width:200px">
                    <span>{{  $model->origen_calle  }}</span>
                </td>
                <td>
                    <span>{{  $model->origen_direccion_full  }}</span>
                </td>
                <td>
                    <span>{{  $model->origen_interior  }}</span>
                </td>
                <td>
                    <span>{{  $model->origen_referencia  }}</span>
                </td>
                <td>
                    <span>{{  $model->origen_remitente  }}</span>
                </td>
                <td>
                    <span>{{  $model->origen_celular  }}</span>
                </td>
                <td>
                    <span>{{  $model->destino_calle  }}</span>
                </td>
                <td>
                    <span>{{  $model->destino_direccion_full  }}</span>
                </td>
                <td>
                    <span>{{  $model->destino_interior  }}</span>
                </td>
                <td>
                    <span>{{  $model->destino_referencia  }}</span>
                </td>
                <td>
                    <span>{{  $model->destino_remitente  }}</span>
                </td>
                <td>
                    <span>{{  $model->destino_celular  }}</span>
                </td>
                <td>
                    <span>{{  $model->ancho . 'cm x ' . $model->altura . 'cm x ' . $model->profundidad . 'cm' }}</span>
                </td>
                <td>
                    <span>{{  $model->peso }}Kg.</span>
                </td>
                <td>
                    <span>{{  $model->tiempoValor()  }}</span>
                </td>
                <td>
                    <span>{{  $model->costo_total  }}</span>
                </td>
                <td>
                    <span>{{  $model->cupon_descuento  }}</span>
                </td>
                <td>
                    <span>{{  $model->tarjeta_id  }}</span>
                </td>
                <td>
                    <span>{{  $model->usuario_id  }}</span>
                </td>
                <td>
                    <span>{{  $model->peso_volumetrico  }}</span>
                </td>

                <td>
                    <span>{{  $model->created_at  }}</span>
                </td>

                <td>

                  {{$emitirfactura}}
                </td>

                <td>
                  @if ($emitirfactura=='RUC')
                    <span >{{ $model->regular_ruc }}</span>
                  @endif



                </td>

                <td>
                  @if ($emitirfactura=='RUC')
                    <span >{{ $model->regular_razonsocial }}</span>
                  @endif
                </td>

                <td>
                  @if (isset($model->codigo_culqi_pago))
                    <span>{{  $model->codigo_culqi_pago  }}</span>
                  @endif

                </td>


                <td class="text-center"><a href="{{ route('adm.regular.view',$model->id) }}" class="ver-detail-item"
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

  $('#upload_ubigeos').click(function() {
    $('#theFileInput').click();
  });








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



  (function() {
  	var xlf = document.getElementById('theFileInput');
  	if(!xlf.addEventListener) return;
  	function handleFile(e) { ejecutaSubida(); }
  	xlf.addEventListener('change', handleFile, false);
  })();



  function ejecutaSubida(){
    $('.loading-ubigeos').addClass('active');
    var url = $("#form-regular").data('url');
    var formData = new FormData($('#theFileInput')[0]);



    $.ajax({
        url: url,
        type: "POST",
        data:new FormData($("#form-regular")[0]),
        async: true,
        success: function (data) {
          $('.loading-ubigeos').removeClass('active');
            if (data.estado == 0) {
              toastr.success(data.mensaje);
            } else {
              toastr.warning(data.mensaje);
            }
            //setTimeout(function(){location.reload();}, 5000);
        },
        error: function () {
            console.log('error');
            $('.loading-ubigeos').removeClass('active');
        },
        cache: false,
        contentType: false,
        processData: false
    });


  }
  $('#enviarExcel').on('click',function(){
    ejecutaSubida();
  })


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
