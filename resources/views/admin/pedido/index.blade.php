@extends('admin.layout.index')

@section('title')
    Pedidos express
@endsection

@section('page-header')
    Pedidos express
@endsection

@section('content')
  <style media="screen">
  .class_1530115754{
    display: inline-block;
    vertical-align: middle;
    margin-bottom: 0;
    /* padding: 7px; */
  }
  .class_1530115754 .datepicker {
    padding: 0;
    width: 50%;
    float: left;
  }
  .class_1530115754 .datepicker input{
    background:#fff;
  }
  .table > tbody > tr > td {
      white-space: nowrap;
  }
  </style>
  <div class="row">
    <div class="col-sm-12">
      <div class="widget widget-fullwidth widget-small">
        <div class="widget-head">
          {{-- {!! Form::open(array('route' => 'adm.pedido.upload-plantilla','method'=>'POST','files'=>'true','id' => 'form-reserva', 'data-url' => route('adm.pedido.upload-plantilla') , "enctype"=>"multipart/form-data")) !!}
          {{csrf_field()}}
          <input type="file" name="file" id="theFileInput" style="display:none;" />

          <input type="hidden" name="data" id="dataInput" />

          {!! Form::close() !!} --}}
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

                  <a href="{{route('adm.pedido.download') .'?'. $query_str  }}" class="m-nav__link" id="a_reserva_download">
                      <span class="">
                          Descargar Data Sistemas
                      </span>
                  </a>
              </li>
              <li class="m-nav__item">
                  {{-- @php($current = route('adm.pedido.order')) --}}

                  @php($full = url()->full())
                  @php($query_str = parse_url($full, PHP_URL_QUERY))

                  <a href="{{route('adm.pedido.downloaddata') .'?'. $query_str  }}" class="m-nav__link open-external">
                      <span class="">
                          Descargar Data
                      </span>
                  </a>
              </li>
              {{-- <li>
                  <a href="{{route('adm.pedido.download-plantilla')}}">
                      <span class="">
                          Descargar Plantilla
                      </span>
                  </a>
              </li> --}}
              {{-- <li>

                  <a style="cursor:pointer"  id="upload_plantilla">
                      <span class="">
                          Importar Data
                      </span>
                  </a>
              </li> --}}



            </ul>
          </div>
          <div class="title">Lista de pedidos express</div>
        </div>


        {!! Form::open([
           'method' => 'GET',
           'id' => 'frmSearch'
        ]) !!}

        <div class="panel-body row">
          <form role="form">
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
                <a href="{{  route('adm.pedido.order',['column-10', $order, 'pager' => $pager, 'search' => $search])}}">
                  ID
                  @if($column == 'column-1')
                      <span class="glyphicon glyphicon-sort-by-attributes{{$order == 'desc'? '':'-alt'}}"></span>
                  @endif
                </a>
              </th>
              <th>
                <a href="{{  route('adm.pedido.order',['column-1', $order, 'pager' => $pager, 'search' => $search])}}">
                  Codigo
                  @if($column == 'column-1')
                      <span class="glyphicon glyphicon-sort-by-attributes{{$order == 'desc'? '':'-alt'}}"></span>
                  @endif
                </a>
              </th>
              <th>
                <a href="{{  route('adm.pedido.order',['column-2', $order, 'pager' => $pager, 'search' => $search])}}">
                  Fecha creacion
                  @if($column == 'column-2')
                      <span class="glyphicon glyphicon-sort-by-attributes{{$order == 'desc'? '':'-alt'}}"></span>
                  @endif
                </a>
              </th>
              <th>
                <a href="{{  route('adm.pedido.order',['column-3', $order, 'pager' => $pager, 'search' => $search])}}">
                  Calle desde
                  @if($column == 'column-3')
                      <span class="glyphicon glyphicon-sort-by-attributes{{$order == 'desc'? '':'-alt'}}"></span>
                  @endif
                </a>
              </th>
              <th>
                <a href="{{  route('adm.pedido.order',['column-4', $order, 'pager' => $pager, 'search' => $search])}}">
                  Calle hasta
                  @if($column == 'column-4')
                      <span class="glyphicon glyphicon-sort-by-attributes{{$order == 'desc'? '':'-alt'}}"></span>
                  @endif
                </a>
              </th>
              <th>
                <a href="{{  route('adm.pedido.order',['column-5', $order, 'pager' => $pager, 'search' => $search])}}">
                  Nombre emisor
                  @if($column == 'column-5')
                      <span class="glyphicon glyphicon-sort-by-attributes{{$order == 'desc'? '':'-alt'}}"></span>
                  @endif
                </a>
              </th>
              <th>
                <a href="{{  route('adm.pedido.order',['column-6', $order, 'pager' => $pager, 'search' => $search])}}">
                  Nombre receptor
                  @if($column == 'column-6')
                      <span class="glyphicon glyphicon-sort-by-attributes{{$order == 'desc'? '':'-alt'}}"></span>
                  @endif
                </a>
              </th>
              <th>
                <a href="{{  route('adm.pedido.order',['column-7', $order, 'pager' => $pager, 'search' => $search])}}">
                  Cuanto paga
                  @if($column == 'column-7')
                      <span class="glyphicon glyphicon-sort-by-attributes{{$order == 'desc'? '':'-alt'}}"></span>
                  @endif
                </a>
              </th>
              <th>
                <a href="{{  route('adm.pedido.order',['column-8', $order, 'pager' => $pager, 'search' => $search])}}">
                  Corporativo
                  @if($column == 'column-8')
                      <span class="glyphicon glyphicon-sort-by-attributes{{$order == 'desc'? '':'-alt'}}"></span>
                  @endif
                </a>
              </th>
              <th>
                <a href="{{  route('adm.pedido.order',['column-9', $order, 'pager' => $pager, 'search' => $search])}}">
                  Estado
                  @if($column == 'column-9')
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
                  <span >{{ $model->pedido_id }}</span>
              </td>
              <td>
                  <span >{{ $model->pedido_codigo }}</span>
              </td>
              <td>
                  <span >{{ $model->pedido_fechacreacion }}</span>
              </td>
              <td>
                  <span >{{ $model->pedido_calledesde }}</span>
              </td>
              <td>
                  <span >{{ $model->pedido_callehasta }}</span>
              </td>
              <td>
                  <span >{{ $model->pedido_nombreemisor }}</span>
              </td>
              <td>
                  <span >{{ $model->pedido_nombrereceptor }}</span>
              </td>
              <td>
                  <span >{{ $model->pedido_cuantopaga }}</span>
              </td>
              <td>
                  <span >{{ $model->pedido_escorporativo }}</span>
              </td>
              <td>
                  <span >{{ $model->pedido_estado }}</span>
              </td>


              <td class="text-center">
                <a href="{{ route('adm.pedido.view',$model->pedido_id) }}" class="ver-detail-item"
                 title="Ver">
                  <span class="icon s7-look"></span>
                </a>
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
{!! Html::script('js/js-xlsx/shim.js') !!}
{!! Html::script('js/js-xlsx/dist/xlsx.full.min.js') !!}

    <script>
        //app.init();

  // $('#upload_plantilla').click(function() {
  //   $('#theFileInput').click();
  // });
  var DATAJSON = [];
  var dataReserva = [];
  var X = XLSX;
  var XW = {
  	/* worker message */
  	msg: 'xlsx',
  	/* worker scripts */
  	worker: './xlsxworker.js'
  };

  var global_wb;

  var process_wb = (function() {

  	var to_json = function to_json(workbook) {
  		var result = {};
      var sheet = 'Reservas';
  		workbook.SheetNames.forEach(function(sheet) {
  			var roa = X.utils.sheet_to_json(workbook.Sheets['Reservas'], {header:1,skipUndefined: true});
        var lista = roa.filter( r => {return r.length > 0;})
  			if(roa.length) result['Reservas'] = lista;
  		});
  		return result['Reservas'];
  	};


  	return function process_wb(wb) {
  		global_wb = wb;
  		DATAJSON = to_json(wb);
      DATAJSON.shift();
      $('#dataInput').val(JSON.stringify(DATAJSON));
      debugger;
      var url = $("#form-reserva").data('url');
      $.ajax({
          type: 'POST',
          url: url,
          data: $("#form-reserva").serialize(),
          success: function (data) {
              if (data.estado == 0) {
                toastr.success(data.mensaje);
              } else {
                toastr.warning(data.mensaje);
              }
              setTimeout(function(){location.reload();}, 5000);

          },
          error: function () {
              console.log('error');
          }
      });
  	};
  })();

  var setfmt = window.setfmt = function setfmt() { if(global_wb) process_wb(global_wb); };

  var b64it = window.b64it = (function() {
  	var tarea = document.getElementById('b64data');
  	return function b64it() {
  		if(typeof console !== 'undefined') console.log("onload", new Date());
  		var wb = X.read(tarea.value, {type:'base64', WTF:false});
  		process_wb(wb);
  	};
  })();

  var do_file = (function() {
  	var rABS = true;
  	var use_worker = true;

  	var xw = function xw(data, cb) {
  		var worker = new Worker(XW.worker);
  		worker.onmessage = function(e) {
  			switch(e.data.t) {
  				case 'ready': break;
  				case 'e': console.error(e.data.d); break;
  				case XW.msg: cb(JSON.parse(e.data.d)); break;
  			}
  		};
  		worker.postMessage({d:data,b:rABS?'binary':'array'});
  	};

  	return function do_file(files) {
  		use_worker = false;
  		var f = files[0];
  		var reader = new FileReader();
  		reader.onload = function(e) {
  			if(typeof console !== 'undefined') console.log("onload", new Date(), rABS, use_worker);
  			var data = e.target.result;
  			if(!rABS) data = new Uint8Array(data);
  			if(use_worker) xw(data, process_wb);
  			else process_wb(X.read(data, {type: rABS ? 'binary' : 'array'}));
  		};
  		if(rABS) reader.readAsBinaryString(f);
  		else reader.readAsArrayBuffer(f);
  	};
  })();


  // (function() {
  //   var xlf = document.getElementById('theFileInput');
  //
  //
  //   if(!xlf.addEventListener)
  //    return;
  //   function handleFile(e) { do_file(e.target.files); }
  //   xlf.addEventListener('change', handleFile, false);
  // })();

  //
  // toastr.options = {
  //     "closeButton": false,
  //     "debug": false,
  //     "newestOnTop": false,
  //     "progressBar": false,
  //     "positionClass": "toast-top-right",
  //     "preventDuplicates": false,
  //     "onclick": null,
  //     "showDuration": "350",
  //     "hideDuration": "1000",
  //     "timeOut": "5000",
  //     "extendedTimeOut": "1000",
  //     "showEasing": "swing",
  //     "hideEasing": "linear",
  //     "showMethod": "fadeIn",
  //     "hideMethod": "fadeOut"
  // };

  $("#form-reserva").submit(function(e) {
    var url =
    $.ajax({
        type: 'POST',
        url: url,
        data: $("#form-reserva").serialize(),
        success: function (data) {
            if (data.estado == 0) {
              toastr.success(data.mensaje);
            } else {
              toastr.warning(data.mensaje);
            }
        },
        error: function () {
            console.log('error');
        }
    });
  });

  var a_bk = '';

        //Js Code


  $('#a_reserva_download').on('click',function(){

    var _this = $(this)
    var a = _this.attr('href');
    a_bk = a;
    var fecha_inicio = $('#filtro_fecha_inicio').val();
    var fecha_fin = $('#filtro_fecha_fin').val();
    if(fecha_inicio!=''&&fecha_fin!=''){
      if(a.indexOf('?')!==-1){
        a += '&filtro_fecha_inicio='+fecha_inicio+'&filtro_fecha_fin='+fecha_fin;
      }else{
        a += '?filtro_fecha_inicio='+fecha_inicio+'&filtro_fecha_fin='+fecha_fin;
      }
      _this.attr('href',a);
      setTimeout(function(){
        _this.attr('href',a_bk);
      },400);

    }


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
