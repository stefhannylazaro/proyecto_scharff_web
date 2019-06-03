


if(env==='production'){
var scharff_api_aux = 'https://api.holascharff.com/pickapp/api/v1/';
var pickapp_api_aux = 'https://mobile.pickapp.pe/';
var token = 'b99a4646a4abce7f834d4f1411626e3e';
}else{
var scharff_api_aux = 'https://schrf-api-dev.jnq.io/pickapp/api/v1/';
var token = '644f1a0004b177ac1ec245c0d4f8cac1';

if(window.location.href.indexOf("localhost") > -1) {
  scharff_api_aux = 'http://localhost:8001/pickapp/api/v1/';
  token = 'f8ce1022ca989928bbe5e1b35bf5c852';
}

var pickapp_api_aux = 'https://beta.pickapp.pe/';
//pickapp_api_aux = 'http://scharff-express.apiblueprint.org/';

}

// if(window.location.href.indexOf("holascharff") > -1) {
// }else{
// }
export const token_aux = token;

// https://beta.pickapp.pe/pickapp                /api/rest/empresa/1/settings?token=6a02b4a3b3dfa75d6f8a66cd951bef6b
// http://scharff-express.apiblueprint.org/pickapp/api/rest/empresa/1settings?token=token=c57741f4c0edf042ccd3fd9efaeb60a8
// http://scharff-express.apiblueprint.org/pickapp/api/rest/empresa/1/settings?token=6a02b4a3b3dfa75d6f8a66cd951bef6b
// http://scharff-express.apiblueprint.org/pickapp/api/rest/settings/1?token=6a02b4a3b3dfa75d6f8a66cd951bef6b
// http://scharff-express.apiblueprint.org/pickapp/api/rest/settings?token=6a02b4a3b3dfa75d6f8a66cd951bef6b
// http://scharff-express.apiblueprint.org/pickapp/api/rest/company/1/settings?token=6a02b4a3b3dfa75d6f8a66cd951bef6b


// https://beta.pickapp.pe/pickapp/api/rest/empresa/1/settings?token=token=c57741f4c0edf042ccd3fd9efaeb60a8
// https://beta.pickapp.pe/pickapp/api/rest/empresa/1/settings?token=6a02b4a3b3dfa75d6f8a66cd951bef6b
// https://beta.pickapp.pe/pickapp/api/rest/settings/1?token=6a02b4a3b3dfa75d6f8a66cd951bef6b
// https://beta.pickapp.pe/pickapp/api/rest/settings?token=6a02b4a3b3dfa75d6f8a66cd951bef6b
// https://beta.pickapp.pe/pickapp/api/rest/company/1/settings?token=6a02b4a3b3dfa75d6f8a66cd951bef6b
// https://beta.pickapp.pe/pickapp/api/rest/settings/55?token=6a02b4a3b3dfa75d6f8a66cd951bef6b

// https://beta.pickapp.pe/pickapp/api/rest/empresa/1/settings?token=79f23bb6f4494c63ee120e92cf609071
// https://beta.pickapp.pe/pickapp/api/rest/empresa/1/settings?token=79f23bb6f4494c63ee120e92cf609071
// https://beta.pickapp.pe/pickapp/api/rest/settings/1?token=79f23bb6f4494c63ee120e92cf609071
// https://beta.pickapp.pe/pickapp/api/rest/settings?token=79f23bb6f4494c63ee120e92cf609071
// https://beta.pickapp.pe/pickapp/api/rest/company/1/settings?token=79f23bb6f4494c63ee120e92cf609071
// https://beta.pickapp.pe/pickapp/api/rest/settings/55?token=21a56f2cbf808633359c2854d15025a3


// https://beta.pickapp.pe/pickapp/api/rest/settings?token=6a02b4a3b3dfa75d6f8a66cd951bef6b
// https://beta.pickapp.pe/pickapp/api/rest/settings?token=21a56f2cbf808633359c2854d15025a3
// https://beta.pickapp.pe/pickapp/api/rest/empresa/1/settings?token=21a56f2cbf808633359c2854d15025a3

// http://beta.pickapp.pe/pickapp/api/rest/settings/1?token=21a56f2cbf808633359c2854d15025a3
// http://beta.pickapp.pe/pickapp/api/rest/settings?token=21a56f2cbf808633359c2854d15025a3
// https://beta.pickapp.pe/pickapp/api/rest/empresa/1/settings?token=21a56f2cbf808633359c2854d15025a3
// https://beta.pickapp.pe/pickapp/api/rest/empresa/1/settings?token=79f23bb6f4494c63ee120e92cf609071

export const scharff_api_root = scharff_api_aux;
export const pickapp_api_root = pickapp_api_aux;




