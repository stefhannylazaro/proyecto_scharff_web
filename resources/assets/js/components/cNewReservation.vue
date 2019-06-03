<template>
  <v-flex xs12>
    <v-stepper class="elevation-0 bg-gray-one" v-model="e1">
      <v-stepper-header class="px-5 stepper-width-head elevation-0 align-elements-reservation">
        <v-stepper-step step="1" :complete="e1 > 1" class="stepper-control"></v-stepper-step>
        <v-divider></v-divider>
        <v-stepper-step step="2" :complete="e1 > 2" class="stepper-control"></v-stepper-step>
        <v-divider></v-divider>
        <v-stepper-step step="3" :complete="e1 > 3" class="stepper-control"></v-stepper-step>
        <v-divider></v-divider>
        <v-stepper-step step="4" class="stepper-control"></v-stepper-step>
      </v-stepper-header>
      <v-stepper-items>
        <v-stepper-content step="1">
          <v-flex xs12 class="font-light text-center section-one-stepper">
            <h2 class="font-medium">Porque el tamaño sí importa</h2>
            <span class="">Escoge uno de nuestros tres tamaños de locker, y presiona SIGUIENTE.</span>
            <div class="info-stepper" style="display:none">
              <img :src="infoIcon.url" :alt="infoIcon.alt">
              <a>Saber más</a>
            </div>
          </v-flex>
          <v-container class="nopadding-w390">
            <v-layout xs12 row wrap>
              <v-flex
                v-for="(item, i) in sizeElockers"
                :key="i"
                xs12 sm12 md4
                class="text-center py-5 size-lockers-container"
                :class="{lockerActive: lockerActive(item.slug)}"
                @click="setLockerActive(item)">
                <div>
                  <v-icon class="locker-checked" v-if="lockerActive(item.name)">check</v-icon>
                  <div class="size-lockers-title">
                    <h3 class="font-bold color-pink">{{item.name}}</h3>

                  </div>
                  <div class="imagen-container-stepper">
                    <img :src="item.url" :alt="item.alt">
                  </div>
                </div>
              </v-flex>
              <v-flex xs12 class="text-center pt-4">
                <small class="small-text clearfix size-lockers__leyenda">*Recuerda: (a) ancho, (h) altura, (p) profundidad</small>
                <v-btn v-if="isEmptyActiveLocker" round outline class="btn-next-small" @click.native="e1 = 2">siguiente</v-btn>
                <v-btn v-else round outline disabled class="btn-next-small">siguiente</v-btn>


              </v-flex>
            </v-layout>
          </v-container>
        </v-stepper-content>

        <v-stepper-content step="2">
          <v-flex xs12 class="font-light text-center section-one-stepper lock-step-3">
            <h2 class="font-medium mb-3">Elige tu locker</h2>
            <div class="wrapper-step-tree mb-4">
              <v-icon style="font-size:16px;margin-bottom:.3rem">place</v-icon>
                <label  v-text="dir_selected"></label>
                <!--<GmapAutocomplete :options="{
                    componentRestrictions: {'country': ['pe']}
                }"
                style="outline:none;" placeholder="Ingresa un distrito, avenida o calle" @place_changed="setPlace" id="autocompleteInput"></GmapAutocomplete>
