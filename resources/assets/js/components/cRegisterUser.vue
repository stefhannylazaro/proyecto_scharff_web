<template>
 	<v-card class="white--text elevation-0 create-user px-5 pt-4" :class="{'register_success':register_success}">
		<div class="register-form">
      <div class="" v-if="!register_success">


  			<div class="user-anonimous py-4">
  				<img src="../../img/icon_login.png" alt="">
  				<div class="text">
  					<span>HOLA</span>
  					<H4>Usuario</H4>
  				</div>
  			</div>
  			<!--<div class="type-account">
  				<h4 class="mb-0">Quieres una cuenta para</h4>
  				<v-btn round small  :outline="usuario_tipo==2" class="btn-create person " :class="{'white black--text':usuario_tipo==1}" @click="ch_tipoCuenta('persona')">Persona</v-btn>
  				<v-btn @click="ch_tipoCuenta('empresa')" round small :outline="usuario_tipo==1" :class="{'white black--text':usuario_tipo==2}"  class="btn-create company">Empresa</v-btn>
  			</div>-->
  			<div>

          <v-text-field
  					class="white--text input-create" :class="{'input-invalid': errorName}"
  					name="input-1-1"
  					label="Nombre"
            single-line
            v-model="nombre"
            tabindex="1"

  				></v-text-field>

          <v-text-field
  					class="white--text input-create" :class="{'input-invalid': errorApellidos}"
  					name="input-1-2"
  					label="Apellidos"
            single-line
            v-model="apellidos"
            tabindex="2"
  				></v-text-field>

          <!-- <v-text-field
  					class="white--text input-create" :class="{'input-invalid': errorDNI}"
  					name="input-1-3"
  					label="DNI"
  					single-line
  					v-model="dni"
            tabindex="3"
  				></v-text-field> -->


          <!-- <v-text-field
  					class="white--text input-create" :class="{'input-invalid': errorMovil}"
  					name="input-1-5"
  					label="Celular"
            single-line
            v-model="movil"
            tabindex="5"

  				></v-text-field> -->



  				<v-text-field
  					class="white--text input-create" :class="{'input-invalid': errorEmail}"
  					name="username"
  					label="Correo eletrónico"

  					single-line
  					type="email"
  					v-model="email"
            tabindex="4"

  				></v-text-field>

  				<v-text-field
  					class="white--text input-create" :class="{'input-invalid': errorPass}"
  					name="input-1-6"
  					label="Contraseña"
  					single-line
  					type="password"
  					v-model="password"
            tabindex="6"
  				></v-text-field>
  				<v-text-field
  					class="white--text input-create" :class="{'input-invalid': errorPassC}"
  					name="input-1-7"
  					label="Confirmar contraseña"
  					single-line
  					type="password"
  					v-model="password_c"
            tabindex="7"

  				></v-text-field>
  			</div>
  			<div class="register-checkbox"style="display:flex">
  				<v-checkbox
  					class="white--text input-create check"
  					label=""
  					v-model="checkbox"
  					@change="verificarCheck"
  					@blur="verificarCheck"
  					required
            tabindex="8"
  				></v-checkbox>
  				<span class="pt-1 pl-1">He leído y acepto los <a  href="" @click.prevent="$emit('open_terminos')">Términos y Condiciones de Uso</a> de esta web</span>
  			</div>
      </div>
      <div class="text-center" v-if="registerAlert">



        <span v-if="registerAlert=='correo_usado'" class="red-text" :class="{'blue-text':register_success}">El correo electrónico ya se encuentra registrado. Inténtalo con otro o <span @click="$emit('register_success');">Inicia sesión aquí</span></span>
        <span v-else class="red-text" :class="{'blue-text':register_success}" v-html="registerAlert"></span>


        <div v-if="register_success" style="margin-right:-30px;margin-left:-30px">
          <br>
          <v-btn round class=" btn-active create elevation-0" tabindex="9" @click.native="$emit('register_success');">Iniciar sesión</v-btn>
        </div>
      </div>
			<div class="register-btn-create mt-1 mb-3">
				<v-btn round :disabled="procesando" :loading="procesando" v-if="!register_success" class=" btn-active create elevation-0" @click="registrarApi">Crear cuenta</v-btn>
			</div>




<br>


			<div class="register-social" v-if="!register_success">
        <div class="social-btn facebook">
           <i>
             <svg style="width:24px;height:24px" viewBox="0 0 24 24">
                 <path style="fill:white;" d="M5,3H19A2,2 0 0,1 21,5V19A2,2 0 0,1 19,21H5A2,2 0 0,1 3,19V5A2,2 0 0,1 5,3M18,5H15.5A3.5,3.5 0 0,0 12,8.5V11H10V14H12V21H15V14H18V11H15V9A1,1 0 0,1 16,8H18V5Z" />
             </svg>
           </i>
           <span v-if="startfb"><fb-signin-button
           :params="fbSignInParams"
           @success="onSignInSuccess"
           @error="onSignInError">
           Regístrate con Facebook
           </fb-signin-button></span>

         </div>


				<div class="social-btn google" v-if="false">
					<img class="social-img" src="../../img/google-icon.png" alt="Logotipo google">
					<span>Regístrate</span>
				</div>
			</div>

      <div v-if="faceAlert[0]" :class="{'red--text':faceAlert[0]=='error','red--blue':faceAlert[0]=='success'}" class="small-text text-center" v-text="faceAlert[1]">

      </div>
		</div>

	</v-card>
