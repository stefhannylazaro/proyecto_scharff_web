
<!DOCTYPE html>
<html lang="en"></html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <title>Scharff</title>
  <link rel="stylesheet" type="text/css" href="/assets/admin/lib/stroke-7/style.css"/>
  <link rel="stylesheet" type="text/css" href="/assets/admin/lib/jquery.nanoscroller/css/nanoscroller.css"/><!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
  <link rel="stylesheet" href="/assets/admin/css/style.css" type="text/css"/>
</head>
<body class="am-splash-screen">
  <div class="am-wrapper am-login">
    <div class="am-content">
      <div class="main-content">
        <div class="login-container">
          <div class="panel panel-default">
            <div class="panel-heading">
              <img src="/images/scharff_logo_w@2x.png" alt="logo" width="150px" height="39px" class="logo-img">
              <span>Panel de Administración.</span>
            </div>
            <div class="panel-body">
              {!! Form::open(['method' => 'post', 'class' => 'form-horizontal']) !!}

              @if($errors->any())
                  <div class="m-alert m-alert--outline alert alert-danger alert-dismissible" role="alert">
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close"></button>
                      <span>{{$errors->first()}}</span>
                  </div>
              @endif

                <div class="login-form">
                  <div class="form-group">
                    <div class="input-group"><span class="input-group-addon"><i class="icon s7-user"></i></span>
                      <input id="email" name="email" type="text" placeholder="Username" autocomplete="off" class="form-control">
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="input-group"><span class="input-group-addon"><i class="icon s7-lock"></i></span>
                      <input id="password" name="password" type="password" placeholder="Password" class="form-control">
                    </div>
                  </div>
                  <div class="form-group login-submit">
                    <button data-dismiss="modal" type="submit" class="btn btn-primary btn-lg">Acceder</button>
                  </div>
                  {{-- <div class="form-group footer row">
                    <div class="col-xs-6"><a href="#">Forgot Password?</a></div>
                    <div class="col-xs-6 remember">
                      <label for="remember">Remember Me</label>
                      <div class="am-checkbox">
                        <input type="checkbox" id="remember" class="needsclick">
                        <label for="remember"></label>
                      </div>
                    </div>
                  </div> --}}
                </div>
              {!! Form::close() !!}
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <style media="screen">
  img.logo-img {
    width: 175px;
    height: auto;
  }
  </style>
  <script src="/assets/admin/lib/jquery/jquery.min.js" type="text/javascript"></script>
  <script src="/assets/admin/lib/jquery.nanoscroller/javascripts/jquery.nanoscroller.min.js" type="text/javascript"></script>
  <script src="/assets/admin/js/main.js" type="text/javascript"></script>
  <script src="/assets/admin/lib/bootstrap/dist/js/bootstrap.min.js" type="text/javascript"></script>
  <script type="text/javascript">
    $(document).ready(function(){
    	//initialize the javascript
    	App.init();
    });

  </script>
</body>
