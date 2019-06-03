<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


$metas = App\Http\Controllers\Service\ConfiguracionController::getMetas();
//Route::get('/', ['as' => 'home','uses' => 'Home\IndexController@index']);
Route::get('/', function () use ($metas) {
    //return view("home.welcome", ["descripcion"=>"lalalala","titulo"=>"asdasdasd"]);
    return view('home.welcome',["metas"=>$metas['home'],"ruta"=>'home']);
})->where( 'path', '([A-z\d-\/_.]+)?' );

// Route::get('/', function () {
//   return File::get(public_path() . '/index.html');
// });


/* Routes Auth */
Route::get('/login',['as' => 'login','uses' => 'Auth\LoginController@showLoginForm']);
Route::post('/login',['as' => 'login','uses' => 'Auth\LoginController@login']);
Route::get('/logout', ['as' => 'logout','uses' => 'Auth\LoginController@logout']);


Route::get('/reclamo', ['as'=> 'reclamo', 'uses' => 'Home\ClaimbookController@index']);

Route::post('/reclamo', ['as'=> 'reclamo', 'uses' => 'Home\ClaimbookController@save']);



Route::get('/migrate', ['as'=> 'migration', 'uses' => 'Admin\AdminController@elmigration']);
Route::get('/seed', ['as'=> 'seeder', 'uses' => 'Admin\AdminController@elseeder']);
Route::get('/function_exists', ['as'=> 'seeder', 'uses' => 'Admin\AdminController@function_exists']);
Route::get('/updateuserides', ['as'=> 'updateuserides', 'uses' => 'Admin\AdminController@updateuserides']);
// Route::get('/auxrfacebook', ['as'=> 'auxrfacebook', 'uses' => 'Admin\AdminController@auxrfacebook']);

/* Rutas para VueJS */
Route::get('/scharff-stop', function () use ($metas) {
    return view('home.welcome',["metas"=>$metas['scharff-stop'],"ruta"=>'stop']);
})->where( 'path', '([A-z\d-\/_.]+)?' );



Route::get('/libro-reclamaciones', function () use ($metas) {
    return view('home.welcome',["metas"=>$metas['complaints-book']]);
})->where( 'path', '([A-z\d-\/_.]+)?' );

Route::get('/empresas', function () use ($metas) {
    return view('home.welcome',["metas"=>$metas['empresas']]);
})->where( 'path', '([A-z\d-\/_.]+)?' );

Route::get('/express', function () use ($metas) {
    return view('home.welcome',["metas"=>$metas['scharff-express'],"ruta"=>'express']);
})->where( 'path', '([A-z\d-\/_.]+)?' );

Route::get('/scharffclub', function () use ($metas) {
    return view('home.welcome',["metas"=>$metas['scharff-club'],"ruta"=>'scharffclub']);
})->where( 'path', '([A-z\d-\/_.]+)?' );

Route::get('/scharff-club', function () use ($metas) {
    return view('home.welcome',["metas"=>$metas['scharff-club'],"ruta"=>'scharffclub']);
})->where( 'path', '([A-z\d-\/_.]+)?' );

Route::get('/ScharffClub', function () use ($metas) {
    return view('home.welcome',["metas"=>$metas['scharff-club'],"ruta"=>'scharffclub']);
})->where( 'path', '([A-z\d-\/_.]+)?' );

Route::get('/carga-domestica', function () use ($metas) {
    return view('home.welcome',["metas"=>$metas['domestica'],"ruta"=>'cargadomestica']);
})->where( 'path', '([A-z\d-\/_.]+)?' );

Route::get('/aduanas', function () use ($metas) {
    return view('home.welcome',["metas"=>$metas['aduanas'],"ruta"=>'aduanas']);
})->where( 'path', '([A-z\d-\/_.]+)?' );

Route::get('/almacen', function () use ($metas) {
    return view('home.welcome',["metas"=>$metas['almacenes'],"ruta"=>'almacen']);
})->where( 'path', '([A-z\d-\/_.]+)?' );

Route::get('/carga-internacional', function () use ($metas) {
    return view('home.welcome',["metas"=>$metas['carga'],"ruta"=>'cargainternacional']);
})->where( 'path', '([A-z\d-\/_.]+)?' );

Route::get('/distribucion', function () use ($metas) {
    return view('home.welcome',["metas"=>$metas['distribucion'],"ruta"=>'distribucion']);
})->where( 'path', '([A-z\d-\/_.]+)?' );

Route::get('/envio-regular', function () use ($metas) {
    return view('home.welcome',["metas"=>$metas['distribucion'],"ruta"=>'envio-regular']);
})->where( 'path', '([A-z\d-\/_.]+)?' );

Route::get('/empresa', function () use ($metas) {
    return view('home.welcome',["metas"=>$metas['empresa'],"ruta"=>'empresa']);
})->where( 'path', '([A-z\d-\/_.]+)?' );

Route::get('/para-ti', function () use ($metas) {
    return view('home.welcome',["metas"=>$metas['para-ti'],"ruta"=>'para-ti']);
})->where( 'path', '([A-z\d-\/_.]+)?' );

Route::get('/lab', function () use ($metas) {
    return view('home.welcome',["metas"=>$metas['lab'],"ruta"=>'lab']);
})->where( 'path', '([A-z\d-\/_.]+)?' );


