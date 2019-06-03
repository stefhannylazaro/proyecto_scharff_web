<template>
<v-slide-y-transition>


  <v-card class="px-5 pb-4 pt-5 white login-style" transition="slide-y-transition">
    <div class="close">
      <i @click.stop="closeModal">
        <svg style="width:32px;height:32px;fill: rgba(0, 0, 0, 0.4);" viewBox="0 0 24 24">
            <path d="M12,20C7.59,20 4,16.41 4,12C4,7.59 7.59,4 12,4C16.41,4 20,7.59 20,12C20,16.41 16.41,20 12,20M12,2C6.47,2 2,6.47 2,12C2,17.53 6.47,22 12,22C17.53,22 22,17.53 22,12C22,6.47 17.53,2 12,2M14.59,8L12,10.59L9.41,8L8,9.41L10.59,12L8,14.59L9.41,16L12,13.41L14.59,16L16,14.59L13.41,12L16,9.41L14.59,8Z" />
        </svg>
      </i>
    </div>


    <div v-if="!rememberAccount" class="login-screen-loading-w" :class="{'login-screen-loading-w-active':loginBtnLoading}">
      <div class="header pb-3">
        <div class="login-options"  v-if="!sesionIniciada">
        <button href="" :class="{'active': loginOptionActive=='personas'}" class="login-empresa" @click.stop="cambiaLogin">Personas</button>
        <button href="" :class="{'active': loginOptionActive=='empresa'}" class="login-personas" @click.stop="cambiaLogin">Empresa</button>
      </div><!-- /.register-social -->
        <h4 class="pb-2">Bienvenido</h4>
        <span v-if="!sesionIniciada && loginOptionActive=='empresa'">Acceso a la intranet para usuarios corporativos.</span>
      </div>


      <vue-select class="c-login-modal" v-if="loginOptionActive=='empresa'&&!sesionIniciada" :firstItem="true" nameTitle="País" :listData="servicePais" :selected="pais.name" v-on:selectValue="selectPais"></vue-select>
      <div v-if="!sesionIniciada">

        <div class="inputs pt-1 pb-1">
          <input v-model="email" type="text" :placeholder="loginOptionActive=='personas'?'Correo electrónico':'Usuario'">
          <input v-model="password" type="password" placeholder="Contraseña" @keyup.enter="validateSend">
        </div>

        <div class="text-right pb-2">
        <input type="checkbox" v-model="recordar" if="recordar" name="recordar" value=""><label for="recordar" @click="recordar=!recordar"> Recordar</label>
        </div>
        <div class="register-social" :class="{'hidden': loginOptionActive=='empresa'}">
          <!--<div class="social-btn pb-aux google">
            <img class="social-img" src="../../img/google-icon.png" alt="Logotipo google">
            <span>Iniciar sesión</span>
          </div>-->





            <fb-signin-button
            :params="fbSignInParams"
            @success="onSignInSuccess"
            @error="onSignInError"
             class="social-btn facebook">
            <i>
              <svg style="width:24px;height:24px" viewBox="0 0 24 24">
                  <path style="fill:white;" d="M5,3H19A2,2 0 0,1 21,5V19A2,2 0 0,1 19,21H5A2,2 0 0,1 3,19V5A2,2 0 0,1 5,3M18,5H15.5A3.5,3.5 0 0,0 12,8.5V11H10V14H12V21H15V14H18V11H15V9A1,1 0 0,1 16,8H18V5Z" />
              </svg>
            </i> <span>Iniciar sesión</span>
            </fb-signin-button>





        </div>


      <div class="login-error-alert mb-2" v-if="showAlert!=''">
        <span v-text="showAlert"></span>
      </div>
      <div class="login-sucess-alert mb-2" v-if="showSuccess!=''">
        <span v-text="showSuccess"></span>
      </div>


      <div class="register-btn-create mt-1 mb-2">
        <v-btn round large class="btn-active create elevation-0" :disabled="loginBtnLoading" :loading="loginBtnLoading" @click.stop="validateSend">Iniciar sesión</v-btn>
      </div>
      <div class="extra-links">
        <p v-if="loginOptionActive=='personas'" @click.stop="remAccount()">¿Olvidaste tu contraseña?</p>
        <p @click.stop="createAccount()" v-if="loginOptionActive=='personas'">Crear una cuenta</p>
      </div>
      </div>
      <div v-if="sesionIniciada">
        <strong>{{nombreUsuario}}</strong>
        <br>
        <br>
        <v-btn round class="btn-active create elevation-0" @click.stop="gotoAdmin">Ir al panel administrativo</v-btn>
        <br>
        <br>
      </div>
      <div class="login-loading-screen" :class="{'login-loading-screen-success':felicitaciones}">

        <div class="header login-felicitaciones" v-if="felicitaciones">
          <p>Inicio de sesión exitoso.</p>
          <p>Bienvenido a Scharff</p>
        </div>
        <v-progress-circular v-else :size="50" indeterminate color="primary"></v-progress-circular>

      </div>
    </div>
    <div v-else>
      <div class="header pb-3">
        <h4 class="pb-2">Bienvenido</h4>
        <span>Recupera tu contraseña</span>
      </div>
      <div class="inputs pt-3 pb-2">
        <input v-model="email" type="email" placeholder="Correo electrónico">
      </div>
      <small class="blue--text" v-html="showSuccessRec"></small>
      <small class="red--text">{{showAlertRec}}</small>
      <div class="register-btn-create mt-1 mb-3">

        <v-btn round :disabled="btn_reset_ocupado" :loading="btn_reset_ocupado" large class="btn-active create elevation-0" @click.stop="recuperarClave">Enviar</v-btn>
      </div>
    </div>
  </v-card>
  </v-slide-y-transition>
