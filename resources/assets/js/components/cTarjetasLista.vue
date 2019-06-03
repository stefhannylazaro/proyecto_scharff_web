<template lang="html">
  <div class="">
    <slot></slot>
    <div
    class="tarjetas-agregadas"
    v-for="(el, idx) in addedCards"
    :key="idx" v-if="el.usable">

      <div  class="tarjeta-agregada"
      @click="select_this(idx)"
      :class="{
      'tarjeta-seleccionada' : cardSelected==el.tarjeta_id,
      'semiseleccionada':cardClickeada==el.tarjeta_id}">

          <i class="material-icons tarjeta-agregada-icon-left">credit_card</i>
          <p>
            <span>{{el.tarjeta_marca}}</span>
            <strong>**** **** **** {{el.tarjeta_numero}}</strong>
            <!--<span>{{el.tarjeta_predeterminada}}</span> <br>
            <span>{{el.tarjeta_cardid}}</span> <br>-->
          </p>
          <span class="selected-card" v-if="cardSelected==el.tarjeta_id"><i class="material-icons">check_circle</i></span>



      </div>

    </div>

    <v-slide-x-transition v-if="propAdminPanel=='metodos'">
    <div class="tarjetas-seleccionadas-opciones" v-if="opcionesTarjeta&&!showCardForm">
      <span @click="predeterminarApi" :class="{'loading':predeterminarApiLoading}"><i :class="{'material-icons':!predeterminarApiLoading}" v-text="predeterminarApiLoading?'':'check'"></i> Predeterminar</span>
      <span @click="eliminarTarjetaApi" :class="{'loading':eliminarTarjetaLoading}"><i :class="{'material-icons':!eliminarTarjetaLoading}" v-text="eliminarTarjetaLoading?'':'close'"></i> Eliminar</span>
    </div>
    </v-slide-x-transition>


  </div>
</template>

<script>
import axios from 'axios'
import * as apiRutas from '../config/apiRutas';
import { EventBus } from '../config/ebus.js'




export default {
  props:['propAdminPanel'],
  data () {
    return {
      cardClickeada:-1,
      opcionesTarjeta:false,
      predeterminarApiLoading:false,
      eliminarTarjetaLoading:false
    }
  },
  mounted () {
    console.log('cardSelected');


  },
  watch:{
    showCardForm:function(el){
      if(el){
        this.cardClickeada = -1;
      }
    }
  },
  computed:{
    addedCards: function () {
      return this.$store.getters.loadStateAddedCards;
    },
    cardSelected:function(){
      return this.$store.getters.loadStateTarjetaPredeterminada;
    },
    showCardForm:function(){
      return this.$store.getters.loadStateShowCardForm;
    }
  },methods:{
    select_this: function(idx){

      this.$store.commit('setStateShowCardForm',false);

      var vm = this;
      this.addedCards.forEach(function(el){
        if(el.cardClickeada==1){
          vm.cardClickeada = 0;
        }
      });

      if(this.opcionesTarjeta&&(this.cardClickeada ==this.addedCards[idx].tarjeta_id)){
        console.log("a entrado aqui");
        console.log(this.opcionesTarjeta);

        this.opcionesTarjeta=false;
        this.cardClickeada='';
        return false;
      }

      this.cardClickeada = this.addedCards[idx].tarjeta_id;


      this.opcionesTarjeta=true;


      if(this.propAdminPanel!='metodos'){
        this.predeterminarApi();
      }

    },
    predeterminarApi:function(){
      this.predeterminarApiLoading = true;
      var vm = this;
      var pro = localStorage.getItem("user_p_info");
      pro = JSON.parse(pro);
      var token = pro.token;


      var servicio_setPredeterminada = apiRutas.marcarPredeterminada+'/'+this.cardClickeada;

      axios({
        url:servicio_setPredeterminada,
        method:'put',
        params: {
          token:token
        },
        auth : {
          username: 'admin@pickapp.com',
          password: 'PickJanaq18',
        }
      })
      .then(function(response){
        let res = response.data;
        //console.log(res);
        vm.$store.commit('setStateTarjetaPredeterminada',vm.cardClickeada);
        // vm.addedCards.forEach(function(el){
        //   if(el.tarjeta_id==vm.cardSelected){
        //     el.tarjeta_predeterminada = 1;
        //   }else{
        //     el.tarjeta_predeterminada = 0;
        //   }
        // });
        vm.predeterminarApiLoading = false;

      }).catch(function (error) {
        console.log(error);
        vm.predeterminarApiLoading = false;
      });
    },
    eliminarTarjetaApi:function(){
        this.$store.commit('setStateAddCardQueFue',['','']);
        if(this.eliminarTarjetaLoading){
          return false;
        }
        this.eliminarTarjetaLoading = true;
        var vm = this;

        var pro = localStorage.getItem("user_p_info");
        pro = JSON.parse(pro);
        var token = pro.token;

        var servicio_eliminarCard = apiRutas.eliminarTarjeta+'/'+this.cardClickeada;

        axios({
          url:servicio_eliminarCard,
          method:'delete',
          params: {
            token:token
          },
          auth : {
            username: 'admin@pickapp.com',
            password: 'PickJanaq18',
          }
        })
        .then(function(response){
          let res = response.data;
          console.log('tarjeta eli res');
          console.log(res);
          if(res.tipo==1){


            vm.cardOpMessage = 'Tarjeta eliminada';
            vm.opcionesTarjeta = false;
            let auxAddedCards = vm.addedCards;
            auxAddedCards.forEach(function(el){
              if(el.tarjeta_id==vm.cardClickeada){
                el.usable = false;
              }
            });


            vm.cardClickeada = -1;
            vm.$store.commit('setStateAddedCards',auxAddedCards);
            vm.$store.commit('setStateTarjetaPredeterminada',-1);


          }else if(res.tipo==3){
            vm.cardOpMessage = 'No se pudo eliminar la tarjeta';

          }
          vm.eliminarTarjetaLoading=false;
        }).catch(function (error) {
          console.log(error);
          vm.eliminarTarjetaLoading=false;
        });

        return false;


    },

  }
}
</script>

<style lang="css">
</style>