</template>

<script>

import axios from 'axios'
import * as apiRutas from '../config/apiRutas';
export default {
  props:['referencia'],
  data () {
    return {
        checkbox: false,
        nombre:'',
    		email:'',
    		password:'',
    		password_c:'',
        registerAlert:null,
        errorName:false,
        errorEmail:false,
        errorPass:false,
        errorPassC:false,
        procesando:false,
        register_success:false,
        errorApellidos:false,
        apellidos:'',
        errorMovil:false,
        dni:'',
        errorDNI:false,
        movil:'',
        usuario_tipo:2,
        fbSignInParams: {
          scope: 'email',
          return_scopes: true
        },
        startfb:false,
        faceAlert:['','']

    }
  },mounted(){
    var vm = this;

    setTimeout(function(){
      vm.startfb = true
    },1000);



  },
  methods:{
    onSignInSuccess (response) {
      this.registerAlert='';
    var vm = this;
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
            vm.faceAlert = ['success','Inicio exitoso.'];
            resf.user_id=res.data.id;//add
            vm.loginFacebookApi(resf,'login');

          }else if(res.status==2){

            //localStorage.setItem("user_p_info", JSON.stringify(res.data));

            vm.faceAlert = ['success','Registrado con exito.'];
            vm.loginFacebookApi(resf,'reg');


          }else{
            console.log("Error facebook");
            vm.faceAlert = ['error','Un error ha ocurrido.'];
          }

        }).catch(function (error) {
          console.log("Error facebookk");
          console.log(error);
        });


      }
    );
  },
  onSignInError (error) {
    this.registerAlert='';
    console.log('facebook login error ');


    var vm = this;

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

        vm.loginFacebookApi(resf,'login');

      }else if(res.status==2){

        vm.loginFacebookApi(resf,'reg');
      }else{
        vm.faceAlert = ['error','Un error ha ocurrido.'];
      }

    }).catch(function (error) {
      console.log(error);
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
              usuario_movil:'999999999',
              usuario_web_id:(typeof resf.user_id !== 'undefined')? resf.user_id:''//add
            },
            auth : {
              username: 'admin@pickapp.com',
              password: 'PickJanaq18',
            }
          }).then(function(response){
            let res = response.data;
            console.log(res);
            if(res.tipo==1){
              vm.showSuccess = 'Registrado con exito';
              localStorage.setItem("user_p_info", JSON.stringify(res.data));
              setTimeout(function(){
                vm.$router.push('/admin');
              },1500);

            }else{
              vm.faceAlert = ['error','Un error ha ocurrido.'];
            }
          }).catch(function (error) {
            console.log(error);
            vm.faceAlert = ['error','Un error ha ocurrido.'];
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
          vm.faceAlert = ['success','Inicio exitoso.'];


          localStorage.setItem("user_p_info", JSON.stringify(res.data));
          setTimeout(function(){
            vm.$router.push('/admin');
          },1500);

        }else{
          vm.faceAlert = ['error','Un error ha ocurrido.'];
        }
      }).catch(function (error) {
        console.log(error);
        vm.faceAlert = ['error','Un error ha ocurrido.'];
      });


    }

  },





    registrarApi:function () {
      this.faceAlert=['',''];
      this.registerAlert = '';
      if(this.procesando){
        console.log("click ignorado");
        return;
      }

      var vm=this;
      vm.errorName=false;
      vm.errorEmail=false;
      vm.errorPass=false;
      vm.errorPassC=false;
      vm.errorApellidos=false;



      if(vm.email==''){
        vm.errorEmail = true;
      }

      if(vm.nombre==''){
        vm.errorName = true;
      }

      if(vm.apellidos==''){
        vm.errorApellidos = true;
      }


      if(vm.password==''){
        vm.errorPass = true;
      }


      if(vm.errorPass||vm.errorApellidos||vm.errorName||vm.errorEmail||vm.errorPass){
        vm.registerAlert = 'Llene todos los campos del formulario';
        return;
      }

      var ree = /^[a-zA-ZÀ-ÿ\u00f1\u00d1]+(\s*[a-zA-ZÀ-ÿ\u00f1\u00d1]*)*[a-zA-ZÀ-ÿ\u00f1\u00d1]+$/g;
      if(!ree.test(this.nombre.toLowerCase())){
        vm.registerAlert='Ingrese un nombre válido (solo letras).';
        vm.errorName = true;
        return;
      }


      var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
      if(!re.test(this.email.toLowerCase())){
        vm.registerAlert='Ingrese un email válido';
        vm.errorEmail = true;
        return;
      }

      if(vm.password !== vm.password_c){
        vm.registerAlert = "Debes confirmar tu contraseña";
        vm.errorPassC = true;
        return;
      }


      if(!vm.checkbox){
        vm.registerAlert = "Debe aceptar las condiciones para continuar";
        return;
      }

      vm.procesando = true;

      


//vm.ga('send', 'event', 'Register', 'click');
      axios({
        method:'post',
        url:apiRutas.usuario_usuario,
        data: {
          usuario_email:vm.email,
          usuario_nombre:vm.nombre,
          usuario_apellidos :vm.apellidos,
          // usuario_movil :vm.movil,
          // usuario_dni :vm.dni,
          usuario_tipo :2,
          usuario_clave :vm.password,
          usuario_device :'pc',
          usuario_nombredispositivo :'',
          usuario_gcmid:vm.fcmid

        },
        auth : {
          username: 'admin@pickapp.com',
          password: 'PickJanaq18',
        }
      })
  		.then(function(response){
        let res = response.data;
        //console.log(res);
        if(res.tipo==1){
          vm.registrandoLocalApi(res.data.usuario2);

        }else{
          vm.procesando = false;
          vm.registerAlert = res.mensajes[0];
        }


  		}).catch(function (error) {
        console.log(error);
        vm.procesando = false;
      });



    },
    registrandoLocalApi:function(usuario2){

      var vm = this;



      var referencia = null;

      if(vm.referencia){
        referencia = vm.referencia;
      }

      axios.post('/api/register', {
    		email:vm.email,
    		password:vm.password,
        usuario_nombre:vm.nombre,
        usuario_apellidos: vm.apellidos,
        usuario_movil: vm.movil, 
        usuario_tipo:vm.usuario_tipo,
        usuario_dni:vm.dni,
        usuario_usuario2:usuario2,
        referencia
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

            vm.$ua.trackEvent('Register', 'click');
            //vm.avisarDelID(res.user_id);
          }else{
            vm.procesando = false;
          }
  			}

  		}).catch(function (error) {
        console.log(error);
        vm.procesando = false;
      });






    },
    avisarDelID:function(user_id){
      var vm = this;

      axios.post('/api/coordinar-userids', {
    		email:vm.email,
        user_id
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
            vm.avisarDelID(res.user_id);
          }else{
            vm.procesando = false;
          }
  			}

  		}).catch(function (error) {
        console.log(error);
        vm.procesando = false;
      });
    },
    ch_tipoCuenta:function(tipo){
      this.usuario_tipo = tipo=='persona'?1:2;
    },
    procedeRegistroApiB:function(){

    },
  	verificarCheck: function(){
  		//console.log(this.checkbox)
  	},
    email_ocupado:function(){

    }
  }

}
</script>

