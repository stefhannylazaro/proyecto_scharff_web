<template>
  <v-layout row wrap class="p_relative">
    <v-slide-x-transition>
    <new-reservation class="p_absolute" v-if="createReserva" v-on:createReservation="createReservation"></new-reservation>
    <booking-history
      v-else
      v-on:createReservation="createReservation"
      class="p_absolute">
    </booking-history>
    </v-slide-x-transition>
  </v-layout>
</template>

<script>
import bookingHistory from '../components/cBookingHistory.vue'
import newReservation from '../components/cNewReservation.vue'

export default {
  data () {
    return {
      createReserva: true
    }
  },
  methods: {
    createReservation: function (value) {
      this.createReserva = value
    }
  },
  components: {
    'booking-history': bookingHistory,
    'new-reservation': newReservation
  }

}
</script>

<style>

</style>
