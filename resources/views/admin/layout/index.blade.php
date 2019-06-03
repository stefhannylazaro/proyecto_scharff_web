<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" type="image/png" href="/images/favicon_rosa.png" sizes="16x16">
    <link rel="icon" type="image/png" href="/images/favicon_rosa.png" sizes="32x32">
    <link rel="icon" type="image/png" href="/images/favicon_rosa.png" sizes="96x96">
    <title>@yield('title')</title>
    {!! Html::style('assets/admin/lib/stroke-7/style.css') !!}
    {!! Html::style('assets/admin/lib/jquery.nanoscroller/css/nanoscroller.css') !!}
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    {!! Html::style('assets/admin/lib/datetimepicker/css/bootstrap-datetimepicker.min.css') !!}
    {!! Html::style('assets/admin/lib/font-awesome/css/font-awesome.min.css') !!}
    {!! Html::style('assets/admin/lib/summernote/summernote.css') !!}
    {!! Html::style('assets/admin/css/style.css') !!}
    {!! Html::style('assets/admin/css/custom.css') !!}


    <script
            src="https://ajax.googleapis.com/ajax/libs/webfont/1.6.16/webfont.js"></script>
    <script>
    WebFont.load({
        google: {"families":["Poppins:300,400,500,600,700","Roboto:300,400,500,600,700"]},
        active: function() {
            sessionStorage.fonts = true;
        }
    });
    </script>


  </head>
  <body>
    <div class="am-wrapper">
      <nav class="navbar navbar-default navbar-fixed-top am-top-header">
        <div class="container-fluid">
          <div class="navbar-header">
            <div class="page-title"><span>
              @yield('page-header')
            </span></div><a href="#" class="am-toggle-left-sidebar navbar-toggle collapsed"><span class="icon-bar"><span></span><span></span><span></span></span></a><a href="/" class="navbar-brand"></a>
          </div><a href="#" data-toggle="collapse" data-target="#am-navbar-collapse" class="am-toggle-top-header-menu collapsed"><span class="icon s7-angle-down"></span></a>
          <div id="am-navbar-collapse" class="collapse navbar-collapse">
            <ul class="nav navbar-nav am-user-nav">
              <li class="dropdown"><a href="#" data-toggle="dropdown" role="button" aria-expanded="false" class="dropdown-toggle"><img src="/assets/admin/img/icon_cuenta-2x.png"><span class="user-name"></span><span class="angle-down s7-angle-down"></span></a>
                <ul role="menu" class="dropdown-menu">
                  {{-- <li><a href="#"> <span class="icon s7-user"></span>My profile</a></li>
                  <li><a href="#"> <span class="icon s7-config"></span>Settings</a></li>
                  <li><a href="#"> <span class="icon s7-help1"></span>Help</a></li> --}}
                  <li><a href="{{ route('logout') }}"> <span class="icon s7-power"></span>Cerrar</a></li>
                </ul>
              </li>
            </ul>
            <ul class="nav navbar-nav am-top-menu">
              <li><a href="/">Inicio</a></li>
              <li class="dropdown"><a href="#" data-toggle="dropdown" role="button" aria-expanded="false" class="dropdown-toggle">Servicios <span class="angle-down s7-angle-down"></span></a>
                <ul role="menu" class="dropdown-menu">
                  @if(\App\Models\PerfilAccion::verificarAcceso('reserva'))
                  <li><a href="{{ route('adm.reserva.index') }}">Reservas de lockers</a></li>
                  @endif
                  {{-- <li><a href="#">Postulantes</a></li> --}}
                  @if(\App\Models\PerfilAccion::verificarAcceso('regular'))
                  <li><a href="{{ route('adm.regular.index') }}">Envíos regulares</a></li>
                  @endif

                  @if(\App\Models\PerfilAccion::verificarAcceso('regular'))
                  <li><a href="{{ route('adm.pedido.index') }}">Envíos Express</a></li>
                  @endif

                  @if(\App\Models\PerfilAccion::verificarAcceso('regular'))
                  <li><a href="{{ route('adm.dashboard.general') }}">Listado General</a></li>
                  @endif

                  @if(\App\Models\PerfilAccion::verificarAcceso('admin'))
                  <li><a href="{{ route('adm.promocion.index') }}">Promociones</a></li>
                  @endif






                  {{-- <li><a href="#">Usuarios registrados</a></li> --}}
                </ul>
              </li>
              @if(\App\Models\PerfilAccion::verificarAcceso('contacto'))
              <li>
                  <a href="{{ route('adm.contacto.index') }}"><span>Contactos</span></a>
              </li>
              @endif

              @if(\App\Models\PerfilAccion::verificarAcceso('regular'))
              <li id="salir-mobile"><a href="{{ route('logout') }}"> <span class="icon s7-power"></span> &nbsp;Cerrar</a></li>
              @endif

              {{-- <li><a href="#">Support</a></li> --}}
            </ul>
            <ul class="nav navbar-nav am-icons-nav">
              {{-- <li class="dropdown"><a href="#" data-toggle="dropdown" role="button" aria-expanded="false" class="dropdown-toggle"><span class="icon s7-comment"></span></a>
                <ul class="dropdown-menu am-messages">
                  <li>
                    <div class="title">Messages<span class="badge">3</span></div>
                    <div class="list">
                      <div class="am-scroller nano">
                        <div class="content nano-content">
                          <ul>
                            <li class="active"><a href="#">
                                <div class="logo"><img src="assets/admin/img/avatar2.jpg"></div>
                                <div class="user-content"><span class="date">April 25</span><span class="name">Jessica Caruso</span><span class="text-content">Request you to be a part of the same so that we can work...</span></div></a></li>
                            <li><a href="#">
                                <div class="logo"><img src="assets/admin/img/avatar3.jpg"></div>
                                <div class="user-content"><span class="date">March 18</span><span class="name">Joel King</span><span class="text-content"> We wish to extend the building.</span></div></a></li>
                            <li><a href="#">
                                <div class="logo"><img src="assets/admin/img/avatar4.jpg"></div>
                                <div class="user-content"><span class="date">January 3</span><span class="name">Claire Sassu</span><span class="text-content"> We the ladies of a block are wiling to join together to set up a catering...</span></div></a></li>
                            <li><a href="#">
                                <div class="logo"><img src="assets/admin/img/avatar5.jpg"></div>
                                <div class="user-content"><span class="date">January 2</span><span class="name">Emily Carter</span><span class="text-content"> Request you to be a part of the same so that we can work...</span></div></a></li>
                          </ul>
                        </div>
                      </div>
                    </div>
                    <div class="footer"> <a href="#">View all messages</a></div>
                  </li>
                </ul>
              </li>
              <li class="dropdown"><a href="#" data-toggle="dropdown" role="button" aria-expanded="false" class="dropdown-toggle"><span class="icon s7-bell"></span><span class="indicator"></span></a>
                <ul class="dropdown-menu am-notifications">
                  <li>
                    <div class="title">Notifications<span class="badge">3</span></div>
                    <div class="list">
                      <div class="am-scroller nano">
                        <div class="content nano-content">
                          <ul>
                            <li class="active"><a href="#">
                                <div class="logo"><span class="icon s7-pin"></span></div>
                                <div class="user-content"><span class="circle"></span><span class="name">Jessica Caruso</span><span class="text-content"> accepted your invitation to join the team.</span><span class="date">2 min ago</span></div></a></li>
                            <li><a href="#">
                                <div class="logo"><span class="icon s7-add-user"></span></div>
                                <div class="user-content"><span class="name">Joel King</span><span class="text-content"> is now following you</span><span class="date">2 days ago</span></div></a></li>
                            <li><a href="#">
                                <div class="logo"><span class="icon s7-gleam"></span></div>
                                <div class="user-content"><span class="name">Claire Sassu</span><span class="text-content"> is watching your main repository</span><span class="date">2 days ago</span></div></a></li>
                            <li><a href="#">
                                <div class="logo"><span class="icon s7-add-user"></span></div>
                                <div class="user-content"><span class="name">Emily Carter</span><span class="text-content"> is now following you</span><span class="date">5 days ago</span></div></a></li>
                          </ul>
                        </div>
                      </div>
                    </div>
                    <div class="footer"> <a href="#">View all notifications</a></div>
                  </li>
                </ul>
              </li> --}}
              {{-- <li class="dropdown"><a href="#" data-toggle="dropdown" role="button" aria-expanded="false" class="dropdown-toggle"><span class="icon s7-share"></span></a>
                <ul class="dropdown-menu am-connections">
                  <li>
                    <div class="title">Connections</div>
                    <div class="list">
                      <div class="content">
                        <ul>
                          <li>
                            <div class="logo"><img src="assets/admin/img/github.png"></div>
                            <div class="field"><span>GitHub</span>
                              <div class="switch-container">
                                <div class="switch-button switch-button-sm">
                                  <input type="checkbox" checked="" name="check1" id="switch1"><span>
                                    <label for="switch1"></label></span>
                                </div>
                              </div>
                            </div>
                          </li>
                          <li>
                            <div class="logo"><img src="assets/admin/img/bitbucket.png"></div>
                            <div class="field"><span>Bitbucket</span>
                              <div class="switch-container">
                                <div class="switch-button switch-button-sm">
                                  <input type="checkbox" name="check2" id="switch2"><span>
                                    <label for="switch2"></label></span>
                                </div>
                              </div>
                            </div>
                          </li>
                          <li>
                            <div class="logo"><img src="assets/admin/img/slack.png"></div>
                            <div class="field"><span>Slack</span>
                              <div class="switch-container">
                                <div class="switch-button switch-button-sm">
                                  <input type="checkbox" checked="" name="check3" id="switch3"><span>
                                    <label for="switch3"></label></span>
                                </div>
                              </div>
                            </div>
                          </li>
                          <li>
                            <div class="logo"><img src="assets/admin/img/dribbble.png"></div>
                            <div class="field"><span>Dribbble</span>
                              <div class="switch-container">
                                <div class="switch-button switch-button-sm">
                                  <input type="checkbox" name="check4" id="switch4"><span>
                                    <label for="switch4"> </label></span>
                                </div>
                              </div>
                            </div>
                          </li>
                        </ul>
                      </div>
                    </div>
                    <div class="footer"> <a href="#">View all connections</a></div>
                  </li>
                </ul>
              </li> --}}
            </ul>
          </div>
        </div>
      </nav>



      {{-- START SIDEBAR --}}
      @include('admin.layout.sidebar')
      {{-- END SIDEBAR --}}


      <div class="am-content">
        <div class="page-head">
          <h2>@yield('page-header')</h2>
          {{-- <ol class="breadcrumb">
            <li><a href="#">Home</a></li>
            <li><a href="#">Layouts</a></li>
            <li class="active">No sidebar right</li>
          </ol> --}}
        </div>


        <div class="main-content">

              @yield('content')

        </div>
      </div>
    </div>


    @include('admin.layout.scripts')

    @yield('script')

  </body>
</html>
