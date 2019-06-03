<div class="am-left-sidebar">
        <div class="content">
          <div class="am-logo"></div>
          <ul class="sidebar-elements">

            @if(\App\Models\PerfilAccion::verificarAcceso('dashboard'))
            <li class="parent {{ Request::is('superadmin/dashboard') ?' active':''}}"><a href="{{ route('adm.dashboard.index') }}"><i class="icon s7-monitor"></i><span>Dashboards</span></a>
            </li>
            @endif






            <li class="parent {{ Request::is('superadmin/sssss') ?' active':''}}">
              <a href="#"><i class="icon s7-news-paper"></i><span>Contenido</span></a>

              <ul class="sub-menu">
                {{-- @if(\App\Models\PerfilAccion::verificarAcceso('admin'))
                <li class="{{ Request::is('superadmin/preferencia*') ?' active':''}}">
                  <a href="{{ route('adm.preferencia.index') }}">Preferencia</a>
                </li>
                @endif --}}
                @if(\App\Models\PerfilAccion::verificarAcceso('config-texto'))
                  <li class="{{ Request::is('superadmin/config-texto*') ?' active':''}}">
                    <a href="{{ route('adm.configtext.index') }}">Adminstrar textos</a>
                  </li>
                @endif

                @if(\App\Models\PerfilAccion::verificarAcceso('config-link'))
                  <li class="{{ Request::is('superadmin/config-link*') ?' active':''}}">
                    <a href="{{ route('adm.configlink.index') }}">Adminstrar links</a>
                  </li>
                @endif


                @if(\App\Models\PerfilAccion::verificarAcceso('banner'))
                <li class="{{ Request::is('superadmin/banner*') ?' active':''}}">
                  <a href="{{ route('adm.banner.index') }}">Gestión de Banners</a>
                </li>
                @endif

                {{-- @if(\App\Models\PerfilAccion::verificarAcceso('servicio'))
                  <li class="{{ Request::is('superadmin/servicio*') ?' active':''}}">
                    <a href="{{ route('adm.servicio.index') }}">Servicios</a>
                  </li>
                @endif --}}

                @if(\App\Models\PerfilAccion::verificarAcceso('sucursal'))
                  <li class="{{ Request::is('superadmin/sucursal') ?' active':''}}">
                    <a href="{{ route('adm.sucursal.index') }}">Gestión de Sucursales</a>
                  </li>
                @endif

                @if(\App\Models\PerfilAccion::verificarAcceso('locker'))
                <li class=" {{ Request::is('superadmin/locker*') ?' active':''}}">
                    <a href="{{ route('adm.locker.index') }}">Gestión de lockers</a>
                </li>
                @endif

                @if(\App\Models\PerfilAccion::verificarAcceso('faq'))
                <li class=" {{ Request::is('superadmin/faq*') ?' active':''}}">
                    <a href="{{ route('adm.faq.index') }}">Preguntas frecuentes</a>
                </li>
                @endif


















              </ul>
            </li>


            @if(\App\Models\PerfilAccion::verificarAcceso('user'))
            <li class=" {{ Request::is('superadmin/user*') ?' active':''}}">
                <a href="{{ route('adm.user.index') }}"><i class="icon s7-users"></i><span>Clientes</span></a>
            </li>
            @endif


            <li class="parent {{ Request::is('superadmin/sssss') ?' active':''}}">
              <a href="#"><i class="icon s7-note2"></i><span>Formularios</span></a>

              <ul class="sub-menu">

                @if(\App\Models\PerfilAccion::verificarAcceso('postulantes'))
                <li class=" {{ Request::is('superadmin/postulante*') ?' active':''}}">
                    <a href="{{ route('adm.postulante.index') }}">Postulantes</a>
                </li>
                @endif

                @if(\App\Models\PerfilAccion::verificarAcceso('contacto'))
                <li class=" {{ Request::is('superadmin/contacto*') ?' active':''}}">
                    <a href="{{ route('adm.contacto.index') }}">Contactos</a>
                </li>
                @endif

                @if(\App\Models\PerfilAccion::verificarAcceso('reclamo'))
                <li class=" {{ Request::is('superadmin/reclamo*') ?' active':''}}">
                    <a href="{{ route('adm.claimbook.index') }}">Libro de reclamaciones</a>
                </li>
                @endif

              </ul>
            </li>


            <li class="parent {{ Request::is('superadmin/sssss') ?' active':''}}">
              <a href="#"><i class="icon s7-settings"></i><span>Settings</span></a>
              <ul class="sub-menu">
                @if(\App\Models\PerfilAccion::verificarAcceso('log'))
                <li class=" {{ Request::is('superadmin/log*') ?' active':''}}">
                    <a href="{{ route('adm.log.index') }}">Log de transacciones</a>
                </li>
                @endif


                @if(\App\Models\PerfilAccion::verificarAcceso('motivo'))
                  <li class="{{ Request::is('superadmin/motivo*') ?' active':''}}">
                    <a href="{{ route('adm.motivo.index') }}">Motivos de contacto</a>
                  </li>
                @endif

                @if(\App\Models\PerfilAccion::verificarAcceso('opciones'))
                  <li class="{{ Request::is('superadmin/opciones*') ?' active':''}}">
                    <a href="{{ route('adm.opciones.index') }}">Preferencias</a>
                  </li>
                @endif



                @if(\App\Models\PerfilAccion::verificarAcceso('perfil'))
                <li class="{{ Request::is('superadmin/perfil*') ?' active':''}}">
                    <a href="{{ route('adm.perfil.index') }}">Perfiles de usuarios</a>
                </li>
                @endif


                @if(\App\Models\PerfilAccion::verificarAcceso('admin'))
                <li class=" {{ Request::is('superadmin/admin*') ?' active':''}}">
                    <a href="{{ route('adm.admin.index') }}">Administradores</a>
                </li>
                @endif

                @if(\App\Models\PerfilAccion::verificarAcceso('admin'))
                <li class=" {{ Request::is('superadmin/referencia*') ?' active':''}}">
                    <a href="{{ route('adm.referencia.index') }}">Tipos de usuario</a>
                </li>
                @endif



              </ul>
            </li>

            @if(\App\Models\PerfilAccion::verificarAcceso('admin'))
            <li class=" {{ Request::is('superadmin/gobuypedido*') ?' active':''}}">
                <a href="{{ route('adm.gobuypedido.type',0) }}"><i class="icon s7-news-paper"></i><span>Pedidos Go&buy</span></a>
                <ul class="sub-menu">
                  @if(\App\Models\PerfilAccion::verificarAcceso('contacto'))
                  <li class=" {{ Request::is('superadmin/gobuyalerta*') ?' active':''}}">
                      <a href="{{ route('adm.gobuyalerta.index') }}">Administrar alertas</a>
                  </li>
                  @endif

                </ul>
            </li>
            @endif






























          </ul>
          <!--Sidebar bottom content-->
        </div>
      </div>
