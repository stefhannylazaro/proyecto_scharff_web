<template>
  <div class="text-center font-regular">
    <h3 class="font-bold mb-3">Tu información de cuenta</h3>

    <div class="input-cuenta-details">
      <input type="text" placeholder="Nombre" v-model="usuario_nombre" style="width:100%;">
      <input type="text" placeholder="Apellidos" v-model="usuario_apellidos" style="width:100%;">
      <!-- <select v-model="select_document" style="width:100%;">
        <option value="" disabled>Selecciona tipo de documento</option>
        <option v-for="item in list_documents" v-bind:value="item.name" v-text="item.name"></option>
      </select> -->
      <input type="number" class="sinflechas" placeholder="DNI" style="width:100%;" v-model="usuario_dni" maxlength="12" onkeydown="return !(event.keyCode == 69||event.keyCode == 189||event.keyCode == 187||event.keyCode == 190)">
      <input type="number" class="sinflechas" placeholder="Movil" style="width:100%;" v-model="usuario_movil" onkeydown="return !(event.keyCode == 69||event.keyCode == 189||event.keyCode == 187||event.keyCode == 190)">

      <input type="text" placeholder="Correo" style="width: 100%;" v-model="usuario_email">
      <input type="text" placeholder="RUC" style="width: 100%;" v-model="usuario_ruc" maxlength="11">
      <input type="text" placeholder="Razón social" style="width: 100%;" v-model="usuario_razonsocial">
      <input type="password" placeholder="nueva contraseña" style="width: 100%;" v-model="nueva_clave" @keyup="alerta_precambio=''">
      <input type="password" placeholder="repetir contaseña" style="width:100%;" v-model="nueva_clave_confirma" @keyup="alerta_precambio=''">
      <!-- <div class="mt-3"></div> -->
      <span class="error-msg-email" v-show="errorRuc">Ingresa un RUC válido</span>
      <span class="error-msg-email" v-show="errorDocumento">Ingresa un documento válido</span>
      <span class="error-msg-email" v-show="errorMovil">Ingresa teléfono válido</span>
      <span class="error-msg-email" v-show="errorEmail">Ingresa un correo válido</span>
      <span class="error-msg-email" v-show="errorNombre">Ingresa nombre válido (solo letras)</span>
      <span class="error-msg-email" v-show="errorApellido">Ingresa apellidos válido (solo letras)</span>
    </div>

    <div>
      <p v-if="alerta_precambio" v-text="alerta_precambio"></p>
      <v-btn round :disabled="btn_cambia_op" :loading="btn_cambia_op" class="mb-3 btn-active elevation-0 btn--round" @click="guardarPanelCuenta">Guardar cambios</v-btn>
      <div><p class="blue--text" v-text="notifica_cambio"></p></div>
    </div>
  </div>
</template>

