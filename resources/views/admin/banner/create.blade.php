@extends('admin.layout.index')

@section('title')
    Administración | Banner | Editar
@endsection

@section('page-header')
            Editar Banner
@endsection

@section('content')
  <div class="row">
    <div class="col-md-12">
      <div class="panel panel-default">
        <div class="panel-heading">
          <h3>Editar Banner</h3>
        </div>
        <div class="panel-body">
          <div style="border-radius: 0px;" class="form-horizontal group-border-dashed">
            {!! Form::model(null,[
            'method' => 'POST',
            'id' => 'frmBanner',
            'enctype' => 'multipart/form-data',
            'novalidate'=>"novalidate"
            ]) !!}


            @include('admin.banner.fields')

            <div class="row">
              <div class="text-inverse col-md-9">
                  <button type="submit" class="btn btn-space btn-primary">
                      <span class="btn-label">
                          <i class="fa fa-check"></i>
                      </span>
                      Guardar
                  </button>

                  <a href="{{ route('adm.banner.index') }}" class="btn btn-space btn-default">
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
$(document).ready(function(){

    $('#editor1a').summernote({
      height: 300
    });
    $('#editor1a').code('');
    $('#editor2a').summernote({
      height: 100
    });
    $('#editor2a').code('');
    $('#frmBanner').submit(function() {
      var bbbb = $("#editor1a").code();
      var cccc = $("#editor2a").code();
      $('#titulo').val(bbbb);
      $('#subtitulo').val(cccc);
    });
})
</script>
@endsection