<style lang="scss">
@import "../../scss/vars.scss";
.red-text{
  //color:#ff3636;
  color:#fff;
}
.blue-text,.red-text.blue-text{
  color: #fff;
  font-weight: bold;
  padding-top: 300px;
  display: block;
      font-size: 20px;
      margin-right: -40px;
    margin-left: -40px;
}
.input-create.input-invalid .input-group__details::before {
    background-color: red !important;
}
.input-group__details {
    min-height: 13px;
}
.user-anonimous+div{
  display: flex;
  flex-direction: column;
}
// .user-anonimous+div>div:nth-child(1){
//   order:1;
// }
// .user-anonimous+div>div:nth-child(2){
//   order:2;
// }
// .user-anonimous+div>div:nth-child(3){
//   order:3;
// }
// .user-anonimous+div>div:nth-child(4){
//   order:5;
// }
// .user-anonimous+div>div:nth-child(5){
//   order:4;
// }
// .user-anonimous+div>div:nth-child(6){
//   order:6;
// }
// .user-anonimous+div>div:nth-child(7){
//   order:7;
// }
// .user-anonimous+div>div:nth-child(8){
//   order:8;
// }

.register-social .facebook{
      width: 100%;
      padding-left: 36px;
      cursor: pointer;
}
.register-form{
  width: 100%;
}
.register_success br{
  display: none;
}
.register-form .text-center span,
.register-form .text-center small{
  display:block;
}
.register-form .text-center span{
  padding: 18px 0;
}
.register-form .text-center span span{
  display: inline-block;
  padding: 0;
  text-decoration: underline;
  cursor: pointer;
}
.register_success .register-form .text-center span {
    font-family: Carnas-Regular;
    font-weight: 400;
}
.register_success .register-form .text-center span strong{
    font-family: Carnas-Bold;
    font-weight: 400;
}
.register-checkbox {
    margin-top: 10px;
    margin-bottom: 10px;
}
</style>
