<?php

use Illuminate\Database\Seeder;

class BannersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
     public function run()
     {
       $campos = "'home', 'distribucion_nacional', 'aduanas', 'carga', 'almacenes', 'envios_internacionales', 'scharff_express', 'scharff_stop', 'cotizador', 'scharff_lab','empresa', 'domestica', 'paraTi'";

       DB::statement("ALTER TABLE banners CHANGE COLUMN slug slug ENUM(".$campos.") DEFAULT 'home'") ;
       DB::table('banners')->delete();
       DB::table('banners')->insert(
           [
             [
                 'id' => '1',
                 'titulo' => '<p class="send mb-0 black--text d-align-center">
                 <img class="circle-cover mr-2" src="/images/item_one.png" :alt="circleOne.alt">
                 envía.
               </p>
               <p class="send mb-0 black--text d-align-center">
                 <img class="circle-cover mr-2" src="/images/item_two.png" :alt="circleTwo.alt">
                 recibe.
               </p>
               <p class="send mb-0 black--text d-align-center">
                 <img class="circle-cover mr-2" src="/images/item_three.png" :alt="circleThree.alt">
                 acerca.
               </p>',
                 'subtitulo' => 'Más de 30 años diseñando logística',
                 'url' => '',
                 'imagen' => 'banner-demo/1_97857317.png',
                 'slug' => 'home'
             ],[
                 'id' => '2',
                 'titulo' => '<p class="send mb-0 black--text">Conecta tu negocio con el Perú y el Mundo</p>',
                 'subtitulo' => 'Somos el partner logístico que tu empresa necesita',
                 'url' => '',
                 'imagen' => 'banner-demo/2_46791307.png',
                 'slug' => 'home'
             ],[
                 'id' => '3',
                 'titulo' => '<p class="send mb-0 black--text">Ahora enviar es  <br /> más sencillo</p>',
                 'subtitulo' => 'Transformamos la manera de hacer logística para ti.',
                 'url' => '',
                 'imagen' => 'banner-demo/3_22630973.png',
                 'slug' => 'home'
             ],





               //aduanas
               [
                   'id' => '4',
                   'titulo' => '<p class="send mb-0 black--text">Crecer no tiene <br>límites </p>',
                   'subtitulo' => 'Más de 30 años de gestión y asesoría personalizada de aduanas',
                   'url' => '',
                   'imagen' => 'banner-demo/img_aduanas.png',
                   'slug' => 'aduanas'
               ],

               //almacenes
               [
                   'id' => '5',
                   'titulo' => '<p class="send mb-0 black--text">El espacio que tu negocio <br>necesita para crecer</p>',
                   'subtitulo' => 'Contamos con múltiples almacenes en el Perú',
                   'url' => '',
                   'imagen' => 'banner-demo/img_almacen.png',
                   'slug' => 'almacenes'
               ],




               //carga
               [
                   'id' => '6',
                   'titulo' => '<p class="send mb-0 black--text">Que tu negocio <br>cruce fronteras</p>',
                   'subtitulo' => 'Llevamos tu carga a donde vaya tu negocio.',
                   'url' => '',
                   'imagen' => 'banner-demo/img_servicio_carga.png',
                   'slug' => 'carga'
               ],



               //distribucion_nacional
               [
                   'id' => '7',
                   'titulo' => '<p class="send mb-0 black--text">Somos la conexión <br>que necesitas</p>',
                   'subtitulo' => 'Accede a nuestra red urbana y nacional de <br />distribución',
                   'url' => '',
                   'imagen' => 'banner-demo/img_servicio_distribucion.png',
                   'slug' => 'distribucion_nacional'
               ],





             ///domestica
             [
                 'id' => '8',
                 'titulo' => '<p class="send mb-0 black--text">El Perú te espera</p>',
                 'subtitulo' => 'Accede a nuestra red de transportistas a <br />nivel nacional y llega siempre a tiempo',
                 'url' => '',
                 'imagen' => 'banner-demo/img_domestica.png',
                 'slug' => 'domestica'
             ],



             ///empresa
             [
                 'id' => '9',
                 'titulo' => '<p class="send mb-0 black--text">El socio logístico que <br>tu negocio necesita</p>',
                 'subtitulo' => '',
                 'url' => '',
                 'imagen' => 'banner-demo/img_principal_empresa.png',
                 'slug' => 'empresa'
             ],


             //scharff_lab
             [
                 'id' => '10',
                 'titulo' => '<p class="send mb-0 black--text">Transformando la forma <br> de hacer logística </p>',
                 'subtitulo' => 'Creamos el primer laboratorio de innovación <br> logística en el Perú.',
                 'url' => '',
                 'imagen' => 'banner-demo/img_principallab.png',
                 'slug' => 'scharff_lab'
             ],



             ///para-ti
             [
                 'id' => '11',
                 'titulo' => '<p class="send mb-0 black--text">Haz tus envíos de <br>la manera más fácil </p>',
                 'subtitulo' => '',
                 'url' => '',
                 'imagen' => 'banner-demo/img_principalparaTi.png',
                 'slug' => 'paraTi'
             ],


               //scharff_express
               [
                   'id' => '12',
                   'titulo' => '<p class="send mb-0 black--text">Entregamos por ti</p>',
                   'subtitulo' => 'Moviliza tus paquetes rápidamente con <br> nuestra red de delivery express.',
                   'url' => '',
                   'imagen' => 'banner-demo/slider_express.png',
                   'slug' => 'scharff_express'
               ],


               //scharff_stop
               [
                   'id' => '13',
                   'titulo' => '<p class="send mb-0 black--text">Entregar es más <br>sencillo </p>',
                   'subtitulo' => 'Envía y recibe paquetes sin trámites <br>ni intermediarios 24/7',
                   'url' => '',
                   'imagen' => 'banner-demo/img_principal_stop.png',
                   'slug' => 'scharff_stop'
               ],
            







           ]
       );
     }
}
