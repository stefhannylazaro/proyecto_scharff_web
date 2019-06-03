<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="keywords" content="" />
    <title>Kode - Premium Bootstrap Admin Template</title>

    <!-- ========== Css Files ========== -->
    {!! Html::style('assets/admin/css/root.css') !!}
    {!! Html::style('assets/admin/css/custom.css') !!}
    <style type="text/css">
        body{background: #F5F5F5;}
    </style>
</head>
<body>

<div class="login-form">
    <form action="">
        <div class="top">
            <img src="/assets/admin/img/se_logo@2x.png" alt="Sin Evolturas" class="logo">
        </div>
        <div class="form-area">
            <div class="group">
                {!! Form::text('user',null,['class' => 'form-control','placeholder' => 'Usuario']) !!}
                <i class="fa fa-user"></i>
            </div>
            <div class="group">
                {!! Form::password('password',['class' => 'form-control','placeholder' => 'Contraseña']) !!}
                <i class="fa fa-key"></i>
            </div>
            <div class="checkbox checkbox-primary">
                <input id="checkbox101" type="checkbox" checked>
                <label for="checkbox101"> Recordarme</label>
            </div>
            <button type="submit" class="btn btn-default btn-block">LOGIN</button>
        </div>
    </form>
    {{--
    <div class="footer-links row">
        <div class="col-xs-6"><a href="#"><i class="fa fa-external-link"></i> Register Now</a></div>
        <div class="col-xs-6 text-right"><a href="#"><i class="fa fa-lock"></i> Forgot password</a></div>
    </div>
    --}}
</div>

</body>
</html>