</template>

<script>

import axios from 'axios'
import firebase from 'firebase'
import vueSelect from './cSelectData.vue'

import * as apiRutas from '../config/apiRutas';

export default {
  props: ['sesionIniciada','nombreUsuario'],
  data () {
    return {
      email: null,
      password: null,
      loginOptionActive:'personas',
      pais: { name: 'Perú', value: 'P'},
      servicePais: [
        { name: 'Perú', value: 'P'},
        { name: 'Bolivia', value: 'B'}
      ],
      showAlert: '',
      showSuccess:'',
      fcmid:'',
      loginBtnLoading:false,
      yalogueado:false,
      rememberAccount: false,
      fbSignInParams: {
        scope: 'email',
        return_scopes: true
      },
      showAlertRec:'',
      showSuccessRec:'',
      btn_reset_ocupado:false,
      felicitaciones:false,
      recordar:false,
      usuario2:null,
      userApi:''
    }
  },
  watch: {
    email: function () {
      this.changeAlert()
    },
    password: function () {
      this.changeAlert()
    },
    pais: function () {
      this.changeAlert()
    },
    // showSuccess:function(el){
    //   if(el=!''){
    //     this.showAlert = '';
    //   }
    // },
    // showAlert:function(){
    //   if(el=!''){
    //     this.showSuccess = '';
    //   }
    // }

  },mounted(){

    var vm = this;

    //console.log('this.$store.state.loadStateLogin');
    //console.log(vm.$store.state.loadStateLogin);

    const messaging = firebase.messaging();
    messaging.requestPermission()
    .then(function(){
      return messaging.getToken();
    }).then(function(token){
      console.log("el token");
      vm.fcmid = token;

    }).catch(function(err){
      console.log("error permisos notificaciones");
      console.log(err);
    });



    //this.loginFacebookApi();

    //setTimeout(function(){
      //vm.felicitaciones = true
    //},3000);
      var frecuente = localStorage.getItem("frecuente");
      var mac = localStorage.getItem("mac");
    if(frecuente){
      vm.email=frecuente;
      vm.password=mac;
      vm.recordar = true;
    }




    if(window.location.hash === "#empresa"){
      vm.loginOptionActive ="empresa"
    }

  },
  methods: {
    onSignInSuccess (response) {
      var vm = this;
      vm.loginBtnLoading = true;
      console.log(response);
      FB.api('/me', { fields: 'first_name,last_name, email' },
        function(response) {





          var resf = response;
          /*
          var resf = {};
          resf.first_name="jean";
          resf.last_name="carlos";
          resf.email="face14@aa.com";
          resf.id="123456790";
          */
          // var a = FB.getAuthResponse();
          // console.log("FB.getAuthResponse();");
          // console.log(a);
          // console.log(a.accessToken);

          //PARAPRUEBAS
          console.log("PASO POR AQUI FB");
          console.log(resf.email);
          if(!resf.email || resf.email=="" || resf.email == 'undefined' || typeof resf.email == 'undefined'){
            FB.login(
              function(response) {
                console.log("response relogin");
                console.log(response);
              },
              {
                scope: 'email',
                auth_type: 'rerequest'
              }
            );
          }



          //pruebas
          axios({
            method:'post',
            url:'api/facebooklogin',
            data: {
              usuario_face_id:resf.email,
              usuario_nombre:resf.first_name,
              usuario_apellidos:resf.last_name,
              email:resf.email,
            }
          })
          .then(function(response){
            let res = response.data;
            console.log(res);
            console.log(res.status);
            if(res.status==1){

              //localStorage.setItem("user_p_info", JSON.stringify(res.data));
              //vm.showSuccess = 'Logueado con exito.';

              vm.loginFacebookApi(resf,'login');


            }else if(res.status==2){

              //localStorage.setItem("user_p_info", JSON.stringify(res.data));

              //vm.showSuccess = 'Registrado con exito.';

              vm.loginFacebookApi(resf,'reg');


            }else{
              vm.showAlert = "Error facebook";
              vm.loginBtnLoading = false;
            }

          }).catch(function (error) {
            console.log(error);
            vm.loginBtnLoading = false;
          });







        }
      );

      //FB.api('/me', dude => {
      //  console.log(`Good to see you, ${dude.name}.`)
      //})
    },
    onSignInError (error) {
      console.log('facebook login error ');

      return false;
      var vm = this;
      vm.loginBtnLoading = true;

      var resf = {};
      //resf.email=1123558;
      resf.first_name="Prueba";
      resf.last_name="carlos";
      resf.email="face29@gmaill.com";
      resf.id="123456799";

      axios({
        method:'post',
        url:'api/facebooklogin',
        data: {
          usuario_face_id:resf.email,
          usuario_nombre:resf.first_name,
          usuario_apellidos:resf.last_name,
          email:resf.email,
        }
      })
      .then(function(response){
        let res = response.data;
        console.log(res);
        console.log(res.status);
        if(res.status==1){

          //localStorage.setItem("user_p_info", JSON.stringify(res.data));
          //vm.showSuccess = 'Logueado con exito';
          vm.loginFacebookApi(resf,'login');


        }else if(res.status==2){

          //localStorage.setItem("user_p_info", JSON.stringify(res.data));

          //vm.showSuccess = 'Registrado con exito';
          vm.loginFacebookApi(resf,'reg');


        }else{
          console.log('Error facebook ');
          vm.showAlert = "Error facebook";
          vm.loginBtnLoading = false;
        }

      }).catch(function (error) {
        console.log(error);
        vm.loginBtnLoading = false;

        vm.showAlert = "Error facebook_k";
      });
    },
    loginFacebookApi:function(resf,accion){

      var vm = this;
      console.log('response---');
      console.log(resf);
      console.log(resf.email);

      var action_url='';

      if(accion=='reg'){
            action_url = apiRutas.usuario_usuario;
            //action_url = 'http://localhost:8001/pickapp/api/v1/usuario/usuario'

            axios({
              method:'post',
              //url:'http://localhost:8001/pickapp/api/v1/usuario/usuario',
              url:action_url,
              data: {




                usuario_email:resf.email,
                usuario_tipo:2,
                usuario_nombre:resf.first_name,
                usuario_apellidos:resf.last_name,
                usuario_fbid:resf.id,
                usuario_device:'pc',
                usuario_gcmid:vm.fcmid,
                usuario_movil:'999999999'
              },
              auth : {
                username: 'admin@pickapp.com',
                password: 'PickJanaq18',
              }
            }).then(function(response){
              let res = response.data;
              console.log(res);
              if(res.tipo==1){
                localStorage.setItem("user_p_info", JSON.stringify(res.data));
                vm.felicitaciones = true;
                setTimeout(function(){
                  vm.$router.push('/admin');
                },1500);

              }else{
                vm.showAlert = "Error Api facebook ";
                vm.loginBtnLoading = false;
              }
        		}).catch(function (error) {
              console.log(error);
              vm.showAlert = "Errorerror facebook";
              vm.loginBtnLoading = false;
            });



      }else{

        action_url = apiRutas.usuario_facebook
        //action_url = 'http://localhost:8001/pickapp/api/v1/usuario/usuarioFacebook'

        axios({
          method:'post',
          //url:'http://localhost:8001/pickapp/api/v1/usuario/usuario',
          url:action_url,
          data: {

            usuario_email:resf.email,
            usuario_tipo:2,
            usuario_nombre:resf.first_name,
            usuario_apellidos:resf.last_name,
            usuario_fbid:resf.id,
            usuario_device:'pc',
            usuario_gcmid:vm.fcmid,
            usuario_movil:'999999999'
          },
          auth : {
            username: 'admin@pickapp.com',
            password: 'PickJanaq18',
          }
        }).then(function(response){
          let res = response.data;
          console.log(res);
          if(res.tipo==1){
            localStorage.setItem("user_p_info", JSON.stringify(res.data));
            vm.felicitaciones = true;
            setTimeout(function(){
              vm.$router.push('/admin');
            },1500);

          }else{
            vm.showAlert = "Error Api facebook ";
            vm.loginBtnLoading = false;
          }
        }).catch(function (error) {
          console.log(error);
          vm.showAlert = "Errorerror facebook";
          vm.loginBtnLoading = false;
        });


      }











    },registrandoLocalApi:function(){

      var vm = this;

      axios.post('/api/register', {
    		email:vm.email,
    		password:vm.password,
        usuario_nombre:vm.nombre,
        usuario_apellidos: vm.apellidos,
        usuario_movil: vm.movil, 
        usuario_tipo:vm.usuario_tipo,
        usuario_dni:vm.dni
      })
  		.then(function(response){
  			let res = response.data
  			if(res) {
  			  if(res.status==0){
              vm.registerAlert = res.error;
              vm.procesando = false;
          }else if(res.status==1){
            vm.registerAlert = "Se registró exitosamente! <div class='text-center'><strong>"+vm.email+"</strong></div>";
            //vm.registerAlert = "Se registró exitosamente!";

            vm.register_success = true;
            vm.procesando = false;


            //vm.register_success = true;

          }else{
            vm.procesando = false;
          }
  			}

  		}).catch(function (error) {
        console.log(error);
        vm.procesando = false;
      });






    },
    changeAlert: function () {
      this.showAlert = ''
    },
    validateSend: function () {
      //if(this.showSuccess!=''){
      //  this.$router.push('/admin');
      //}
      if(this.email != null && this.password != null && this.pais != ''){
        console.log('done!')

        if(this.loginOptionActive=='empresa'){
          this.loginExterno();
          //this.loginExternoSintad();
        }else{
          this.loginApi();
        }

      } else{
        console.log('fail')
        this.showAlert = 'Llene todos los campos del formulario'
      }
    },
    loginExternoSintad: function () {

      let form = document.createElement( "form" );
      form.setAttribute( "name", "formulario" );
      form.setAttribute( "id", "loginForm" );
      form.setAttribute( "action", "http://scharff.sintad.pe/Verifylogin" );

      form.setAttribute( "method", "post" );
      form.setAttribute( "target", "_blank" );

      let USU = document.createElement( "input" );
      USU.setAttribute( "name", "usuario" );
      USU.setAttribute( "type", "hidden" );
      USU.setAttribute( "value", this.email );

      let PWD = document.createElement( "input" );
      PWD.setAttribute( "name", "pass" );
      PWD.setAttribute( "type", "hidden" );
      PWD.setAttribute( "value", this.password);

      let cmbPais = document.createElement( "input" );
      cmbPais.setAttribute( "name", "cmbPais" );
      cmbPais.setAttribute( "type", "hidden" );
      cmbPais.setAttribute( "value", this.pais.value);

      form.appendChild( cmbPais );
      form.appendChild( USU );
      form.appendChild( PWD );
      document.getElementsByTagName( "body" )[0].appendChild( form );
      document.formulario.submit();
      this.removeChildForm()



    },
    loginExterno: function () {

      let form = document.createElement( "form" );
      form.setAttribute( "name", "formulario" );
      form.setAttribute( "id", "loginForm" );
      form.setAttribute( "action", "http://200.37.50.50/Servicios/CorporativoV2/logRedir.asp" );

      form.setAttribute( "method", "post" );
      form.setAttribute( "target", "_blank" );

      let USU = document.createElement( "input" );
      USU.setAttribute( "name", "USU" );
      USU.setAttribute( "type", "hidden" );
      USU.setAttribute( "value", this.email );

      let PWD = document.createElement( "input" );
      PWD.setAttribute( "name", "PWD" );
      PWD.setAttribute( "type", "hidden" );
      PWD.setAttribute( "value", this.password);

      let cmbPais = document.createElement( "input" );
      cmbPais.setAttribute( "name", "cmbPais" );
      cmbPais.setAttribute( "type", "hidden" );
      cmbPais.setAttribute( "value", this.pais.value);

      form.appendChild( cmbPais );
      form.appendChild( USU );
      form.appendChild( PWD );
      document.getElementsByTagName( "body" )[0].appendChild( form );
      document.formulario.submit();
      this.removeChildForm()
    },
    removeChildForm: function () {
      let formula = document.getElementById("loginForm")
      formula.parentNode.removeChild(formula)
      this.email = null,
      this.password = null,
      this.pais = { name: 'Perú', value: 'P'}
      this.closeModal()
      return false
    },
    closeModal: function () {
      this.$emit('closeLoginModal')
    },
    createAccount: function () {
      this.$emit('closeLoginActive')
    },
    remAccount: function () {
      this.rememberAccount = true;
    },
    selectPais: function (item) {
      this.pais = item
    },cambiaLogin: function () {
      this.loginOptionActive = this.loginOptionActive=='empresa' ? 'personas' : 'empresa';
      return false;
    },
    loginApi:function(){
      var vm = this;
      vm.showAlert = '';
      vm.showSuccess =  '';
      vm.loginBtnLoading = true;
      axios({
        method:'post',
        url:apiRutas.usuario_login,

        data: {
          usuario_email:vm.email,
        	usuario_clave:vm.password,
        	usuario_device:"pc",
        	usuario_tipo:2,
        	//usuario_nombredispositivo:"sss",
        	usuario_gcmid:vm.fcmid
        },
        auth : {
          username: 'admin@pickapp.com',
          password: 'PickJanaq18',
        }
      })
  		.then(function(response){
        let res = response.data;
        if(res.tipo==1){
          //vm.showSuccess = 'Logueado con exito';
          //vm.showAlert = '';
          console.log('tefaaaaaaaa');
          console.log(res.data.usuario2);
          vm.loginEnLocal(res.data);
          localStorage.setItem("user_p_info", JSON.stringify(res.data));
        }else{
          vm.showAlert = 'Credenciales incorrectos';
          vm.loginBtnLoading = false;
        }

  		}).catch(function (error) {
        console.log('error');
        vm.loginBtnLoading = false;
        vm.showAlert = 'Se ha producido un error';
        console.log(error);
      });
    },loginEnLocal:function(userDataPS){

      var vm = this;

      axios.post('/api/login', {
        user:vm.email,
        password:vm.password,
        userApi:userDataPS.usuario2
      })
      .then(function(response){
        let res = response.data;
        console.log(res);
        if(res.status==1){

          //recordar aquii
          if(vm.recordar){
            localStorage.setItem("frecuente", vm.email);
            localStorage.setItem("mac", vm.password);
          }else{
            localStorage.removeItem("frecuente");
            localStorage.removeItem("mac");
          }



          //vm.showSuccess = 'Logueado con exito';
          vm.felicitaciones = true;

          setTimeout(function(){
            vm.$router.push('/admin');
            vm.loginBtnLoading = false;
          },1000);

        }else{
          if(res.error=='user es inválido.'){
            vm.procedeRegistroApiB(userDataPS);
          }else{
            vm.showAlert = res.error;
            vm.loginBtnLoading = false;
          }
        }


  		}).catch(function (error) {
        console.log(error);
        vm.loginBtnLoading = false;
        vm.showAlert = "Error iniciando sesión";
      });



    },
    procedeRegistroApiB:function(userDataPS){
      var vm = this;

      axios.post('/api/register', {
    		email:userDataPS.usuario_email,
    		password:vm.password,
        usuario_nombre:userDataPS.usuario_nombre,
        usuario_apellidos: userDataPS.usuario_apellidos,
        usuario_movil: userDataPS.usuario_movil, 
        usuario_tipo:userDataPS.usuario_tipo,
        usuario_dni:userDataPS.usuario_dni
      })
  		.then(function(response){
  			let res = response.data
  			if(res) {
  			  if(res.status==1){

            vm.loginEnLocal(userDataPS);

          }else {
            vm.showAlert = "Error iniciando sesión";
          }
          vm.loginBtnLoading = false;

  			}

  		}).catch(function (error) {
        vm.showAlert = "Error iniciando sesión";
        vm.loginBtnLoading = false;
      });

    },
    gotoAdmin:function(){
      if(this.nombreUsuario==='Superadmin'){
        document.location ='/superadmin';
      }else{
        this.$router.push('/admin');
      }

      document.title='Scharff - Grupo Scharff'
    },
    recuperarClave:function(){
      var vm = this;
      vm.btn_reset_ocupado = true;



      axios({
        method:'post',
        url:apiRutas.usuario_resetear,
        data: {
          usuario_email:vm.email,
          usuario_tipo:2,
        },
        auth : {
          username: 'admin@pickapp.com',
          password: 'PickJanaq18',
        }
      })
      .then(function(response){
        let res = response.data;
        if(res.tipo==1){
          let lanuevaclave = atob(res.temporal_attr);
          vm.recuperarClaveLocal(lanuevaclave);
        }else{
          vm.showAlertRec = res.mensajes;
          vm.showSuccessRec = '';
          vm.btn_reset_ocupado=false;
        }
  		}).catch(function (error) {
        console.log(error);
        vm.showAlertRec = "Ha ocurrido un error";
        vm.showSuccessRec = '';
        vm.btn_reset_ocupado = false;
      });
    },recuperarClaveLocal:function(cla){
      var vm = this;
      axios({
        method:'post',
        url:'/api/reseteard',
        data: {
          usuario_clave:cla,
          usuario_email:vm.email,
        }
      })
      .then(function(response){
        let res = response.data;
        console.log(res);
        if(res==1){
          vm.showSuccessRec = 'Se le ha enviado un <br />correo de recuperacion de contraseña';
          vm.showAlertRec = '';
          setTimeout(function(){
            vm.rememberAccount = false;
          },4500);

        }else{
          vm.showAlertRec = res.mensajes;

          vm.showSuccessRec = '';
        }
        vm.btn_reset_ocupado = false;
  		}).catch(function (error) {
        console.log(error);
        vm.showAlertRec = "Ha ocurrido un error";
        vm.showSuccessRec = '';
        vm.btn_reset_ocupado = false;
      });






    }
















  },
  components: {
    'vue-select':vueSelect
  }

}
</script>

<style lang="scss">
@import "../../scss/vars.scss";
.login-sucess-alert{
  font-size: 0.9rem;
    color: #1c2aff;
    padding-top: 12px;
}
.login-error-alert {
    padding-top: 12px;
}
.login-style .social-btn.facebook{
  width: 100%;
padding-left: 68px;
cursor:pointer;
}
.btn-active.btn--disabled {
    background-color: #cecece !important;
    color: #fff !important;
}
.login-felicitaciones p{
  font-size: 20px;
  margin-bottom: 4px;
  }
  .login-felicitaciones strong{
  font-size: 22px;
margin-bottom: 9px;
display: block;
}
  .header.login-felicitaciones {
    padding: 45px 0 63px;
}
.login-screen-loading{
  position: relative;
}


.login-loading-screen{
  position: absolute;
      top: 0;
      left: 0;
      background: rgba(255, 255, 255, 0.9);
      width: 100%;
      height: 100%;
      align-items: center;
      justify-content: center;
      display: none;
}
.login-screen-loading-w-active .login-loading-screen{
  display: flex;
}
.login-loading-screen.login-loading-screen-success{
  background: #fff;
}
.login-loading-screen circle{
      stroke: #ff535a;
}
</style>
