<template>
<v-app>
  <v-container>
    <v-layout>
      <v-flex class="complaints">

        <div v-if="!completeForm" class="container-top font-regular text-center">
          <h2 class="mb-3 mt-4 pt-5">
            Registro de usuario
          </h2>

        </div>

        <div class="form font-regular container">
          <div class="user">

            <div>

              <v-text-field
                label="Solo"
                single-line
                solo
              ></v-text-field>


              <v-text-field
      					:class="{'input-invalid': errorName}"
      					name="input-1-1"
      					label="Nombre"


                tabindex="1"

      				></v-text-field>

              <v-text-field
      					class="white--text input-create" :class="{'input-invalid': errorApellidos}"
      					name="input-1-2"
      					label="Apellidos"

                v-model="apellidos"
                tabindex="2"
      				></v-text-field>

              <v-text-field
      					class="white--text input-create" :class="{'input-invalid': errorDNI}"
      					name="input-1-3"
      					label="DNI"

      					v-model="dni"
                tabindex="3"
      				></v-text-field>


              <v-text-field
      					class="white--text input-create" :class="{'input-invalid': errorMovil}"
      					name="input-1-5"
      					label="Celular"

                v-model="movil"
                tabindex="5"

      				></v-text-field>



      				<v-text-field
      					class="white--text input-create" :class="{'input-invalid': errorEmail}"
      					name="username"
      					label="Correo eletrónico"


      					type="email"
      					v-model="email"
                tabindex="4"

      				></v-text-field>

      				<v-text-field
      					class="white--text input-create" :class="{'input-invalid': errorPass}"
      					name="input-1-6"
      					label="Contraseña"

      					type="password"
      					v-model="password"
                tabindex="6"
      				></v-text-field>
      				<v-text-field
      					class="white--text input-create" :class="{'input-invalid': errorPassC}"
      					name="input-1-7"
      					label="Confirmar contraseña"

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




















            <v-layout row wrap class="pb-3">
              <v-flex xs12 class="mb-3 input-complaints">
                <span class="font-bold">Nombre <i>*</i></span><br>
                <input type="text" class="input" v-model="userName" v-on:keyup="userNameInvalid=false;" v-bind:class="{'is-invalid': userNameInvalid}" >
              </v-flex>




              <v-flex xs12 class="mb-3 input-complaints">
                <span class="font-bold">Domicilio <i>*</i></span><br>
                <input type="text" class="input" v-model="userAddress"  v-on:keyup="userAddressInvalid=false;" v-bind:class="{'is-invalid': userAddressInvalid}" >
              </v-flex>
              <v-flex xs12 sm6 class="mb-3 input-complaints" :class="{'pr-2': isDesktop}">
                <span class="font-bold">DNI / CE <i>*</i></span><br>
                <input type="number" class="input" :class="{'is-invalid': dniInvalid}" v-model="userDNI">
                <div>
                  <span class="error-msg-email" v-if="dniInvalid" >Ingrese un DNI valido (entre 8 a 15 caracteres).</span>
                </div>
              </v-flex>
              <v-flex xs12 sm6 class="mb-3 input-complaints" :class="{'pl-2': isDesktop}">
                <span class="font-bold">Teléfono <i>*</i></span><br>
                <input type="number" class="input" :class="{'error-field': phoneInvalid}" v-model="userPhone">
                <div>
                  <span class="error-msg-email" v-if="phoneInvalid" >Ingrese un telefono valido (entre 9 a 15 caracteres).</span>
                </div>
              </v-flex>
              <v-flex xs12 class="mb-3 input-complaints">
                <span class="font-bold">Correo electrónico <i>*</i></span><br>
                <input type="email" class="input" :class="{'error-field': userEmailInvalid }" v-model="userEmail" name="email" v-validate="'required|email'">
                <span class="error-msg-email" v-show="userEmailInvalid">ingresa un correo valido</span>
              </v-flex>
              <v-flex xs12 class="mb-3 input-complaints">
                <span class="font-bold">Nombre del Padre o Madre (En caso de ser menor de edad):</span><br>
                <span class="font-bold"><b>*</b>Nombre/Domicilio/Teléfono/Correo</span><br>
                <textarea name="" id="" cols="30" class="input" rows="5" v-model="legalRepresentative"></textarea>
              </v-flex>
            </v-layout>
            <div class="user">
              <v-layout row wrap class="pb-3">
                <v-flex xs12 class="input-complaints">
                  <p>2. Idetificación del Bien Contratado (Marca Uno) <i style="color:#ff535a;">*</i> <span class="inline-red" v-if="bienContratadoInvalid" >Seleccione un Bien contratado.</span></p>
                  <v-radio-group v-model="bienContratado" row :mandatory="false" class="pt-0">
                    <!-- <v-radio label="Producto" color="red darken-1" value="Producto"></v-radio> -->
                    <v-radio label="Servicio" color="red darken-1" value="Servicio"></v-radio>
                  </v-radio-group>

                </v-flex>
                <v-flex xs12 class="input-complaints">
                  <span class="font-bold">Tipo de moneda <i>*</i></span> <span class="inline-red" v-if="typeCurrencyInvalid" >Seleccione un tipo de moneda.</span><br>
                  <v-radio-group v-model="typeCurrency" row :mandatory="false" class="pt-2">
                    <v-radio v-for="(el, x) in availableCurrency" :key="x" :label="el.value" color="red darken-1" :value="el.name"></v-radio>
                  </v-radio-group>
                </v-flex>
                <v-flex xs12 class="mb-3 input-complaints">
                  <span class="font-bold">Monto Reclamado <i>*</i></span><br>
                  <input type="number" class="input pt-2" v-model="montoReclamado" v-on:keyup="montoReclamadoInvalid=false;" v-bind:class="{'is-invalid': montoReclamadoInvalid}">
                </v-flex>
                <v-flex xs12 class="mb-3 input-complaints">
                  <span class="font-bold">Descripción<i>*</i></span><br>
                  <textarea name="" id="" cols="30" class="input" rows="5" v-model="descriptionProduct"  v-on:keyup="descriptionProductInvalid=false;" v-bind:class="{'is-invalid': descriptionProductInvalid}"></textarea>
                </v-flex>
              </v-layout>
            </div>
            <div class="user">
              <v-layout row wrap class="pb-3">
                <v-flex xs12>
                  <p>3. Detalle de Reclamaciones y Pedido del Consumidor <i style="color:#ff535a;">*</i> <span class="inline-red" v-if="tipoReclamoInvalid" >Seleccione un tipo de reclamo.</span></p>
                  <v-radio-group v-model="tipoReclamo" row :mandatory="false" class="pt-0">
                    <v-radio label="Reclamo" color="red darken-1" value="Reclamo"></v-radio>
                    <v-radio label="Queja" color="red darken-1" value="Queja"></v-radio>
                  </v-radio-group>
                </v-flex>
                <v-flex xs12 class="mb-3 input-complaints">
                  <span class="font-bold">Descripción:</span><br>
                  <textarea name="" id="" cols="30" class="input" rows="5" v-model="descriptionReclamo"></textarea>
                </v-flex>
                <v-flex xs12 class="mb-3 input-complaints">
                  <span class="font-bold">Pedido:</span><br>
                  <textarea name="" id="" cols="30" class="input" rows="5" v-model="pedidoReclamo"></textarea>
                </v-flex>
              </v-layout>
            </div>
            <div class="user">
              <v-layout row wrap class="pb-3">
                <v-flex xs12>
                  <p>4. Observaciones y acciones adoptadas por el proveedor <i>*</i></p>
                  <span class="font-bold">Detalle:</span><br>
                  <textarea name="" id="" cols="30" class="input" rows="5" v-model="observacionDetalle"></textarea>
                </v-flex>
              </v-layout>
            </div>

            <div class="user">
              <v-layout row wrap class="pb-3">
                <v-flex xs12>
                  <p>Subir archivo <i>(opcional)</i></p>

                  <input v-if="thefile==''" type="file" class="input pt-2" @change="onFileChange">
                  <div class="image-container-w" v-else>
                    <div class="image-container">
                      <span @click="removeImage"><i class="material-icons">close</i></span>
                      <img :src="thefile" />
                    </div>

                  </div>
                </v-flex>
              </v-layout>
            </div>
          </div>



        </div>
        <div class="font-light container">
          <p class="mb-1">RECLAMO: Disconformidad relacionada con los productos o servicios.</p>
          <p class="mb-1">QUEJA: Disconformidad no relacionada a los productos o servicios; o, malestar o descontento respecto a la atención al público.</p>
          <br>
          <p class="mb-1">*La formulación del reclamo no impide acudir a otras vías de solución de controversias ni es requisito previo para interponer una denuncia ante el INDECOPI.</p>
          <p class="mb-1">*El proveedor deberá dar respuesta al reclamo en un plazo no mayor a treinta (30) días calendario, pudiendo ampliar el plazo hasta por treinta (30) días más, previa comunicación al consumidor.</p>
        </div>
        <div>
          <span class="error-msg-email" v-if="isInvalid" >Llene todo los campos requeridos (*).</span>
        </div>
        <!-- <div>
          <span class="error-msg-email" style="color:#00c7a2!important;font-size:1.1rem;" v-if="isValidForm" >Se registro correctamente.</span>
        </div> -->
        <div v-if="!completeForm" class="py-3 pb-5 text-center">
          <v-btn round large class="cover btn-active elevation-0"  @click="preSendDataForm()">Registrar Reclamación</v-btn>
        </div>
        <div v-show="false">{{ csrf }}</div>
      </v-flex>
    </v-layout>
  </v-container>