-->
            </div>

            <div>

              <div class="mapaylista">
                <div class="listalockers-w">
                  <v-card>

                    <v-list two-line color="cyan" dark>
                      <template v-for="(el, index) in lockersListItems">

                        <v-list-tile :key="el.nombre" @click="selecListLocker(el)" :class="{'lockerSelected':lockerIDSelected==el.id}">

                          <v-list-tile-content>
                            <v-list-tile-title v-html="el.nombre"></v-list-tile-title>
                          </v-list-tile-content>
                        </v-list-tile>
                      </template>
                    </v-list>
                  </v-card>
                </div>

                <div class="mapalockers-w">
                  <gmap-map
                    v-if="e1==2"
                    :center="currentLocation"
                    :zoom="14"
                    map-type-id="roadmap"
                    class="px-4"
                    style="width: 100%; height: 100%;min-height: 16rem;"
                    >
                    <gmap-marker
                      :key="index"
                      v-for="(m, index) in markers"
                      :position="m.position"
                      :clickable="true"
                      :draggable="false"
                      :icon_="'/images/mapa.png'"

                      @click="clickOnLocker(m.id)">
                      <gmap-info-window>
                        <strong>{{m.direccion}}</strong>
                    </gmap-info-window>
                    </gmap-marker>

                  </gmap-map>
                </div>

              </div>



              <input type="hidden" v-model="searchLocation" name="" value="">
            </div>

          </v-flex>
          <v-container class="nopadding-w390">
            <v-layout xs12 row wrap>
              <v-flex xs12>
                <div class="text-center">
                    <span class=" red--text" v-if="noLockerSelectedAlert">Elige un Locker del mapa para continuar.</span>
                </div>
              </v-flex>
              <v-flex xs12 class="text-center pt-4">
                <v-btn round outline class="btn-send-next" @click.native="e1 = 1">ATRAS</v-btn>
                <v-btn round outline class="btn-send-next" :disabled="lockerIDSelected==0" @click.native="lockerIDSelected>0?e1=3:noLockerSelectedAlert=true">Siguiente</v-btn>
              </v-flex>
            </v-layout>
          </v-container>
          <!-- <v-card color="grey lighten-1" class="mb-5" height="200px"></v-card>
          <v-btn color="primary" @click.native="e1 = 1">Continue</v-btn>
          <v-btn flat>Cancel</v-btn> -->
        </v-stepper-content>


        <v-stepper-content step="3">
          <v-flex xs12 class="font-light text-center section-one-stepper">
            <h2 class="font-medium">¿Para quién es?</h2>
            <span class="">Cuéntanos quién recogerá el paquete</span>
          </v-flex>
          <v-container class="nopadding-w390">
            <v-layout xs12 row wrap>
              <v-flex xs12 class="text-justify">
                <div class="wrapper-step-two">
                  <div class="font-regular min-width-step-two">
                    <div class="text-step-two">
                      <input type="text" placeholder="Nombres y apellidos" v-model="friendName"><br>
                      <input style="width:100%;" v-validate="'required|email'" name="email" type="email" placeholder="Correo electrónico" v-model="friendEmail"><br>
                      <input class="sinflechas" type="number" min="0" v-model="friendDni" name="dni" placeholder="DNI"  onkeydown="return !(event.keyCode == 69||event.keyCode == 189||event.keyCode == 187||event.keyCode == 190)"><br>
                      <input class="sinflechas" type="number" min="0"  placeholder="Celular" name="celular" v-model="friendPhone"  onkeydown="return !(event.keyCode == 69||event.keyCode == 189||event.keyCode == 187||event.keyCode == 190)"><br>
                      <input type="text" min="0" placeholder="¿Qué vas a dejar en el locker?" v-model="queArticulo"><br>
                      <span class="error-msg-email" v-show="!emailValid && friendEmail!==''" >ingresa un correo válido</span>
                      <span class="error-msg-email" v-show="!dniValid && friendDni!==''" >ingresa un DNI válido</span>
                      <span class="error-msg-email" v-show="!frnameValid && friendName!=''" >ingresar al menos un nombre y un apellido</span>
                    </div>
                    <img class="img-step-two" :src="bgsteptwo.url" :alt="bgsteptwo.alt">
                  </div>

                </div>
              </v-flex>
              <v-flex xs12 class="text-center pt-4">
                <v-btn round outline class="btn-send-next" @click.native="e1 = 2">ATRAS</v-btn>
                <v-btn v-if="isEmptyStepTwo" :disabled="btnListoLoading" :loading="btnListoLoading" round outline class="btn-send-next" @click.native="goStep4">Listo</v-btn>
                <v-btn v-else round outline disabled class="btn-send-next" >Listo</v-btn>
              </v-flex>
            </v-layout>
          </v-container>
          <!-- <v-card color="grey lighten-1" class="mb-5" height="200px"></v-card>
          <v-btn color="primary" @click.native="e1 = 3">Continue</v-btn>
          <v-btn flat>Cancel</v-btn> -->
        </v-stepper-content>

        <!--asdasd-->
        <v-stepper-content step="4" class="regular-step1 regular-step1m3">
          <v-flex xs12 class="font-light text-center section-one-stepper">
            <h2 class="font-medium mb-2">Resumen de reserva</h2>
          </v-flex>
          <v-container class="nopadding-w390 enviar-container regular-block">
            <v-layout xs12 row wrap>
              <div class="white-bg xs12 row wrap layout">
                <v-flex xs12 sm6 md6>
                  <div class="font-regular min-width-step-two ep-form-package">
                    <div class="text-step-two text-step-one line-bottom_em">
                      <strong class="primary--color">DIRECCIÓN DEl LOCKER</strong>
                      <p>{{dir_selected}}</p>
                    </div>
                  </div>
                </v-flex>
                <!--<v-flex xs12 sm6 md6>
                  <div class="font-regular min-width-step-two ep-form-package">
                    <div class="text-step-two text-step-one line-left">
                      <strong class="green--text">DESTINO</strong>
                      <p></p>
                    </div>
                  </div>
                </v-flex>-->
              </div>

              <div class="white-bg xs12 row wrap layout">
                <v-flex xs12 sm12 md12>
                  <div class="font-regular min-width-step-two ep-form-package">
                    <div class="text-step-two text-step-one line-bottom_em">
                      <strong class="">SOBRE TU ENVÍO</strong>
                    </div>

                    <v-layout row>
                      <v-flex xs6 justify-space-between class="layout re-">
                        <span>Tamaño: {{activeLock}}</span>
                      </v-flex>
                    </v-layout>
                  </div>
                </v-flex>
              </div>

              <div class="white-bg xs12 row wrap layout">
                <v-flex xs12 sm12 md12>
                  <div class="font-regular min-width-step-two ep-form-package">
                    <div class="text-step-two text-step-one line-bottom_em">
                      <v-layout row wrap justify-space-between>
                        <v-flex xs12 md6  class="cupon-box">
                          <div >
                              <div class="text-step-two text-step-one line-bottom_em">
                                <strong>CUPÓN DE DESCUENTO</strong>
                              </div>
                              <div class="cupon-elementos">
                                <div class="cupon-input-w">
                                  <input type="text" :disabled="se_aplico_cupon" name="" class="input-cupon" value="" v-model="cupon_descuento">
                                  <i class="material-icons" v-if="cupon_descuento!=''" @click="resetearCupon" >
                                  close
                                  </i>
                                </div>
                                <v-btn round outline class="btn-aplicar-cupon" :disabled="se_aplico_cupon" @click.native="aplicarCupon">Aplicar cupón</v-btn>


                                <transition name="fade">
                                  <span v-if="cupon_mensaje!='' && !se_aplico_cupon" v-text="cupon_mensaje"></span>
                                </transition>
                                <span v-if="se_aplico_cupon">
                                  <i class="material-icons">
                                  check
                                  </i>
                                </span>
                              </div>
                          </div>
                          <!-- asd ruc-->
                          <div class="block-factura">
                            <v-checkbox
                    					class="input-create check"
                              label="¿Desea factura?"
                    					v-model="checkboxFactura"
                    				></v-checkbox>
                            <div class="input-factura" v-if="checkboxFactura">
                              <input class="sinflechas" type="number" :class="{facturacion_error:facturacion_error_ruc}" placeholder="RUC" v-model="facturacion_ruc">
                              <input type="text" :class="{facturacion_error:facturacion_error_razonsocial}" placeholder="Razón social"  v-model="facturacion_razonsocial">
                              <div class="text--red" v-if="facturacion_notice!=''" v-text="facturacion_notice"></div>
                            </div>
                          </div>
                          <!-- asd -->
                        </v-flex>

                        <!-- <v-flex text-md-right xs12 :md6="tiene_cupon" :md12="!tiene_cupon" class="text-md-right"> -->
                        <v-flex text-md-right xs12 md6 class="text-md-right">
                          <span class="subheading bold">Subtotal  <span class="montos-labels">s/.{{formatoCosto(total_pagado)}}</span></span>
                          <div class="" v-if="promocion_id!=-1">

                              <span v-if="promocion_promo_label" class="subheading bold">{{promocion_promo_label}} <span class="montos-labels">s/.-{{formatoCosto(descuento)}}</span></span>
                              <!-- <span class="subheading bold">Concepto(IGV): </span> -->
                          </div>
                          <div class="" v-if="cupon_id!=-1">

                              <span v-if="promocion_cupon_label" class="subheading bold">{{promocion_cupon_label}} <span class="montos-labels">s/.-{{formatoCosto(descuento_cupon)}}</span></span>
                              <!-- <span class="subheading bold">Concepto(IGV): </span> -->
                          </div>
                            <span class="display-1 bold">Total <span class="montos-labels"> s/.{{total_pagado_final}}</span></span>
                        </v-flex>
                      </v-layout>
                    </div>
                  </div>
                </v-flex>
              </div>

              <v-flex xs12 class="text-center pt-4">
                <v-btn round outline class="btn-send-next" @click.native="e1 = 3">ATRAS</v-btn>
                <v-btn :disabled="btnListoLoading" :loading="btnListoLoading" round outline class="btn-send-next" @click.native="abrirPanelPagar">Listo</v-btn>
                <!-- <v-btn v-else round outline disabled class="btn-send-next" >Listo</v-btn> -->
              </v-flex>
            </v-layout>
          </v-container>
        </v-stepper-content>
        <!---->
      </v-stepper-items>
    </v-stepper>
    <v-dialog
      v-model="modalComplete"
      fullscreen
      transition="dialog-bottom-transition">
      <div class="modal-open-login">
        <v-card class="wrapper-info-finish">
          <div class="font-regular">
            <img class="icon-close-modal" src="../../img/close_icon.png" alt="">
            <h3 class="font-bold pb-2">Gracias por tu reserva</h3>
            <p>Estamos procesando tu solicitud, cuando tu reserva esté confirmada te enviaremos un correo con un código para que puedas dejar tu paquete en el locker que reservaste. </p>
            <img src="../../img/qrmail.png" alt="">
            <p class="mt-2">
