@extends('admin.layout.index')

@section('title')
    Dashboard
@endsection

@section('page-header')
    <h1 class="title">Dashboard</h1>
    {{-- <ol class="breadcrumb">
        <li class="active">This is a quick overview of some features</li>
    </ol> --}}
@endsection

@section('content')
  <style media="screen">
  .widget.widget-tile {
  margin-bottom: 13px;
}
.widget.widget-tile .data-info {
    display: inline-block;
    width: calc(100% - 70px);
}
@media (max-width: 1114px) {
  .widget.widget-tile.widget-tile-wide.cuadro-totalvendido {
      display: block;
  }
  .widget.widget-tile.widget-tile-wide.cuadro-totalvendido > .tile-info,
  .widget.widget-tile.widget-tile-wide.cuadro-totalvendido > .tile-value{
    display: block;
    width: 100%;
    text-align: right;
  }
  .widget.widget-tile.widget-tile-wide.cuadro-totalvendido > .tile-value>span{
    padding-right:0;
  }

}
  </style>
    <div class="container-default">



      <div class="row">
        <div class="col-sm-6">
            <div class="panel panel-default">
              <div class="panel-heading">
                <span class="title">Pedidos registrados últimos 30 días</span>
              </div>
              <div class="panel-body">
                {{-- <div id="line-chart"></div>
                <hr> --}}
                <canvas id="canvas" height="280" width="600"></canvas>
              </div>
            </div>

        </div>
        <div class="col-sm-6">
          <div class="row">
              <div class="col-md-6">
                        <div class="widget widget-tile">
                          <div class="data-info">
                            <div data-toggle="counter" data-end="18.6" data-decimals="1" data-suffix="%" class="value">{{$usuarios_ultimo_mes}}</div>
                            <div class="desc">Registros de clientes en los últimos 30 días</div>
                          </div>
                          <div class="icon"><span class="s7-cloud-download"></span></div>
                        </div>
              </div>
              <div class="col-md-6">
                        <div class="widget widget-tile">
                          <div class="data-info">
                            <div data-toggle="counter" data-end="33" data-suffix="%" class="value">{{$postulaciones_ultimo_mes}}</div>
                            <div class="desc">Postulaciones en los últimos 30 días</div>
                          </div>
                          <div class="icon"><span class="s7-timer"></span></div>
                        </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-6">
                <div class="widget widget-tile">
                  <div class="data-info">
                    <div data-toggle="counter" data-end="156" class="value">{{$contactos_ultimo_mes}}</div>
                    <div class="desc">Contactos en los últimos 30 días</div>
                  </div>
                  <div class="icon"><span class="s7-graph1"></span></div>
                </div>
              </div>
              <div class="col-md-6">
                <div class="widget widget-tile">
                  <div class="data-info">
                    <div data-toggle="counter" data-decimals="1" data-end="7.5" data-suffix="K" class="value" id="n_transacciones">0</div>
                    <div class="desc">Transacciones en los últimos 30 días</div>
                  </div>
                  <div class="icon"><span class="s7-like2"></span></div>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-12">
                <div class="widget widget-tile widget-tile-wide cuadro-totalvendido">
                  <div class="tile-info">
                    <div class="icon"><span class="s7-like"></span></div>
                    <div class="data-info">
                      <div class="title">Total vendido de los últimos 30 días </div>
                      <div class="desc">(en los 3 servicios)</div>
                    </div>
                  </div>
                  <div class="tile-value"><span data-toggle="counter" data-decimals="2" data-end="28458" data-prefix="$"><span id="general_suma"></span></span></div>
                </div>
              </div>
            </div>
        </div>

      </div>

      <div class="row">
          <!--Responsive table-->
          <div class="col-sm-12">
            <div class="widget widget-fullwidth widget-small">
              <div class="widget-head">
                <div class="tools"><span class="icon s7-upload"></span><span class="icon s7-edit"></span><span class="icon s7-close"></span></div>
                <div class="title">Postulaciones mas recientes</div>
              </div>
              <div class="table-responsive noSwipe">
                <table class="table table-striped table-fw-widget table-hover">
                  <thead>
                    <tr>
                      <th width="25%">Nombre y apellidos</th>
                      <th width="25%">Correo</th>
                      <th width="10%">Celular</th>
                      <th width="10%">Fecha Registro</th>
                      <th width="10%" class="number">Tipo</th>
                    </tr>
                  </thead>
                  <tbody class="no-border-x">
                    @if(count($postulantes))
                      @foreach($postulantes as $model)

                    <tr class="odd gradeX">
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
                          <span style="width: 200px;">{{ $model->created_at }}</span>
                      </td>

                      <td style="text-align: right;">
                          <span style="width: 200px;">{{ $model->tipo_scharfer() }}</span>
                      </td>








                    </tr>
                  @endforeach
                  @else
                      <span class="m-datatable--error" style="width: 100%;">No records found</span>
                  @endif

                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
    </div>




