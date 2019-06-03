<template>
  <v-container class="pb-0 px-0">
    <v-layout row wrap class="wrapper-cover">
      <v-flex class="pt-5">
        <h3 class="color-pink text-center font-bold title-component">
          ¿Cómo funciona?
        </h3>
        <p class="text-center font-medium sub-title-component">
          Sigue estos pasos
        </p>
      </v-flex>
      <v-flex xs12>
        <smartphone-control></smartphone-control>

      </v-flex>
      <!--<v-flex xs12>
      <v-stepper v-model="e6" vertical non-linear class="elevation-0">
        <v-layout row wrap>
          <v-flex xs12 sm6 class="d-align-center">
            <div class="stepper-control-express">
              <v-stepper-step class="stepper-item-control" step="1"  @click.native="e6 = 1">
                Punto de recojo
                <small v-show="e6==1">Ingresa tu dirección e informacion sobre donde se recojerá tu envió <br>
                  <a href="" class="black--text font-bold">Haz tu envió aquí</a>
                </small>
              </v-stepper-step>
              <v-stepper-step class="stepper-item-control" step="2"  @click.native="e6 = 2">
                Punto de entrega
                <small v-show="e6==2">Ingresa la información de destino donde se entregara tu envió</small>
              </v-stepper-step>

              <v-stepper-step class="stepper-item-control" step="3" @click.native="e6 = 3">
                Confirma tu envío
                <small v-show="e6==3">Listo! Llegara un scharffer a recoger y entregar tu paquete. Te notificaremos sobre el estado de tu envío.</small>
              </v-stepper-step>

            </div>
        </v-flex>
        <v-flex xs12 sm6>
          <v-stepper-content step="1" class="stepper-no-borders">
            <v-card color="" class="" height="32rem">
              <div class="d-justify-center mt-3">
                <img :src="stepOne.url">
              </div>
            </v-card>
        </v-stepper-content>
        <v-stepper-content step="2" class="stepper-no-borders">
          <v-card color="" class="" height="32rem">
              <div class="d-justify-center mt-3">
                <img :src="stepTwo.url">
              </div>
            </v-card>
        </v-stepper-content>
        <v-stepper-content step="3" class="stepper-no-borders">
          <v-card color="" class="" height="32rem">
              <div class="d-justify-center mt-3">
                <img :src="stepTree.url">
              </div>
            </v-card>
        </v-stepper-content>


        </v-flex>
        </v-layout>
      </v-stepper>
    </v-flex> -->
    </v-layout>
  </v-container>
</template>

<script>
import smartphonesSection from './cSmartPhoneControl.vue'
import { Carousel, Slide } from 'vue-carousel'
export default {
  data () {
    return {
      forYou: {url:'./images/person_1.png', alt: 'para ti Scharff'},
      forBusinesses: {url:'./images/person_2.png', alt: 'para empresas Scharff'},
      windowWidth: null,
      stepOne: {url:'./images/smartphone_express.png', alt: 'smartphone express'},
      stepTwo: {url:'./images/smartphone_express_2.png', alt: 'smartphone express'},
      stepTree: {url:'./images/smartphone_express_3.png', alt: 'smartphone express'},
      // controlsMobile: false,
      // itemOne: true,
      // itemTwo: true,
      number:2,
      e6: 1
    }
  },
  mounted () {
    this.$nextTick(function() {
      window.addEventListener('resize', this.getWindowWidth);
      this.getWindowWidth()
    })
  },
  watch: {
    windowWidth: function (el) {
      if(el>599) {
        // this.controlsMobile = false
        // this.itemOne = true
        // this.itemTwo = true
        this.number = 2
      } else {
        this.number = 1
        // this.controlsMobile = true
        // this.responsiveItems(true,false)
      }
    }
  },
  methods: {
    // responsiveItems: function (one, two) {
    //   this.itemOne = one
    //   this.itemTwo = two
    // },
    getWindowWidth(event) {
      this.windowWidth = document.documentElement.clientWidth
      // console.log(this.windowWidth)
    }
  },
  components: {
    Carousel,
    Slide,
    'smartphone-control': smartphonesSection,
  }
}
</script>

<style lang="scss">
@import "../../scss/vars.scss";
  .steper-aux{
    width: 100%;
    display: flex;
  }

</style>
