@extends('admin.layout.index')

@section('title')
    Administración | Administrador
@endsection

@section('page-header')
    <div class="mr-auto">
        <h3 class="m-subheader__title m-subheader__title--separator">
            Administrador
        </h3>
        <!--<ul class="m-subheader__breadcrumbs m-nav m-nav--inline">
            <li class="m-nav__item m-nav__item--home">
                <a href="#" class="m-nav__link m-nav__link--icon">
                    <i class="m-nav__link-icon la la-home"></i>
                </a>
            </li>
            <li class="m-nav__separator">
                -
            </li>
            <li class="m-nav__item">
                <a href="" class="m-nav__link">
                                <span class="m-nav__link-text">
                                    Base
                                </span>
                </a>
            </li>
            <li class="m-nav__separator">
                -
            </li>
            <li class="m-nav__item">
                <a href="" class="m-nav__link">
                                <span class="m-nav__link-text">
                                    State Colors
                                </span>
                </a>
            </li>
        </ul>-->
    </div>
@endsection

@section('content')

    <div class="m-portlet m-portlet--mobile">
        <div class="m-portlet__head">
            <div class="m-portlet__head-caption">
                <div class="m-portlet__head-title">
                    <h3 class="m-portlet__head-text">
                        Nuevo Administrador
                    </h3>
                </div>
            </div>
        </div>

        {!! Form::open([
        'method' => 'POST',
        'id' => 'frmBanner',
        'enctype' => 'multipart/form-data',
        'novalidate'=>"novalidate"
        ]) !!}

        <div class="m-portlet__body">
            <div class="m-form__section m-form__section--first">
                @include('admin.admin.fields')
            </div>
            <div class="m-portlet__foot m-portlet__foot--fit">
                <br>

                <div class="m-form__actions m-form__actions">
                    <button type="submit" class="btn btn-wd btn-success btn-fill">
                        <span class="btn-label">
                            <i class="fa fa-check"></i>
                        </span>
                        Guardar
                    </button>

                    <a href="{{ route('adm.admin.index') }}" class="btn btn-wd btn-danger btn-fill">
                            <span class="btn-label">
                                <i class="fa fa-times"></i>
                            </span>
                        Cancelar
                    </a>
                </div>
            </div>
        </div>
        {!! Form::close() !!}
    </div>
@endsection

@section('script')
    <script type="text/javascript">
        banner.init();
    </script>
@endsection