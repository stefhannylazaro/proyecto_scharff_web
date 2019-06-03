<template>
  <v-layout row wrap class="p_relative">
    <v-slide-x-transition>

    <v-flex xs12 v-if="tipo_panel=='historial'" >

      <v-flex x12 class=" px-4 py-3  text-center">

          <v-btn
            round
            class="elevation-0" :class="{'pink white--text': $route.params.panel=='reservas'}"
            @click="gotoPanel('reservas')">
              RESERVAS LOCKER
          </v-btn>

          <v-btn
            round
            class="elevation-0" :class="{'pink white--text': $route.params.panel=='express'}"
            @click="gotoPanel('express')">
             ENVÍOS EXPRESS
          </v-btn>

          <v-btn
            round
            class="elevation-0" :class="{'pink white--text': $route.params.panel=='regular'}"
            @click="gotoPanel('regular')">
             ENVÍOS REGULARES
          </v-btn>
        </v-flex>

        <v-flex xs12 class="pa-3" >

          <info-table-reserva
            v-if="$route.params.panel=='reservas'"
          ></info-table-reserva>


          <info-table
            v-if="$route.params.panel=='express'"
            v-on:openModalDetail="openModalDetail"
            v-on:verSeguimiento="verSeguimiento"
          ></info-table>


          <info-table-regular
            v-if="$route.params.panel=='regular'"
          ></info-table-regular>



        </v-flex>


  </v-flex>


  <seguimiento-envio class="p_absolute"
  v-else-if="tipo_panel=='express'"
  :envioid="$route.params.item_id"
  @verHistorial="gotoHistorial"
  ></seguimiento-envio>

  <regular-detalle class="p_absolute"
  v-else-if="tipo_panel=='regular'"
  :itemId="$route.params.item_id"
  :detalleDe="'regular'"
  @verHistorial="gotoHistorial"
  ></regular-detalle>





    </v-slide-x-transition>
  </v-layout>
</template>

<script>
import infoTable from './cInfoTable.vue'

import infoTableReserva from './cInfoTableReserva.vue'
import infoTableRegular from './cInfoTableRegular.vue'
import seguimientoEnvio from '../components/cSeguimientoEnvio.vue'
import regularDetalle from '../components/cEnvioRegularDetalle.vue'

export default {
  data () {
    return {
      createReserva: false,
      tabla:1,
      envioid:0,
      panel_q:'',
      tipo_panel:'historial'
    }
  },mounted(){
    console.log("inicio");
    console.log("MOUNTED HISTORIAL");
    if(this.$route.params.item_id){
      this.envioid = this.$route.params.item_id;
      this.tipo_panel=this.$route.params.panel;
      console.log('this.tipo_panel');
      console.log(this.tipo_panel);
    }else{
      this.tipo_panel='historial';
      console.log('this.tipo_panel');
      console.log(this.tipo_panel);

    }




      // if(this.$route.params.tabla=="express"){
      //   this.tabla=2;
      //   this.panel='historial';
      // }
      //
      // if(window.location.hash === "#express"){
      //   this.tabla=2;
      //   this.panel='historial';
      // }
      // if(this.$route.params.tabla=="seguimiento"){
      //   this.tabla=2;
      //   let pedido_id = this.$route.params.pedido_id;
      //   this.envioid = pedido_id;
      //   this.panel='verSeguimiento';
      //
      // }


  },
  methods: {
    gotoPanel:function(panel){
      this.$router.push({ name: 'historial', params: { panel: panel }});
      this.tipo_panel='historial';
    },
    createReservation: function () {
      // console.log(this.$route)
      this.$emit('createReservation', 'newEnvio')
    },openModalDetail:function(){
      this.$emit('openModalDetailP', true)
    },verSeguimiento:function(pedido_id){
      console.log("si habia llegado");

      this.envioid = pedido_id;
      this.tipo_panel='seguimiento';
      this.$router.push({ name: 'historial', params: { panel: 'express' ,item_id:this.envioid}});
    },gotoHistorial:function(panel){
      this.tipo_panel='historial';

    },
  },
  components: {
    'info-table': infoTable,
    'info-table-reserva': infoTableReserva,
    'info-table-regular': infoTableRegular,
    'seguimiento-envio': seguimientoEnvio,
    'regular-detalle': regularDetalle
  }

}
</script>

<style>

</style>
