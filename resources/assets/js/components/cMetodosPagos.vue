<template>
  <div class="text-center font-regular">
    <tarjetas-lista :propAdminPanel="propAdminPanel">
      <h3 class="font-bold mb-3">Elige tu método de pago</h3>
    </tarjetas-lista>

    <div class="agregar-tarjeta px-4" @click.natural="deseleccionarTarjeta()" >
      <img src="/images/mas.png" alt="">Agregar tarjeta de crédito
    </div>

<v-slide-x-transition>
    <div  class="agregar-tarjeta-form mb-3" v-if="$store.getters.loadStateAdminPanel == propAdminPanel && showCardForm">


      <div class="stepper-add-card">
        <div class="">
          <div :class="'card-wrapper-'+propAdminPanel"></div>
          <div class="d-align-around container-pay-icons">
            <div
              class="pay-icon"
              v-for="(el, idx) in iconPay"
              :key="idx"

              >
              <img :src="el.url" :alt="el.name">
            </div>
          </div>

          <div :class="'input-payment-methods card-form-'+propAdminPanel+' pb-3'">
            <input type="hidden" id="card[email]"
            :value="userEmailAccount" class="hidden" />

            <input type="text"
            placeholder="Número de tarjeta" style="width:100%;" v-model="tarjeta_numero" name="number" >

            <input type="hidden" id="card[number]"
            placeholder="Número de tarjeta" style="width:100%;" :value="tarjeta_numero_formated">

            <input type="text" name="" style="width:100%;" name="expiry" v-model="expiry_origen" placeholder="Mes / Año">

            <input type="hidden" id="card[exp_month]" placeholder="Mes" style="width: 40%;" v-model="monthCard">

            <input type="hidden" id="card[exp_year]" placeholder="Año" style="width: 58%;" v-model="yearCard">

            <input type="number" id="card[cvv]" name="cvc" placeholder="cvv" style="width:100%;" v-model="cvvCard" class="sinflechas">



          </div>

          <v-btn v-if="vaidMethodPay()" round disabled class="cover btn-active elevation-0">Agregar</v-btn>
          <v-btn v-else round :loading="addCardBtnLoading" :disabled="addCardBtnLoading" class=" btn-active elevation-0 btn--round" @click.stop="agregarTarjeta">Agregar</v-btn>
          <div class="red--text" v-if="addCardQueFue[0]=='error'" v-text="addCardQueFue[1]"></div>
        </div>

      </div>

    </div>
    </v-slide-x-transition>
      <div class="card-op-message" v-if="addCardQueFue[0]=='success'" v-text="addCardQueFue[1]"></div>

  </div>
</template>

<script>
import axios from 'axios'
import { EventBus } from '../config/ebus.js'
import tarjetasLista from './cTarjetasLista'
import * as apiRutas from '../config/apiRutas';
import card from 'card/dist/card.js'

export default {
  props:['propAdminPanel'],
  data () {
    return {
      //showCardForm: 0,
      iconPay: [
        { url: '/images/visa.png', name: 'visa'},
        { url: '/images/american_express.png', name: 'american_express'},
        { url: '/images/master_card.png', name: 'master_card'},
        { url: '/images/diners_club.png', name: 'diners_club'}
      ],payMethodSelected:null,
      tarjeta_numero: '',
      monthCard: '',
      yearCard: '',
      cvvCard: '',
      methodCard: '',
      cardSelected:0,
      errorAddCard:'',
      //addCardBtnLoading:false,
      cardClickeada:'',
      opcionesTarjeta:false,
      cardOpMessage:'',
      userEmailAccount:'',
      eliminarTarjetaLoading:false,
      predeterminarApiLoading:false,
      expiry_origen:'',
      addedCards:[]
    }
  },
  mounted(){

    var vm = this;

    var pro = localStorage.getItem("user_p_info");
    pro = JSON.parse(pro);

    vm.userEmailAccount = pro.usuario_email;

    // EventBus.$off('sincronizar_tarjetas_r');
    // EventBus.$on('sincronizar_tarjetas_m', this.sincronizar_tarjetas_m);
    // EventBus.$off('tokenizar_tarjeta');
    // EventBus.$on('tokenizar_tarjeta', this.tokenizar_tarjeta_cont);






    window.$ = window.jQuery = require('jquery');
    //require('card');

    $(document).ready(function(){



    });

  },
  methods:{
    // selectPayMethod: function(el) {
    //   this.payMethodSelected = el
    // },
    // iconActive: function(el) {
    //   if(this.payMethodSelected == el) {
    //     return true
    //   } else {
    //     return false
    //   }
    // },
    vaidMethodPay: function() {
      if( this.tarjeta_numero.length >= 16 &&
          this.monthCard.length < 3 &&
          this.yearCard.length == 4 &&
          this.cvvCard.length >= 3) {
          return false
      } else {
        //console.log("FALSO");
        return true;
      }
    },
    deseleccionarTarjeta:function(){

      //this.showCardForm=2;
      var vm = this;
      this.$store.commit('setStateShowCardForm',true);
      this.$store.commit('setStateAdminPanel',vm.propAdminPanel);
      this.$store.commit('setStateAddCardQueFue',['','']);

      setTimeout(function(){
        console.log("Se va ejecutar card 3th")
        console.log(vm.propAdminPanel);
        new Card({
          form: document.querySelector('.card-form-'+vm.propAdminPanel),
          container: '.card-wrapper-'+vm.propAdminPanel,
          messages: {
    	      validDate: 'Vence\nfin de',
    	      monthYear: 'Mes / Año'
    	    },
        });
      },400);

      // this.cardOpMessage='';
      // this.addedCards.forEach(function(el){
      //   if(el.tarjeta_predeterminada==1){
      //     el.tarjeta_predeterminada = 0;
      //   }
      // });
    },

    agregarTarjeta: function(){
      this.cardOpMessage='';

      //verificar primer servicioa
      var pro = localStorage.getItem("user_p_info");
        pro = JSON.parse(pro);
        var token = pro.token;
      if(pro.usuario_dni==''||pro.usuario_movil==''||!pro.usuario_dni || !pro.usuario_movil){
          this.$store.commit('setStateDataUsuario', 2);
        return false;
      }

      setTimeout(function(){
        console.log("Tokenizar desde metodos");
        Culqi.createToken();
      },200);




      var vm = this;
      //vm.errorAddCard = '';

      //vm.addCardBtnLoading = true;
      vm.$store.commit('setStateAddCardQueFue',['','']);
      vm.$store.commit('setStateAddCardBtnLoading',true);
      // vm.addedCards.forEach(function(el){
      //   if(el.tarjeta_predeterminada==1){
      //     el.tarjeta_predeterminada = 0;
      //   }
      // });

      return false;


    },

  },
  computed:{
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
    stateDataUsuario: function () {
      return this.$store.getters.loadStateDataUsuario
    }
  },
  watch:{
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
    stateDataUsuario: function(el) {
      if(this.$store.getters.loadStateDataUsuario=='continuar-addcard'){
        this.agregarTarjeta();
      }
    }

  },
  components:{
    'tarjetas-lista':tarjetasLista
  }

}
</script>

<style lang="scss">
@import "../../scss/vars.scss";

</style>
