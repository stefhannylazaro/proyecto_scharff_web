<template>
  <v-container fluid class="pb-0 px-0 py-0">
    <v-layout row wrap class="wrapper-cover">
      <v-flex xs12 sm4 md5 class="cover-col"> 
        <div class="container-left d-flex justify-center ">
          <div>
            <div class="d-flex pr-2 text-left">
              <h3 class="title-font-regular black--text">Revoluciona la<br>
                Forma de enviar
              </h3>
              <!-- <p class="send mb-0">envía</p> -->
              <p class="text-litle pt-3 mb-0">
                Haz tus envios y recibe paquetes<br>sin hacer trámites.
              </p>
            </div>
            <div class="py-3 btn-align-rigth">
              <v-btn round large outline class="cover black black--text">Reserva tu locker</v-btn>
            </div>
          </div>
        </div>
      </v-flex>
      <v-flex xs12 sm8 md7  class="container-left-stop py-5">
        <div class="wrapper-title-center pr-2 text-center">
          <h3 class="font-medium  black--text">¿Cómo funciona?
          </h3>
          <p class="white--text font-bold">Sigue estos tres simples pasos.</p>
        </div>
        <div class="flex-items">
            <div class="f-item pb-3 pt-5 text-center px-2 font-regular" v-for="(item, i) in ListItems" :key="item.title">
              <img class="f-imagen pb-3" :src="item.img" :alt="item.alt">
              <h3 class="black--text pb-2">{{item.title}}</h3>
              <p class="white--text">
                {{item.description}}
                <br v-if="i==0">
                <a class="text-underline"v-if="i==0" @click="stateChangeRegister()">aquí</a> 
              </p>
            </div>
        </div>
      </v-flex>
    </v-layout>
  </v-container>
</template>

<script>
export default {
  data () {
    return {
      peopleCover: {url:'./images/collage.png', alt: 'collage Scharff'},
      ListItems:[
        {title:'1.Regístrate', img: './images/icon_register.png', alt: 'Icon register', description: 'Crea tu cuenta' },
        {title:'2.Reserva', img: './images/icon_reserva.png', alt: 'Icon reserva', description: 'Separa el E-locker donde dejarás tu paquete y recibe tu código de envío.' },
        {title:'3.Usa tu código', img: './images/icon_usecode.png', alt: 'Icon QR', description: 'Ingresa tu código para entregar ó recoger tu paquete.' }
      ]
    }
  },
  methods: {
    stateChangeRegister: function () {
      let topCero = window.scrollTo(0,0)
      this.$store.commit('setStateRegister', true)
    }
  }
}
</script>

<style>
