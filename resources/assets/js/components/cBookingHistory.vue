<template>
  <v-flex xs12>
    <v-flex x12 class="d-align-between px-4 py-3 bg-smoke">
        <h3>HISTORIAL DE RESERVAS</h3>
        <v-btn
          round
          class="pink white--text elevation-0"
          @click="createReservation()">
            nueva reserva
        </v-btn>
      </v-flex>
      <v-flex xs12 class="pa-3" >
        <info-table-reserva></info-table-reserva>
      </v-flex>
  </v-flex>
</template>

<script>
import infoTableReserva from './cInfoTableReserva.vue'
export default {
  data () {
    return {

    }
  },
   methods: {
    createReservation: function () {
      // console.log(this.$route)
      this.$emit('createReservation', true)
    }
  },
  components: {
    'info-table-reserva': infoTableReserva,
  }
}
</script>

<style>

</style>