export const usuario_usuario = scharff_api_root+'usuario/usuario'
export const usuario_facebook = scharff_api_root+'usuario/usuarioFacebook'
export const usuario_login = scharff_api_root+"usuario/login"
export const usuario_resetear = scharff_api_root+"usuario/resetear"
export const usuario_actualizar = scharff_api_root+"usuario/actualizar"


export const marcarPredeterminada = scharff_api_root+"tarjeta/marcarPredeterminada"
export const getTarjetaList = scharff_api_root+"tarjeta/getTarjetaList"
export const reserva_lista = scharff_api_root+"reserva/lista"
export const eliminarTarjeta = scharff_api_root+"tarjeta/eliminarTarjeta"
export const crearTarjeta = scharff_api_root+"tarjeta/crearTarjeta"


export const locker_tarifa = scharff_api_root+"locker/tarifa"
export const locker_lista = scharff_api_root+"locker/lista"
export const reserva_agregar = scharff_api_root+"reserva/agregar"




export const pedido_tarifa = scharff_api_root+"pedido/tarifa"
export const pedido_agregardesc = scharff_api_root+"pedido/agregardesc"
export const pedido_extrainfo = scharff_api_root+"pedido/pedidoextra"





export const pickapp_favoritos_origen = pickapp_api_aux+"pickapp/api/rest/favoritoorigen/getFavoritosOrigen"

export const pickapp_getPedidoRecibir = pickapp_api_aux+"pickapp/api/rest/pedido/getPedidoRecibir"

export const pickapp_getMisPedidos = pickapp_api_aux+"pickapp/api/rest/pedido/getMisPedidos"
export const pickapp_calificar = pickapp_api_aux+"pickapp/api/rest/pedido/calificar"
export const pickapp_eliminarPedido = pickapp_api_aux+"pickapp/api/rest/pedido/eliminarPedido"
export const pickapp_getTarifa = pickapp_api_aux+"pickapp/api/rest/tarifa/getTarifa"
export const pickapp_generarPedido = pickapp_api_aux+"pickapp/api/rest/pedido/generarPedido"
export const pickapp_notificarPedido = pickapp_api_aux+"pickapp/api/rest/pedido/notificarPedido"
export const pickapp_getSeguimiento = pickapp_api_aux+"pickapp/m/rest/pedido/getSeguimiento"



export const regular_lista = scharff_api_root+"regular/lista"
export const regular_crear = scharff_api_root+"regular/agregar"
export const regular_tarifa = scharff_api_root+"regular/tarifa"
export const regular_buscarportracking = scharff_api_root+"regular/buscarportracking"
export const regular_buscarporid = scharff_api_root+"regular/buscarporid"





export const get_departamentos = scharff_api_root+"ubigeos/departamentos"
export const get_provincias = scharff_api_root+"ubigeos/provincias"
export const get_distritos = scharff_api_root+"ubigeos/distritos"














// export const pickapp2_company = "http://scharff-express.apiblueprint.org/pickapp/api/rest/settings"
// export const pickapp2_company = "http://scharff-express.apiblueprint.org/pickapp/api/rest/settings"
export const pickapp2_company = pickapp_api_root+"pickapp/api/rest/empresa"
export const pickapp2_byid = pickapp_api_root+"pickapp/api/rest/settings"


// http://scharff-express.apiblueprint.org/pickapp/api/rest/pedido/generarPedido
// http://scharff-express.apiblueprint.org/pickapp/api/rest/pedido/getPedidoRecibir/id?token=token
// http://scharff-express.apiblueprint.org/pickapp/api/rest/pedido/getPedidoNotificacion/id?token=token












export const asmx_DisponibilidadLocker = 'http://200.37.50.60/servicios/wsElocker/SrvDistribucion.asmx/DisponibilidadLocker';
export const asmx_RegistrarReserva = 'http://200.37.50.60/servicios/wsElocker/SrvDistribucion.asmx/RegistrarReserva';
export const asmx_CancelarReserva = 'http://200.37.50.60/servicios/wsElocker/SrvDistribucion.asmx/CancelarReserva';
export const asmx_RegistrarOperacion = 'http://200.37.50.60/servicios/wsElocker/SrvDistribucion.asmx/RegistrarOperacion';
// export const asmx_DisponibilidadLocker = 'http://200.37.50.60/servicios/wsElocker/SrvDistribucion.asmx/DisponibilidadLocker';
// export const asmx_DisponibilidadLocker = 'http://200.37.50.60/servicios/wsElocker/SrvDistribucion.asmx/DisponibilidadLocker';
// export const asmx_DisponibilidadLocker = 'http://200.37.50.60/servicios/wsElocker/SrvDistribucion.asmx/DisponibilidadLocker';


export const gobuypedido_crear = scharff_api_root+"gobuypedido/create"
export const gobuypedido_lista = scharff_api_root+"gobuypedido/listar"
export const gobuypedido_buscarportracking = scharff_api_root+"gobuypedido/buscarportracking"