Recuerda que tienes 24 horas para dejar tu paquete en el locker y luego 24 horas para que sea retirado.</p>
          </div>
        </v-card>
        <div class="back-modal-active" @click.stop="createReservation()">_</div>
      </div>
    </v-dialog>



    <v-navigation-drawer
      temporary
      v-model="drawerRight"
      disable-route-watcher
      disable-resize-watcher
      hide-overlay
      stateless
      touchless
      right
      light
      fixed
      class=" pb-3 drawer-admin-border d-flex justify-center" style="padding-top:103px;">
      <div class="text-center font-regular">


        <h3 class="font-bold">Total:</h3>
        <h2 class="font-bold monto-info mb-2 px-4 ">S./{{total_pagado_final}}</h2>
        <p style="" class="px-4 ">Recuerda que tienes 24 horas para dejar tu paquete en el locker y luego 24 horas para que sea retirado.</p>




        <metodos-pagos :propAdminPanel="'locker'">
        </metodos-pagos>

         <div class="pb-2">
           <v-btn v-if="!cardSelected" round disabled large class="cover btn-active elevation-0">Pagar</v-btn>
           <v-btn v-else round :disabled="pagarBtnLoading" :loading="pagarBtnLoading" large class="cover btn-active elevation-0" @click="guardarReservacionApi()">Pagar</v-btn>
         </div>
         <div class="text--red" v-if="errorGenerarPedido!=''" v-html="errorGenerarPedido"></div>
      </div>
    </v-navigation-drawer>
    <div v-if="drawerRight" class="back-modal-active-admin" style="position:fixed;" @click.stop="drawerRight = false">_</div>


  </v-flex>
</template>

