<template>
  <v-container fluid class="pa-0">
    <v-layout row wrap>
      <v-flex xs12 id="formGrow" class="white--text text-center g-form-grow pt-5 ">
        <h3 id="cont_contacto_descripcion" class="font-bold pb-4 px-3 pt-5">Escríbenos o contáctanos al 517-1600</h3><!-- Haz crecer tu negocio, escríbenos -->
        <!-- <p class="font-medium">escríbenos</p> -->
        <div class="d-flex justify-center">
          <div class="form-inputs g-input-no-borders pb-5 font-regular" >
            <input
            v-model="name"
            v-on:keyup="missingName=false;"
            v-bind:class="{'is-invalid': missingName}"
            class="input white--text bg-light-white"
            type="text"
            placeholder="Nombre de contacto">


            <input
            v-model="company"
            class="input white--text bg-light-white"
            type="text"
            placeholder="Empresa">


            <input
            v-model="email"
            v-on:keyup="missingEmail=false;"
            v-bind:class="{'is-invalid': missingEmail}"
            class="input white--text bg-light-white"
            type="email"
            placeholder="Correo electrónico">

            <span class="el-error gi-30" v-bind:class="{'active': !validated_email}">Ingresa un correo válido</span>

            <input v-model="phone" v-on:keyup="missingPhone=false;" class="input white--text bg-light-white" type="tel" placeholder="Teléfono o Celular" v-bind:class="{'is-invalid': missingPhone}">
            <div class="select-w">
               <select
                v-if='motivosContacto'
                @click="missingMotivo=false;"
                v-model="motivo"
                v-bind:class="{'is-invalid': missingMotivo}"
                class="input white--text bg-light-white"
                type="tel"
                placeholder="Teléfono o Celular">

                <option value="" disabled selected hidden>¿Cuál es el motivo de tu consulta?</option>
                <option v-for="motivo in motivosContacto" :value="motivo.nombre">{{motivo.nombre}}</option>
              </select>
              <i aria-hidden="true" class="material-icons icon">keyboard_arrow_down</i>
            </div><!-- /.select-w -->




            <div class="gi-2">
              <label for="">¿Sobre qué servicio(s) es tu consulta? <span class="el-error" v-bind:class="{'active': missingServicios}"> &nbsp;Selecciona uno más servicios</span></label>

              <div class="gi-3" v-bind:class="{'is-invalid': missingServicios}">
                <div>
                  <input type="checkbox" id="servicioa" name="servicioa" value="Aduana"/>
                  <label for="servicioa">Aduana</label>
                </div>
                <div>
                  <input type="checkbox" id="serviciob" name="serviciob" value="Almacén"/>
                  <label for="serviciob">Almacén</label>
                </div>
                <div>
                  <input type="checkbox" id="servicioc" name="servicioc" value="Carga Doméstica"/>
                  <label for="servicioc">Carga Doméstica</label>
                </div>
                <div>
                  <input type="checkbox" id="serviciod" name="serviciod" value="Carga Internacional"/>
                  <label for="serviciod">Carga Internacional</label>
                </div>
                <div>
                  <input type="checkbox" id="servicioe" name="servicioe" value="Distribución"/>
                  <label for="servicioe">Distribución</label>
                </div>
                <div>
                  <input type="checkbox" id="serviciof" name="serviciof" value="Envíos Internacionales"/>
                  <label for="serviciof">Envíos Internacionales</label>
                </div>

              </div><!-- /.gi-2 -->
            </div>
            <textarea v-model="message" class="input white--text bg-light-white" placeholder="Mensaje">

            </textarea>
            <div class="login-error-alert" v-if="showAlert">
              <span>Llene todos los campos del formulario</span>
            </div>
            <div class="login-error-alert white--text " v-if="messageSucess">
              <span>{{msj}}</span>
            </div>
            <v-btn
              round
              :loading="loading4"
              class="white btn-crear black--text elevation-0"
              @click.stop="validateFields">
              enviar
              <span slot="loader" class="custom-loader">
                <v-icon light>cached</v-icon>
              </span>
            </v-btn>
            <!-- <v-btn
              color="info"
              :loading="loading4"
              @click.native="loader = 'loading4'"
              :disabled="loading4"
            >
              Icon Loader
              <span slot="loader" class="custom-loader">
                <v-icon light>cached</v-icon>
              </span>
            </v-btn> -->
          </div>
        </div>
      </v-flex>
    </v-layout>
    <v-dialog
      v-model="modalContactoOk"
      fullscreen
      transition="dialog-bottom-transition">
      <div class="modal-open-login">
        <v-card class="wrapper-info-finish" style="background:white">
          <div class="font-regular">
            <img class="icon-close-modal" src="../../img/close_icon.png" alt="">
            <h3 class="font-bold pb-2">Mensaje enviado</h3>
            <p>Gracias por escribirnos, nos comunicaremos contigo lo antes posible.</p>
            <img src="../../img/qrmail.png" alt="">
            <p class="mt-2"></p>
          </div>
        </v-card>
        <div class="back-modal-active" @click.stop="modalContactoOk=false">_</div>
      </div>
    </v-dialog>
  </v-container>
