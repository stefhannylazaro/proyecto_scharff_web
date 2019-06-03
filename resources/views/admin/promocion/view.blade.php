@extends('admin.layout.index')

@section('title')
    Administración | Promoción | Editar
@endsection

@section('page-header')
            Promoción
@endsection

@section('content')
  <style media="screen">
  .s7-date:before {
  content: "\e660";
}

.datepicker input.form-control{
  background: #fff;
}
  </style>
  <div class="row">
    <div class="col-md-12">
      <div class="panel panel-default">
        <div class="panel-heading">
          <h3>Editando promoción con ID: {{$model->promocion_id}}</h3>
        </div>
        <div class="panel-body">
          <div style="border-radius: 0px;" class="form-horizontal group-border-dashed">
            {!! Form::model($model,[
            'method' => 'POST',
            'id' => 'frmBanner',
            'enctype' => 'multipart/form-data',
            'novalidate'=>"novalidate"
            ]) !!}


            @include('admin.promocion.fields')


            <div class="form-group">
                <label class="col-sm-3 control-label">
                  <a onclick="return confirm('¿Estas seguro?')" href="{{ route('adm.promocion.delete',$model->promocion_id) }}" class="ver-detail-item" title="Ver">
                      Eliminar
                  </a>
                </label>
                <div class="col-md-6">

                </div>
            </div>



            <div class="row">
              <div class="text-inverse col-md-9">
                  <button type="submit" class="btn btn-space btn-primary">
                      <span class="btn-label">
                          <i class="fa fa-check"></i>
                      </span>
                      Guardar
                  </button>

                  <a href="{{ route('adm.promocion.index') }}" class="btn btn-space btn-default">
                          <span class="btn-label">
                              <i class="fa fa-times"></i>
                          </span>
                      Cancelar
                  </a>
              </div>
            </div>

            {!! Form::close() !!}
          </div>

        </div>
      </div>
    </div>
  </div>




@endsection

@section('script')
    <script type="text/javascript">
        //banner.init();


        $(function () {
            $('.datepicker').datetimepicker({
                todayHighlight: true,
                autoclose: true,
                pickerPosition: 'bottom-left',
                format: 'yyyy-mm-dd',
                //format: 'yyyy-mm-dd hh:ii:00',
                clearBtn: true,

            });
        });

        var checkBox = document.getElementById("check1");

        if (checkBox.checked == true){
          $('#cupones_promo_group').show();
        } else {
          $('#cupones_promo_group').hide();
        }

        $('#check1').click(function(){
            if($(this).is(':checked')){
                $('#cupones_promo_group').show();
            } else {
                $('#cupones_promo_group').hide();
            }
        });


        //var tipo_id = $('#tipo_id').val(["2","3"]);

        $(document).ready(function(){


          if($('#tipo_id').val()){
            var tipo_id = $('#tipo_id').val().split(",");
            $('#tipo_id_arf').val(tipo_id);
          }
          //$('#tipo_id_arf>option').first().attr('selected','selected').attr('disabled','disabled');

          $('#frmBanner').submit(function() {
            var string = $('#tipo_id_arf').val().toString();
            $('#tipo_id').val(string);
            //alert($("#tipo_id_arf")[0].selectedIndex);
            // if($("#tipo_id_arf")[0].selectedIndex == 0)
            // {
            //     //alert("esta pasando");
            //     string = $('#todos_tipos').data('todos_tipos');
            //     $('#tipo_id').val(string);
            // }
          });
        });









    </script>
@endsection
