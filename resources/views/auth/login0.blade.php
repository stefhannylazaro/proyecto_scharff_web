<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <title>
        SCHRAFF | Login
    </title>
    <meta name="description" content="Latest updates and statistic charts">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!--begin::Web font -->
    <script src="https://ajax.googleapis.com/ajax/libs/webfont/1.6.16/webfont.js"></script>
    <script>
        WebFont.load({
            google: {"families":["Poppins:300,400,500,600,700","Roboto:300,400,500,600,700"]},
            active: function() {
                sessionStorage.fonts = true;
            }
        });
    </script>
    <!--end::Web font -->
    <!--begin::Base Styles -->
    <link href="/assets/vendors/base/vendors.bundle.css" rel="stylesheet" type="text/css" />
    <link href="/assets/demo/default/base/style.bundle.css" rel="stylesheet" type="text/css" />
    <!--end::Base Styles -->
</head>

<body class="m--skin- m-header--fixed m-header--fixed-mobile m-aside-left--enabled m-aside-left--skin-dark m-aside-left--offcanvas m-footer--push m-aside--offcanvas-default"  >
<!-- begin:: Page -->
<div class="m-grid m-grid--hor m-grid--root m-page">
    <div class="m-grid__item m-grid__item--fluid m-grid m-grid--hor m-login m-login--signin m-login--2 m-login-2--skin-2" id="m_login" style="background-image: url(../../../assets/app/media/img//bg/bg-3.jpg);">
        <div class="m-grid__item m-grid__item--fluid	m-login__wrapper">
            <div class="m-login__container">
                <div class="m-login__logo">
                        <h1>SCHARFF</h1>
                </div>

                <div class="m-login__signin">
                    <div class="m-login__head">
                        <h3 class="m-login__title">
                            Panel de Administración
                        </h3>
                    </div>
                    {!! Form::open(['method' => 'post', 'class' => 'm-login__form m-form']) !!}

                    @if($errors->any())
                        <div class="m-alert m-alert--outline alert alert-danger alert-dismissible" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"></button>
                            <span>{{$errors->first()}}</span>
                        </div>
                    @endif

                    <div class="form-group m-form__group">
                            <input class="form-control m-input"   type="text" placeholder="Email" name="email" autocomplete="off">
                        </div>
                        <div class="form-group m-form__group">
                            <input class="form-control m-input m-login__form-input--last" type="password" placeholder="Password" name="password">
                        </div>
                        <div class="row m-login__form-sub">
                            <div class="col m--align-left m-login__form-left">
                                <label class="m-checkbox  m-checkbox--focus">
                                    <input type="checkbox" name="remember">
                                    Remember me
                                    <span></span>
                                </label>
                            </div>

                        </div>
                        <div class="m-login__form-action">
                            <button type="submit" id="m_login_signin_submit" class="btn btn-focus m-btn m-btn--pill m-btn--custom m-btn--air m-login__btn m-login__btn--primary">
                                Login
                            </button>
                        </div>
                    {!! Form::close() !!}

                </div>

            </div>
        </div>
    </div>
</div>
<!-- end:: Page -->
<!--begin::Base Scripts -->
<script src="/assets/vendors/base/vendors.bundle.js" type="text/javascript"></script>
<script src="/assets/demo/default/base/scripts.bundle.js" type="text/javascript"></script>
<!--end::Base Scripts -->
<!--<script src="/assets/snippets/pages/user/login.js" type="text/javascript"></script>-->
<!--begin::Page Snippets -->
</body>
<!-- end::Body -->
</html>

<body>

