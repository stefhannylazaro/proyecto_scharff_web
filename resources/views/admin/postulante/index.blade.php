@extends('admin.layout.index')

@section('title')
    Postulantes Scharffer
@endsection

@section('page-header')
  Postulantes Scharffer
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
                  @php($current = route('adm.postulante.order'))

                  @php($full = url()->full())
                  @php($query_str = parse_url($full, PHP_URL_QUERY))

                  <a href="{{route('adm.postulante.download-data-system') .'?'. $query_str  }}" class="m-nav__link" id="a_reserva_download">
                      <span class="">
                          Descargar Data Sistemas
                      </span>
                  </a>
              </li>
              <li class="m-nav__item">
                  @php($current = route('adm.postulante.order'))

                  @php($full = url()->full())
                  @php($query_str = parse_url($full, PHP_URL_QUERY))

                  <a href="{{route('adm.postulante.download') .'?'. $query_str  }}" class="m-nav__link" id="">
                      <span class="">
                          Descargar Data
                      </span>
                  </a>
              </li>
            </ul>
          </div>
          <div class="title">Lista de postulante scharffer</div>
        </div>

        {!! Form::open(array('route' => 'adm.postulante.upload-plantilla','method'=>'POST','files'=>'true','id' => 'form-postulante', 'data-url' => route('adm.postulante.upload-plantilla') , "enctype"=>"multipart/form-data")) !!}
        {{csrf_field()}}
        <input type="file" name="file" id="theFileInput" style="display:none;" />

        <input type="hidden" name="data" id="dataInput" />

        {!! Form::close() !!}


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
                <a href="{{  route('adm.postulante.order',['column-1', $order, 'pager' => $pager, 'search' => $search])}}">
                  ID Reserva
                  @if($column == 'column-1')
                      <span class="glyphicon glyphicon-sort-by-attributes{{$order == 'desc'? '':'-alt'}}"></span>
                  @endif
                </a>
              </th>
              <th>
                <a href="{{  route('adm.postulante.order',['column-2', $order, 'pager' => $pager, 'search' => $search])}}">
                  Nombres y apellidos
                  @if($column == 'column-2')
                      <span class="glyphicon glyphicon-sort-by-attributes{{$order == 'desc'? '':'-alt'}}"></span>
                  @endif
                </a>
              </th>
              <th>
                <a href="{{  route('adm.postulante.order',['column-3', $order, 'pager' => $pager, 'search' => $search])}}">
                  Correo electrónico
                  @if($column == 'column-3')
                      <span class="glyphicon glyphicon-sort-by-attributes{{$order == 'desc'? '':'-alt'}}"></span>
                  @endif
                </a>
              </th>
              <th>
                <a href="{{  route('adm.postulante.order',['column-4', $order, 'pager' => $pager, 'search' => $search])}}">
                  Celular
                  @if($column == 'column-4')
                      <span class="glyphicon glyphicon-sort-by-attributes{{$order == 'desc'? '':'-alt'}}"></span>
                  @endif
                </a>
              </th>
              <th>
                <a href="{{  route('adm.postulante.order',['column-5', $order, 'pager' => $pager, 'search' => $search])}}">
                  Fecha Nacimiento
                  @if($column == 'column-5')
                      <span class="glyphicon glyphicon-sort-by-attributes{{$order == 'desc'? '':'-alt'}}"></span>
                  @endif
                </a>
              </th>
              <th>
                <a href="{{  route('adm.postulante.order',['column-6', $order, 'pager' => $pager, 'search' => $search])}}">
                  Tipo Scharfer
                  @if($column == 'column-6')
                      <span class="glyphicon glyphicon-sort-by-attributes{{$order == 'desc'? '':'-alt'}}"></span>
                  @endif
                </a>
              </th>
              <th>
                <a href="{{  route('adm.postulante.order',['column-7', $order, 'pager' => $pager, 'search' => $search])}}">
                  Fecha de solicitud
                  @if($column == 'column-7')
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
                  <span style="width: 200px;">{{ $model->nombre.' '.$model->apellidos }}</span>
              </td>
              <td>
                  <span style="width: 200px;">{{ $model->correo }}</span>
              </td>

              <td>
                  <span style="width: 200px;">{{ $model->celular }}</span>
              </td>
              <td>
                  <span style="width: 200px;">{{ $model->fecha_nacimiento }}</span>
              </td>
              <td>
                  <span style="width: 200px;">{{ $model->tipo_scharfer() }}</span>
              </td>

              <td>
                  <span style="width: 200px;">{{ $model->created_at }}</span>
              </td>
              <td class="text-center"><a href="{{ route('adm.postulante.view',$model->id) }}" class="ver-detail-item"
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
{!! Html::script('js/js-xlsx/shim.js') !!}
{!! Html::script('js/js-xlsx/dist/xlsx.full.min.js') !!}

    <script>
        //app.init();

  $('#upload_plantilla').click(function() {
    $('#theFileInput').click();
  });
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
      var url = $("#form-postulante").data('url');
      $.ajax({
          type: 'POST',
          url: url,
          data: $("#form-postulante").serialize(),
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

  (function() {
  	var xlf = document.getElementById('theFileInput');
  	if(!xlf.addEventListener) return;
  	function handleFile(e) { do_file(e.target.files); }
  	xlf.addEventListener('change', handleFile, false);
  })();


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

  $("#form-postulante").submit(function(e) {
    var url =
    $.ajax({
        type: 'POST',
        url: url,
        data: $("#form-postulante").serialize(),
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
