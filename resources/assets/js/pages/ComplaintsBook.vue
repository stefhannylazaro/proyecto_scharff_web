<template>
<v-app>
  <v-container>
    <v-layout>
      <v-flex class="complaints">
        <div>
          <v-breadcrumbs divider="/" class="py-2">
            <v-breadcrumbs-item
              v-for="item in items" :key="item.text"
              :disabled="item.disabled"
              class="breadcrumbs pa-0"
              :class="{strongClass: item.strong}"
              href="/">
              {{ item.text }}
            </v-breadcrumbs-item>
          </v-breadcrumbs>
        </div>
        <div v-if="!completeForm" class="container-top font-regular text-center">
          <h2 class="mb-3 mt-4">
            HOJA DE RECLAMACIÓN {{claimCode}}
          </h2>
          <p>
            Conforme a lo establecido en el código de la Protección y Defensa del consumidor este establecimiento cuenta con un Libro de Reclamaciones a tu disposición. Registra la queja o reclamo aqui
          </p>
        </div>
        <div v-else class="container-top font-regular text-center">
          <h2 class="mb-3 mt-4">
            Su solicitud ha sido registrada con éxito
          </h2>
          <p>
            Su {{tipoReclamo}} ha sido registrado con el código {{claimCode}}. <br>Resumen de solicitud:
          </p>
        </div>
        <div class="font-regular container">
          <v-flex xs12 class="mb-0 input-complaints">
            <span class="font-bold">Linea de Servicio <i>*</i></span><br>
            <multiselect
              v-model="serviceSelected"
              :options="serviceLine"
              label="name"
              :searchable="false"
              :close-on-select="true"
              :show-labels="false"
              class="input--modifier" v-bind:class="{'select-invalid': serviceInvalid}"
              placeholder="Seleccione">
            </multiselect>
          </v-flex>
        </div>
        <div class="font-regular container">
          <span class="">Fecha: </span>
          <span>{{actualDate}}</span><br>
          <div
            v-for="(el, i) in infoCompany"
            :key="i"
            class="font-medium">
            <span>{{el.title}}</span>
            <span>{{el.detail}}</span>
          </div>
        </div>
        <div class="form font-regular container">
          <div v-if="!completeForm" class="user">
            <p>1. Identificación del Consumidor Reclamante</p>
            <v-layout row wrap class="pb-3">
              <v-flex xs12 class="mb-3 input-complaints">
                <span class="font-bold">Nombre <i>*</i></span><br>
                <input type="text" class="input" v-model="userName" v-on:keyup="userNameInvalid=false;" v-bind:class="{'is-invalid': userNameInvalid}" >
              </v-flex>
              <v-flex xs12 sm4 class="mb-3 input-complaints">
                <span class="font-bold">Departamento <i>*</i></span><br>
                <!-- <input type="text" class="input"> -->
                <multiselect
                  v-model="departmentSelect"
                  :options="departmentsList"
                  label="name"
                  :searchable="true"
                  :close-on-select="true"
                  :show-labels="false"
                  class="input--modifier" v-bind:class="{'select-invalid': departmentInvalid}"
                  placeholder="Seleccione">
                </multiselect>
              </v-flex>
              <v-flex xs12 sm4 :class="{'px-3': isDesktop}" class="mb-3 input-complaints">
                <span class="font-bold">Provincia <i>*</i></span><br>
                <multiselect
                  v-model="provinceSelect"
                  :options="provinceList"
                  label="name"
                  :searchable="true"
                  :close-on-select="true"
                  :show-labels="false"
                  class="input--modifier" v-bind:class="{'select-invalid': provinceInvalid}"
                  placeholder="Seleccione">
                </multiselect>
              </v-flex>
              <v-flex xs12 sm4 class="mb-3 input-complaints">
                <span class="font-bold">Distrito <i>*</i></span><br>
                <multiselect
                  v-model="districtSelect"
                  :options="districtList"
                  label="name"
                  :searchable="false"
                  :close-on-select="true"
                  :show-labels="false"
                  class="input--modifier" v-bind:class="{'select-invalid': districtInvalid}"
                  placeholder="Seleccione">
                </multiselect>
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


          <div v-else class="user">
            <p>1. Identificación del Consumidor Reclamante</p>
            <v-layout row wrap class="pb-3">
              <v-flex xs12 class="mb-3 input-complaints">
                <span class="font-bold">Nombre:</span>&nbsp;&nbsp; {{userName}}
              </v-flex>
              <v-flex xs12 class="mb-3 input-complaints">
                <span class="font-bold">Departamento/Provincia/Distrito:</span>&nbsp;&nbsp; {{departmentSelect.name}}/{{provinceSelect.name}}/{{districtSelect.name}}
              </v-flex>
              <v-flex xs12 class="mb-3 input-complaints">
                <span class="font-bold">Domicilio: </span>&nbsp;&nbsp; {{userAddress}}
              </v-flex>
              <v-flex xs12 class="mb-3 input-complaints">
                <span class="font-bold">DNI / CE: </span>&nbsp;&nbsp; {{userDNI}}
              </v-flex>
              <v-flex xs12 class="mb-3 input-complaints">
                <span class="font-bold">Teléfono: </span>&nbsp;&nbsp; {{userPhone}}
              </v-flex>
              <v-flex xs12 class="mb-3 input-complaints">
                <span class="font-bold">Correo electrónico: </span>&nbsp;&nbsp; {{userEmail}}
              </v-flex>
              <v-flex xs12 class="mb-3 input-complaints">
                <span class="font-bold">Nombre del Padre o Madre (En caso de ser menor de edad):</span><br>
                <span class="font-bold"><b>*</b>Nombre/Domicilio/Teléfono/Correo : </span>&nbsp;&nbsp; {{legalRepresentative}}
              </v-flex>
            </v-layout>
            <div class="user">
              <p>2. Idetificación del Bien Contratado</p>
              <v-layout row wrap class="pb-3">
                <v-flex xs12 class="mb-3 input-complaints">
                  <span class="font-bold">Tipo de bien contratado: </span>&nbsp;&nbsp; {{bienContratado}}
                </v-flex>
                <v-flex xs12 class="mb-3 input-complaints">
                  <span class="font-bold">Linea de Servicio: </span>&nbsp;&nbsp; {{serviceSelected.name}}
                </v-flex>
                <v-flex xs12 v-if="typeCurrency == 'soles'" class="mb-3 input-complaints">
                  <span  class="font-bold">Monto Reclamado: </span>&nbsp;&nbsp; S/. {{montoReclamado}}
                </v-flex>
                <v-flex xs12 v-else class="mb-3 input-complaints">
                  <span class="font-bold">Monto Reclamado: </span>&nbsp;&nbsp; $ {{montoReclamado}}
                </v-flex>
                <v-flex xs12 class="mb-3 input-complaints">
                  <span class="font-bold">Descripción: </span>&nbsp;&nbsp; {{descriptionProduct}}
                </v-flex>
              </v-layout>
            </div>
            <div class="user">
              <p>3. Detalle de Reclamaciones y Pedido del Consumidor</p>
              <v-layout row wrap class="pb-3">
                <v-flex xs12 class="mb-3 input-complaints">
                  <span class="font-bold">Tipo de Reclamo: </span>&nbsp;&nbsp; {{tipoReclamo}}
                </v-flex>
                <v-flex xs12 class="mb-3 input-complaints">
                  <span class="font-bold">Descripción: </span>&nbsp;&nbsp; {{descriptionReclamo}}
                </v-flex>
                <v-flex xs12 class="mb-3 input-complaints">
                  <span class="font-bold">Pedido: </span>&nbsp;&nbsp; {{pedidoReclamo}}
                </v-flex>
              </v-layout>
            </div>
            <div class="user">
              <p>4. Observaciones y acciones adoptadas por el proveedor</p>
              <v-layout row wrap class="pb-3">
                <v-flex xs12 class="mb-3 input-complaints">
                  <span class="font-bold">Detalle:</span>&nbsp;&nbsp;{{observacionDetalle}}
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

      getClaim: '/ajax/obtener-reclamo',
      getDepartments: '/ajax/departamentos',
      getProvince: '/ajax/provincias',
      getDistrict: '/ajax/distritos',
      setClaim: '/ajax/registro-reclamo',
      row: '',
      infoCompany: [
        //{ title: 'Razón Social: ', detail: 'SCHARFF INTERNATIONAL COURIER & CARGO SA'},
        //{ title: 'RUC: ', detail: 20110964928 },
        { title: 'Razón Social: ', detail: 'SCHARFF LOGISTICA INTEGRADA S.A.'},
        { title: 'RUC: ', detail: 20463958590 },
        { title: 'Dirección Fiscal: ', detail: 'Calle los Cedros Nro. 143 Fnd. Bocanegra - Callao'},
      ],
      claimCode: '',
      items: [
        { text: 'INICIO',
          disabled: false,
          strong: false
        },
        {
          text: 'LIBRO DE RECLAMACIONES',
          disabled: true,
          strong: true
        }
      ],
      isDesktop:true,
      windowWidth: null,
      isInvalid: false,
      //FormData
      userName: '',
      userAddress: '',
      userDNI: '',
      userPhone: '',
      userEmail: '',
      bienContratado: '',
      montoReclamado: '',
      tipoReclamo: '',

      legalRepresentative: '',
      descriptionProduct: '',
      descriptionReclamo: '',
      pedidoReclamo: '',
      observacionDetalle: '',

      serviceSelected: '',
      typeCurrency: '',
      departmentSelect: '',
      departmentsList: [],
      provinceSelect: '',
      provinceList: [],
      districtSelect: '',
      districtList: [],
      ubigeoValid: false,
      dniInvalid: false,
      phoneInvalid: false,
      serviceLine: [],
      csrf:'v',
      isValidForm: false,
      completeForm: false,
      errores:[],
      availableCurrency: [],

      userNameInvalid: false,
      userAddressInvalid: false,
      userPhoneInvalid: false,
      userEmailInvalid: false,
      bienContratadoInvalid: false,
      montoReclamadoInvalid: false,
      tipoReclamoInvalid: false,
      serviceSelectedInvalid: false,
      typeCurrencyInvalid: false,
      departmentInvalid: false,
      provinceInvalid: false,
      districtInvalid: false,
      serviceInvalid: false,


      descriptionProductInvalid:false,
      thefile:'',
      props: {
        selectedCallback: Function,
        title: String
      },
    }
  },
  mounted () {
    var the_route
    if(window.location.href.indexOf('localhost') !== -1){
     the_route = 'http://localhost:8000';
   }else if(window.location.href.indexOf('holascharff') !== -1){
     the_route = 'http://www.holascharff.com';
    }else{
     the_route = 'http://sw-dev.janaq.pro/';
    }

    

    this.$nextTick(function() {
      window.addEventListener('resize', this.getWindowWidth);
    })
    this.getWindowWidth()
    this.loadData()
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
    departmentSelect: function (el) {
      if(el != ''){
        this.provinceSelect = '';
        this.districtSelect = '';
        this.consumeService(this.getProvince, 'province', el.id);
        this.departmentInvalid=false;
      }
    },
    provinceSelect: function (el) {
      if(el != ''){
        this.districtSelect = ''
        this.consumeService(this.getDistrict, 'district', el.id)
        this.provinceInvalid=false;
      }
    },
    districtSelect: function (el) {
      if(el != '') {
        this.ubigeoValid = true
        this.districtInvalid=false;
      } else {
        this.ubigeoValid = false

      }
    },
    userDNI: function (el) {
      if(el.length > 7 && el.length <= 15){
        this.dniInvalid = false
      } else {
        this.dniInvalid = true
      }
    },
    userEmail: function (el) {
      var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
      this.userEmailInvalid = !re.test(el.toLowerCase());
    },
    userPhone: function (el) {
      if(el.length > 8 && el.length <= 15){
        this.phoneInvalid = false
      } else {
        this.phoneInvalid = true
      }
    },
    serviceSelected: function (el) {
      if(el != ''){
        this.serviceInvalid=false;
      }

      if(el.value==='envios-internacionales'){

        this.infoCompany[0].detail = 'SCHARFF INTERNATIONAL COURIER & CARGO S.A.';
        this.infoCompany[1].detail = 20110964928;
      }else{
        this.infoCompany[0].detail = 'SCHARFF LOGISTICA INTEGRADA S.A.';
        this.infoCompany[1].detail = 20463958590;
      }
    },





    infoCompany: [
      //{ title: 'Razón Social: ', detail: 'SCHARFF INTERNATIONAL COURIER & CARGO SA'},
      //{ title: 'RUC: ', detail: 20110964928 },
      { title: 'Razón Social: ', detail: 'SCHARFF LOGISTICA INTEGRADA S.A.'},
      { title: 'RUC: ', detail: 20463958590 },
      { title: 'Dirección Fiscal: ', detail: 'Calle los Cedros Nro. 143 Fnd. Bocanegra - Callao'},
    ],





  },
  computed: {
    actualDate: function () {
      let now = new Date()
      let dd = now.getDate()
      let mm = now.getMonth() + 1
      let yyyy = now.getFullYear()
      now = dd + '/' + mm + '/' + yyyy
      return now
    }
  },
  methods: {
    loadData: function () {
      let vm = this
      axios.get(vm.getClaim)
        .then(function(response) {
          let res = response.data.data
          console.log(res)
          vm.claimCode = res.numero_reclamo
          vm.availableCurrency = res.tipo_moneda
          vm.serviceLine = res.linea_servicio
          vm.consumeService(vm.getDepartments, 'departments')
        })
    },
    fileSelected: function(){
      if (this.selectedCallback) {
        if (e.target.files[0]) {
          this.selectedCallback(e.target.files[0]);
        } else {
          this.selectedCallback(null);
        }
      }
    },
    onFileChange(e) {
      var files = e.target.files || e.dataTransfer.files;
      if (!files.length)
        return;
      this.createImage(files[0]);
    },
    createImage(file) {
      var image = new Image();
      var reader = new FileReader();
      var vm = this;

      reader.onload = (e) => {
        vm.thefile = e.target.result;
      };
      reader.readAsDataURL(file);
    },
    removeImage: function (e) {
      this.thefile = '';
    },
    // loadDepartments: function () {
    //   let vm = this
    //   axios.get(vm.getDepartments)
    //    .then(function(response){
    //      let res = response.data
    //      console.log(response)
    //      vm.departmentsList = res.data

    //    })
    //    .catch(function (err){
    //      console.log(err)
    //    })
    // },
    consumeService: function (urlService, container, value) {
      let vm = this
      let fullUrl
      // console.log(value)
      if(value != undefined) {
        fullUrl = urlService + '/' + value
      } else {
        fullUrl = urlService
      }
      axios.get(fullUrl)
      .then(function(response){
        let res = response.data
        // console.log(response)
        switch (container) {
          case 'departments':
            vm.departmentsList = res.data
            break
          case 'province':
            vm.provinceList = res.data
            break
          case 'district':
            vm.districtList = res.data
            break
        }
      })
      .catch(function (err){
        console.log(err)
      })
    },
    getWindowWidth(event) {
      this.windowWidth = document.documentElement.clientWidth
    },
    preSendDataForm(){
      console.log('presend');
      let vm = this;



      if(vm.userName == ''){
        vm.userNameInvalid = true;
      }
      if(vm.userAddress == ''){
        vm.userAddressInvalid = true;
      }

      if(vm.userDNI.length > 7 && vm.userDNI.length <= 15){
        vm.dniInvalid = false
      } else {
        vm.dniInvalid = true
      }



      if(vm.userPhone.length > 8 && vm.userPhone.length <= 15){
        vm.phoneInvalid = false
      } else {
        vm.phoneInvalid = true
      }



      if(vm.userEmail!=''){
        var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
        vm.userEmailInvalid = !re.test(vm.userEmail.toLowerCase());
      }else{
        vm.userEmailInvalid = true;
      }


      if(vm.bienContratado == ''){
        vm.bienContratadoInvalid = true;
      }else{
        vm.bienContratadoInvalid = false;
      }
      if(vm.montoReclamado == ''){
        vm.montoReclamadoInvalid = true;
      }
      if(vm.tipoReclamo == ''){
        vm.tipoReclamoInvalid = true;
      }else{
        vm.tipoReclamoInvalid = false;
      }
      if(vm.serviceSelected == ''){
        vm.serviceSelectedInvalid = true;
      }else{
        vm.serviceSelectedInvalid = false;
      }
      if(vm.typeCurrency == ''){
        vm.typeCurrencyInvalid = true;
      }else{
        vm.typeCurrencyInvalid = false;
      }
      if(vm.descriptionProduct == ''){
        vm.descriptionProductInvalid = true;
      }




      if(vm.departmentSelect == ''){
        vm.departmentInvalid = true;
      }
      if(vm.provinceSelect == ''){
        vm.provinceInvalid = true;
      }
      if(vm.districtSelect == ''){
        vm.districtInvalid = true;
      }

      console.log(vm.serviceSelected);
      if(vm.serviceSelected == ''){
        vm.serviceInvalid = true;
      }else{
        vm.serviceInvalid = false;
      }


      vm.sendDataForm();
    },
    sendDataForm(){




      let opciones = this.$store.getters.loadStateOpciones.opciones;
      let reclamos_email_admin = '';
      opciones.forEach((el)=>{
        if(el.slug==='reclamos_email_admin'){
          reclamos_email_admin = el.valor;
        }
      });

      console.log(reclamos_email_admin);
      console.log('reclamos_email_admin');

      let vm = this
      let arrayData = {}
      if(
          !vm.userNameInvalid &&
          !vm.userAddressInvalid &&
          !vm.userEmailInvalid &&
          !vm.bienContratadoInvalid &&
          !vm.montoReclamadoInvalid &&
          !vm.tipoReclamoInvalid &&
          !vm.serviceInvalid &&
          !vm.typeCurrencyInvalid &&
          !vm.descriptionProductInvalid &&
          vm.ubigeoValid &&
          !vm.dniInvalid &&
          !vm.phoneInvalid){
            let dni = parseFloat(vm.userDNI)
            let telefono = parseFloat(vm.userPhone)
            let monto = parseFloat(vm.montoReclamado)
            arrayData = {
              // "numero_reclamo": vm.claimCode,
              "nombre": vm.userName,
              "ubigeo_id": vm.districtSelect.id,
              "direccion": vm.userAddress,
              "documento": dni,
              "telefono": telefono,
              "correo": vm.userEmail,
              "descripcion_menor_edad": vm.legalRepresentative,
              "bien_contratado": vm.bienContratado,
              "monto_reclamado": monto,
              "descripcion_bien_contratado": vm.descriptionProduct,
              "tipo_reclamo": vm.tipoReclamo,
              "detalle_reclamo": vm.descriptionReclamo,
              "pedido_reclamo": vm.pedidoReclamo,
              "observacion": vm.observacionDetalle,
              "tipo_moneda": vm.typeCurrency,
              "linea_servicio": vm.serviceSelected.value,
              "imagen_name": vm.thefile,
              "reclamos_email_admin": reclamos_email_admin,

            }
            vm.isInvalid = false
            vm.sendClaim(arrayData)
      } else {
        vm.isInvalid = true;
      }
      // console.log(arrayData)

    },
















    sendClaim: function (object) {
      let vm = this
      console.log(object)
      axios.post(vm.setClaim, object, {headers: {
        'X-CSRF-Token': this.csrf,
        // 'Access-Control-Allow-Credentials': true
        }})
      // axios.post(vm.setClaim, object)
      .then (function(response) {
        console.log(response);
        let res = response.data.status
        if(res){
          vm.isValidForm = true
          // console.log(response)
          setTimeout(function(){

            // vm.$router.push({path: '/'})
            vm.$scrollTo('#menu-home', 1000)
            vm.completeForm = true
          }, 1000)
        } else {
          console.log('algo salio mal, recarga')
        }

      })
      .catch(function(err) {
        vm.isValidForm = true
        console.log(err)
        setTimeout(function(){
          // vm.$router.push({path: '/'})

          vm.$scrollTo('#menu-home', 1000)
          vm.completeForm = true
        }, 1000)

      })
    },
    toHome: function (el) {
      console.log(el)
      if(el == 'INICIO'){
        vm.$router.push({path: '/'})
      }
    },
  },
  components: { Multiselect },

}
</script>

<style src="vue-multiselect/dist/vue-multiselect.min.css">


</style>
