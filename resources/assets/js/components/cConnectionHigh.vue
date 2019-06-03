<template>
  <v-container class="pb-0 px-0">
    <v-layout row wrap class="wrapper-cover py-5">
      <v-flex xs12 class="text-center mb-3 mt-5">
        <h4 id="ser_servicio_descripcion" class="title-font-bold black--text">
          Creamos conexiones de alto valor <br>
          a través de la cadena logística
        </h4>
      </v-flex>
      <v-flex class="font-regular d-justify-center pt-3 pb-5">
        <cuadricula-services></cuadricula-services>
        <!-- <div class="container-chain">
          <div
            @click="goToFrom()"
            v-for="(el, i) in chainItems"
            :key="i"
            class="chain-card pa-4"
            :class="{'white': isImpar(i)}">
            <img :src="el.url" alt="">
            <span class="chain-text">{{el.name}}</span>
          </div>
        </div> -->
      </v-flex>
    </v-layout>
  </v-container>
</template>

<script>
import cuadriculaServices from './cCuadricula.vue'
export default {
  data () {
    return {
      chainItems: [
        {name: 'Probando', url: './images/icon_express.svg'},
        {name: 'Distribución <br />Nacional', url: './images/item_distribucion.png'},
        {name: 'Aduanas', url: './images/item_aduanas.png'},
        {name: 'Carga <br />Internacional', url: './images/item_carga_internacional.png'},
        {name: 'Carga <br />Doméstica', url: './images/item_domestica.png'},
        {name: 'Almacenes', url: './images/item_almacenes.png'},
        {name: 'Envíos <br />Internacionales', url: './images/item_internacionales.png'},
        {name: 'Scharff <br />Express', url: './images/item_express.png'},
        {name: 'Scharff <br />Stop', url: './images/item_stop.png'},
      ]
    }
  },
  methods: {
    goToFrom: function () {
      this.$scrollTo('#formGrow', 1000)
    },
    isImpar: function (i) {
      if(i<4){
        if(i % 2 == 0){
          return true
        } else {
          return false
        }
      } else {
        if(i % 2 != 0){
          return true
        } else {
          return false
        }
      }


    }
  },
  components: {
    'cuadricula-services': cuadriculaServices
  }

}
</script>

<style>

</style>
