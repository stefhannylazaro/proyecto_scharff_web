<template>
  <v-flex xs12>
    <v-flex x12 class="d-align-between px-4 py-3 bg-smoke">
        <h3>HISTORIAL DE PEDIDOS</h3>
        <v-btn
          round
          class="pink white--text elevation-0"
          @click="createReservation('newEnvio')">
            NUEVO PEDIDO
        </v-btn>
      </v-flex>
      <v-flex xs12 class="pa-3" >
        <info-table
          v-on:openModalDetail="openModalDetail"
          v-on:verSeguimiento="verSeguimiento"
        ></info-table>
      </v-flex>
  </v-flex>
</template>

<script>
import infoTable from './cInfoTable.vue'
export default {
  data () {
    return {

    }
  },
   methods: {
    createReservation: function () {
      // console.log(this.$route)
      this.$emit('createReservation', 'newEnvio')
    },openModalDetail:function(){
      console.log("este si llega");
      this.$emit('openModalDetailP', true)
    },verSeguimiento:function(pedido_id){
      this.$emit('verSeguimiento', pedido_id);
      console.log("si seguimiento");
    }
  },
  components: {
    'info-table': infoTable,
  }
}
</script>

<style>

</style>