Route::get('/unirse-scharffer', function () use ($metas) {
    return view('home.welcome',["metas"=>$metas['unirse-scharffer']]);
})->where( 'path', '([A-z\d-\/_.]+)?' );

Route::get('/terminos-y-condiciones', function () use ($metas) {
    return view('home.welcome',["metas"=>$metas['terminos-y-condiciones'],"ruta"=>'terminos']);
})->where( 'path', '([A-z\d-\/_.]+)?' );

Route::get('/preguntas-frecuentes', function () use ($metas) {
    return view('home.welcome',["metas"=>$metas['preguntas-frecuentes'],"ruta"=>'faq']);
})->where( 'path', '([A-z\d-\/_.]+)?' );

Route::get('/registro', function () use ($metas) {
    return view('home.welcome',["metas"=>$metas['registro']]);
})->where( 'path', '([A-z\d-\/_.]+)?' );


Route::get('/go-buy', function () use ($metas) {
    return view('home.welcome',["metas"=>$metas['home'],"ruta"=>'go-buy']);
})->where( 'path', '([A-z\d-\/_.]+)?' );


Route::get('wordpress', function () {
    return redirect('/');
});


// Rutas microservicios para VUEjs
Route::prefix('api')->group( function() {
    Route::post('reset', 'Admin\OpcionesController@reset');//add
    Route::post('active', 'Admin\BannerController@active');//add
    Route::post('change-status', 'Admin\GobuyPedidoController@change_status');//add
    Route::post('save-consolidado', 'Admin\ConsolidadoController@save');//add
    Route::post('update-consolidado', 'Admin\GobuyPedidoController@update_consolidado');//add
    Route::post('change-status-byconsolidado', 'Admin\GobuyPedidoController@change_status_byconsolidado');//add
    Route::post('costo-real', 'Admin\GobuyPedidoController@get_costo_real');//add
    Route::resource('contacts', 'ContactsController');
    Route::resource('motivos', 'MotivosContactoController');




    Route::post('login', 'Auth\LoginController@login_vue');
    Route::post('register', 'Auth\RegisterController@create');
    Route::post('coordinar-userids', 'Auth\RegisterController@CoordinarUserids');
    Route::post('resetear', 'Auth\RegisterController@resetear');
    Route::post('cambiar_datos', 'Admin\AdminController@cambiar_datos');
    Route::post('reseteard', 'Auth\RegisterController@resetearDirecto');
    Route::post('resetear-no-usar', 'Auth\RegisterController@resetearNoUsar');
    Route::post('facebooklogin', 'Auth\LoginController@facebooklogin');
    Route::group(['prefix' => 'reserva'],function() {
        Route::get('/user/{user_id?}', 'Service\ReservaLockerController@userReservas');
        //Route::get('/order/{column?}/{order?}', ['as' => 'adm.reserva.order', 'uses' => 'Service\ReservaLockerController@index']);
        Route::post('/create', 'Service\ReservaLockerController@create');
        //Route::get('/view/{id}', ['as' => 'adm.reserva.view', 'uses' => 'Service\ReservaLockerController@view']);
    });


    Route::group(['prefix' => 'log'],function() {
        //Route::get('/user/{user_id?}', 'Service\LogTransactionController@userReservas');

        //Route::get('/order/{column?}/{order?}', ['as' => 'adm.reserva.order', 'uses' => 'Service\ReservaLockerController@index']);
        Route::post('/create', 'Service\LogTransactionController@create');
        //Route::get('/view/{id}', ['as' => 'adm.reserva.view', 'uses' => 'Service\ReservaLockerController@view']);
    });

    Route::group(['prefix' => 'faq'],function() {
        Route::get('/index', 'Admin\FaqsController@apiIndex');
    });


    Route::group(['prefix' => 'postulante'],function() {
        //Route::get('/user/{user_id?}', 'Service\PostulantesController@userReservas');
        //Route::get('/order/{column?}/{order?}', ['as' => 'adm.reserva.order', 'uses' => 'Service\ReservaLockerController@index']);
        Route::post('/create', 'PostulantesController@create');
        //Route::get('/view/{id}', ['as' => 'adm.reserva.view', 'uses' => 'Service\ReservaLockerController@view']);
    });



    Route::group(['prefix' => 'locker'],function() {


        //servicio
        ////Route::get('/lista', 'Service\LockerController@apiLockers');

        //servicio
        //Route::post('/agregar', 'Service\LockerController@apiLockerCreate');


        //servicio
        ////Route::get('/tarifa', 'Service\LockerController@apiLockerTarifa');


        //api-vue
        Route::get('/user/{user_id?}', 'Service\LockerController@userLockers');


        //api-vue
        //Route::post('/create', 'Service\LockerController@create');

    });


    Route::post('/actualizar-user-datos', 'Service\ConfiguracionController@usuario_actualizar_parciales');

});


