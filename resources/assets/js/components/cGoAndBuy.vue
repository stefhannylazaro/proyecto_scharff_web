<template>
  <v-layout row wrap class="p_relative">
    <!-- <v-slide-x-transition> -->

      <v-flex xs12 v-if="tipo_panel=='panel'">

        <v-layout class=" py-5 pm-5  text-center">

            <v-flex x6
              round
              class="elevation-0 text-lg-right"
              @click="gotoPanel('mi-direccion')">
              <v-btn
                flat
                class="btn-dashed"
                :class="{'active': $route.params.panel=='mi-direccion'}"
              >
                Mi dirección
              </v-btn>
            </v-flex>

            <v-flex 6
              round
              class="elevation-0 text-lg-left"
              @click="gotoPanel('mis-pedidos')">
              <v-btn
                flat
                class="btn-dashed"
                :class="{'active': $route.params.panel=='mis-pedidos'}"
              >
                Mis pedidos
              </v-btn>

            </v-flex>


        </v-layout>

        <v-flex xs12 class="gobuyadmin-f-view-router" >
          <mi-direccion
            v-if="$route.params.panel=='mi-direccion'"
          ></mi-direccion>


          <mis-pedidos
            v-if="$route.params.panel=='mis-pedidos'"
          ></mis-pedidos>





        </v-flex>


      </v-flex>


      <go-pedido-detalle v-else
        :pedidoid="$route.params.item_id"
        @verHistorial="gotoHistorial"
      ></go-pedido-detalle>







    <!-- </v-slide-x-transition> -->
  </v-layout>
</template>

<script>
import infoTable from './cInfoTable.vue'

import miDireccion from './cMiDireccion.vue'
import misPedidos from './cMisPedidos.vue'
import goPedidoDetalle from './cGoPedidoDetalle.vue'

export default {
  data () {
    return {
      createReserva: false,
      tabla:1,
      envioid:0,
      panel_q:'',
      tipo_panel:'panel'
    }
  },mounted(){
    
    if(this.$route.params.item_id){
      this.envioid = this.$route.params.item_id;
      this.tipo_panel='seguimiento';
      console.log('this.tipo_panel');
      console.log(this.tipo_panel);
    }else{
      this.tipo_panel='panel';
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
      this.$router.push({ name: 'go-buy-admin', params: { panel: panel }});
      this.tipo_panel='panel';
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
      this.$router.push({ name: 'panel', params: { panel: 'express' ,item_id:this.envioid}});
    },gotoHistorial:function(panel){
      this.tipo_panel='historial';

    },
  },
  components: {
    'mi-direccion':miDireccion,
    'mis-pedidos':misPedidos,
    'go-pedido-detalle':goPedidoDetalle
  }

}
</script>

<style>
  .btn-dashed .btn__content:after{
    border-radius: 17px;
    color: #ff535a;
    content: "";
    position: absolute;
    left: 30%;
    top: 36px;
    height: 0.3rem;
    opacity: 1;
    -webkit-transition: 0.3s cubic-bezier(0.25, 0.8, 0.5, 1);
    transition: 0.3s cubic-bezier(0.25, 0.8, 0.5, 1);
    width: 40%;
  }
  .btn-dashed.active .btn__content:after,
  .btn-dashed:hover .btn__content:after{
    background: #ff535a;
  }

  .btn-dashed .btn__content {
    text-transform: initial;
    font-size: 20px;
    font-family: Carnas-Bold;
  }
@media screen and (max-width: 1200px){
  .gobuyadmin-f-view-router{
    padding-left:20px;
    padding-right:20px;
  }
}
</style>
