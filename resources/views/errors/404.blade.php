<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">

        <meta name="csrf-token" content="{{ csrf_token() }}">
        @if(!empty($metas['titulo']))
          <title>{{$metas['titulo']}}</title>
        @else
          <title>Scharff - Grupo Scharff</title>
        @endif

        @if(!empty($metas['description']))
          <meta name="description" content="{{$metas['description']}}"  />
        @else
          <meta name="description" content="En Scharff creamos conexiones de alto valor para nuestros clientes a través de soluciones estratégicas diseñadas en nuestro Scharff Lab, el primer laboratorio de innovación logística en el Perú. A partir de nuestra experiencia. Carga. Aduana. Transporte. Almacenamiento. Distribución. FedEx Express. ¡Vive la experiencia!"  />
        @endif


        <script type='text/javascript'>
        /* <![CDATA[ */
        var env = "{{env('APP_ENV','devel')}}"
        var env_culquikey = "{{env('CULQUI_KEY','pk_test_DImyJlnC7NtrF5ok')}}"
        var env_map_key = "{{env('APP_MAPA_ID','AIzaSyA4soAMjFo8X_D7yGAVeb4C68T-otDsmuE')}}"
        /* ]]> */
        </script>



        <link rel="icon" type="image/png" href="/images/favicon_scharff_white16.png" sizes="16x16">
        <link rel="icon" type="image/png" href="/images/favicon_scharff_white32.png" sizes="32x32">
        <link rel="icon" type="image/png" href="/images/favicon_scharff_white96.png" sizes="96x96">



        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, minimal-ui">
        <!-- Fonts -->
        <!-- <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css"> -->
        <link rel="stylesheet" type="text/css" href="{{ mix('css/app.css') }}?462">
        <link href='https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Material+Icons' rel="stylesheet">

        <!-- Styles -->



@if (env('APP_ENV','devel')==='production')
<!-- Facebook Pixel Code -->
<script>
!function(f,b,e,v,n,t,s)
{if(f.fbq)return;n=f.fbq=function(){n.callMethod?
n.callMethod.apply(n,arguments):n.queue.push(arguments)};
if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
n.queue=[];t=b.createElement(e);t.async=!0;
t.src=v;s=b.getElementsByTagName(e)[0];
s.parentNode.insertBefore(t,s)}(window, document,'script',
'https://connect.facebook.net/en_US/fbevents.js');
fbq('init', '285309895366135');
fbq('track', 'PageView');
</script><noscript><img height="1" width="1" style="display:none" src="https://www.facebook.com/tr?id=285309895366135&ev=PageView&noscript=1"/></noscript>
@endif



    </head>

    <body class="{{env('APP_ENV','devel')==='production'?'holascharff_body':'scharff_devel_body'}}">

<!--hoo-->
<!--
{{env('DB_DATABASE_PICKAPP_API', 'forge')}}
{{env('DB_DATABASE', 'forge')}}
-->
<!--haaa-->
      <div id="app" class="container pa-0 fluid">


        @if (!empty($ruta))
          @if ($ruta=='home')
            @php
            include(base_path().'/public/prerender/home.html')
            @endphp

          @elseif ($ruta=='stop')
            @php
            include(base_path().'/public/prerender/stop.html')
            @endphp

          @elseif ($ruta=='express')
            @php
            include(base_path().'/public/prerender/express.html')
            @endphp

          @elseif ($ruta=='scharffclub')
            @php
            include(base_path().'/public/prerender/scharffclub.html')
            @endphp

          @elseif ($ruta=='cargadomestica')
            @php
            include(base_path().'/public/prerender/cargadomestica.html')
            @endphp

          @elseif ($ruta=='aduanas')
            @php
            include(base_path().'/public/prerender/aduanas.html')
            @endphp

          @elseif ($ruta=='almacen')
            @php
            include(base_path().'/public/prerender/almacen.html')
            @endphp

          @elseif ($ruta=='cargainternacional')
            @php
            include(base_path().'/public/prerender/cargainternacional.html')
            @endphp

          @elseif ($ruta=='distribucion')
            @php
            include(base_path().'/public/prerender/distribucion.html')
            @endphp

          @elseif ($ruta=='empresa')
            @php
            include(base_path().'/public/prerender/empresa.html')
            @endphp

          @elseif ($ruta=='para-ti')
            @php
            include(base_path().'/public/prerender/para-ti.html')
            @endphp

          @elseif ($ruta=='lab')
            @php
            include(base_path().'/public/prerender/lab.html')
            @endphp

          @elseif ($ruta=='terminos')
            @php
            include(base_path().'/public/prerender/terminos.html')
            @endphp

          @elseif ($ruta=='faq')
            @php
            include(base_path().'/public/prerender/faq.html')
            @endphp

          @elseif ($ruta=='go-buy')
            @php
            include(base_path().'/public/prerender/go-buy.html')
            @endphp


          @endif

        @endif












      </div>


    <script src="{{ mix('js/app.js') }}?462"></script>



<script>



  function async(u, c) {
    var d = document, t = 'script',
        o = d.createElement(t),
        s = d.getElementsByTagName(t)[0];
    o.src = u;
    if (c) { o.addEventListener('load', function (e) { c(null, e); }, false); }
    s.parentNode.insertBefore(o, s);
  }
  async('https://checkout.culqi.com/v2', function() {
    Culqi.publicKey = "{{env('CULQUI_KEY','pk_test_DImyJlnC7NtrF5ok')}}";
    Culqi.init();
  });
</script>
















  <script type="text/javascript">
  window.fbAsyncInit = function() {
    FB.init({
      appId      : '{{env('APP_ENV','devel')==='production'?'2001153770200290':'481742742227883'}}',
      cookie     : true,  // enable cookies to allow the server to access the session
      xfbml      : true,  // parse social plugins on this page
      version    : 'v2.8' // use graph api version 2.8
    });
  };
  (function(d, s, id) {
    var js, fjs = d.getElementsByTagName(s)[0];
    if (d.getElementById(id)) return;
    js = d.createElement(s); js.id = id;
    js.src = "//connect.facebook.net/en_US/sdk.js";
    fjs.parentNode.insertBefore(js, fjs);
  }(document, 'script', 'facebook-jssdk'));


  </script>


{{--
  <script type="text/javascript">
    function aaa(){
       var promise = new Promise(function(resolve, reject) {
         window.setTimeout(function() {
           resolve('done!');
         },3000);
       });
       return promise;
    }


    function bbb(){
      return new Promise(function(resolve,reject){
        setTimeout(function(){
          resolve({ob:'ject'});
        },3000);
        console.log("RRRRRR");
      });

    }

    var ccc = new Promise(function(resolve,reject){
        setTimeout(function(){
          resolve({ob:'JJJJJJ'});
        },3000);
        console.log("RRRRRR<<<<<");
      });





    var lobue;
    var vaaa = ccc.then(function(done) {
      console.log(done); // --> 'done!'
      console.log(vaaa);
      lobue = done;
      printbue();
    });
    console.log('bbbb');


    function printbue(){
      console.log(lobue);
      console.log(lobue['ob']);
      console.log(lobue.ob);
    }


  </script> --}}





    </body>
</html>