</template>

<script>
import axios from 'axios'
import { EventBus } from '../config/ebus.js'

export default {
  data () {
    return {
      urlService: 'http://laravelvue.vh/api/contacts',
      company: '',
      name: '',
      email: '',
      phone: '',
      message: '',
      motivo: '',
      servicios: null,
      SucursalesPeruOne: [
        { departamento: 'Piura.', ciudad: 'Paita', dirOne: 'Av. Meliton Carbajal Mz G,', dirTwo: 'Lt 15 Urb. Las Mercedes', tel: '(051)732-12760' },
        { departamento: 'La Libertad.', ciudad: 'Trujillo', dirOne: 'Calle Libertad 270,', dirTwo: 'Salaverry', tel: '(044)585-168' },
        { departamento: 'Tumbes.', ciudad: 'Tumbes', dirOne: 'Av. 28 de Julio 507', dirTwo: 'Tumbes', tel: '(072)561-204' },
        { departamento: 'Tacna.', ciudad: 'Pocollay', dirOne: 'Ampliación Bolognesi Mz G,', dirTwo: 'Lt 12. Pocollay', tel: '(052)227-534' },
        { departamento: 'Puno.', ciudad: 'Desaguadero', dirOne: 'Av. Panamericana 357,  2do', dirTwo: 'piso. Desaguadero', tel: '(051)505-150' },
        { departamento: 'Arequipa.', ciudad: 'Arequipa', dirOne: 'Av. Italia 105 Cerro', dirTwo: 'Colorado', tel: '(051)054 443666' },
        { departamento: 'Callao.', ciudad: 'Callao', dirOne: 'Calle Los Cedros 143', dirTwo: 'Urb. Las Fresas', tel: '(+51)517 1600' },
        { departamento: 'Lima', ciudad: 'Miraflores', dirOne: 'Av. Meliton Carbajal Mz G,', dirTwo: 'Lt 15 Urb. Las Mercedes', tel: '(051)732-12760' }
      ],
      SucursalesBolivia: [
        { departamento: 'Bolivia.', ciudad: 'La Paz', dirOne: 'Av. 20 de Octubre N. 2619', dirTwo: '(entre Campos y Phila)', tel: '591 2120000' },
        { departamento: 'Bolivia.', ciudad: 'Santa Cruz', dirOne: 'Calle Cochabamba 694', dirTwo: '(esquina Saavedra)', tel: '591 3116211' }
      ],
      showAlert: false,
      loader: null,
      loading4: false,
      messageSucess:false,
      msj: '',
      motivosContacto:null,

      missingCompany:false,
      missingName:false,
      missingEmail:false,
      missingPhone:false,
      missingServicios:false,
      missingMotivo:false,
      validated_email:true,
      modalContactoOk:false
    }
  },
  mounted(){
    let vm = this ;
    let array = {};


      EventBus.$emit('loadedForm',1);
      EventBus.$on('RestponseloadedForm',function(motivos){
        vm.motivosContacto = motivos;
      })

  },
  watch: {

    name: function () {
      this.messageAlert(false)
    },
    email: function () {
      this.messageAlert(false)
    },
    phone: function () {
      this.messageAlert(false)
    },
    message: function () {
      this.messageAlert(false)
    },
    messageSucess: function () {
      let vm = this
      setTimeout(()=>(
        vm.closeMessage()
      ),2000)
    }
  },
  methods: {
    closeMessage: function () {
      this.messageSucess =  false
    },
    validateFields: function () {
      this.servicios = []
      var checkboxes = document.querySelectorAll('.gi-3 input[type=checkbox]:checked')

      for (var i = 0; i < checkboxes.length; i++) {
        this.servicios.push(checkboxes[i].value)
      }

      this.missingName=false;
      this.missingEmail=false;
      this.missingPhone=false;
      this.missingServicios=false;
      this.missingMotivo=false;

      var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
      if(this.email!=''){
        this.validated_email = re.test(this.email.toLowerCase());
      }else{
        this.validated_email = true;
      }
      if (
          this.name != '' &&
          this.email != '' &&
          this.phone != '' &&
          this.servicios.length != 0 &&
          this.motivo != ''&&
          this.validated_email
          ){


            this.sendFormData()

          } else {
            if(this.name==''){
              this.missingName =true;
            }
            if(this.email==''||!this.validated_email){
              this.missingEmail =true;
            }
            if(this.phone==''){
              this.missingPhone =true;
            }
            if(this.motivo==''){
              this.missingMotivo =true;
            }
            if(this.servicios.length==0){
              this.missingServicios =true;
            }

            this.messageAlert(true);
          }
    },
    messageAlert: function (value) {
      this.showAlert = value
    },
    sendFormData: function () {
      this.loading4 = true;
      let vm = this
      let array = {
        'company': this.company,
        'name': this.name,
        'email': this.email,
        'phone': this.phone,
        'message': this.message,
        'motivo': this.motivo,
        'servicios': this.servicios.toString(),
      }
      //console.log(array);
      axios.post('/api/contacts', array)
      .then(function(response){
        console.log(response)
        let res = response.data
        if(res.status) {
          vm.msj = res.mensaje
          //vm.clearFormContact();
        } else {
          vm.msj = res.mensaje
        }
        vm.messageSucess = true
        vm.loading4 = false;
        vm.modalContactoOk=true;
        vm.clearFormContact();
      })
      .catch((e)=>{
        vm.loading4 = false;
      })
    },

    clearFormContact: function () {
      this.company = ''
      this.name = ''
      this.email = ''
      this.phone = ''
      this.message = ''
    }
  }

}
</script>