Route::prefix('ajax')->group( function() {
    Route::post('login', 'Auth\LoginController@login_vue');
    Route::get('departamentos', 'Service\UbigeoController@get_department');
    Route::get('provincias/{departamento_id}', 'Service\UbigeoController@get_province');
    Route::get('distritos/{provincia_id}', 'Service\UbigeoController@get_district');
    Route::get('/obtener-reclamo', 'Service\ClaimbookController@get_numero');
    Route::post('/registro-reclamo', 'Service\ClaimbookController@save_reclamo');
    Route::get('/home-config', 'Service\ConfiguracionController@home_config');
    Route::get('/admin-config', 'Service\ConfiguracionController@admin_config');
    Route::get('/terminos', 'Service\ConfiguracionController@getTerminos');
    Route::get('/terminosb', 'Service\ConfiguracionController@getTerminosb');
    Route::get('/distancia-map', 'Service\ConfiguracionController@distanciaMap');
    Route::get('/banner-config/{slug}', 'Service\ConfiguracionController@banner_config');

    Route::post('/registro-constancia', 'Admin\GobuyPedidoController@save_gobuypedido');
    Route::post('/get-info-gobuy', 'Admin\GobuyPedidoController@get_info_gobuy');//add
    Route::get('/list-alert-gobuy', 'Admin\GobuyAlertaController@list_alert_gobuy');
});

Route::get('api/userinfo', ['as' => 'adm.userinfo', 'uses' => 'Admin\AdminController@getUserInfo']);

Route::get('/pruebaya', function(){
  echo "funcionaaaaa";
  return "Holaaa";
});