</v-app>
</template>

<script>

import axios from 'axios'
import Multiselect from 'vue-multiselect'
// import vueSelect from './../components/cSelectData.vue'
export default {
  data () {
    return {
      //routes

      isDesktop:true,
      windowWidth: null,
      //isInvalid: false,
      //FormData
      // userName: '',
      // userAddress: '',
      // userDNI: '',
      // userPhone: '',
      // userEmail: '',
      // bienContratado: '',
      // montoReclamado: '',
      // tipoReclamo: '',
      //
      // legalRepresentative: '',
      // descriptionProduct: '',
      // descriptionReclamo: '',
      // pedidoReclamo: '',
      // observacionDetalle: '',
      //
      // serviceSelected: '',
      // typeCurrency: '',
      // departmentSelect: '',
      // departmentsList: [],
      // provinceSelect: '',
      // provinceList: [],
      // districtSelect: '',
      // districtList: [],
      // ubigeoValid: false,
      // dniInvalid: false,
      // phoneInvalid: false,
      // serviceLine: [],
      // csrf:'v',
      // isValidForm: false,
      // completeForm: false,
      // errores:[],
      // availableCurrency: [],
      //
      // userNameInvalid: false,
      // userAddressInvalid: false,
      // userPhoneInvalid: false,
      // userEmailInvalid: false,
      // bienContratadoInvalid: false,
      // montoReclamadoInvalid: false,
      // tipoReclamoInvalid: false,
      // serviceSelectedInvalid: false,
      // typeCurrencyInvalid: false,
      // departmentInvalid: false,
      // provinceInvalid: false,
      // districtInvalid: false,
      // serviceInvalid: false,
      //
      //
      // descriptionProductInvalid:false,
      // thefile:'',
      // props: {
      //   selectedCallback: Function,
      //   title: String
      // },



    }
  },
  mounted () {
    var the_route

    this.$nextTick(function() {
      window.addEventListener('resize', this.getWindowWidth);
    })
    this.getWindowWidth()

    this.csrf = document.head.querySelector('meta[name="csrf-token"]').content
  },
  watch:{
    windowWidth: function (el) {
      if(el < 600){
        this.isDesktop = false
      } else {
        this.isDesktop = true
      }
    },




  },
  computed: {

  },
  methods: {
    getWindowWidth(event) {
      this.windowWidth = document.documentElement.clientWidth
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


      if(vm.errorPass||vm.errorApellidos||vm.errorEmail||vm.errorPass){
        vm.registerAlert = 'Llene todos los campos del formulario';
        return;
      }



      var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
      if(!re.test(this.email.toLowerCase())){
        vm.registerAlert='Ingrese un email valido';
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


      axios({
        method:'post',
        url:apiRutas.usuario_usuario,
        data: {
          usuario_email:vm.email,
          usuario_nombre:vm.nombre,
          usuario_apellidos :vm.apellidos,
          usuario_movil :vm.movil,
          usuario_dni :vm.dni,
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
          vm.registrandoLocalApi();

        }else{
          vm.procesando = false;
          vm.registerAlert = res.mensajes[0];
        }


  		}).catch(function (error) {
        console.log(error);
        vm.procesando = false;
      });



    },
    registrandoLocalApi:function(){

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



          }else{
            vm.procesando = false;
          }
  			}

  		}).catch(function (error) {
        console.log(error);
        vm.procesando = false;
      });






    },
  }
}
</script>

<style src="vue-multiselect/dist/vue-multiselect.min.css">


</style>