@endsection


@section('script')

{!! Html::script('assets/admin/js/Chart.bundle.js') !!}


<script type="text/javascript">
@php

  $js_reservas_sta = json_encode($reservas_sta);
  echo "var general_sta = ". $js_reservas_sta . ";\n";

@endphp
//
// var reserva_sta = [
//   [
//     {"date":"2018-03-16","views":1},
//     {"date":"2018-04-10","views":1},
//     {"date":"2018-08-10","views":4},
//     {"date":"2018-08-13","views":3}
//   ],
//   [
//     {"date":"2018-06-07","views":6},
//     {"date":"2018-06-08","views":2},
//     {"date":"2018-06-13","views":1},
//     {"date":"2018-06-15","views":1},
//     {"date":"2018-07-27","views":25},
//     {"date":"2018-07-30","views":9},
//     {"date":"2018-08-10","views":1},
//     {"date":"2018-08-13","views":7}
//   ]
// ];
//
//  var reserva_sta = [
//    [
//      {"date":"2018-08-13","views":3},
//      {"date":"2018-08-10","views":4},
//      {"date":"2018-08-1","views":0}
//      ]
//    ];

  var general_suma = general_sta[3];
  var twoPlacedFloat = parseFloat(general_suma).toFixed(2);
  general_suma =  's/. ' + twoPlacedFloat;
  document.getElementById('general_suma').innerHTML = general_suma;
  var n_transacciones = 0;

  var reserva_sta_labels = [];
  var reserva_sta_values = [];

  general_sta[0] = general_sta[0].reverse();
  general_sta[0].forEach(el => {
    reserva_sta_labels.push(el.date);
    reserva_sta_values.push(el.views);
    n_transacciones += el.views;
  });

  var regular_sta_labels = [];
  var regular_sta_values = [];

  general_sta[1] = general_sta[1].reverse();
  general_sta[1].forEach(el => {
    regular_sta_labels.push(el.date);
    regular_sta_values.push(el.views);
    n_transacciones += el.views;
  });


  var pedido_sta_labels = [];
  var pedido_sta_values = [];

  general_sta[2] = general_sta[2].reverse();
  general_sta[2].forEach(el => {
    pedido_sta_labels.push(el.date);
    pedido_sta_values.push(el.views);
    n_transacciones += el.views;
  });

  document.getElementById('n_transacciones').innerHTML = n_transacciones;


  window.chartColors = {
  	red: 'rgb(255, 99, 132)',
  	orange: 'rgb(255, 159, 64)',
  	yellow: 'rgb(255, 205, 86)',
  	green: 'rgb(75, 192, 192)',
  	blue: 'rgb(54, 162, 235)',
  	purple: 'rgb(153, 102, 255)',
  	grey: 'rgb(201, 203, 207)'
  };

  var ctx = document.getElementById("canvas").getContext('2d');

  ctx.height = 268;





  var myChart = new Chart(ctx, {
    type: 'line',
    data: {
        labels:reserva_sta_labels,
        datasets: [
          {
            label: 'Envíos regulares',
            data: reserva_sta_values,
            borderWidth: 1,
            fill: false,
            backgroundColor: window.chartColors.blue,
			      borderColor: window.chartColors.blue,
          },
          {
            label: 'Reservas regulares',
            data: regular_sta_values,
            borderWidth: 1,
            fill: false,
            backgroundColor: window.chartColors.orange,
			      borderColor: window.chartColors.orange,
          },
          {
            label: 'Pedidos express',
            data: pedido_sta_values,
            borderWidth: 1,
            fill: false,
            backgroundColor: window.chartColors.red,
			      borderColor: window.chartColors.red,
          },
        // {
        //     label: 'Reservas regulares',
        //     data: Prices,
        //     borderWidth: 1,
        //     fill: false,
        //     backgroundColor: window.chartColors.orange,
        //     borderColor: window.chartColors.orange,
        // },
        // {
        //     label: 'Pedidos express',
        //     data: Prices,
        //     borderWidth: 1,
        //     fill: false,
        //     backgroundColor: window.chartColors.yellow,
        //     borderColor: window.chartColors.yellow,
        // }
      ]
    },
    options: {
			responsive: true,
      maintainAspectRatio: false,
			title: {
				display: false,
				text: 'Chart.js Line Chart'
			},
			tooltips: {
				mode: 'index',
				intersect: false,
			},
			hover: {
				mode: 'nearest',
				intersect: true
			},
      elements: {
				line: {
					tension: 0.000001
				}
			},
			scales: {
				xAxes: [{
					display: true,
					scaleLabel: {
						display: true,
						labelString: 'Días'
					}
				}],
				yAxes: [{
					display: true,
					scaleLabel: {
						display: true,
						labelString: 'Nº servicios'
					}
				}]
			}
		}
  });









</script>
@endsection
