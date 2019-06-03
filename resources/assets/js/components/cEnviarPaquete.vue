<template>
  <v-layout row wrap class="p_relative">
    <v-slide-x-transition>
      <booking-history
        v-if="panelEnvio=='envioLista'"
        v-on:createReservation="createReservation"
        v-on:verSeguimiento="verSeguimiento"
        class="p_absolute">
      </booking-history>


      <new-reservation class="p_absolute"
      v-else-if="panelEnvio=='newEnvio'"
      v-on:createReservation="createReservation"
      ></new-reservation>


      <seguimiento-envio class="p_absolute"
      v-else-if="panelEnvio=='verSeguimiento'"
      :envioid="envioid"

      v-on:createReservation="createReservation"
      ></seguimiento-envio>


    </v-slide-x-transition>
  </v-layout>
</template>

<script>
import bookingHistory from '../components/cBookingHistoryPackage.vue'
import newReservation from '../components/cNewSendPackage.vue'
import seguimientoEnvio from '../components/cSeguimientoEnvio.vue'

export default {
  data () {
    return {
      panelEnvio: 'newEnvio',
      envioid : null
    }
  },
  methods: {
    createReservation: function (value) {
      if(value==false){
        //value='envioLista';
        this.$router.push({name: 'historial', params: { panel: 'express' }})
      }

      this.panelEnvio = value
    },
    verSeguimiento: function (value) {
      this.envioid = value;
      this.panelEnvio = 'verSeguimiento'
    }
  },
  components: {
    'booking-history': bookingHistory,
    'new-reservation': newReservation,
    'seguimiento-envio': seguimientoEnvio,
  }

}
</script>

<style>

</style>