<script>
  var querystring = require('querystring');
  import axios from 'axios'
  import { EventBus } from '../config/ebus.js'
  import * as apiRutas from '../config/apiRutas';
  //import tarjetasLista from './cTarjetasLista'
  import metodosPagos from './cMetodosPagos'

  var config_axios = {
    headers: {
      'Content-Type': 'application/x-www-form-urlencoded'
    }
  }

  export default {
    data () {
      return {
        enableNextStepPay: false,
        isEmptyStepTwo: false,
        menu: false,
        dateFormatted: null,
        monto: '50.00',
        date: null,
        direccion: 'Guillermo Prescott, Miraflores,',
        drawerRight: false,
        e1: 0,
        infoIcon: { url: '/images/info-min.png' , alt: 'icon info'},
        sizeElockers: [
          {name: 'Pequeño', slug:"pequeño", url: '/images/locker_smallcn.png', alt: 'elocker pequeño', costo: '20.00',
            h:'13cm',a:'31cm',p:'52cm'},
          {name: 'Mediano', slug:"mediano", url: '/images/locker_medianocn.png', alt: 'elocker mediano', costo: '50.00',
            h:'28cm',a:'31cm',p:'52cm'},
          {name: 'Grande', slug:"grande", url: '/images/locker_grandecn.png', alt: 'elocker grande', costo: '100.00',
            h:'43cm',a:'31cm',p:'52cm'}
        ],
        cupon_descuento: '',
        bgsteptwo: {url: '/images/shadow_box.png', alt: 'fondo paso dos'},
        activeLock: '',
        isEmptyActiveLocker: false,
        windowWidth: null,
        friendName: '',
        friendDni: '',
        friendEmail: '',
        friendPhone: null,
        emailValid: false,
        dniValid: false,
        // friend: {
        //     name: '', dni: null, email:'', phone: null,
        //   },
        currentLocation: {lat:-12.061844, lng: -76.99153409999997},
        center: {lat: -12.061844, lng: -76.99153409999997},
        markers: [
        ],
        searchLocation: '',
        modalComplete: false,
        queArticulo:'',
        //showCardForm:0,
        //cardSelected:0,
        addedCards:[

        ],
        modalDetalles:false,
        iconPay: [
          { url: '/images/visa.png', name: 'visa'},
          { url: '/images/american_express.png', name: 'american_express'},
          { url: '/images/master_card.png', name: 'master_card'},
          { url: '/images/diners_club.png', name: 'diners_club'},
        ],

        user_id:'',
        total_pagado:'',
        tarjeta_id:'2',
        amountPayable:0,


        tarjeta_numero: '',
        monthCard: '',
        yearCard: '',
        cvvCard: '',
        errorAddCard:'',
        addCardResult:{result:'',message:''},
        //addCardBtnLoading:false,
        userEmailAccount:'',


        lockerIDSelected:0,
        noLockerSelectedAlert:false,




        lockersListItems: [
        ],

        pagarBtnLoading:false,
        avisoPaso2:'',

        dir_selected:'Selecciona el locker mas cercano',
        btnListoLoading:false,
        expiry_origen:'',
        errorGenerarPedido:'',
        dataPromociones:null,
        tiene_cupon:false,
        promocion_id:-1,
        promocion_cupon_id:-1,
        soloPromocion:false,
        promocion_promo_label:'',
        promocion_cupon_label:'',
        descuento:0,
        descuento_cupon:0,
        //total_pagado_final:0,
        timeoutLlenandoCupon:false,
        datarescupon:null,
        promo_cuantos_usos_van:null,
        cupon_id:null,
        se_aplico_cupon:false,
        cupon_mensaje:'',
        checkboxFactura: false,


        facturacion_ruc:'',
        facturacion_razonsocial:'',
        facturacion_notice:'',
        facturacion_ruc_aux:'',
        facturacion_razonsocial_aux:'',

        promocion_minimo:0,
        promocion_cupon_minimo:0,


        frnameValid:false
      }
    },
    computed:{
      facturacion_error_ruc:function(){
        if(this.checkboxFactura){
          if(this.facturacion_notice!=''&&(this.facturacion_ruc.length!=11)){
            return true;
          }
        }
        return false;
      },
      facturacion_error_razonsocial:function(){
        if(this.checkboxFactura){
          if(this.facturacion_notice!=''&&this.facturacion_razonsocial==''){
            return true;
          }
        }
        return false;
      },
      total_pagado_final(){
         let total_pagado_final =  this.formatoCosto(parseFloat(this.total_pagado) - parseFloat(this.descuento) - parseFloat(this.descuento_cupon));

         if(parseFloat(total_pagado_final)<0){
           total_pagado_final = 0;
         }
         return total_pagado_final;
      },
      tarjeta_numero_formated () {
        return this.tarjeta_numero.replace(/\s+/g, '');
      },
      expiry_formated () {
        return this.monthCard + this.yearCard;
      },
      addCardBtnLoading(){
        return this.$store.getters.loadStateAddCardBtnLoading;
      },
      showCardForm(){
        return this.$store.getters.loadStateShowCardForm;
      },
      addCardQueFue(){
        return this.$store.getters.loadStateAddCardQueFue;
      },
      cardSelected:function(){
        let a = this.$store.getters.loadStateTarjetaPredeterminada;
        if(a==null||a==''||a==-1){
          return false
        }
        return a;
      },
    },
    watch:{
      facturacion_ruc:function(el){
        if(el.length==0||el.length==11){
          this.facturacion_notice = '';
        }
      },
      facturacion_razonsocial:function(el){
        if(el){
          this.facturacion_notice = '';
        }
      },
      expiry_origen: function (el) {
        let a = el.replace(/\s+/g, '');
        if(a.indexOf('/') !== -1){
          var a_ar = a.split("/");
          this.monthCard = a_ar[0];
          if((''+a_ar[1]).length<=2){
            this.yearCard = '20'+a_ar[1];
          }else{
            this.yearCard = a_ar[1];
          }


        }else{
          this.monthCard = '';
          this.yearCard = '';
        }
      },
      windowWidth: function (el) {
        if(el<460){
          // this.showMaps = false
        } else {
          // this.showMaps = true
        }
      },

      date: function (el) {
        if(el != null){
          this.enableNextStepPay = true
        }
      },
      activeLock: function (el) {
        if(el != null){
          this.isEmptyActiveLocker = true
        } else {
          this.isEmptyActiveLocker = false
        }
      },
      friendName: function (el) {
        if(el!=''){
          console.log('friendName');
          console.log(el);
          console.log(el.trim().indexOf(' ') != -1);
          if(el.trim().indexOf(' ') != -1){
            this.frnameValid = true;
          }else{
            this.frnameValid = false;
          }
        }else{
          this.frnameValid = true;
        }


        this.validateStepTwo();
      },
      friendEmail: function (el) {
        var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
        if(re.test(el.toLowerCase())){
          this.emailValid = true;
          this.validateStepTwo();
        }else{
          this.emailValid = false;
          this.validateStepTwo();
        }
      },
      friendPhone: function (el) {
        if(el != null){
          this.validateStepTwo()
        }
      },
      friendDni: function (el) {
        if(el != null){
          if(el.length==8){
            this.dniValid = true;
          }else{
            this.dniValid = false;
          }
          this.validateStepTwo()
        }
      },


    },
    mounted () {
      this.$nextTick(function() {
        window.addEventListener('resize', this.getWindowWidth);
      })
      this.getWindowWidth();
      this.geolocate();
      //this.listarTarjetasApi();
      //this.loadLockers();
      this.loadLockersApi();


      var pro = localStorage.getItem("user_p_info");
      pro = JSON.parse(pro);

      var vm = this;

      vm.user_id = pro.id;
      vm.userEmailAccount = pro.usuario_email;

      window.$ = window.jQuery = require('jquery');
      $('#autocompleteInput').on('keyup',function(e){
        //console.log($('#autocompleteInput').val());
        var code = e.which;

        vm.searchLocation = $('#autocompleteInput').val();
        if(code==13){
          console.log("enter");
          vm.searchTheLocation('user',$('#autocompleteInput').val());
        }
      });



      var pro = this.getLocalUser();

      this.facturacion_ruc = pro.usuario_ruc?pro.usuario_ruc:'';
      this.facturacion_razonsocial = pro.usuario_razonsocial?pro.usuario_razonsocial:'';
      this.facturacion_ruc_aux = pro.usuario_ruc?pro.usuario_ruc:'';
      this.facturacion_razonsocial_aux = pro.usuario_razonsocial?pro.usuario_razonsocial:'';


      // var querystring = require('querystring');
      //
      // var requestBody = querystring.stringify({
      //   'cuenta':	'01160551',
      //   'id_elocker':	'151',
      //   'id_locker_size':	1
      // })
      //
      // var url = apiRutas.asmx_DisponibilidadLocker;
      // var pres = '';
      // axios.post(url, requestBody, config_axios)
      //   .then((result) => {
      //     let res = result.data;
      //     var parser = new DOMParser();
      //     var xmlres = parser.parseFromString(res,"text/xml");
      //     // <Response>
      //     //   <codigo>1</codigo>
      //     //   <mensaje>Ok</mensaje>
      //     //   <contenido />
      //     // </Response>
      //     pres = xmlres.getElementsByTagName("mensaje")[0].childNodes[0].nodeValue;
      //
      //
      //   })
      //   .catch((err) => {
      //     // Do somthing
      //   })
      //





    },
    methods: {

      abrirPanelPagar:function(){
        if(this.checkboxFactura && (this.facturacion_ruc.length!=11 || this.facturacion_razonsocial=='')){
          if(this.facturacion_ruc.length!=11&& this.facturacion_razonsocial!=''){
            this.facturacion_notice = "Ingresa un RUC válido";
          }else{
            this.facturacion_notice = "Ingresa tus detalles de facturación";
          }
          return false;
        }
        this.drawerRight = true;
        this.errorGenerarPedido='';
      },
      resetearCupon:function(){
        this.se_aplico_cupon = false;
        this.cupon_descuento='';
        //this.promocion_id = -1;
        this.cupon_id = null;
        this.promocion_cupon_id = null;
        // alert(this.total_pagado_final);
        //this.total_pagado_final = parseFloat(this.total_pagado_final) + parseFloat(this.descuento);
        // alert(this.total_pagado_final);
        // alert(this.descuento);
        this.descuento_cupon = 0;

      },
      loadTarifaReservaApi:function(_callback){
        // return new Promise(
        //     function (resolve, reject) {
        //       setTimeout(()=>{
        //         var message = 'Hey friend, I have a new  phone';
        //         console.log(message);
        //         resolve(message);
        //       },5000);
        //
        //     }
        // );
        console.log("vamos a ver tarifa");
        this.btnListoLoading = true;
        var vm = this;
        var pro = localStorage.getItem("user_p_info");
        pro = JSON.parse(pro);
        var token = pro.token;



        axios({
          method:'get',
          url:apiRutas.locker_tarifa,
          params: {
            token:token,
            size:vm.activeLock,
            cupon:vm.cupon_descuento,
            promo_id:vm.promocion_id
          },
          auth : {
            username: 'admin@pickapp.com',
            password: 'PickJanaq18',
          }
        }).then(function(response){

          vm.total_pagado = response.data.data.precio;
          //vm.total_pagado_final = vm.total_pagado;
          vm.datarescupon = response.data.data.cupon_comoes;
          vm.promo_cuantos_usos_van = response.data.data.promo_cuantos_usos_van;
          console.log(vm.total_pagado);
          vm.btnListoLoading = false;
          //vm.drawerRight = true;
          vm.e1 = 4;
          if(_callback!=null){
          _callback();
          }
        }).catch(function (error) {
          console.log(error);
          vm.btnListoLoading = false;
        });
      },
      actualizarDelCupon:function(){
        this.loadTarifaReservaApi(()=>{

          if(this.datarescupon=='no-cupon'){
            this.cupon_mensaje = 'Cupón incorrecto';
            setTimeout(()=>{
              this.cupon_mensaje = '';
            },3000);
          }else if(this.datarescupon=='limite-alcanzado'){
            this.descuento_cupon = 0;
            this.promocion_cupon_label = '';
            this.cupon_id = this.datarescupon.cupon_id;
            this.promocion_cupon_id = -1;
            this.cupon_mensaje = 'Ya usaste este cupón';
            setTimeout(()=>{
              this.cupon_mensaje = '';
            },3000);
          }else if(this.datarescupon){
            var descuento_aux = 0;
            if(this.datarescupon.promocion_descuento_tipo =='porcentaje'){
              descuento_aux = this.total_pagado*(this.datarescupon.promocion_descuento/100);
            }else if(this.datarescupon.promocion_descuento_tipo =='flat'){
              descuento_aux = this.datarescupon.promocion_descuento;
            }

            // if(descuento_aux<=this.total_pagado){

              this.promocion_cupon_minimo = this.datarescupon.promocion_minimo;
              if(this.promocion_cupon_minimo){
                if(this.promocion_cupon_minimo>this.total_pagado){
                  this.promocion_cupon_minimo=this.total_pagado
                }
                if(this.total_pagado-descuento_aux<this.promocion_cupon_minimo){
                  descuento_aux = this.total_pagado - this.promocion_cupon_minimo;
                }
              }



              this.descuento_cupon = this.formatoCosto(descuento_aux);

              //this.promocion_descuento = promo_item.promocion_descuento;
              //this.tipo_descuento = promo_item.promocion_descuento_tipo;

              //this.total_pagado_final = this.formatoCosto(this.total_pagado - this.descuento);
              this.promocion_cupon_label = this.datarescupon.promocion_nombre;
              this.cupon_id = this.datarescupon.cupon_id;
              this.promocion_cupon_id = this.datarescupon.promocion_id;
              //alert("a llegado");

              //console.log(this.total_pagado_final)
              console.log('this.total_pagado_final')
              this.se_aplico_cupon = true;
            // }else{
            //   this.cupon_id=0;
            //   this.descuento_cupon = 0;
            //   this.promocion_cupon_label = "Cupón(error)";
            // }
          }
        });
      },
      goStep4:function(){

        this.calculaPromocion();

      },
      calculaPromocion:function(){

        var sihubocalculodepromo = false;
        var dataPromociones = this.$store.getters.loadStatePromociones;
        //var cuanto = dataPromociones.promo_cuantos_usos_van['scharff-stop'];

        if(dataPromociones&&dataPromociones.hay_promo==1){
          var arrayPromos = dataPromociones.promo_servicios['scharff-stop'];

          if(arrayPromos && arrayPromos.length>0){

                 //se va elegir el que tenga mayor prioridad
                 var promo_item = null;
                 var hay_cupon = false;


                 arrayPromos = arrayPromos.sort(function compare(a,b) {
                   if (a.promocion_prioridad < b.promocion_prioridad)
                   return -1;
                   if (a.promocion_prioridad > b.promocion_prioridad)
                   return 1;
                   return 0;
                 });



                 sihubocalculodepromo = true;
                 // if(!this.tiene_cupon){

                 this.loadTarifaReservaApi(() => {
                   var descuento_aux = 0;

                   var aux_ar_promos_total = [];
                   this.promo_cuantos_usos_van.forEach((el)=>{
                      aux_ar_promos_total[el.promocion_id] = el.total;
                   });


                   for (let el of arrayPromos) {
                     let total_promos_user = aux_ar_promos_total[el.promocion_id];
                     if(total_promos_user==null){
                       total_promos_user=0;
                     }
                     console.log("fuera");
                     console.log(total_promos_user);
                     console.log(el.promocion_transacciones);
                     console.log(el.promocion_id);
                     console.log(el.tiene_cupon);
                     if(el.tiene_cupon!=1){
                       if(total_promos_user<el.promocion_transacciones||el.promocion_transacciones==null){
                         console.log("paso");
                         console.log(el.promocion_transacciones);
                         console.log(el.promocion_id);
                         console.log(el.tiene_cupon);
                         console.log(el);

                         promo_item = el;
                         break;
                       }
                     }else{
                       hay_cupon = true;
                     }
                   }


                   if(promo_item!=null){


                       console.log(promo_item.promocion_id);
                       console.log("PromoTRANSACCIONES: "+promo_item.promocion_transacciones);

                       var promo_cuantos_usos_van_val = aux_ar_promos_total[promo_item.promocion_id];

                       console.log("PromoUSOS: "+promo_cuantos_usos_van_val);
                       console.log("PromoUSOSESTEPROMO: "+promo_item.promocion_id);


                       this.promocion_id = promo_item.promocion_id;

                       if(promo_item.promocion_descuento_tipo =='porcentaje'){
                         descuento_aux = this.total_pagado*(promo_item.promocion_descuento/100);
                       }else if(promo_item.promocion_descuento_tipo =='flat'){
                         descuento_aux = promo_item.promocion_descuento;
                       }


                       if(promo_item.promocion_transacciones!=null){

                         if(promo_cuantos_usos_van_val>=promo_item.promocion_transacciones){

                           this.promocion_id = -1;
                           this.descuento = 0;
                           descuento_aux = 0;
                         }
                       }

                       console.log('promo_item');
                       console.log(promo_item);
                       console.log(this.total_pagado);
                       console.log(this.descuento);
                       console.log(descuento_aux);
                       if(descuento_aux!=0){


                         //this.promocion_descuento = promo_item.promocion_descuento;
                         //this.tipo_descuento = promo_item.promocion_descuento_tipo;
                         //this.total_pagado_final = this.formatoCosto(this.total_pagado-this.descuento);
                         this.promocion_promo_label = "Promoción: "+promo_item.promocion_nombre;


                         if(promo_item.promocion_minimo){
                           this.promocion_minimo = promo_item.promocion_minimo;
                         }
                         if(this.promocion_minimo>this.total_pagado){
                           this.promocion_minimo=this.total_pagado
                         }
                         if(this.total_pagado-descuento_aux<this.promocion_minimo){
                           descuento_aux = this.total_pagado - this.promocion_minimo;
                         }



                         this.descuento = this.formatoCosto(descuento_aux);

                       }else{

                         this.descuento = 0;
                         this.promocion_promo_label = "Promoción(error)";
                       }
                       this.tiene_cupon = hay_cupon;
                       //alert("este");
                   }
                   //else{
                   //alert(hay_cupon);
                   if(!hay_cupon){
                     this.tiene_cupon = false;
                   }else{
                     //alert("y este");
                     //alert(this.cupon_descuento);
                     this.tiene_cupon = true;
                     if(this.cupon_descuento!=''){
                       //alert("si pasa");
                       this.actualizarDelCupon();
                     }
                   }
                   //}



















                 });

                 // }else{
                 //   this.actualizarDelCupon();
                 // }
              //}
          }
        }
        if(!sihubocalculodepromo){
          this.loadTarifaReservaApi();
        }

      },
      aplicarCupon:function(){
        // clearTimeout(this.timeoutLlenandoCupon);
        // console.log('llenandoCupon');
        // if(this.cupon_descuento.length>6){
        //     this.timeoutLlenandoCupon = setTimeout(()=>{
        //     console.log('revisandoCupones');
            this.actualizarDelCupon();
        //   },3000)
        // }
      },

      loadLockersApi:function(){

        var vm = this;
        var pro = localStorage.getItem("user_p_info");
        pro = JSON.parse(pro);
        var token = pro.token;
        axios({
          method:'get',
          url:apiRutas.locker_lista,
          params: {
            token:token
          },
          auth : {
            username: 'admin@pickapp.com',
            password: 'PickJanaq18',
          }
        }).then(function(response){
          let res = response.data;

          res.data.forEach(function(el){
            vm.markers.push({
              position:{
                lat: parseFloat(el.ubicacion_lat),
                lng: parseFloat(el.ubicacion_lng),

              },id: el.id,
              direccion: el.direccion,
            })
            vm.lockersListItems.push({
              nombre:el.nombre,
              id:el.id,
              lat: parseFloat(el.ubicacion_lat),
              lng: parseFloat(el.ubicacion_lng),
              direccion: (el.direccion),
            })
          });

        });
      },
      searchTheLocation: function(value, dir) {
        console.log("search");
        let geocoder = new google.maps.Geocoder()
        geocoder.geocode({'address': dir,
            componentRestrictions: {
            country: 'pe'
          }}, (results, status) => {
          if (status === 'OK') {
            switch(value){
              case 'user':
                this.currentLocation.lat = results[0].geometry.location.lat()
                this.currentLocation.lng = results[0].geometry.location.lng()
                //this.markers[0].position = {lat: this.currentLocation.lat, lng: this.currentLocation.lng};
                break
              case 'client':
                this.currentLocationClient.lat = results[0].geometry.location.lat();
                this.currentLocationClient.lng = results[0].geometry.location.lng();
            }

          }
        })
      },
      geolocate: function () {
        if ("geolocation" in navigator) {
          /* geolocation is available */
          //console.log('si')
          //console.log('aqui!')
          navigator.geolocation.getCurrentPosition((position) => {
            this.currentLocation = {
              lat: position.coords.latitude,
              lng: position.coords.longitude
            }
            //this.markers[0].position = {lat: position.coords.latitude, lng: position.coords.longitude};
          })
        } else {
          //console.log('no')
          /* geolocaiton IS NOT available */
        }

      },
      validateStepTwo: function () {
        if( this.friendName != '' &&
            this.friendDni != null &&
            this.friendDni.length == 8 &&
            this.emailValid === true &&
            this.friendPhone != null){
              this.isEmptyStepTwo = true
            } else {
              this.isEmptyStepTwo = false
            }

      },
      // isEmptyActiveLocker(item) {
      //   if(item != null) {
      //     return false
      //   } else {
      //     return true
      //   }

      // },
      isEmptyDate: function (el) {
        if (el != null){
          return true
        } else {
          return false
        }
      },
      parseDate (date) {
        if (!date) {
          return null
        }

        const [month, day, year] = date.split('/')
        return `${day.padStart(2, '0')}-${month.padStart(2, '0')}-${year}`
      },
      formatDate (date) {
        if (!date) {
          return null
        }

        const [year, month, day] = date.split('-')
        return `${day}-${month}-${year}`
      },
      // loadActualDate: function () {
      //   var hoy = new Date();
      //   var dd = hoy.getDate();
      //   var mm = hoy.getMonth()+1; //hoy es 0!
      //   var yyyy = hoy.getFullYear();
      //   // return `${dd}-${mm}-${yyyy}`
      //   this.date = `${dd}-${mm}-${yyyy}`
      // },
      openResumen: function () {
        this.drawerRight = false
        this.modalComplete = true
      },
      createReservation: function (){
        //this.modalComplete = false
        //this.$emit('createReservation', false)
        this.$router.push({name: 'historial', params: { panel: 'reservas' }})
        // this.e1 = 1
      },
      getWindowWidth(event) {
        this.windowWidth = document.documentElement.clientWidth
      },
      setLockerActive (item){
        this.activeLock = item.slug
        //this.amountPayable = item.costo
        //console.log(this.activeLock);
      },
      lockerActive: function (item) {
        return this.activeLock == item
      },
      searchMyLocation: function() {
        var geocoder = new google.maps.Geocoder();
        geocoder.geocode({'address': this.searchLocation}, (results, status) => {
          if (status === 'OK') {
            this.currentLocation.lat = results[0].geometry.location.lat();
            this.currentLocation.lng = results[0].geometry.location.lng();
            console.log("por ok");

            this.markers[0].position = {lat: this.currentLocation.lat, lng: this.currentLocation.lng};
          }
        });
      },
      // vaidMethodPay: function() {
      //   if( this.tarjeta_numero.length >= 16 &&
      //       this.monthCard.length < 3 &&
      //       this.yearCard.length == 4 &&
      //       this.cvvCard.length >= 3) {
      //         console.log(this.tarjeta_numero.length)
      //         console.log(this.monthCard.length)
      //         console.log(this.yearCard.length)
      //         console.log(this.cvvCard.length)
      //
      //         return false
      //   } else {
      //     return true
      //   }
      //
      // },
      guardarReservacionApi:function(){
        if(this.total_pagado_final<0){
          this.errorGenerarPedido='Error en el monto a pagar.';
          return false;
        }


        this.pagarBtnLoading = true;
        this.errorGenerarPedido='';
        var vm = this;

        var pro = localStorage.getItem("user_p_info");
        pro = JSON.parse(pro);
        var token = pro.token;
        var usuario_email = pro.usuario_email;


        var update_rucrazonsocial = 0;
        if(this.facturacion_ruc_aux != this.facturacion_ruc){
          update_rucrazonsocial = 1;
        }
        if(this.facturacion_razonsocial_aux != this.facturacion_razonsocial){
          if(update_rucrazonsocial==1){
            update_rucrazonsocial = 3;
          }else{
            update_rucrazonsocial = 2;
          }
        }

        var datacodigopedidos = this.$store.getters.loadStateCodigoPedidos;
        console.log('datacodigopedidos');
        console.log(datacodigopedidos);
        axios({
          method:'post',
          url:apiRutas.reserva_agregar+'?token='+token,
          data: {
            estado:'1',
            //fecha_entrega:fecha_entrega,
            contacto:vm.friendName,
            dni:vm.friendDni,
            correo:vm.friendEmail,
            celular:vm.friendPhone,
            //fecha_recojo:'1999-05-00 07:12:00',
            //fecha_recojo:fecha_recojo,
            total_pagado:vm.total_pagado_final,
            size:this.activeLock,
            articulo:vm.queArticulo,
            tarjeta_id:vm.cardSelected,
            locker_id:vm.lockerIDSelected,
            usuario_email,
            promocion_id:vm.promocion_id,
            promocion_cupon_id:vm.promocion_cupon_id,
            cupon_descuento:vm.cupon_descuento,
            tiene_cupon:vm.tiene_cupon?1:0,
            descuento:vm.descuento,
            descuento_cupon:vm.descuento_cupon,
            cupon_id:vm.cupon_id,
            reserva_ruc:vm.facturacion_ruc,
            reserva_razonsocial:vm.facturacion_razonsocial,
            emitir_factura:vm.checkboxFactura?1:0,
            update_rucrazonsocial,
            datacodigopedidos
            //direccion:vm.searchLocation,
            //user_id:vm.user_id,
          },
          auth : {
            username: 'admin@pickapp.com',
            password: 'PickJanaq18',
          }
        }).then(function(response){
          console.log(response);
          if(response.data.tipo==1){
            vm.modalComplete=true;
            vm.drawerRight=false;
            if(response.data.updated_rucrazonsocial){
              var pro = vm.getLocalUser();
              pro.usuario_ruc = vm.facturacion_ruc;
              pro.usuario_razonsocial = vm.facturacion_razonsocial;
              vm.setLocalUser(pro);
            }
            vm.$store.commit('setStateCodigoPedidos', 2);
          }else{
            vm.addCardBtnLoading = false;
            vm.errorGenerarPedido='No se pudo realizar el pago.<br />Inténtalo nuevamente';
            vm.reportarLog('registrar_pago',"Error durante pago - locker");
          }
          vm.pagarBtnLoading=false;
        }).catch(function(error){
          console.log(error);

          vm.pagarBtnLoading=false;
          if(vm.total_pagado_final<3){
            vm.errorGenerarPedido='El pago debe ser mayor o igual que 3 soles.<br />';
            vm.reportarLog('registrar_pago',"Pago menor a 3 soles - locker");
          }else{
            vm.errorGenerarPedido='No se pudo realizar el pago.<br />Inténtalo nuevamente';
            vm.reportarLog('registrar_pago',"Error consumo api - locker");
          }
        });
      },


      clickOnLocker:function(id){
        console.log("clic en ");
        console.log(id);
        this.lockerIDSelected = id;
        this.noLockerSelectedAlert = false;
      },
      selecListLocker:function(el){
        console.log(el);
        this.lockerIDSelected = el.id;
        this.currentLocation= {lat:parseFloat(el.lat), lng: parseFloat(el.lng)};
        console.log('el.direccion');
        console.log(el.direccion);
        this.dir_selected = el.direccion;
      },







    },
    components:{
      //'tarjetas-lista':tarjetasLista,
      'metodos-pagos':metodosPagos
    }
  }
