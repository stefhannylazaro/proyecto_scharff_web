<?php

use Illuminate\Database\Seeder;

class BannersTableSeederV2 extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
     public function run()
     {
       $campos = "'home', 'distribucion_nacional', 'aduanas', 'carga', 'almacenes', 'envios_internacionales', 'scharff_express', 'scharff_stop', 'cotizador', 'scharff_lab','empresa', 'domestica', 'paraTi','gobuy','envio-regular'";

       DB::statement("ALTER TABLE banners CHANGE COLUMN slug slug ENUM(".$campos.") DEFAULT 'home'") ;
       DB::table('banners')->delete();
       DB::table('banners')->insert(
           [
             [
                 'id' => '1',
                 'titulo' => '<p class="send mb-1 white--text d-align-center">
                 <img class="mr-2" src="/images/iconos/untitled-1.png" :alt="circleOne.alt">
                 envía.
               </p>
               <p class="send mb-1 white--text d-align-center">
                 <img class="mr-2" src="/images/iconos/untitled-2.png" :alt="circleTwo.alt">
                 recibe.
               </p>
               <p class="send mb-1 white--text d-align-center">
                 <img class="mr-2" src="/images/iconos/untitled-3.png" :alt="circleThree.alt">
                 acerca.
               </p>',
                 'subtitulo' => 'Más de 30 años diseñando logística',
                 'url' => '#infoCompany',
                 'imagen' => 'banner-demo/intro_media.jpg',
                 'slug' => 'home',
                 'atributos'=>'{"btn_text":"CONOCE &nbsp;<strong> MÁS</strong>","btn_style":"pink"}'
             ],[
                 'id' => '2',
                 'titulo' => 'Conecta tu negocio con el Perú y el Mundo',
                 'subtitulo' => 'Somos el partner logístico que tu empresa necesita',
                 'url' => 'empresa',
                 'imagen' => 'banner-demo/barco_media.jpg',
                 'slug' => 'home',
                 'atributos'=>'{"btn_text":"CONOCE &nbsp;<strong> MÁS</strong>","btn_style":"pink"}'
             ],[
                 'id' => '3',
                 'titulo' => 'Ahora enviar es  <br /> más sencillo',
                 'subtitulo' => 'Más de 30 años transformando la manera de hacer logística para ti.',
                 'url' => 'para-ti',
                 'imagen' => 'banner-demo/lockers_media.jpg',
                 'slug' => 'home',
                 'atributos'=>'{"btn_text":"RESERVA TU &nbsp;<strong> LOCKER</strong>","btn_style":"pink"}'
             ],





               //aduanas//
               [
                   'id' => '4',
                   'titulo' => '¡Que expandir tu empresa <br>no sea un problema!',
                   'subtitulo' => 'Más de 30 años de gestión y asesoría <br/> personalizada de comercio exterior.',
                   'url' => '#formGrow',
                   'imagen' => 'banner-demo/img_aduanas.png',
                   'slug' => 'aduanas',
                   'atributos'=>'{"btn_text":"&nbsp;&nbsp;&nbsp; COTIZA <strong>AQUÍ</strong> &nbsp;&nbsp;&nbsp;","btn_style":"pink"}'
               ],

               //almacenes*//
               [
                   'id' => '5',
                   'titulo' => '¡El espacio que tu <br>empresa necesita!',
                   'subtitulo' => 'Contamos con múltiples almacenes <br />  en todo Perú',
                   'url' => '#formGrow',
                   'imagen' => 'banner-demo/img_almacen.png',
                   'slug' => 'almacenes',
                   'atributos'=>'{"btn_text":"COTIZA <strong>AQUÍ</strong>","btn_style":"pink"}'
               ],




               //carga//
               [
                   'id' => '6',
                   'titulo' => '¡Que tu empresa <br>cruce fronteras!',
                   'subtitulo' => 'Llevamos tu carga a <br/> donde vaya tu negocio.',
                   'url' => '#formGrow',
                   'imagen' => 'banner-demo/img_servicio_carga.png',
                   'slug' => 'carga',
                   'atributos'=>'{"btn_text":"&nbsp;&nbsp;&nbsp; COTIZA <strong>AQUÍ</strong> &nbsp;&nbsp;&nbsp;","btn_style":"pink"}'
               ],



               //distribucion_nacional*//
               [
                   'id' => '7',
                   'titulo' => '¡Somos la conexión <br>que necesitas!',
                   'subtitulo' => 'Contamos con una amplia red<br/>a nivel urbano y nacional.',
                   'url' => '#formGrow',
                   'imagen' => 'banner-demo/img_servicio_distribucion.png',
                   'slug' => 'distribucion_nacional',
                   'atributos'=>'{"btn_text":"&nbsp;&nbsp;&nbsp; COTIZA <strong>AQUÍ</strong> &nbsp;&nbsp;&nbsp;","btn_style":"pink"}'
               ],





             ///domestica*//
             [
                 'id' => '8',
                 'titulo' => '¡El Perú te <br/>espera!',
                 'subtitulo' => 'Accede a nuestra red de <br/>transportistas a nivel nacional.',
                 'url' => '#formGrow',
                 'imagen' => 'banner-demo/img_domestica.png',
                 'slug' => 'domestica',
                 'atributos'=>'{"btn_text":"&nbsp;&nbsp;&nbsp; COTIZA <strong>AQUÍ</strong> &nbsp;&nbsp;&nbsp;","btn_style":"pink"}'
             ],



             ///empresa//
             [
                 'id' => '9',
                 'titulo' => 'El socio logístico que <br>tu negocio necesita',
                 'subtitulo' => '',
                 'url' => '#formGrow',
                 'imagen' => 'banner-demo/img_principal_empresa.png',
                 'slug' => 'empresa',
                 'atributos'=>'{"btn_text":"&nbsp; Conocer más &nbsp;","btn_style":"pink"}'
             ],


             //scharff_lab//
             [
                 'id' => '10',
                 'titulo' => 'Transformando la forma <br> de hacer logística',
                 'subtitulo' => 'Creamos el primer laboratorio de innovación <br> logística en el Perú.',
                 'url' => '#formGrow',
                 'imagen' => 'banner-demo/img_principallab.png',
                 'slug' => 'scharff_lab',
                 'atributos'=>'{"btn_text":"&nbsp; Conocer más &nbsp;","btn_style":"pink"}'
             ],



             ///para-ti//
             [
                 'id' => '11',
                 'titulo' => '¡Envía y recibe <br>sin complicaciones!',
                 'subtitulo' => 'Moviliza rápidamente tus paquetes con <br>nuestra red de delivery express.',
                 'url' => '#formGrow',
                 'imagen' => 'banner-demo/img_principalparaTi.png',
                 'slug' => 'paraTi',
                 'atributos'=>'{"btn_text":"&nbsp; SOLICITA UN <strong>ENVÍO</strong> &nbsp;","btn_style":"pink"}'
             ],


               //scharff_express* empresa//
               [
                   'id' => '12',
                   'titulo' => '¡Entregamos <br>por ti!',
                   'subtitulo' => 'Moviliza rápidamente tus productos con <br> nuestra red de delivery express.',
                   'url' => '',
                   'imagen' => 'banner-demo/slider_express.png',
                   'slug' => 'scharff_express',
                   'atributos'=>'{"btn_text":"&nbsp; SOLICITA UN <strong>ENVÍO</strong>&nbsp;","btn_style":"pink"}'
               ],


               //scharff_stop//
               [
                   'id' => '13',
                   'titulo' => '¡Entregar nunca <br>fue tan fácil!',
                   'subtitulo' => 'Envía tus productos sin trámites <br>ni intermediarios 24/7.',
                   'url' => '',
                   'imagen' => 'banner-demo/img_principal_stop.png',
                   'slug' => 'scharff_stop',
                   'atributos'=>'{"btn_text":"&nbsp; RESERVA TU <strong>LOCKER</strong> &nbsp;","btn_style":"pink"}'
               ],
               [
                   'id' => '14',
                   'titulo' => '¡Traer tus compras online nunca fue tan fácil!',
                   'subtitulo' => 'Envía tus compras a nuestro almacén <br /> y recíbelas en casa',
                   'url' => '',
                   'imagen' => 'banner-demo/img_gobuy.png',
                   'slug' => 'gobuy',
                   'atributos'=>'{"btn_text":"&nbsp;&nbsp;&nbsp;&nbsp;Registra tus compras aquí&nbsp;&nbsp;&nbsp;&nbsp;","btn_style":"pink"}'
               ],
               //envio regular//
               [
                   'id' => '15',
                   'titulo' => '¡Somos la conexión <br>que necesitas!',
                   'subtitulo' => 'Contamos con una amplia red<br/>a nivel urbano y nacional.',
                   'url' => '',
                   'imagen' => 'banner-demo/img_envio_regular.jpg',
                   'slug' => 'envio-regular',
                   'atributos'=>'{"btn_text":"&nbsp;&nbsp;&nbsp; COTIZA <strong>AQUÍ</strong> &nbsp;&nbsp;&nbsp;","btn_style":"pink"}'
               ],

           ]
       );
     }
}