<script>
import axios from 'axios'
import * as apiRutas from '../config/apiRutas';
export default {
  props:['userData'],
  data () {
    return {
      e1: 0,
      nombreApellidos:'',
      // asd
      usuario_nombre:'',
      usuario_apellidos:'',
      usuario_tipo:'',

      usuario_email:'',
      usuario_dni:'',
      usuario_movil:'',
      usuario_ruc:'',
      usuario_razonsocial:'',
      // asd

      errorRuc: false,
      errorEmail: false,
      errorMovil: false,
      errorDocumento: false,
      errorNombre: false,
      errorApellido: false,
      errorInput: false,
      nueva_clave:'',
      nueva_clave_confirma:'',
      notifica_cambio:'',
      alerta_precambio:'',
      btn_cambia_op:false,
      notificaTimer:null,
      select_document:"",
      list_documents: [
        {id:1, name:"DNI"},
        {id:2, name:"Pasaporte"},
        {id:3, name:"Carnet"}
      ],
    }
  },
  mounted(){
    this.cargaLocalstoredUserDatos();

    this.$parent.$on('loadLocalstoredData', this.cargaLocalstoredUserDatos);
  },
  computed: {
  },
  watch: {
    usuario_dni: function(el) {
      if(el==''){
        this.errorDocumento = false;
      } else {
        if(this.usuario_dni!=undefined){
          if(this.usuario_dni.length<=12 && this.usuario_dni.length>=8){
            this.errorDocumento = false;
          }else{
            this.errorDocumento = true;
          }
        }
      }
    },
    usuario_nombre: function(el) {
      var ree = /^[a-zA-ZÀ-ÿ\u00f1\u00d1]+(\s*[a-zA-ZÀ-ÿ\u00f1\u00d1]*)*[a-zA-ZÀ-ÿ\u00f1\u00d1]+$/g;
      if(el==''){
        this.errorNombre = true;
      } else {
        if(this.usuario_nombre!=undefined){
          if(ree.test(this.usuario_nombre.toLowerCase())){
            this.errorNombre = false;
          } else {
            this.errorNombre = true;
          }
        }
      }
    },
    usuario_apellidos: function(el) {
      var ree = /^[a-zA-ZÀ-ÿ\u00f1\u00d1]+(\s*[a-zA-ZÀ-ÿ\u00f1\u00d1]*)*[a-zA-ZÀ-ÿ\u00f1\u00d1]+$/g;
      if(el==''){
        this.errorApellido = true;
      } else {
        if(this.usuario_apellidos!=undefined){
          if(ree.test(this.usuario_apellidos.toLowerCase())){
            this.errorApellido = false;
          } else {
            this.errorApellido = true;
          }
        }
      }
    },
    usuario_movil: function(el) {
      if(el==''){
        this.errorMovil = false;
      } else {
        if(this.usuario_movil!=undefined){
          if(this.usuario_movil.length>=6){
            this.errorMovil = false;
          }else{
            this.errorMovil = true;
          }
        }
      }
    },
    usuario_ruc: function(el) {
      if(el==''){
        this.errorRuc = false;
      } else {
        if(this.usuario_ruc!=undefined){
          if(this.usuario_ruc.length==11){
            this.errorRuc = false;
          }else{
            this.errorRuc = true;
          }
        }
      }
    },
    usuario_email: function(el) {
      var ree = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
      if(el==''){
          this.errorEmail = true;
        } else {
          if(this.usuario_email!=undefined){
            if(ree.test(this.usuario_email.toLowerCase())){
              this.errorEmail = false;
            } else {
              this.errorEmail = true;
            }
          }
        }
    }
  },
  methods:{
    cargaLocalstoredUserDatos:function(){
      var pro = this.getLocalUser();

      this.usuario_apellidos = pro.usuario_apellidos;
      this.usuario_dni = pro.usuario_dni;
      this.usuario_email = pro.usuario_email;
      this.usuario_movil = pro.usuario_movil;
      this.usuario_nombre = pro.usuario_nombre;
      this.usuario_razonsocial = pro.usuario_razonsocial;
      this.usuario_ruc = pro.usuario_ruc;
    },
    guardarPanelCuenta:function(){
      var vm = this;
      vm.alerta_precambio='';
      vm.notifica_cambio='';
      clearTimeout(vm.notificaTimer);
      // vm.cambiar_datos_local();
      // return false;
      console.log("LLEGA?");

      if(vm.nueva_clave!=vm.nueva_clave_confirma){
        vm.alerta_precambio = "Las contraseñas no coenciden."
        vm.nueva_clave='';
        vm.nueva_clave_confirma='';
        vm.notificaTimer = setTimeout(function(){vm.alerta_precambio = "";},8000);
        return false;
      }

      if(vm.nueva_clave!=''&&vm.nueva_clave.length<6){
        vm.alerta_precambio = "Las contraseña debe tener minimo 6 caracteres."
        vm.nueva_clave='';
        vm.nueva_clave_confirma='';
        vm.notificaTimer = setTimeout(function(){vm.alerta_precambio = "";},10000);
        return false;
      }

      vm.btn_cambia_op = true;

      var cambiar_clave = 0;
      if(vm.nueva_clave.length>4){
        cambiar_clave = 1;
      }

      var p_token = localStorage.getItem("p_token");
      var pro = localStorage.getItem("user_p_info");
      pro = JSON.parse(pro);
      var token = pro.token;
      let usuario_id = pro.id;
      let usuario_id2 = pro.usuario2;
      //
      vm.errorInput = false;
      if(vm.errorNombre||vm.errorEmail||vm.errorApellido||vm.errorDocumento||vm.errorMovil||vm.errorRuc){
        vm.errorInput = true;
        vm.btn_cambia_op = false;
        return;
      }
      //
      axios({
        method: 'post',
        url:'/api/cambiar_datos',
        data: {
          usuario_apellidos:vm.usuario_apellidos,
          usuario_dni:vm.usuario_dni,
          usuario_email:vm.usuario_email,
          usuario_movil:vm.usuario_movil,
          usuario_nombre:vm.usuario_nombre,
          usuario_razonsocial:vm.usuario_razonsocial,
          usuario_ruc:vm.usuario_ruc,

          cambiar_clave,
          usuario_clave: vm.nueva_clave,
          usuario_clave: vm.nueva_clave,
          usuario_id,
          usuario_id2,
        },
        auth : {
          username: 'admin@pickapp.com',
          password: 'PickJanaq18',
        }


      }).then(function(response){
        //console.log(response);

        let res = response.data;
        if(res.status == 1){
          //vm.cambiar_datos_local();
          vm.notifica_cambio = "Se cambió los datos exitosamente."


          var pro = vm.getLocalUser();

          pro.usuario_apellidos = vm.usuario_apellidos;
          pro.usuario_dni = vm.usuario_dni;
          pro.usuario_email = vm.usuario_email;
          pro.usuario_movil = vm.usuario_movil;
          pro.usuario_nombre = vm.usuario_nombre;
          pro.usuario_razonsocial = vm.usuario_razonsocial;
          pro.usuario_ruc = vm.usuario_ruc;

          vm.setLocalUser(pro)
        }else{
          vm.notifica_cambio = "No se pudo cambiar datos.";
        }
        vm.btn_cambia_op = false;
        vm.notificaTimer = setTimeout(function(){vm.notifica_cambio = "";},5000);
      }).catch(function (error) {
        vm.btn_cambia_op = false;
        vm.notifica_cambio = "Error al cambiar datos."
        vm.notificaTimer = setTimeout(function(){vm.notifica_cambio = "";},5000);
      });

      //this.$emit('guardarPanelCuenta', 1);
    },
    cambiar_datos_local:function(){
      var vm = this;

      axios({
        method:'post',
        url:'/api/cambiar_datos',
        data: {
          usuario_nombre: vm.usuario_nombre,
          usuario_apellidos: vm.usuario_apellidos,
          usuario_email: vm.usuario_email,
          usuario_clave: vm.nueva_clave
        }
      })
      .then(function(response){
        console.log(response);
        if(response.data.status==1){
          vm.notifica_cambio = "Se cambió los datos exitosamente."
          setTimeout(function(){vm.notifica_cambio = "";},7000);
          vm.nueva_clave='';
          vm.nueva_clave_confirma='';
          vm.btn_cambia_op = false;
          vm.$emit('guardarPanelCuenta', 1);
        }else{
          vm.notifica_cambio = "No se pudo cambiar datos."
          setTimeout(function(){vm.notifica_cambio = "";},5000);
          vm.btn_cambia_op = false;
        }
      }).catch(function (error) {
        vm.notifica_cambio = "No se pudo cambiar datos."
        setTimeout(function(){vm.notifica_cambio = "";},5000);
        vm.btn_cambia_op = false;
      });
    }
  }

}
</script>

<style lang="scss">
@import "../../scss/vars.scss";
.input-cuenta-details input, .input-cuenta-details select{
  border: solid 0.1rem #000;
  padding: 0.2rem;
  margin-top: 0.5rem;
  border-radius: 0px;
  -moz-appearance: textfield;
}
select {
  -webkit-appearance: none;
  -moz-appearance: none;
  background: transparent;
  background-image: url("data:image/svg+xml;utf8,<svg fill='black' height='24' viewBox='0 0 24 24' width='24' xmlns='http://www.w3.org/2000/svg'><path d='M7 10l5 5 5-5z'/><path d='M0 0h24v24H0z' fill='none'/></svg>");
  background-repeat: no-repeat;
  background-position-x: 100%;
}

.input-cuenta-details {
  padding: 17px 0 30px;
}
.block-factura {
  .input-create {
    label {
      color: #333 !important;
    }
    .input-group__details {
      display: none;
    }
  }
  .input-factura {
    margin: 10px 0 10px;
    input {
      margin-bottom: 5px;
      width: 250px;
      max-width: 100%;
      border-bottom: solid 1px;
      outline: none;
      padding-left: 1rem;
      padding-top: 12px;
    }
  }
}


</style>