</script>

<style lang="scss">
@import "../../scss/vars.scss";
.primary--color {
  color: $primary-color
}
.lock-step-3{
  width: 999px;
margin: auto;

}
.mapaylista{
  display: flex;
}
.listalockers-w{
  width: 300px;
  height: 330px;
  overflow-y: auto;
  background: #424242;
}
.mapalockers-w{
  width: calc(100% - 300px)
}
.listalockers-w .list--two-line .list__tile {
    height: 64px;
}
.lockerSelected{
  border-right: 3px solid $primary-color;
  background: #272727;
}
.wrapper-step-tree{
    width: 31rem;
  max-width: 100%;
  text-align: center;
  border-bottom: none
}
.wrapper-step-tree label {
  display: inline;
  width: auto;
}
.size-lockers__leyenda{
  clear: both;
  display: block;
  text-align: center;
  margin-top: -11px;
  margin-bottom: 17px;
  font-weight: 500;
  font-family: Carnas-light;
}
@media screen and (max-width: 600px) {
     .listalockers-w{
       width: auto;
       .list__tile--link {
         font-size: 10px;
         height: 44px !important;
       }
     }
     .mapalockers-w {
       width: calc(100% - 170px);
     }
     .min-width-step-two {
       padding: 2.5rem 2rem;
     }
     .cupon-box{
       margin-bottom: 20px;
     }
    .regular-step1 .min-width-step-two {
      padding-left: 1.5rem;
      padding-right: 1.5rem;
    }
    .regular-step1m3 .line-bottom_em:before {
      left: 23px;
      width: calc(100% - 45px);
    }
}
span.montos-labels {
    display: inline-block;
    min-width: 109px;
}
.btn-aplicar-cupon {
  border-color: gray !important;
}
.btn-aplicar-cupon .btn__content{
font-family: Carnas-Regular;
    color: gray;
    text-transform: initial;
  }
  .regular-step1m3 .line-bottom_em input.input-cupon{
    width: 162px;
    max-width: 100%;
    margin-right: 18px;
}
.btn-aplicar-cupon+span{
  display: inline-block;
  vertical-align: middle;
}
.cupon-input-w i{
  display: none;
}
.cupon-input-w:hover i{
  display: block;
}
.fade-leave-active {
  transition: opacity .5s;
}
 .fade-leave-to{
  opacity: 0;
}
.text--red {
    color: #ff5e65;
}
.block-factura .input-factura input.facturacion_error {
    border-bottom: 1px solid red;
}
</style>
