<template>
<div>
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
    class="px-4 pt-5 pb-3 drawer-admin-border d-flex justify-center align-center">
    <div class="text-center font-regular">
      <h3 class="font-bold mb-3">Resumen de reserva</h3>
      <p>Estás reservando un elocker en </p>
      <h3 class="font-bold">¿Para cuando?</h3>
      <v-menu
      lazy
      :close-on-content-click="false"
      v-model="menu"
      transition="scale-transition"
      offset-y
      full-width
      :nudge-right="40"
      max-width="290px"
      min-width="290px"
    >
      <v-text-field
        slot="activator"
        label="Fecha"
        v-model="dateFormatted"
        prepend-icon="event"
        readonly
        class="input-date-reservation black--text"
        :class="{labelDisplayNone: isEmptyDate(date)}"
        @blur="date = parseDate(dateFormatted)"
      ></v-text-field>
      <v-date-picker
        v-model="date"
        @input="dateFormatted = formatDate($event)"
        no-title scrollable actions>
        <template slot-scope="{ save, cancel }">
          <v-card-actions>
            <v-spacer></v-spacer>
            <v-btn flat color="primary" @click="cancel">Cancel</v-btn>
            <v-btn flat color="primary" @click="save">OK</v-btn>
          </v-card-actions>
        </template>
      </v-date-picker>
    </v-menu>
      <h3 class="font-bold">Total:</h3>
      <h2 class="font-bold monto-info mb-2">S./{{monto}}</h2>
      <p style="font-size:.8rem;">Recuerda que tienes 24hrs para dejar tu paquete en el elocker y 24 hrs para recogerlo.</p>
      <div>
        <v-btn v-if="!enableNextStepPay" round disabled large class="cover btn-active elevation-0">Pagar</v-btn>
        <v-btn v-else round large class="cover btn-active elevation-0" @click="openResumen()">Pagar</v-btn>
      </div>
    </div>
  </v-navigation-drawer>
  <div v-if="drawerRight" class="back-modal-active-admin" style="position:fixed;" @click.stop="drawerRight = false">_</div>

</div>



</template>

<script>
export default {

}
</script>

<style lang="scss">

</style>
