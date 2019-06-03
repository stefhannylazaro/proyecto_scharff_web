<!DOCTYPE html>
<html>
    <head>
        <title>Registro exitoso</title>
        <style type="text/css" media="all">
            body {
                font-family: Arial, Helvetica, sans-serif;
            }
            img {
                max-width: 100%;
                height: auto;
            }
        </style>
        <style type="text/css" media="only screen and (max-width: 480px)">
            /* Mobile styles */
            @media only screen and (max-width: 480px) {

                [class="w320"] {
                    width: 320px !important;
                }

                [class="mobile-block"] {
                    width: 100% !important;
                    display: block !important;
                }
            }
        </style>
    </head>
    <body style="letter-spacing: 0.03em;margin:0;">
<div class="bg-wrapper" style="background-color: #f9f9f9;">
            <center>
                <table class="email-table w320" style="background-color: #ffffff;width: 600px;" width="600" cellpadding="0" cellspacing="0">
                    <tbody>
                        <tr>
                            <td align="center">
                                <img alt="Scharff" src="http://www.holascharff.com/images/cabecera-img.png" width="600" height="168">
                            </td>
                        </tr>
                        <tr>

                        </tr>
                        <tr>
                            <td>
                                <table width="600" cellpadding="0" cellspacing="0" border="0" bgcolor="#f1f1f1" style="font-size: 13px;width: 100%;">
                                <tbody>
                                    <tr><td height="40">&nbsp;</td></tr>
                                    <tr>
                                        <td align="center" colspan="2">
                                            <center>
                                                <table cellpadding="0" cellspacing="0" bgcolor="#ffffff" style="width: 90%;">
                                                <tbody>
                                                    <tr>
                                                        <td>
                                                            <center>

                                                            <table cellspacing="0" cellpadding="0" width="90%">
                                                                <tbody>
                                                                    <tr>
                                                                        <td>
                                                                            <tr>
                                                        <td><h3><strong style="color: #ff7177;font-size: 26px;">Hola {{$usuario_nombre}}</strong></h3></td>
                                                    </tr>
                                                    <tr>
                                                        <td>

<p>
@if($cambio_otros_datos==0)
  @if(!empty($email_nuevo))
    Tu contraseña y tu correo electrónico en Scharff han sido cambiadas satisfactoriamente.
  @else
    Tu contraseña en Scharff ha sido cambiada satisfactoriamente.
  @endif
@else
    Tus datos fueron modificados.
@endif
</p>
<p>
  @if($cambio_otros_datos==0)
    Ahora puedes
  @else
    Puedes
  @endif
  <a href="http://holascharff.com#login" target="_blank" style="color: #ff7177;">iniciar sesión</a>.
</p>
<p></p>
                                                        </td>
                                                    </tr>


                                                                        </td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                            </center>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                            </center>
                                        </td>
                                    </tr>
                                    <tr><td height="20">&nbsp;</td></tr>
                                    <tr bgcolor="#575757" style="background-color: #575757;color: #fff;">
                                        <td align="center">
                                            <center>
                                                <table cellpadding="0" cellspacing="0" border="0" style="width: 80%;">
                                                <tbody>
                                                    <tr><td height="20">&nbsp;</td></tr>
                                                    <tr>
                                                        <td>
                                                            <p>Si tienes alguna duda, por favor comunícate con nosotros:</p>
                                                            <p style="margin: 0;line-height: 26px;"><span>WhatsApp: <a href="tel:998140976" style="color: #fff;text-decoration: none;">998 140 976</a></span></p>
                                                            <p style="margin: 0;line-height: 26px;"><span>Email: <a href="mailto:atencionalcliente@holascharff.com" style="color: #fff;text-decoration: none;">atencionalcliente@holascharff.com</a></span></p>
                                                        </td>
                                                    </tr>
                                                    <tr><td height="20">&nbsp;</td></tr>
                                                </tbody>
                                            </table>
                                            </center>
                                        </td>
                                    </tr>
                                    <tr bgcolor="#ffffff" style="background-color: #fff;">
                                        <td align="center" colspan="2" style="color: #000000;font-size: 9px;padding: 15px;">
                                            <span><a href="/terms" style="color: #000000;text-decoration: none;">Terms</a> | <a href="/privacy" style="color: #000000;text-decoration: none;">Privacy</a> | <a href="/unsubscribe" style="color: #000000;text-decoration: none;">Unsubscribe</a></span>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </center>
        </div>
</body>