// Rutas de panel superadmin
Route::group(['middleware' => 'auth'],function(){


    Route::group(['prefix' => 'superadmin', 'middleware' => ['superadmin','permiso-perfil']], function (){
        Route::get('/', ['as' => 'adm.index', 'uses' => 'Admin\DashboardController@index']);

        Route::group(['prefix' => 'dashboard'],function() {
            Route::get('/', ['as' => 'adm.dashboard.index', 'uses' => 'Admin\DashboardController@index']);
            Route::get('/listado-general', ['as' => 'adm.dashboard.general', 'uses' => 'Admin\DashboardController@listado_general']);
            Route::get('/listado-general/downloadsistemas', ['as' => 'adm.general.downloadsistemas', 'uses' => 'Admin\DashboardController@download_listadogeneral']);
            Route::get('/listado-general/download', ['as' => 'adm.general.download', 'uses' => 'Admin\DashboardController@download']);
            Route::get('/listado-general/order/{column?}/{order?}', ['as' => 'adm.general.order', 'uses' => 'Admin\DashboardController@listado_general']);
        });

        Route::group(['prefix' => 'admin'],function() {
            Route::get('/', ['as' => 'adm.admin.index', 'uses' => 'Admin\AdminController@index']);
            Route::get('/order/{column?}/{order?}', ['as' => 'adm.admin.order', 'uses' => 'Admin\AdminController@index']);
            Route::get('/nuevo', ['as' => 'adm.admin.new', 'uses' => 'Admin\AdminController@create']);
            Route::post('/nuevo', ['as' => 'adm.admin.new', 'uses' => 'Admin\AdminController@save']);
            Route::get('/edit/{id}', ['as' => 'adm.admin.edit', 'uses' => 'Admin\AdminController@edit']);
            Route::post('/edit/{id}', ['as' => 'adm.admin.update', 'uses' => 'Admin\AdminController@update']);
            Route::get('/download', ['as' => 'adm.admin.download', 'uses' => 'Admin\AdminController@download']);
        });

        Route::group(['prefix' => 'perfil'],function() {
            Route::get('/', ['as' => 'adm.perfil.index', 'uses' => 'Admin\PerfilController@index']);
            Route::get('/order/{column?}/{order?}', ['as' => 'adm.perfil.order', 'uses' => 'Admin\PerfilController@index']);
            Route::get('/nuevo', ['as' => 'adm.perfil.new', 'uses' => 'Admin\PerfilController@create']);
            Route::post('/nuevo', ['as' => 'adm.perfil.new', 'uses' => 'Admin\PerfilController@save']);

            Route::get('/edit/{id}', ['as' => 'adm.perfil.edit', 'uses' => 'Admin\PerfilController@edit']);
            Route::post('/edit/{id}', ['as' => 'adm.perfil.update', 'uses' => 'Admin\PerfilController@update']);
            Route::get('/download', ['as' => 'adm.perfil.download', 'uses' => 'Admin\PerfilController@download']);
        });

        Route::group(['prefix' => 'contacto'],function() {
            Route::get('/', ['as' => 'adm.contacto.index', 'uses' => 'Admin\ContactController@index']);
            Route::get('/order/{column?}/{order?}', ['as' => 'adm.contacto.order', 'uses' => 'Admin\ContactController@index']);
            Route::get('/edit/{id}', ['as' => 'adm.contacto.edit', 'uses' => 'Admin\ContactController@edit']);
            Route::get('/view/{id}', ['as' => 'adm.contacto.view', 'uses' => 'Admin\ContactController@view']);
            Route::get('/download', ['as' => 'adm.contacto.download', 'uses' => 'Admin\ContactController@download']);
        });

        Route::group(['prefix' => 'opciones'],function() {
          Route::get('/', ['as' => 'adm.opciones.index', 'uses' => 'Admin\OpcionesController@index']);
          Route::get('/order/{column?}/{order?}', ['as' => 'adm.opciones.order', 'uses' => 'Admin\OpcionesController@index']);
          Route::get('/edit/{id}', ['as' => 'adm.opciones.edit', 'uses' => 'Admin\OpcionesController@edit']);

          Route::get('/nuevo', ['as' => 'adm.opciones.new', 'uses' => 'Admin\OpcionesController@create']);
          Route::post('/nuevo', ['as' => 'adm.opciones.new', 'uses' => 'Admin\OpcionesController@save']);
          Route::get('/editar/{id}', ['as' => 'adm.opciones.edit', 'uses' => 'Admin\OpcionesController@edit']);
          Route::get('/editar_b/{id}', ['as' => 'adm.opciones.editGeneral', 'uses' => 'Admin\OpcionesController@editGeneral']);

          Route::post('/editar/{id}', ['as' => 'adm.opciones.update', 'uses' => 'Admin\OpcionesController@update']);
          Route::post('/editar_b/{id}', ['as' => 'adm.opciones.updateGeneral', 'uses' => 'Admin\OpcionesController@updateGeneral']);

          Route::get('/codigopedido', ['as' => 'adm.codigopedido.index', 'uses' => 'Admin\OpcionesController@codigoPedidosIndex']);

        });

        Route::group(['prefix' => 'banner'],function() {
            Route::get('/', ['as' => 'adm.banner.index', 'uses' => 'Admin\BannerController@index']);
            Route::get('/order/{column?}/{order?}', ['as' => 'adm.banner.order', 'uses' => 'Admin\BannerController@index']);
            Route::get('/nuevo', ['as' => 'adm.banner.new', 'uses' => 'Admin\BannerController@create']);
            Route::post('/nuevo', ['as' => 'adm.banner.new', 'uses' => 'Admin\BannerController@save']);
            Route::get('/editar/{id}', ['as' => 'adm.banner.edit', 'uses' => 'Admin\BannerController@edit']);
            Route::post('/editar/{id}', ['as' => 'adm.banner.update', 'uses' => 'Admin\BannerController@update']);
        });

        Route::group(['prefix' => 'servicio'],function() {
            Route::get('/', ['as' => 'adm.servicio.index', 'uses' => 'Admin\ServicioController@index']);
            Route::get('/order/{column?}/{order?}', ['as' => 'adm.servicio.order', 'uses' => 'Admin\ServicioController@index']);
            Route::get('/nuevo', ['as' => 'adm.servicio.new', 'uses' => 'Admin\ServicioController@create']);
            Route::post('/nuevo', ['as' => 'adm.servicio.new', 'uses' => 'Admin\ServicioController@save']);
            Route::get('/editar/{id}', ['as' => 'adm.servicio.edit', 'uses' => 'Admin\ServicioController@edit']);
            Route::post('/editar/{id}', ['as' => 'adm.servicio.update', 'uses' => 'Admin\ServicioController@update']);
        });

        Route::group(['prefix' => 'sucursal'],function() {
            Route::get('/', ['as' => 'adm.sucursal.index', 'uses' => 'Admin\SucursalController@index']);
            Route::get('/order/{column?}/{order?}', ['as' => 'adm.sucursal.order', 'uses' => 'Admin\SucursalController@index']);
            Route::get('/nuevo', ['as' => 'adm.sucursal.new', 'uses' => 'Admin\SucursalController@create']);
            Route::post('/nuevo', ['as' => 'adm.sucursal.new', 'uses' => 'Admin\SucursalController@save']);
            Route::get('/editar/{id}', ['as' => 'adm.sucursal.edit', 'uses' => 'Admin\SucursalController@edit']);
            Route::post('/editar/{id}', ['as' => 'adm.sucursal.update', 'uses' => 'Admin\SucursalController@update']);
        });

        Route::group(['prefix' => 'config-texto'],function() {
            Route::get('/', ['as' => 'adm.configtext.index', 'uses' => 'Admin\ConfiguradorTextosController@index']);
            Route::get('/order/{column?}/{order?}', ['as' => 'adm.configtext.order', 'uses' => 'Admin\ConfiguradorTextosController@index']);
            Route::get('/editar/{id}', ['as' => 'adm.configtext.edit', 'uses' => 'Admin\ConfiguradorTextosController@edit']);
            Route::post('/editar/{id}', ['as' => 'adm.configtext.update', 'uses' => 'Admin\ConfiguradorTextosController@update']);
        });

        Route::group(['prefix' => 'config-link'],function() {
            Route::get('/', ['as' => 'adm.configlink.index', 'uses' => 'Admin\ConfiguradorLinksController@index']);
            Route::get('/order/{column?}/{order?}', ['as' => 'adm.configlink.order', 'uses' => 'Admin\ConfiguradorLinksController@index']);
            Route::get('/editar/{id}', ['as' => 'adm.configlink.edit', 'uses' => 'Admin\ConfiguradorLinksController@edit']);
            Route::post('/editar/{id}', ['as' => 'adm.configlink.update', 'uses' => 'Admin\ConfiguradorLinksController@update']);
        });


        Route::group(['prefix' => 'referencia'],function() {
            Route::get('/', ['as' => 'adm.referencia.index', 'uses' => 'Service\ReferenciaController@index']);
            Route::get('/order/{column?}/{order?}', ['as' => 'adm.referencia.order', 'uses' => 'Service\ReferenciaController@index']);
            Route::get('/editar/{id}', ['as' => 'adm.referencia.edit', 'uses' => 'Service\ReferenciaController@edit']);
            Route::post('/editar/{id}', ['as' => 'adm.referencia.update', 'uses' => 'Service\ReferenciaController@update']);
            Route::get('/nuevo', ['as' => 'adm.referencia.new', 'uses' => 'Service\ReferenciaController@create']);
            Route::post('/nuevo', ['as' => 'adm.referencia.new', 'uses' => 'Service\ReferenciaController@save']);
            Route::get('/delete/{id}', ['as' => 'adm.referencia.delete', 'uses' => 'Service\ReferenciaController@delete']);
        });

        Route::group(['prefix' => 'reclamo'],function() {
            Route::get('/', ['as' => 'adm.claimbook.index', 'uses' => 'Admin\ClaimbookController@index']);
            Route::get('/order/{column?}/{order?}', ['as' => 'adm.claimbook.order', 'uses' => 'Admin\ClaimbookController@index']);
            Route::get('/download', ['as' => 'adm.claimbook.download', 'uses' => 'Admin\ClaimbookController@download']);
            Route::get('/edit/{id}', ['as' => 'adm.claimbook.edit', 'uses' => 'Admin\ClaimbookController@edit']);
            Route::get('/view/{id}', ['as' => 'adm.claimbook.view', 'uses' => 'Admin\ClaimbookController@view']);

        });

        Route::group(['prefix' => 'motivo'],function() {
            Route::get('/', ['as' => 'adm.motivo.index', 'uses' => 'Admin\MotivoContactoController@index']);
            Route::get('/order/{column?}/{order?}', ['as' => 'adm.motivo.order', 'uses' => 'Admin\MotivoContactoController@index']);
            Route::get('/edit/{id}', ['as' => 'adm.motivo.edit', 'uses' => 'Admin\MotivoContactoController@edit']);

            Route::get('/nuevo', ['as' => 'adm.motivo.new', 'uses' => 'Admin\MotivoContactoController@create']);
            Route::post('/nuevo', ['as' => 'adm.motivo.new', 'uses' => 'Admin\MotivoContactoController@save']);
            Route::get('/editar/{id}', ['as' => 'adm.motivo.edit', 'uses' => 'Admin\MotivoContactoController@edit']);
            Route::post('/editar/{id}', ['as' => 'adm.motivo.update', 'uses' => 'Admin\MotivoContactoController@update']);
        });
        //
        // Route::group(['prefix' => 'preferencia'],function() {
        //     Route::get('/', ['as' => 'adm.preferencia.index', 'uses' => 'Admin\PreferenciaController@index']);
        //     Route::get('/order/{column?}/{order?}', ['as' => 'adm.preferencia.order', 'uses' => 'Admin\PreferenciaController@index']);
        //     Route::get('/edit/{id}', ['as' => 'adm.preferencia.edit', 'uses' => 'Admin\PreferenciaController@edit']);
        //
        //     Route::get('/nuevo', ['as' => 'adm.preferencia.new', 'uses' => 'Admin\PreferenciaController@create']);
        //     Route::post('/nuevo', ['as' => 'adm.preferencia.new', 'uses' => 'Admin\PreferenciaController@save']);
        //     Route::get('/editar/{id}', ['as' => 'adm.preferencia.edit', 'uses' => 'Admin\PreferenciaController@edit']);
        //     Route::post('/editar/{id}', ['as' => 'adm.preferencia.update', 'uses' => 'Admin\PreferenciaController@update']);
        //
        //
        //
        //
        //
        // });



        Route::group(['prefix' => 'reserva'],function() {
            Route::get('/', ['as' => 'adm.reserva.index', 'uses' => 'Service\ReservaLockerController@admindex']);
            Route::get('/order/{column?}/{order?}', ['as' => 'adm.reserva.order', 'uses' => 'Service\ReservaLockerController@admindex']);
            //Route::get('/edit/{id}', ['as' => 'adm.reserva.edit', 'uses' => 'Service\ReservaLockerController@edit']);
            Route::get('/view/{id}', ['as' => 'adm.reserva.view', 'uses' => 'Service\ReservaLockerController@admview']);
            Route::post('/view/{id}', ['as' => 'adm.reserva.view_update', 'uses' => 'Service\ReservaLockerController@admview_update']);

            Route::get('/download/{column?}/{order?}', ['as' => 'adm.reserva.download', 'uses' => 'Service\ReservaLockerController@download']);//Data
            Route::get('/downloadsistemas/{column?}/{order?}', ['as' => 'adm.reserva.downloadsistemas', 'uses' => 'Service\ReservaLockerController@downloadsistemas']);//Data sistemas
            Route::get('/downloadcorporativo/{column?}/{order?}', ['as' => 'adm.reserva.downloadcorporativo', 'uses' => 'Service\ReservaLockerController@downloadcorporativo']);//Data corporativo
            Route::get('/download-plantilla', ['as' => 'adm.reserva.download-plantilla', 'uses' => 'Service\ReservaLockerController@download_plantilla']);
            Route::post('/upload-reserva', ['as' => 'adm.reserva.upload-plantilla', 'uses' => 'Service\ReservaLockerController@upload_plantilla']);

        });

        Route::group(['prefix' => 'pedido'],function() {
            Route::get('/', ['as' => 'adm.pedido.index', 'uses' => 'Service\PedidoExpressController@admindex']);
            Route::get('/order/{column?}/{order?}', ['as' => 'adm.pedido.order', 'uses' => 'Service\PedidoExpressController@admindex']);
            //Route::get('/edit/{id}', ['as' => 'adm.pedido.edit', 'uses' => 'Service\PedidoExpressController@edit']);
            Route::get('/view/{id}', ['as' => 'adm.pedido.view', 'uses' => 'Service\PedidoExpressController@admview']);
            //Route::post('/view/{id}', ['as' => 'adm.pedido.view_update', 'uses' => 'Service\PedidoExpressController@admview_update']);

            Route::get('/download/{column?}/{order?}', ['as' => 'adm.pedido.download', 'uses' => 'Service\PedidoExpressController@download']);
            Route::get('/downloaddata/{column?}/{order?}', ['as' => 'adm.pedido.downloaddata', 'uses' => 'Service\PedidoExpressController@downloaddata']);
            //Route::get('/download-plantilla', ['as' => 'adm.pedido.download-plantilla', 'uses' => 'Service\PedidoExpressController@download_plantilla']);
            //Route::post('/upload-pedido', ['as' => 'adm.pedido.upload-plantilla', 'uses' => 'Service\PedidoExpressController@upload_plantilla']);

        });


        Route::group(['prefix' => 'regular'],function() {
            Route::get('/', ['as' => 'adm.regular.index', 'uses' => 'Service\EnvioRegularController@admindex']);
            Route::get('/order/{column?}/{order?}', ['as' => 'adm.regular.order', 'uses' => 'Service\EnvioRegularController@admindex']);
            //Route::get('/edit/{id}', ['as' => 'adm.regular.edit', 'uses' => 'Service\EnvioRegularController@edit']);
            Route::get('/view/{id}', ['as' => 'adm.regular.view', 'uses' => 'Service\EnvioRegularController@admview']);
            Route::post('/view/{id}', ['as' => 'adm.regular.view_update', 'uses' => 'Service\EnvioRegularController@admview_update']);

            Route::get('/downloadsistemas/{column?}/{order?}', ['as' => 'adm.regular.downloadsistemas', 'uses' => 'Service\EnvioRegularController@downloadsistemas']);
            Route::get('/download/{column?}/{order?}', ['as' => 'adm.regular.download', 'uses' => 'Service\EnvioRegularController@download']);
            Route::get('/download-plantilla', ['as' => 'adm.regular.download-ubigeos', 'uses' => 'Service\EnvioRegularController@download_ubigeos']);
            Route::post('/upload-regular', ['as' => 'adm.regular.upload-ubigeos', 'uses' => 'Service\EnvioRegularController@upload_ubigeos']);




            //Route::get('/pedido/order/{column?}/{order?}', ['as' => 'adm.regular.pedido_order', 'uses' => 'Service\EnvioRegularController@admview_pedido']);
        });


        Route::group(['prefix' => 'locker'],function() {
            Route::get('/', ['as' => 'adm.locker.index', 'uses' => 'Service\LockerController@index']);
            Route::get('/order/{column?}/{order?}', ['as' => 'adm.locker.order', 'uses' => 'Service\LockerController@index']);
            //Route::get('/edit/{id}', ['as' => 'adm.reserva.edit', 'uses' => 'Service\ReservaLockerController@edit']);
            Route::get('/nuevo', ['as' => 'adm.locker.new', 'uses' => 'Service\LockerController@create']);
            Route::post('/nuevo', ['as' => 'adm.locker.new', 'uses' => 'Service\LockerController@save']);

            Route::get('/editar/{id}', ['as' => 'adm.locker.edit', 'uses' => 'Service\LockerController@edit']);
            Route::post('/editar/{id}', ['as' => 'adm.locker.update', 'uses' => 'Service\LockerController@update']);
        });







        Route::group(['prefix' => 'postulante'],function() {
            Route::get('/', ['as' => 'adm.postulante.index', 'uses' => 'PostulantesController@admindex']);
            Route::get('/order/{column?}/{order?}', ['as' => 'adm.postulante.order', 'uses' => 'PostulantesController@admindex']);
            //Route::get('/edit/{id}', ['as' => 'adm.postulante.edit', 'uses' => 'PostulantesController@edit']);
            Route::get('/view/{id}', ['as' => 'adm.postulante.view', 'uses' => 'PostulantesController@admview']);
            Route::post('/view/{id}', ['as' => 'adm.postulante.view_update', 'uses' => 'PostulantesController@admview_update']);

            Route::get('/download-data-system/{column?}/{order?}', ['as' => 'adm.postulante.download-data-system', 'uses' => 'PostulantesController@download_data_system']);
            Route::get('/download/{column?}/{order?}', ['as' => 'adm.postulante.download', 'uses' => 'PostulantesController@download']);//add
            Route::get('/download-plantilla', ['as' => 'adm.postulante.download-plantilla', 'uses' => 'PostulantesController@download_plantilla']);
            Route::post('/upload-postulante', ['as' => 'adm.postulante.upload-plantilla', 'uses' => 'PostulantesController@upload_plantilla']);
        });


        Route::group(['prefix' => 'log'],function() {
          Route::post('/create', 'Service\LogTransactionController@create');


            Route::get('/', ['as' => 'adm.log.index', 'uses' => 'Service\LogTransactionController@admindex']);
            Route::get('/order/{column?}/{order?}', ['as' => 'adm.log.order', 'uses' => 'Service\LogTransactionController@admindex']);
            //Route::get('/edit/{id}', ['as' => 'adm.log.edit', 'uses' => 'Service\LogTransactionController@edit']);
            Route::get('/view/{id}', ['as' => 'adm.log.view', 'uses' => 'Service\LogTransactionController@admview']);
            Route::post('/view/{id}', ['as' => 'adm.log.view_update', 'uses' => 'Service\LogTransactionController@admview_update']);

            Route::get('/download/{column?}/{order?}', ['as' => 'adm.log.download', 'uses' => 'Service\LogTransactionController@download']);
            Route::get('/download-plantilla', ['as' => 'adm.log.download-plantilla', 'uses' => 'Service\LogTransactionController@download_plantilla']);
            Route::post('/upload-log', ['as' => 'adm.log.upload-plantilla', 'uses' => 'Service\LogTransactionController@upload_plantilla']);
        });

        Route::group(['prefix' => 'faq'],function() {
          Route::post('/create', 'Admin\FaqsController@create');
            Route::get('/', ['as' => 'adm.faq.index', 'uses' => 'Admin\FaqsController@index']);
            Route::get('/order/{column?}/{order?}', ['as' => 'adm.faq.order', 'uses' => 'Admin\FaqsController@index']);

            Route::get('/nuevo', ['as' => 'adm.faq.new', 'uses' => 'Admin\FaqsController@create']);
            Route::post('/nuevo', ['as' => 'adm.faq.new', 'uses' => 'Admin\FaqsController@save']);

            Route::get('/editar/{id}', ['as' => 'adm.faq.edit', 'uses' => 'Admin\FaqsController@edit']);
            Route::post('/editar/{id}', ['as' => 'adm.faq.update', 'uses' => 'Admin\FaqsController@update']);

            Route::get('/view/{id}', ['as' => 'adm.faq.view', 'uses' => 'Admin\FaqsController@view']);
            Route::post('/view/{id}', ['as' => 'adm.faq.view_update', 'uses' => 'Admin\FaqsController@view_update']);

        });



        Route::group(['prefix' => 'user'],function() {
          Route::post('/create', 'Admin\FaqsController@create');
            Route::get('/', ['as' => 'adm.user.index', 'uses' => 'Admin\UserController@index']);
            Route::get('/order/{column?}/{order?}', ['as' => 'adm.user.order', 'uses' => 'Admin\UserController@index']);

            Route::get('/nuevo', ['as' => 'adm.user.new', 'uses' => 'Admin\UserController@create']);
            Route::post('/nuevo', ['as' => 'adm.user.new', 'uses' => 'Admin\UserController@save']);

            Route::get('/editar/{id}', ['as' => 'adm.user.edit', 'uses' => 'Admin\UserController@edit']);
            Route::post('/editar/{id}', ['as' => 'adm.user.update', 'uses' => 'Admin\UserController@update']);

            Route::get('/view/{id}', ['as' => 'adm.user.view', 'uses' => 'Admin\UserController@view']);
            Route::post('/view/{id}', ['as' => 'adm.user.view_update', 'uses' => 'Admin\UserController@view_update']);


            Route::get('/download/{column?}/{order?}', ['as' => 'adm.user.download', 'uses' => 'Admin\UserController@download']);

            Route::get('/download_data/{column?}/{order?}', ['as' => 'adm.user.download_data', 'uses' => 'Admin\UserController@download_data']);


            Route::get('/index_b', ['as' => 'adm.user.index_b', 'uses' => 'Admin\UserController@index_b']);

            Route::get('/view_b/{id}', ['as' => 'adm.user.view_b', 'uses' => 'Admin\UserController@view_b']);
            Route::post('/view_b/{id}', ['as' => 'adm.user.view_update_b', 'uses' => 'Admin\UserController@view_update_b']);

        });





        Route::group(['prefix' => 'promocion'],function() {
          Route::post('/create', 'Admin\PromocionController@create');
            Route::get('/', ['as' => 'adm.promocion.index', 'uses' => 'Admin\PromocionController@index']);
            Route::get('/order/{column?}/{order?}', ['as' => 'adm.promocion.order', 'uses' => 'Admin\PromocionController@index']);

            Route::get('/nuevo', ['as' => 'adm.promocion.new', 'uses' => 'Admin\PromocionController@create']);
            Route::post('/nuevo', ['as' => 'adm.promocion.new', 'uses' => 'Admin\PromocionController@save']);

            Route::get('/editar/{id}', ['as' => 'adm.promocion.edit', 'uses' => 'Admin\PromocionController@edit']);
            Route::post('/editar/{id}', ['as' => 'adm.promocion.update', 'uses' => 'Admin\PromocionController@update']);

            Route::get('/view/{id}', ['as' => 'adm.promocion.view', 'uses' => 'Admin\PromocionController@view']);
            Route::post('/view/{id}', ['as' => 'adm.promocion.view_update', 'uses' => 'Admin\PromocionController@view_update']);


            Route::get('/delete/{id}', ['as' => 'adm.promocion.delete', 'uses' => 'Admin\PromocionController@delete']);

        });



        Route::group(['prefix' => 'cupon'],function() {
          Route::post('/create', 'Admin\CuponController@create');
            Route::get('/', ['as' => 'adm.cupon.index', 'uses' => 'Admin\CuponController@index']);
            Route::get('/order/{column?}/{order?}', ['as' => 'adm.cupon.order', 'uses' => 'Admin\CuponController@index']);

            Route::get('/nuevo', ['as' => 'adm.cupon.new', 'uses' => 'Admin\CuponController@create']);
            Route::post('/nuevo', ['as' => 'adm.cupon.new', 'uses' => 'Admin\CuponController@save']);

            Route::get('/editar/{id}', ['as' => 'adm.cupon.edit', 'uses' => 'Admin\CuponController@edit']);
            Route::post('/editar/{id}', ['as' => 'adm.cupon.update', 'uses' => 'Admin\CuponController@update']);

            Route::get('/view/{id}', ['as' => 'adm.cupon.view', 'uses' => 'Admin\CuponController@view']);
            Route::post('/view/{id}', ['as' => 'adm.cupon.view_update', 'uses' => 'Admin\CuponController@view_update']);
            Route::get('/delete/{id}', ['as' => 'adm.cupon.delete', 'uses' => 'Admin\CuponController@delete']);
        });

        Route::group(['prefix' => 'gobuypedido'],function() {
          Route::post('/create', 'Admin\GobuyPedidoController@create');
            Route::get('/', ['as' => 'adm.gobuypedido.index', 'uses' => 'Admin\GobuyPedidoController@index']);
            Route::get('/tipo/{type?}', ['as' => 'adm.gobuypedido.type', 'uses' => 'Admin\GobuyPedidoController@index1']);////
            Route::get('/tipo/{type?}/consolidado', ['as' => 'adm.gobuypedido.type_cons', 'uses' => 'Admin\GobuyPedidoController@list_consolidado']);////

            Route::get('/order/{column?}/{order?}', ['as' => 'adm.gobuypedido.order', 'uses' => 'Admin\GobuyPedidoController@index']);

            Route::get('/nuevo', ['as' => 'adm.gobuypedido.new', 'uses' => 'Admin\GobuyPedidoController@create']);
            Route::post('/nuevo', ['as' => 'adm.gobuypedido.new', 'uses' => 'Admin\GobuyPedidoController@save']);

            Route::get('/editar/{id}', ['as' => 'adm.gobuypedido.edit', 'uses' => 'Admin\GobuyPedidoController@edit']);
            Route::post('/editar/{id}', ['as' => 'adm.gobuypedido.update', 'uses' => 'Admin\GobuyPedidoController@update']);

            Route::get('/view/{id}', ['as' => 'adm.gobuypedido.view', 'uses' => 'Admin\GobuyPedidoController@view']);
            Route::post('/view/{id}', ['as' => 'adm.gobuypedido.view_update', 'uses' => 'Admin\GobuyPedidoController@view_update']);
            Route::get('/delete/{id}', ['as' => 'adm.gobuypedido.delete', 'uses' => 'Admin\GobuyPedidoController@delete']);
        });
        Route::group(['prefix' => 'gobuyalerta'],function() {
            Route::get('/', ['as' => 'adm.gobuyalerta.index', 'uses' => 'Admin\GobuyAlertaController@index']);
            Route::get('/order/{column?}/{order?}', ['as' => 'adm.motivo.order', 'uses' => 'Admin\GobuyAlertaController@index']);
            Route::get('/edit/{id}', ['as' => 'adm.gobuyalerta.edit', 'uses' => 'Admin\GobuyAlertaController@edit']);
            Route::post('/edit/{id}', ['as' => 'adm.gobuyalerta.update', 'uses' => 'Admin\GobuyAlertaController@update']);
            Route::get('/nuevo', ['as' => 'adm.gobuyalerta.new', 'uses' => 'Admin\GobuyAlertaController@create']);
            Route::post('/nuevo', ['as' => 'adm.gobuyalerta.new', 'uses' => 'Admin\GobuyAlertaController@save']);
        });

    });

    Route::group(['prefix' => 'admin', 'middleware' => 'admin'], function (){
        Route::get('/', function ()  {
            return view('home.welcome');
        })->where( 'path', '([A-z\d-\/_.]+)?' )->name('ad.index');
    });

    Route::group(['prefix' => 'admin/reservar-locker', 'middleware' => 'admin'], function (){
        Route::get('/', function () {
            return view('home.welcome');
        })->where( 'path', '([A-z\d-\/_.]+)?' );
    });

    Route::group(['prefix' => 'admin/enviar-paquete', 'middleware' => 'admin'], function (){
        Route::get('/', function () {
            return view('home.welcome');
        })->where( 'path', '([A-z\d-\/_.]+)?' );
    });



    Route::group(['prefix' => 'admin/envio-regular', 'middleware' => 'admin'], function (){
        Route::get('/', function () {
            return view('home.welcome');
        })->where( 'path', '([A-z\d-\/_.]+)?' );
    });


    Route::group(['prefix' => 'admin/go-buy/{panel?}/{item_id?}', 'middleware' => 'admin'], function (){
        Route::get('/', function () {
            return view('home.welcome');
        })->where( 'path', '([A-z\d-\/_.]+)?' );
    });






    Route::group(['prefix' => 'example'], function () {

        Route::post('/delete', ['as' => 'example.delete', 'uses' => 'ExampleController@destroy']);
    });





});




Route::group(['prefix' => 'admin/historial/{panel?}/{item_id?}'], function (){
    Route::get('/', function () {
        return view('home.welcome');
    })->where( 'path', '([A-z\d-\/_.]+)?' );
});