<style lang="scss">
@import "../../scss/vars.scss";
.el-error{
  display: none;
    font-size: 0.9rem;
  color: #f00;
}
.el-error.active{
  display: inline-block;
}
.el-error.active.gi-30{
  display: block;
  text-align: left;
  width: 100%;
  margin-top: -10px;
  margin-bottom: 10px;
}
.select-w {
  width: 100%;
  position: relative;
}
.select-w .icon{
position: absolute;
  right: 4px;
  top: 10px;
  font-size: 1.8rem;
      pointer-events: none;
}
.g-input-no-borders input.is-invalid, .g-input-no-borders textarea.is-invalid,
.g-input-no-borders select.is-invalid {
  border: 1px solid #f00 !important;
}
  .custom-loader {
    animation: loader 1s infinite;
    display: flex;
  }
  @-moz-keyframes loader {
    from {
      transform: rotate(0);
    }
    to {
      transform: rotate(360deg);
    }
  }
  @-webkit-keyframes loader {
    from {
      transform: rotate(0);
    }
    to {
      transform: rotate(360deg);
    }
  }
  @-o-keyframes loader {
    from {
      transform: rotate(0);
    }
    to {
      transform: rotate(360deg);
    }
  }
  @keyframes loader {
    from {
      transform: rotate(0);
    }
    to {
      transform: rotate(360deg);
    }
  }

</style>
